<?php
/**
 * Theme widgets
 * 
 * @package bootstrap-basic
 */


if (!class_exists('BootstrapBasicSearchWidget')) {
	class BootstrapBasicSearchWidget extends WP_Widget
	{


		private $navbaralign = 'navbar-right';


		public function __construct()
		{
			parent::__construct(
					'bootstrapbasic_search_widget', // base ID
					__('Bootstrap Navbar Search', 'bootstrap-basic'), 
					array('description' => __('Display Search widget for Bootstrap navbar.', 'bootstrap-basic'))
			);
		}// __construct


		/**
		 * back-end widget form
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
			$output .= '<label for="' . $this->get_field_id('navbaralign') . '">' . __('Form alignment:', 'bootstrap-basic') . '</label>';
			$output .= '<select id="' . $this->get_field_id('navbaralign') . '" name="' . $this->get_field_name('navbaralign') . '">';
			$output .= '<option value="navbar-left"' . ($navbaralign == 'navbar-left' ? ' selected="selected"' : '') . '>' . __('Left', 'bootstrap-basic') . '</option>';
			$output .= '<option value="navbar-right"' . ($navbaralign == 'navbar-right' ? ' selected="selected"' : '') . '>' . __('Right', 'bootstrap-basic') . '</option>';
			$output .= '</select>';
			$output .= '</p>';

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

			if ($new_instance['navbaralign'] != 'navbar-left' && $new_instance['navbaralign'] != 'navbar-right') {
				$instance['navbaralign'] = $this->navbaralign;
			} else {
				$instance['navbaralign'] = $new_instance['navbaralign'];
			}

			return $instance;
		}// update


		/**
		 * front-end display of widget
		 * 
		 * @see WP_Widget::widget()
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget($args, $instance) 
		{
			$navbaralign = $this->navbaralign;
			if (isset($instance['navbaralign']) && $instance['navbaralign'] != null) {
				$navbaralign = $instance['navbaralign'];
			}

			// set output front-end widget ---------------------------------
			$output = $args['before_widget'];

			$output .= '<form class="navbar-form ' . $navbaralign . '" action="' . esc_url(home_url('/')) . '" role="search">';
			$output .= '<div class="form-group">';
			$output .= '<input type="text" name="s" class="form-control" placeholder="' . esc_attr_x('Search &hellip;', 'placeholder', 'bootstrap-basic') . '" value="' . esc_attr(get_search_query()) . '" title="' . esc_attr_x('Search for:', 'label', 'bootstrap-basic') . '">';
			$output .= '</div>';
			$output .= ' ';
			$output .= '<button type="submit" class="btn btn-default">' . esc_html__('Search', 'bootstrap-basic') . '</button>';
			$output .= '</form>';

			$output .= $args['after_widget'];

			echo $output;

			// clear unused variables
			unset($output);
		}// widget


	}
}


// wordpress widget action hooks
add_action('widgets_init', create_function('', 'return register_widget("BootstrapBasicSearchWidget");'));

