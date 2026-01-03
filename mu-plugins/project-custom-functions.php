<?php

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
        <tr>
            <th>
                <label for="portfolio_experience_text"><?php esc_html_e( 'Portfolio Experience Phrase', 'personal-website' ); ?></label>
            </th>
            <td>
                <textarea name="portfolio_experience_text" 
                    id="portfolio_experience_text" 
                    rows="3" 
                    cols="30" 
                    class="regular-text"><?php echo esc_textarea( get_the_author_meta( 'portfolio_experience_text', $user->ID ) ); ?></textarea>
                <p class="description">
                    <?php esc_html_e( 'Use %d to display the calculated years of experience.', 'personal-website' ); ?>
                </p>
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
    update_user_meta( $user_id, 'portfolio_experience_text', sanitize_textarea_field( $_POST['portfolio_experience_text'] ) );
}

