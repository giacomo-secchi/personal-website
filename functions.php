<?php

add_action( 'init', function() {
    register_block_bindings_source( 'personal-website/experience-text', array(
        'label'              => __( 'Experience Phrase', 'personal-website' ),
        'get_value_callback' => function( $source_args ) {
            $user_id = isset( $source_args['user_id'] ) ? (int) $source_args['user_id'] : 1;
            $since = get_user_meta( $user_id, 'start_year', true );

            $years = (int) date('Y') - $since;

            $user_data = get_userdata( $user_id );

            if ( ! $user_data ) {
                return '';
            }

            $template = $user_data->description;

            return sprintf( 
                esc_html( __( $template, 'personal-website' ) ), 
                $years 
            );
        },
    ) );

    register_block_bindings_source( 'personal-website/user-full-name', array(
        'label'              => __( 'User Name and Surname', 'personal-website' ),
        'get_value_callback' => function( $source_args ) {

            $user_id = isset( $source_args['user_id'] ) ? (int) $source_args['user_id'] : 1;
            $user_data = get_userdata( $user_id );

            if ( ! $user_data ) {
                return '';
            }

            $first_name = $user_data->first_name;
            $last_name  = $user_data->last_name;

            if ( ! empty( $first_name ) || ! empty( $last_name ) ) {
                return trim( $first_name . ' ' . $last_name );
            }

            return $user_data->display_name;
        },
    ) );

    register_block_bindings_source( 'personal-website/user-email', array(
        'label'              => __( 'Link Email Protetto', 'personal-website' ),
        'get_value_callback' => function( $source_args ) {
            $user_id = isset( $source_args['user_id'] ) ? (int) $source_args['user_id'] : 1;
            $email = get_user_meta( $user_id, 'public_email', true );

            $safe_email = antispambot( $email );
        
             // Restituiamo l'intero tag <a> con l'email offuscata sia nel testo che nel link
            return sprintf( '<a href="mailto:%s">%s</a>', $safe_email, $safe_email );
        }
    ) );
} );



add_action( 'show_user_profile', 'personal_website_custom_user_fields' );
add_action( 'edit_user_profile', 'personal_website_custom_user_fields' );

function personal_website_custom_user_fields( $user ) {
    ?>
    <h3><?php esc_html_e( 'Profile Informations', 'personal-website' ); ?></h3>
    <table class="form-table">
        <tr>
            <th>
                <label for="start_year"><?php esc_html_e( 'Career Start Year', 'personal-website' ); ?></label>
            </th>
            <td>
                <input type="number" 
                    name="start_year" 
                    id="start_year" 
                    value="<?php echo esc_attr( get_the_author_meta( 'start_year', $user->ID ) ); ?>" 
                    min="1990" 
                    max="<?php echo date('Y'); ?>" 
                    step="1" 
                    class="regular-text" />
            </td>
        </tr>
        <tr>
            <th>
                <label for="public_email"><?php esc_html_e( 'Pubblic Email (for contacts)', 'personal-website' ); ?></label>
            </th>
            <td>
                <input type="email" 
                    name="public_email" 
                    id="public_email" 
                    value="<?php echo esc_attr( get_the_author_meta( 'public_email', $user->ID ) ); ?>" 
                    class="regular-text" />
            </td>
        </tr>
    </table>
    <?php
}

// 2. Salva i dati quando aggiorni il profilo
add_action( 'personal_options_update', 'save_personal_website_custom_user_fields' );
add_action( 'edit_user_profile_update', 'save_personal_website_custom_user_fields' );

function save_personal_website_custom_user_fields( $user_id ) {
    if ( ! current_user_can( 'edit_user', $user_id ) ) {
        return false;
    }

    update_user_meta( $user_id, 'start_year', $_POST['start_year'] );
    update_user_meta( $user_id, 'public_email', $_POST['public_email'] );
}