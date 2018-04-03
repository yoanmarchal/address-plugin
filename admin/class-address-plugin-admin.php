<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @author     Your Name <marchalyoan@gmail.com>
 */
class address_plugin_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The ID of this plugin.
     */
    private $address_plugin;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     *
     * @var string The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     *
     * @param      string    $address_plugin       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */

    /**
     * Holds the values to be used in the fields callbacks.
     */
    private $options;

    public function __construct($address_plugin, $version)
    {
        $this->address_plugin = $address_plugin;
        $this->version = $version;
        add_action('admin_menu', [$this, 'add_plugin_page']);
        add_action('admin_init', [$this, 'page_init']);
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

            /*
             * This function is provided for demonstration purposes only.
             *
             * An instance of this class should be passed to the run() function
             * defined in address_plugin_Loader as all of the hooks are defined
             * in that particular class.
             *
             * The address_plugin_Loader will then create the relationship
             * between the defined hooks and the functions defined in this
             * class.
             */
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

            /*
             * This function is provided for demonstration purposes only.
             *
             * An instance of this class should be passed to the run() function
             * defined in address_plugin_Loader as all of the hooks are defined
             * in that particular class.
             *
             * The address_plugin_Loader will then create the relationship
             * between the defined hooks and the functions defined in this
             * class.
             */
    }

    /**
     * Add options page.
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
                    'Settings Admin',
                    'Address Settings',
                    'manage_options',
                    'address-plugin-admin',
                    [$this, 'create_admin_page']
            );
    }

    /**
     * Options page callback.
     */
    public function create_admin_page()
    {
        // Set class property
            $this->options = get_option('address'); ?>
			<div class="wrap">
					<h2>Address settings</h2>
					<form method="post" action="options.php">
					<?php
                        // This prints out all hidden setting fields
                        settings_fields('address_settings');
        do_settings_sections('address-plugin-admin');
        submit_button(); ?>
					</form>
			</div>
			<?php
    }

    // Facebook, YouTube, Twitter, Instagram, Tumblr, Google+,  Skype, Reddit, Soundcloud, Pinterest

    /**
     * Register and add settings.
     */
    public function page_init()
    {
        register_setting(
          'address_settings', // Option group
          'address', // Option name
          [$this, 'sanitize'] // Sanitize
        );

        add_settings_section(
          'setting_section_address', // ID
          'address', // Title
          [$this, 'print_section_info'], // Callback
          'address-plugin-admin' // Page
        );

        add_settings_field(
          'ship-address', // ID
          'Street address', // Title
          [$this, 'street_address_callback'], // Callback
          'address-plugin-admin', // Page
          'setting_section_address' // Section
        );

        add_settings_field(
          'ship-city', // ID
          'City', // Title
          [$this, 'city_callback'], // Callback
          'address-plugin-admin', // Page
          'setting_section_address' // Section
        );

        add_settings_field(
          'ship-state', // ID
          'State', // Title
          [$this, 'state_callback'], // Callback
          'address-plugin-admin', // Page
          'setting_section_address' // Section
        );

        add_settings_field(
          'ship-zip', // ID
          'Postal code', // Title
          [$this, 'zip_callback'], // Callback
          'address-plugin-admin', // Page
          'setting_section_address' // Section
        );

        add_settings_field(
          'ship-country', // ID
          'Country', // Title
          [$this, 'country_callback'], // Callback
          'address-plugin-admin', // Page
          'setting_section_address' // Section
        );

        add_settings_field(
          'phone', // ID
          'Phone', // Title
          [$this, 'phone_callback'], // Callback
          'address-plugin-admin', // Page
          'setting_section_address' // Section
        );

        add_settings_field(
          'fax', // ID
          'Fax', // Title
          [$this, 'fax_callback'], // Callback
          'address-plugin-admin', // Page
          'setting_section_address' // Section
        );

        add_settings_field(
          'email', // ID
          'Email', // Title
          [$this, 'email_callback'], // Callback
          'address-plugin-admin', // Page
          'setting_section_address' // Section
        );

        /*
        rue codepostal ville tel fax email
        */
    }

    /**
     * Sanitize each setting field as needed.
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input)
    {
        $new_input = [];

        if (isset($input['ship-address'])) {
            $new_input['ship-address'] = sanitize_text_field($input['ship-address']);
        }
        if (isset($input['ship-city'])) {
            $new_input['ship-city'] = sanitize_text_field($input['ship-city']);
        }
        if (isset($input['ship-state'])) {
            $new_input['ship-state'] = sanitize_text_field($input['ship-state']);
        }
        if (isset($input['ship-zip'])) {
            $new_input['ship-zip'] = sanitize_text_field($input['ship-zip']);
        }
        if (isset($input['ship-country'])) {
            $new_input['ship-country'] = sanitize_text_field($input['ship-country']);
        }
        if (isset($input['phone'])) {
            $new_input['phone'] = sanitize_text_field($input['phone']);
        }
        if (isset($input['fax'])) {
            $new_input['fax'] = sanitize_text_field($input['fax']);
        }
        if (isset($input['email'])) {
            $new_input['email'] = sanitize_email($input['email']);
        }

        return $new_input;
    }

    /**
     * Print the Section text.
     */
    public function print_section_info()
    {
        echo 'Enter your address below:';
    }

    /**
     * Get the settings option array and print one of its values.
     */
    public function street_address_callback()
    {
        printf(
          '<input type="text" id="ship-address" name="address[ship-address]" value="%s" placeholder="123 Any Street" autocomplete="shipping street-address" />',
          isset($this->options['ship-address']) ? esc_html($this->options['ship-address']) : ''
        );
    }

    public function city_callback()
    {
        printf(
          '<input type="text" id="ship-city" name="address[ship-city]" value="%s" placeholder="New York" autocomplete="shipping locality" />',
          isset($this->options['ship-city']) ? esc_html($this->options['ship-city']) : ''
        );
    }

    public function state_callback()
    {
        printf(
          '<input type="text" id="ship-state" name="address[ship-state]" value="%s" placeholder="NY" autocomplete="shipping region" />',
          isset($this->options['ship-state']) ? esc_html($this->options['ship-state']) : ''
        );
    }

    public function zip_callback()
    {
        printf(
          '<input type="text" id="ship-zip" name="address[ship-zip]" value="%s" placeholder="10011" autocomplete="shipping postal-code" />',
          isset($this->options['ship-zip']) ? esc_html($this->options['ship-zip']) : ''
        );
    }

    public function country_callback()
    {
        printf(
          '<input type="text" id="ship-country" name="address[ship-country]" value="%s" placeholder="USA" autocomplete="shipping country" />',
          isset($this->options['ship-country']) ? esc_html($this->options['ship-country']) : ''
        );
    }

    public function phone_callback()
    {
        printf(
          '<input type="text" id="phone" name="address[phone]" value="%s" placeholder="+1-555-555-1212" autocomplete="tel" />',
          isset($this->options['phone']) ? esc_html($this->options['phone']) : ''
        );
    }

    public function fax_callback()
    {
        printf(
          '<input type="text" id="fax" name="address[fax]" value="%s" placeholder="+1-555-555-1212" autocomplete="fax" />',
          isset($this->options['fax']) ? esc_html($this->options['fax']) : ''
        );
    }

    public function email_callback()
    {
        printf(
          '<input type="email" id="email" name="address[email]" value="%s" placeholder="name@example.com" autocomplete="email" />',
          isset($this->options['email']) ? esc_html($this->options['email']) : ''
        );
    }
}
