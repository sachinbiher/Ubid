<?php

/*
 *  Customizer Notifications
 */ 

require get_template_directory() . '/inc/customizer/customizer-notice/designexo-customizer-notify.php';
$designexo_config_customizer = array(
    'recommended_plugins' => array( 
        'arile-extra' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to show all the features and business sections of the FrontPage. please install and activate %s plugin', 'designexo' ), '<strong>Arile Extra</strong>' 
            ),
        ),
    ),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'designexo' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'designexo' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'designexo' ),
	'activate_button_label'     => esc_html__( 'Activate', 'designexo' ),
	'designexo_deactivate_button_label'   => esc_html__( 'Deactivate', 'designexo' ),
);
Designexo_Customizer_Notify::init( apply_filters( 'designexo_customizer_notify_array', $designexo_config_customizer ) );