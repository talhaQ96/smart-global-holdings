module.exports = {

	projectURL: 'gulp.local',
	productURL: './',
	browserAutoOpen: false,
	injectChanges: true,

	// Style options.
	styleSRC: './assets/scss/core.scss',
	styleDestination: './assets/css/',
	outputStyle: 'compact',
	errLogToConsole: true,
	precision: 10,

	// Add-on Style options
	// The following list is a set of SCSS/CSS files which you want to process and place it on a different folder.
	addonStyles: [
		{
			styleSRC: './assets/scss/templates/home.scss',
			styleDestination: './assets/css/templates/',
		},
		{
			styleSRC: './assets/scss/templates/page.scss',
			styleDestination: './assets/css/templates/',
		},
		{
			styleSRC: './assets/scss/templates/archive.scss',
			styleDestination: './assets/css/templates/',
		},
		{
			styleSRC: './assets/scss/blocks/social-accounts.scss',
			styleDestination: './assets/css/block/',
		},
		{
			styleSRC: './assets/scss/blocks/solution.scss',
			styleDestination: './assets/css/block/',
		},
	],

	// JS Vendor options.
	jsVendorSRC: './assets/js/vendor/*.js',
	jsVendorDestination: './assets/js/',
	jsVendorFile: 'vendor',

	// JS Custom options.
	jsCustomSRC: './assets/js/custom/*.js',
	jsCustomDestination: './assets/js/',
	jsCustomFile: 'custom',

	// Watch files paths.
	watchStyles: './assets/scss/**/*.scss',
	watchJsVendor: './assets/js/vendor/*.js',
	watchJsCustom: './assets/js/custom/*.js',
	watchPhp: './**/*.php',

	BROWSERS_LIST: ['last 2 version', '> 1%']
};
