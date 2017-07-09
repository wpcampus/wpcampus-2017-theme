<?php

/**
 * Holds the back-end admin
 * functionality for the plugin.
 */
class WPCampus_2017_Admin {

	/**
	 * Holds the class instance.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @var		WPCampus_2017_Admin
	 */
	private static $instance;

	/**
	 * Returns the instance of this class.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return	WPCampus_2017_Admin
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			$class_name = __CLASS__;
			self::$instance = new $class_name;
		}
		return self::$instance;
	}

	/**
	 * Warming things up.
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	protected function __construct() {

		// Add meta boxes.
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 1, 2 );

		// Save meta box data.
		add_action( 'save_post', array( $this, 'save_meta_box_data' ), 20, 3 );
	}

	/**
	 * Method to keep our instance from
	 * being cloned or unserialized.
	 *
	 * @since	1.0.0
	 * @access	private
	 * @return	void
	 */
	private function __clone() {}
	private function __wakeup() {}

	/**
	 * Adds our admin meta boxes.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @param   $post_type - string - the post type
	 * @param   $post - WP_Post - the post object
	 * @return  void
	 */
	public function add_meta_boxes( $post_type, $post ) {

		// Add to all post types.
		add_meta_box(
			'wpc-2017-layout',
			__( 'Layout Options', 'wpcampus' ),
			array( $this, 'print_meta_boxes' ),
			$post_type,
			'normal',
			'high'
		);
	}

	/**
	 * Prints the content in our admin meta boxes.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @param   $post - WP_Post - the post object
	 * @param   $metabox - array - meta box arguments
	 * @return  void
	 */
	public function print_meta_boxes( $post, $metabox ) {
		switch ( $metabox['id'] ) {

			case 'wpc-2017-layout':

				// Add a nonce field so we can check for it when saving the data.
				wp_nonce_field( 'wpc_2017_save_layout', 'wpc_2017_save_layout_nonce' );

				// Get saved event details.
				$layout = get_post_meta( $post->ID, 'wpc_2017_layout', true );

				?>
				<table class="form-table">
					<tbody>
						<tr>
							<td>
								<label for="wpc-2017-layout"><?php _e( 'Choose the layout:', 'wpcampus' ); ?></label>
								<select name="wpc_2017_layout" id="wpc-2017-layout" class="postform">
									<option value=""><?php _e( 'Default', 'wpcampus' ); ?></option>
									<option value="fullwidth"<?php selected( 'fullwidth' == $layout ); ?>><?php _e( 'Full Width', 'wpcampus' ); ?></option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
				<?php
				break;
		}
	}

	/**
	 * When the post is saved, saves our custom meta box data.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @param   int - $post_id - the ID of the post being saved
	 * @param   WP_Post - $post - the post object
	 * @param   bool - $update - whether this is an existing post being updated or not
	 * @return  void
	 */
	function save_meta_box_data( $post_id, $post, $update ) {

		// Disregard on autosave.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Not for auto drafts.
		if ( 'auto-draft' == $post->post_status ) {
			return;
		}

		// Make sure user has permissions.
		$post_type_object = get_post_type_object( $post->post_type );
		$user_has_cap = $post_type_object && isset( $post_type_object->cap->edit_post ) ? current_user_can( $post_type_object->cap->edit_post, $post_id ) : false;

		if ( ! $user_has_cap ) {
			return;
		}

		// Check if our nonce is set because the 'save_post' action can be triggered at other times.
		if ( isset( $_POST['wpc_2017_save_layout_nonce'] ) ) {

			// Verify the nonce.
			if ( wp_verify_nonce( $_POST['wpc_2017_save_layout_nonce'], 'wpc_2017_save_layout' ) ) {

				// Make sure layout is set.
				if ( isset( $_POST['wpc_2017_layout'] ) ) {

					// Sanitize the value.
					$layout = sanitize_text_field( $_POST['wpc_2017_layout'] );

					// Update/save value.
					update_post_meta( $post_id, 'wpc_2017_layout', $layout );

				}
			}
		}
	}
}

/**
 * Returns the instance of our WPCampus_2017_Admin class.
 *
 * Will come in handy when we need to access the
 * class to retrieve data throughout the plugin.
 *
 * @since	1.0.0
 * @access	public
 * @return	WPCampus_2017_Admin
 */
function wpcampus_2017_admin() {
	return WPCampus_2017_Admin::instance();
}

// Let's get this show on the road.
wpcampus_2017_admin();
