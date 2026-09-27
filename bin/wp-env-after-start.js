/**
 * wp-env `afterStart` lifecycle script (see .wp-env.json): creates the résumé
 * subsite, activates themes and network plugins, then installs and builds
 * both themes, skipping whatever is already up to date.
 */
const { execSync } = require( 'child_process' );
const fs = require( 'fs' );
const path = require( 'path' );

const RESUME_URL = 'http://localhost:8890/resume/';

const run = ( command ) => execSync( command, { stdio: 'inherit' } );

// Fails on every start after the first because the subsite already exists.
try {
	run( 'wp-env run cli wp site create --slug=resume --title=Resume' );
} catch {}

run( 'wp-env run cli wp theme activate personal-theme' );
run(
	'wp-env run cli wp plugin activate --network advanced-custom-fields-pro dark-mode-toggle-block wordpress-seo translatepress-multilingual'
);
run( `wp-env run cli wp theme activate resume --url=${ RESUME_URL }` );

// npm rewrites node_modules/.package-lock.json on every install, so comparing
// it with the theme's lockfile tells whether dependencies changed since then.
const needsInstall = ( theme ) => {
	const installed = path.join( theme, 'node_modules', '.package-lock.json' );
	return (
		! fs.existsSync( installed ) ||
		fs.statSync( path.join( theme, 'package-lock.json' ) ).mtimeMs >
			fs.statSync( installed ).mtimeMs
	);
};

for ( const theme of [ 'themes/personal-theme', 'themes/resume' ] ) {
	if ( needsInstall( theme ) ) {
		run( `npm --prefix ${ theme } ci` );
	}
	if ( ! fs.existsSync( path.join( theme, 'build' ) ) ) {
		run( `npm --prefix ${ theme } run build` );
	}
}
