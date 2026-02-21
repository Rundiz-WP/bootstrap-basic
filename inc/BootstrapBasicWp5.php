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
            add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockEditorAssets']);

            // Add Bootstrap styles into editor.
            add_action('admin_init', [$this, 'addEditorStyles']);
        }// __construct


        /**
         * Add Bootstrap styles into classic editor.
         */
        public function addEditorStyles()
        {
            if (function_exists('add_editor_style')) {
                add_editor_style('assets/css/bootstrap.min.css');
            }
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

            /**
             * Use modern Bootstrap or not.
             * 
             * @see `bootstrapBasicEnqueueScripts()` function for more details.
             */
            $useModernBootstrap = apply_filters('bootstrap_basic_use_modern_bootstrap', false);
            if (true === $useModernBootstrap) {
                wp_enqueue_style('bootstrap-basic-modern-bootstrap-style');
            } else {
                wp_enqueue_style('bootstrap-style');
            }
        }// enqueueBlockEditorAssets


    }
}