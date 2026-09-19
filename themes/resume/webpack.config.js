// WordPress webpack config.
const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );

// Plugins.
const CopyPlugin = require( 'copy-webpack-plugin' );

const patch = ( config ) => {
	config.plugins.push(
		new CopyPlugin( {
			patterns: [
				{
					from: 'node_modules/bootstrap-icons/icons',
					to: 'bootstrap-icons',
				},
				{
					from: './src/fonts',
					to: './fonts',
				},
				{
					from: './src/css',
					to: './css',
				},
			],
		} )
	);
	return config;
};

module.exports = Array.isArray( defaultConfig )
	? defaultConfig.map( patch )
	: patch( defaultConfig );
