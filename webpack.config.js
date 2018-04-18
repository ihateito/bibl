var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')
		.createSharedEntry('vendor', [
				'jquery',
				'jsgrid',
				'./node_modules/jsgrid/css/jsgrid.css',
    './node_modules/jsgrid/css/theme.css'
		])
		.addEntry('app', './assets/js/app.js')

// allow sass/scss files to be processed
		.enableSassLoader()

		// allow legacy applications to use $/jQuery as a global variable
		.autoProvidejQuery()

		.enableSourceMaps(!Encore.isProduction())

// empty the outputPath dir before each build
		.cleanupOutputBeforeBuild()

		// show OS notifications when builds finish/fail
		.enableBuildNotifications()

// create hashed filenames (e.g. app.abc123.css)
// .enableVersioning()
;


module.exports = Encore.getWebpackConfig();
