<?php
/**
 * Bootstrap Basic class.
 * 
 * @package bootstrap-basic
 */


if (!class_exists('BootstrapBasic')) {
    /**
     * Bootstrap Basic theme main class.
     */
    class BootstrapBasic
    {


        /**
         * Bootstrap Basic theme class constructor.
         */
        public function __construct()
        {
            add_action('init', [$this, 'registerBootstrapAssets']);
        }// __construct


        /**
         * Register Bootstrap assets (CSS, JS).
         * 
         * The assets that was registered in this method can be enqueue later on any parts including hooks by `enqueue_block_assets`.<br>
         * If not register with something earlier than `wp_enqueue_scripts`, it won't work.
         * 
         * @link https://developer.wordpress.org/reference/functions/wp_register_style/ Function reference.
         * @link https://github.com/WordPress/WordPress/blob/master/wp-includes/functions.wp-scripts.php#L187 The register style function called to `_wp_scripts_maybe_doing_it_wrong()`
         * @link https://github.com/WordPress/WordPress/blob/master/wp-includes/functions.wp-scripts.php#L41 The maybe doing it wrong function check that if `init` hook did called then it's work.
         * @link https://developer.wordpress.org/themes/core-concepts/including-assets/ Functions to use when enqueue/register asset files.
         * @since 1.3.2
         */
        public function registerBootstrapAssets()
        {
            // CSS
            wp_register_style('bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', [], '3.4.1');
            wp_register_style('bootstrap-theme-style', get_template_directory_uri() . '/assets/css/bootstrap-theme.min.css', [], '3.4.1');

            // JS
            wp_register_script('bootstrap-script', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', ['jquery'], '3.4.1', true);

            // below is modern Bootstrap 3. --------------------------------------------------------------------
            // CSS
            wp_register_style('bootstrap-basic-modern-bootstrap-style', get_template_directory_uri() . '/assets/vendor/modern-bootstrap/css/bootstrap.min.css', [], '3.4.3');
            wp_register_style('bootstrap-basic-modern-bootstrap-theme-style', get_template_directory_uri() . '/assets/vendor/modern-bootstrap/css/bootstrap-theme.min.css', [], '3.4.3');

            // JS
            wp_register_script('bootstrap-basic-modern-bootstrap-script', get_template_directory_uri() . '/assets/vendor/modern-bootstrap/js/vendor/bootstrap.min.js', ['jquery'], '3.4.3', true);
        }// registerBootstrapAssets


    }
}