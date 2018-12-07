<?php
/**
 * Make Bootstrap Basic support WordPress 5 (Gutenberg).
 * 
 * @package bootstrap-basic
 */


if (!class_exists('BootstrapBasicWp5')) {
    class BootstrapBasicWp5
    {


        /**
         * Bootstrap Basic WP5 class constructor.
         */
        public function __construct()
        {
            // Add Bootstrap styles into Gutenberg editor.
            add_action('enqueue_block_editor_assets', array($this, 'enqueueBlockEditorAssets'));

            // Add Bootstrap styles into editor.
            add_action('admin_init', array($this, 'addEditorStyles'));
        }// __construct


        /**
         * Add Bootstrap styles into classic editor.
         */
        public function addEditorStyles()
        {
            add_editor_style('css/bootstrap.min.css');
        }// addEditorStyles


        /**
         * Add Bootstrap styles into Gutenberg editor.
         */
        public function enqueueBlockEditorAssets()
        {
            if (!wp_script_is('bootstrap-style', 'registered')) {
                $BootstrapBasic = new BootstrapBasic();
                $BootstrapBasic->registerCommonStyles();
            }
            wp_enqueue_style('bootstrap-style');
        }// enqueueBlockEditorAssets


    }
}