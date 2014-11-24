<?php
/**
 * For store widget hook action/filter.
 * 
 * @package bootstrap-basic
 */


if (!function_exists('bootstrapBasicWidgetHooksGetCalendar')) {
	/**
	 * change WordPress calendar widget table to add bootstrap class into it.
	 * 
	 * @todo change code in this function when WordPress allowed to hook into that widget.
	 * @param string $calendar
	 * @return string
	 */
	function bootstrapBasicWidgetHooksGetCalendar($calendar) 
	{
		$new_calendar = preg_replace('#(<table*\s)(id="wp-calendar")#i', '$1 id="wp-calendar" class="table"', $calendar);

		return $new_calendar;
	}// bootstrapBasicWidgetHooksGetCalendar
}
add_filter('get_calendar', 'bootstrapBasicWidgetHooksGetCalendar', 10, 1);

