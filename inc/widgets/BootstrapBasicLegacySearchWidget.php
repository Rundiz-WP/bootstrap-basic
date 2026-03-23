<?php
/**
 * Theme widgets
 * 
 * @package bootstrap-basic
 */


if (!class_exists('BootstrapBasicLegacySearchWidget')) {
    /**
     * Legacy search widget class.
     */
    class BootstrapBasicLegacySearchWidget extends WP_Widget
    {


        /**
         * @var string Widget title.
         */
        private $widget_title;


        /**
         * Class construction for theme search widget.
         */
        public function __construct()
        {
            parent::__construct(
                'bootstrapbasic_legacysearch_widget', // base ID
                __('Bootstrap Legacy Search', 'bootstrap-basic'), 
                array('description' => __('Display Search widget for Bootstrap that can be use in sidebar.', 'bootstrap-basic'))
            );
        }// __construct


        /**
         * Back-end widget form.
         * 
         * @see WP_Widget::form()
         * @param array $instance Previously saved values from database.
         */
        public function form($instance) 
        {
            // search widget title
            if (isset($instance['bootstrapbasic-legacysearch-widget-title'])) {
                $this->widget_title = $instance['bootstrapbasic-legacysearch-widget-title'];
            }

            // output form
            $output = '<p>';
            $output .= '<label for="' . $this->get_field_id('bootstrapbasic-legacysearch-widget-title') . '">' . esc_html__('Title:', 'bootstrap-basic') . '</label>';
            $output .= '<input id="' . $this->get_field_id('bootstrapbasic-legacysearch-widget-title') . '" class="widefat" type="text" value="' . esc_attr($this->widget_title) . '" name="' . $this->get_field_name('bootstrapbasic-legacysearch-widget-title') . '">';
            $output .= '</p>';

            // Cannot use any kses because it contains form.
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo $output;

            unset($output);
        }// form


        /**
         * Sanitize widget form values as they are saved.
         * 
         * @see WP_Widget::update()
         * @param array $new_instance Values just sent to be saved.
         * @param array $old_instance Previously saved values from database.
         * @return array Updated safe values to be saved.
         */
        public function update($new_instance, $old_instance) 
        {
            $instance = array();

            if (isset($new_instance['bootstrapbasic-legacysearch-widget-title'])) {
                $instance['bootstrapbasic-legacysearch-widget-title'] = wp_strip_all_tags($new_instance['bootstrapbasic-legacysearch-widget-title']);
            } else {
                $instance['bootstrapbasic-legacysearch-widget-title'] = '';
            }

            return $instance;
        }// update


        /**
         * Front-end display of widget.
         * 
         * @see WP_Widget::widget()
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance) 
        {
            $widget_title = $this->widget_title;
            if (isset($instance['bootstrapbasic-legacysearch-widget-title'])) {
                $widget_title = $instance['bootstrapbasic-legacysearch-widget-title'];
            }

            // set output front-end widget ---------------------------------
            $output = $args['before_widget'];

            if (isset($instance['bootstrapbasic-legacysearch-widget-title']) && !empty($instance['bootstrapbasic-legacysearch-widget-title'])) {
                $output .= $args['before_title'] . apply_filters('widget_title', $instance['bootstrapbasic-legacysearch-widget-title']) . $args['after_title'] . "\n";
            }

            $searchFormArgs = [];
            $searchFormArgs['echo'] = false;

            $output .= get_search_form($searchFormArgs);
            unset($searchFormArgs);

            $output .= $args['after_widget'];

            // Cannot use any kses because it contains form.
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo $output;

            // clear unused variables
            unset($output);
        }// widget


    }// BootstrapBasicLegacySearchWidget
}
