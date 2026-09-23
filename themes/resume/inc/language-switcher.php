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
            $html .= "<a href='{$item['current_page_url']}' hreflang='{$item['language_code']}'>";
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
            gap: 10px;
            margin: 0;
            padding: 0;
        }
        .trp-custom-language-switcher li {
            list-style: none;
        }
        .trp-custom-language-switcher li:not(:last-child)::after {
            content: "/";
            margin-left: 10px;
        }
        .trp-custom-language-switcher a {
            text-decoration: none;
        }
        .trp-custom-language-switcher li.trp-custom-ls-current a {
            font-weight: 700;
            pointer-events: none;
        }
    </style>
    <?php
} );
