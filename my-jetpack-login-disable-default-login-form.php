<?php
/**
 * @package Jetpack Login - Disable Default Login Form
 * @version 1.0
 */
/*
Plugin Name: Jetpack Login
Plugin URI: https://ultimatetech.org/
Description: This plugin simply remove default Login Form from login page. If you are really sick of spam logins that are happening gain and again, then simply use this plugin. If you login with WordPress.Com then it will almost be impossible to hack your website.
Author: Harman Singh Hira
Version: 1.0
Author URI: http://hsinghhira.me
*/

/* Jetpack Required Notice - Backend Work
======================================================================================================================*/

add_action( 'admin_init', 'hsh_requirejetpack143' );
function hsh_requirejetpack143() {
    if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'jetpack/jetpack.php' ) ) {
        add_action( 'admin_notices', 'hsh_requirejetpack_notice' );

        deactivate_plugins( plugin_basename( __FILE__ ) ); 

        if ( isset( $_GET['activate'] ) ) {
            unset( $_GET['activate'] );
        }
    }
}

/* Jetpack Required Notice
======================================================================================================================*/

function hsh_requirejetpack_notice(){
    ?><div class="error"><p>'Jetpack Login' requires <a href="<?php echo get_home_url(); ?>/wp-admin/plugin-install.php?tab=plugin-information&plugin=jetpack&TB_iframe=true&width=772&height=280" class="thickbox open-plugin-details-modal">Jetpack</a> plugin. Please Install and Activate it first to use Jetpack Login. Thanks :)</p></div><?php
}

/* Add Help Link into Tools Menu
======================================================================================================================*/

add_action('admin_menu', 'add_hshjetpackplugin_link_into_appearnace_menu');
function add_hshjetpackplugin_link_into_appearnace_menu() {
    global $submenu;
    $permalink = 'http://www.ultimatetech.org';
    $submenu['tools.php'][] = array( 'Jetpack Login Guide', 'manage_options', $permalink );
}

/* Add Footer Links
======================================================================================================================*/

add_filter('admin_footer_text', 'ut_remove_footer_admin_jetpackloginsecure');
function ut_remove_footer_admin_jetpackloginsecure () {

echo '<span id="footer-thankyou">Fueled by <a href="http://www.wordpress.org" target="_blank">WordPress</a> | Developed with 💓 & 🍕 @ <a href="http://www.ultimatetech.org" target="_blank">Ultimate Tech</a> | Get Most Cheap <a href="https://blogbing.com/ultimatetech" target="_blank">Managed WordPress Hosting</a> in just $3.80</span>';

}

/* Add Help Link to Plugin Section
======================================================================================================================*/

add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'ut_hsh_jetpackloginplugin_action_links143' );
function ut_hsh_jetpackloginplugin_action_links143( $links ) {
	$links = array_merge( array(
		'<b><a target="_blank" href="https://www.ultimatetech.org">' . __( 'Help❓', 'textdomain' ) . '</a></b>'
	), $links );
	return $links;
}

/* Disable Default Login Form
======================================================================================================================*/
add_filter( 'jetpack_remove_login_form', '__return_true' );