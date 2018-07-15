<?php

/**
 * Class Plugin_Name_Abstract
 *
 * @since      2.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
abstract class Plugin_Name_Abstract implements Plugin_Name_Interface
{
    use Plugin_Name_i18n_Trait;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_version    The current version of the plugin.
     */
    protected $plugin_version;

    /**
     * Plugin_Name_Abstract constructor.
     *
     * @since 1.0.0
     *
     * @param string $plugin_name
     * @param string $plugin_version
     */
    public function __construct( string $plugin_name, string $plugin_version )
    {
        $this->plugin_name = $plugin_name;
        $this->plugin_version = $plugin_version;
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     *
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() : string
    {
        return $this->plugin_name;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     *
     * @return    string    The version number of the plugin.
     */
    public function get_plugin_version() : string
    {
        return $this->plugin_version;
    }
}