<?php

// Enable ACF shortcode support
add_filter( 'acf/settings/enable_shortcode', '__return_true' );

// Allow ACF shortcodes in FSE templates (blocked by default outside the_content)
add_filter( 'acf/shortcode/allow_in_block_themes_outside_content', '__return_true' );
