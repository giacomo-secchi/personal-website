<?php

// Custom TranslatePress language switcher that lists all languages inline (no dropdown)
add_shortcode( 'custom-language-switcher', function() {
    if ( ! function_exists( 'trp_custom_language_switcher' ) ) {
        return '';
    }

    // Check whether TranslatePress can run on the current path or not. If the path is excluded from translation, trp_allow_tp_to_run will be false
    if ( apply_filters( 'trp_allow_tp_to_run', true ) ){
        global $TRP_LANGUAGE;
        $languages = trp_custom_language_switcher();
        $html = '<ul class="trp-custom-language-switcher" data-no-translation>';
        foreach ( $languages as $item ) {
            $is_current = ( $item['language_code'] === $TRP_LANGUAGE );
            $li_class = $is_current ? ' class="trp-custom-ls-current"' : '';
            $html .= "<li{$li_class}>";
            $aria_current = $is_current ? " aria-current='page'" : '';
            $html .= "<a href='{$item['current_page_url']}' hreflang='{$item['language_code']}'{$aria_current}>";
            $html .= "<span>{$item['language_name']}</span></a></li>";
        }
        $html .= '</ul>';
        return $html;
    }
} );

// Inline styles for the custom language switcher above
add_action( 'wp_head', function() {
    ?>
    <style>
        .trp-custom-language-switcher {
            display: flex;
            align-items: center;
            gap: var(--wp--preset--spacing--20);
            margin: 0;
            padding: 0;
        }
        .trp-custom-language-switcher li {
            list-style: none;
        }
        .trp-custom-language-switcher li:not(:last-child)::after {
            content: "/";
            margin-left: var(--wp--preset--spacing--20);
            color: color-mix(in srgb, currentColor 70%, transparent);
        }
        .trp-custom-language-switcher a {
            text-decoration: none;
            color: color-mix(in srgb, currentColor 70%, transparent);
            transition: color 0.2s ease;
        }
        .trp-custom-language-switcher a:hover,
        .trp-custom-language-switcher a:focus-visible,
        .trp-custom-language-switcher li.trp-custom-ls-current a {
            color: inherit;
        }
        .trp-custom-language-switcher li.trp-custom-ls-current a {
            pointer-events: none;
        }
    </style>
    <?php
} );
