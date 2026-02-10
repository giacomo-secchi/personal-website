<?php

/**
 * Registers the blocks using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 * Auto register all blocks found in the `build/blocks` folder.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function auto_register_block_types() {
	if ( file_exists( dirname( __DIR__ ) . '/assets/blocks/' ) ) {
		$block_json_files = glob( dirname( __DIR__ ) . '/assets/blocks/*/block.json' );

		// auto register all blocks that were found.
		foreach ( $block_json_files as $filename ) {
			$block_folder = dirname( $filename );
			register_block_type( $block_folder );
		};
	};
}
add_action( 'init', 'auto_register_block_types' );