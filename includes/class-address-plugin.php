<?php

/**
 * The file that defines the core plugin class.
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      1.0.0
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
 *
 * @author     Your Name <marchalyoan@gmail.com>
 */
class address_plugin
{
    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     *
     * @var address_plugin_Loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The string used to uniquely identify this plugin.
     */
    protected $address_plugin;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     *
     * @var string The current version of the plugin.
     */
    protected $version;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        $this->address_plugin = 'address-plugin';
        $this->version = '1.0.0';

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
     * - address_plugin_Loader. Orchestrates the hooks of the plugin.
     * - address_plugin_i18n. Defines internationalization functionality.
     * - address_plugin_Admin. Defines all hooks for the admin area.
     * - address_plugin_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-address-plugin-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'includes/class-address-plugin-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'admin/class-address-plugin-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)).'public/class-address-plugin-public.php';

        /**
         * The class responsible for update plugin
         *
         */
        if( ! class_exists( 'Smashing_Updater' ) ){
        	require_once plugin_dir_path(dirname(__FILE__)).'includes/class-updater.php';
        }

        /**
         * Load Smashing_Updater class
         *
         */
        $updater = new Smashing_Updater( __FILE__ );
        $updater->set_username( 'yoanmarchal' );
        $updater->set_repository( 'address-plugin' );
        /*
        $updater->authorize( 'abcdefghijk1234567890' ); // Your auth code goes here for private repos
        */
        /**
         * init Smashing_Updater class with params
         *
         */
        $updater->initialize();


        register_activation_hook(__FILE__, 'activate_address_plugin');
        register_deactivation_hook(__FILE__, 'deactivate_address_plugin');


        $this->loader = new address_plugin_Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the address_plugin_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     */
    private function set_locale()
    {
        $plugin_i18n = new address_plugin_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     */
    private function define_admin_hooks()
    {
        $plugin_admin = new address_plugin_Admin($this->get_address_plugin(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     */
    private function define_public_hooks()
    {
        $plugin_public = new address_plugin_Public($this->get_address_plugin(), $this->get_version());
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     *
     * @return string The name of the plugin.
     */
    public function get_address_plugin()
    {
        return $this->address_plugin;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @since     1.0.0
     *
     * @return address_plugin_Loader Orchestrates the hooks of the plugin.
     */
    public function get_loader()
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     *
     * @return string The version number of the plugin.
     */
    public function get_version()
    {
        return $this->version;
    }
}
