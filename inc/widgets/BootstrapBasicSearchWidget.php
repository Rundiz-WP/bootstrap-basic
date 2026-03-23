<?php
/**
 * Theme widgets
 * 
 * @package bootstrap-basic
 */


if (!class_exists('BootstrapBasicSearchWidget')) {
    /**
     * Bootstrap search widget class (for navbar).
     */
    class BootstrapBasicSearchWidget extends WP_Widget
    {


        /**
         * @var string Navbar alignment.
         */
        private $navbaralign = 'navbar-right';


        /**
         * Class construction for theme search widget.
         */
        public function __construct()
        {
            parent::__construct(
                'bootstrapbasic_search_widget', // base ID
                __('Bootstrap Navbar Search', 'bootstrap-basic'), 
                array('description' => __('Display Search widget for Bootstrap navbar.', 'bootstrap-basic'))
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
            // navbar align
            if (isset($instance['navbaralign'])) {
                $navbaralign = $instance['navbaralign'];
            } else {
                $navbaralign = $this->navbaralign;
            }

            // output form
            $output = '<p>';
            $output .= '<label for="' . $this->get_field_id('navbaralign') . '">' . esc_html__('Form alignment:', 'bootstrap-basic') . '</label>';
            $output .= '<select id="' . $this->get_field_id('navbaralign') . '" name="' . $this->get_field_name('navbaralign') . '">';
            $output .= '<option value="navbar-left"' . ('navbar-left' === $navbaralign ? ' selected="selected"' : '') . '>' . esc_html__('Left', 'bootstrap-basic') . '</option>';
            $output .= '<option value="navbar-right"' . ('navbar-right' === $navbaralign ? ' selected="selected"' : '') . '>' . esc_html__('Right', 'bootstrap-basic') . '</option>';
            $output .= '</select>';
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

            if ('navbar-left' !== $new_instance['navbaralign'] && 'navbar-right' !== $new_instance['navbaralign']) {
                $instance['navbaralign'] = $this->navbaralign;
            } else {
                $instance['navbaralign'] = $new_instance['navbaralign'];
            }

            return $instance;
        }// update


        /**
         * Front-end display of widget.
         * 
         * @see WP_Widget::widget()
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget($args, $instance) 
        {
            $navbaralign = $this->navbaralign;
            if (isset($instance['navbaralign']) && !empty($instance['navbaralign'])) {
                $navbaralign = $instance['navbaralign'];
            }

            // set output front-end widget ---------------------------------
            $output = $args['before_widget'];

            $searchFormArgs = [];
            $searchFormArgs['echo'] = false;
            $searchFormArgs['bootstrapbasic']['form_classes'] = 'navbar-form ' . $navbaralign;
            $searchFormArgs['bootstrapbasic']['display_for'] = 'navbar';

            $output .= get_search_form($searchFormArgs);
            unset($searchFormArgs);

            $output .= $args['after_widget'];

            // Cannot use any kses because it contains form.
            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            echo $output;

            // clear unused variables
            unset($output);
        }// widget


    }// BootstrapBasicSearchWidget
}
