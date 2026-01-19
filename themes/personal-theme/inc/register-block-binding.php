<?php




add_action( 'init', function() {

    register_block_bindings_source( 'personal-website/user-full-name', array(
        'label'              => __( 'User Name and Surname', 'personal-website' ),
        'get_value_callback' => function( $source_args ) {

            $admin = get_personal_website_admin_user();
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

            $admin = get_personal_website_admin_user();
            $job = get_user_meta(  $admin->ID, 'job_role', true );


            if ( ! $job ) {
                return '';
            }
            return $job;
        },
    ) );

    register_block_bindings_source( 'personal-website/user-email', array(
        'label'              => __( 'Protected email Link', 'personal-website' ),
        'get_value_callback' => function( $source_args ) {
            $admin = get_personal_website_admin_user();
            $email = get_user_meta( $admin->ID, 'public_email', true );

            $safe_email = antispambot( $email );

             // Restituiamo l'intero tag <a> con l'email offuscata sia nel testo che nel link
            return sprintf( '<a href="mailto:%s">%s</a>', $safe_email, $safe_email );
        }
    ) );


} );


/**
 * Retrieves the portfolio administrator user object based on the saved login name.
 *
 * @return WP_User|false Returns the WP_User object on success, or false on failure.
 */
function get_personal_website_admin_user() {
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
