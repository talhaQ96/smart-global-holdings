// Project options.
const config = require('./gulp.config.js');
const gulp = require('gulp');

// CSS related plugins.
const sass = require('gulp-sass');
const minifycss = require('gulp-uglifycss');
const autoprefixer = require('gulp-autoprefixer');
const mmq = require('gulp-merge-media-queries');

// JS related plugins.
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');
const babel = require('gulp-babel');

// Utility related plugins.
const rename = require('gulp-rename');
const lineec = require('gulp-line-ending-corrector');
const filter = require('gulp-filter');
const sourcemaps = require('gulp-sourcemaps');
const notify = require('gulp-notify');
const browserSync = require('browser-sync').create();
const remember = require('gulp-remember');
const plumber = require('gulp-plumber');
const beep = require('beepbeep');
const merge = require('merge-stream');
const defaults = require('lodash.defaults');

const errorHandler = r => {
	notify.onError('\n\n❌  ===> ERROR: <%= error.message %>\n')(r);
	beep();
	// this.emit('end');
};

const browsersync = done => {
	browserSync.init({
		proxy: config.projectURL,
		open: config.browserAutoOpen,
		injectChanges: config.injectChanges,
		watchEvents: ['change', 'add', 'unlink', 'addDir', 'unlinkDir']
	});
	done();
};

const reload = done => {
	browserSync.reload();
	done();
};

function processStyle(gulpStream, processOptions = {}) {
	processOptions = defaults(processOptions, {
		isRTL: false,
		styleDestination: config.styleDestination,
	});

	return gulpStream
		.pipe(plumber(errorHandler))
		.pipe(sourcemaps.init())
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on('error', sass.logError)
		.pipe(sourcemaps.write({includeContent: false}))
		.pipe(sourcemaps.init({loadMaps: true}))
		.pipe(autoprefixer(config.BROWSERS_LIST))
		.pipe(sourcemaps.write('./'))
		.pipe(lineec())
		.pipe(gulp.dest(processOptions.styleDestination))
		.pipe(filter('**/*.css'))
		.pipe(mmq({log: true}))
		.pipe(browserSync.stream())
		.pipe(rename({suffix: '.min'}))
		.pipe(minifycss({maxLineLen: 10}))
		.pipe(lineec())
		.pipe(gulp.dest(processOptions.styleDestination))
		.pipe(filter('**/*.css'))
		.pipe(browserSync.stream())
		;
}

gulp.task('styles', () => {
	return processStyle(
		gulp.src(config.styleSRC, {allowEmpty: true})
	).pipe(notify({message: '\n\n✅  ===> STYLES — completed!\n', onLast: true}));
});

gulp.task('addonStyles', (done) => {
	// Exit task when no addon styles
	if (config.addonStyles.length === 0) {
		return done();
	}

	// Process each addon style
	var tasks = config.addonStyles.map(function (addon) {

		return processStyle(
			gulp.src(addon.styleSRC, {allowEmpty: true}),
			{styleDestination: addon.styleDestination}
		).pipe(notify({message: '\n\n✅  ===> ADDON STYLES — completed!\n', onLast: true}));

	});

	return merge(tasks);
});

gulp.task('vendorsJS', () => {
	return gulp
		.src(config.jsVendorSRC, {since: gulp.lastRun('vendorsJS')})
		.pipe(plumber(errorHandler))
		.pipe(
			babel({
				presets: [
					[
						'@babel/preset-env',
						{
							targets: {browsers: config.BROWSERS_LIST}
						}
					]
				]
			})
		)
		.pipe(remember(config.jsVendorSRC))
		.pipe(concat(config.jsVendorFile + '.js'))
		.pipe(lineec())
		.pipe(gulp.dest(config.jsVendorDestination))
		.pipe(
			rename({
				basename: config.jsVendorFile,
				suffix: '.min'
			})
		)
		.pipe(uglify())
		.pipe(lineec())
		.pipe(gulp.dest(config.jsVendorDestination))
		.pipe(
			notify({
				message: '\n\n✅  ===> VENDOR JS — completed!\n',
				onLast: true
			})
		);
});

gulp.task('customJS', () => {
	return gulp
		.src(config.jsCustomSRC, {since: gulp.lastRun('customJS')})
		.pipe(plumber(errorHandler))
		.pipe(
			babel({
				presets: [
					[
						'@babel/preset-env',
						{
							targets: {browsers: config.BROWSERS_LIST}
						}
					]
				]
			})
		)
		.pipe(remember(config.jsCustomSRC))
		.pipe(concat(config.jsCustomFile + '.js'))
		.pipe(lineec())
		.pipe(gulp.dest(config.jsCustomDestination))
		.pipe(
			rename({
				basename: config.jsCustomFile,
				suffix: '.min'
			})
		)
		.pipe(uglify())
		.pipe(lineec())
		.pipe(gulp.dest(config.jsCustomDestination))
		.pipe(
			notify({
				message: '\n\n✅  ===> CUSTOM JS — completed!\n',
				onLast: true
			})
		);
});

gulp.task(
	'default',
	gulp.parallel('styles', 'addonStyles', 'vendorsJS', 'customJS', browsersync, () => {
		gulp.watch(config.watchPhp, reload);
		gulp.watch(config.watchStyles, gulp.parallel('styles', 'addonStyles'));
		gulp.watch(config.watchJsVendor, gulp.series('vendorsJS', reload));
		gulp.watch(config.watchJsCustom, gulp.series('customJS', reload));
	})
);
