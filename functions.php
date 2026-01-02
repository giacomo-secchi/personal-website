<?php

add_action( 'init', function() {
    register_block_bindings_source( 'personal-website/experience-text', array(
        'label'              => __( 'Experience Phrase', 'personal-website' ),
        'get_value_callback' => function( $source_args ) {
            $admin = get_personal_website_admin();

            if ( ! $admin ) {
                return;
            }

            $since = get_user_meta( $admin->ID, 'start_year', true );
            $years = (int) date('Y') - $since;
            $user_data = get_userdata( $admin->ID );

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

            $admin = get_personal_website_admin();
            $user_data = get_userdata( $admin->ID );

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

        register_block_bindings_source( 'personal-website/job-position', array(
            'label'              => __( 'Job Position', 'personal-website' ),
            'get_value_callback' => function( $source_args ) {

                $admin = get_personal_website_admin();
                $job = get_user_meta(  $admin->ID, 'job_role', true );


                if ( ! $job ) {
                    return '';
                }
                return $job;
            },
        ) );

    register_block_bindings_source( 'personal-website/user-email', array(
        'label'              => __( 'Link Email Protetto', 'personal-website' ),
        'get_value_callback' => function( $source_args ) {
            $admin = get_personal_website_admin();
            $email = get_user_meta( $admin->ID, 'public_email', true );

            $safe_email = antispambot( $email );
        
             // Restituiamo l'intero tag <a> con l'email offuscata sia nel testo che nel link
            return sprintf( '<a href="mailto:%s">%s</a>', $safe_email, $safe_email );
        }
    ) );
} );

add_action( 'admin_init', function() {

    register_setting( 'general', 'personal_website_user_login' );
   
    add_settings_field( 
        'personal_website_user_login', 
        __( 'Portfolio Administrator', 'personal-website' ), 
        function() {
            // Recuperiamo il valore corretto usando la chiave registrata
            $current_value = get_option( 'personal_website_user_login', '' );
            
            $admins = get_users( array( 'role' => 'administrator' ) );
            
            // IMPORTANTE: Il name deve essere IDENTICO alla chiave registrata sopra
            echo '<select name="personal_website_user_login">';
            echo '<option value="">' . esc_html__( 'Select an user…', 'personal-website' ) . '</option>';
            
            foreach ( $admins as $admin ) {
                printf( 
                    '<option value="%s" %s>%s</option>', 
                    esc_attr( $admin->user_login ), 
                    selected( $current_value, $admin->user_login, false ), 
                    esc_html( $admin->display_name ) 
                );
            }
            echo '</select>';
        }, 
        'general' 
    );
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
                <label for="job_role"><?php esc_html_e( 'Job Position', 'personal-website' ); ?></label>
            </th>
            <td>
                <input type="text" 
                    name="job_role" 
                    id="job_role" 
                    value="<?php echo esc_attr( get_the_author_meta( 'job_role', $user->ID ) ); ?>" 
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
    update_user_meta( $user_id, 'job_role', $_POST['job_role'] );
}


/**
 * Retrieves the portfolio administrator user object based on the saved login name.
 *
 * @return WP_User|false Returns the WP_User object on success, or false on failure.
 */
function get_personal_website_admin() {
    // 1. Get the login name saved in General Settings
    $user_login = get_option( 'personal_website_user_login' );

    if ( ! empty( $user_login ) ) {
        // 2. Fetch the user by their login name
        $user = get_user_by( 'login', $user_login );
        if ( $user ) {
            return $user;
        }
    }

    // 3. Fallback: If no setting is saved, return the first administrator found
    $admins = get_users( array( 
        'role'    => 'administrator', 
        'number'  => 1,
        'orderby' => 'ID',
        'order'   => 'ASC'
    ) );

    return ! empty( $admins ) ? $admins[0] : false;
}