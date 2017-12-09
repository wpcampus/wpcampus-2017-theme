const autoprefixer = require('gulp-autoprefixer');
const bourbon = require('bourbon').includePaths;
const cleanCSS = require('gulp-clean-css');
const gulp = require('gulp');
const mergeMediaQueries = require('gulp-merge-media-queries');
const minify = require('gulp-minify');
const neat = require('bourbon-neat').includePaths;
const normalize = require('node-normalize-scss').includePaths;
const notify = require('gulp-notify');
const rename = require('gulp-rename');
const sass = require('gulp-sass');
const shell = require('gulp-shell');

const sassIncludes = [].concat(normalize,bourbon,neat);

// Define the source paths for each file type.
const src = {
	js: ['assets/js/wpcampus.js','assets/js/wpcampus-livestream.js','assets/js/wpcampus-map.js'],
	php: ['**/*.php','!vendor/**','!node_modules/**'],
	sass: ['assets/scss/**/*','!assets/scss/components']
};

// Define the destination paths for each file type.
const dest = {
	js: 'assets/js',
	sass: 'assets/css'
};

// Compile our JS.
gulp.task('js',function() {
	gulp.src(src.js)
		.pipe(minify({
			mangle: false,
			ext: {
				min: '.min.js'
			}
		}))
		.pipe(gulp.dest(dest.js))
		.pipe(notify('WPC 2017 JS compiled'));
});

// Compile our SASS.
gulp.task('sass', function() {
	return gulp.src(src.sass)
		.pipe(sass({
			includePaths: sassIncludes,
			outputStyle: 'compressed'
		}).on('error', sass.logError))
		.pipe(mergeMediaQueries())
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		.pipe(cleanCSS({
			compatibility: 'ie8'
		}))
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(gulp.dest(dest.sass))
		.pipe(notify('WPC 2017 SASS compiled'));
});

// "Sniff" our PHP.
gulp.task('php', function() {
	// TODO: Clean up. Want to run command and show notify for sniff errors.
	return gulp.src('index.php', {read: false})
		.pipe(shell(['composer sniff'], {
			ignoreErrors: true,
			verbose: false
		}))
		.pipe(notify('WPC 2017 PHP sniffed'), {
			onLast: true,
			emitError: true
		});
});

// Test our files.
gulp.task('test',['php']);

// Compile all the things.
gulp.task('compile',['sass','js']);

// I've got my eyes on you(r file changes).
gulp.task('watch',function() {
	gulp.watch(src.js,['js']);
	gulp.watch(src.php,['php']);
	gulp.watch(src.sass,['sass']);
});

// Let's get this party started.
gulp.task('default',['compile','test']);