<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class Plugin_Name extends Plugin_Name_Abstract
{
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Plugin_Name_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

    /**
     * I18n class for register and translating
     *
     * @var Plugin_Name_i18n
     */
    protected $i18n;

    /**
     * @var Plugin_Name_Admin
     */
    protected $admin;

    /**
     * @var Plugin_Name_Public
     */
    protected $public;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
     *
     * @param string $plugin_name
     * @param string $plugin_version
	 */
    public function __construct( string $plugin_name, string $plugin_version )
    {
        parent::__construct( $plugin_name, $plugin_version );

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
	 * - Plugin_Name_i18n. Defines internationalization functionality.
	 * - Plugin_Name_Admin. Defines all hooks for the admin area.
	 * - Plugin_Name_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
    {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-plugin-name-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-plugin-name-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-plugin-name-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-plugin-name-public.php';
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Name_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
    {
        $this->get_loader()->add_action( 'plugins_loaded', $this->get_i18n(), 'load_plugin_textdomain' );
    }

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
    {
        $this->get_loader()->add_action( 'admin_enqueue_scripts', $this->get_admin(), 'enqueue_styles' );
        $this->get_loader()->add_action( 'admin_enqueue_scripts', $this->get_admin(), 'enqueue_scripts' );

        if ( function_exists( 'acf_add_options_page' ) ) {
            $this->get_loader()->add_action( 'acf/init', $this->get_admin(), 'add_acf_plugin_admin_menu' );
        } else {
            $this->get_loader()->add_action( 'admin_menu', $this->get_admin(), 'add_plugin_admin_menu' );
        }

        $plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->get_plugin_name() . '.php' );
        $this->get_loader()->add_filter( 'plugin_action_links_' . $plugin_basename, $this->get_admin(), 'add_action_links' );
    }

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
    {
        $this->get_loader()->add_action( 'wp_enqueue_scripts', $this->get_public(), 'enqueue_styles' );
        $this->get_loader()->add_action( 'wp_enqueue_scripts', $this->get_public(), 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
    {
		$this->get_loader()->run();
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
    {
        if (! $this->loader) {
            $this->loader = new Plugin_Name_Loader();
        }

		return $this->loader;
	}

    /**
     * Retrieve the I18n object
     *
     * @since 1.1.0
     *
     * @return Plugin_Name_i18n
     */
    public function get_i18n()
    {
        if (! $this->i18n) {
            $this->i18n = new Plugin_Name_i18n( $this->get_plugin_name(), $this->get_plugin_version() );
        }

        return $this->i18n;
    }

    /**
     * @since 1.1.0
     *
     * @return Plugin_Name_Admin
     */
    public function get_admin()
    {
        if (! $this->admin) {
            $this->admin = new Plugin_Name_Admin( $this->get_plugin_name(), $this->get_plugin_version() );
        }

        return $this->admin;
    }

    /**
     * @since 1.1.0
     *
     * @return Plugin_Name_Public
     */
    public function get_public()
    {
        if (! $this->public) {
            $this->public = new Plugin_Name_Public( $this->get_plugin_name(), $this->get_plugin_version() );
        }

        return $this->public;
    }
}
