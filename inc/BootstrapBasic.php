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
            add_action('wp_enqueue_scripts', array($this, 'registerCommonScripts'));
            add_action('wp_enqueue_scripts', array($this, 'registerCommonStyles'));
        }// __construct


        /**
         * Register commonly use scripts.
         */
        public function registerCommonScripts()
        {
            wp_register_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js', array('jquery'), '3.4.1', true);
        }// registerCommonScripts


        /**
         * Register commonly use stylesheets.
         */
        public function registerCommonStyles()
        {
            wp_register_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.4.1');
        }// registerCommonStyles


    }
}