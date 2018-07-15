<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/admin
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Admin extends Plugin_Name_Abstract
{
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
    {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->get_plugin_name(), plugin_dir_url( __FILE__ ) . 'css/plugin-name-admin.css', array(), $this->get_plugin_version(), 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
    {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->get_plugin_name(), plugin_dir_url( __FILE__ ) . 'js/plugin-name-admin.js', array( 'jquery' ), $this->get_plugin_version(), false );
	}

    public function add_plugin_admin_menu()
    {
        add_options_page(
            $this->trans( 'WordPress Plugin Boilerplate Options' ),
            $this->trans( 'WordPress Plugin Boilerplate Options' ),
            'manage_options',
            $this->get_plugin_name(),
            [ $this, 'display_plugin_options_page' ]
        );
    }

    public function add_action_links( array $links ) : array
    {
        $settings_link = [
            '<a href="' . admin_url( 'options-general.php?page=' . $this->get_plugin_name() ) . '">' . $this->trans( 'Settings' ) . '</a>',
        ];

        return array_merge(  $settings_link, $links );
    }

    public function display_plugin_options_page()
    {
        include_once plugin_dir_url( __FILE__ ) . 'partials/plugin-name-admin-display.php';
    }
}
