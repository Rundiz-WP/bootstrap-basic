<?php
/**
 * Template functions
 * for functions to work with template example: get main column size, calculate or check things, ...
 * 
 * @package bootstrap-basic
 */


if (!function_exists('bootstrapBasicGetMainColumnSize')) {
    /**
     * Determine main column size from actived sidebar
     * 
     * For theme designer:
     * By using this column size, Bootstrap grid size is 12. 
     * You may change grid size of sidebar column to number you want; example sidebar-left.php grid 2, sidebar-right.php grid 3.
     * Get Bootstrap grid size minus total sidebar grid size as conditions below this line.
     * Both sidebar active. (12-2-3) = 7. Main column size is 7.
     * Only left sidebar active. (12-2) = 10. Main column size is 10.
     * Only right sidebar active. (12-3) = 9. Main column size is 9.
     * No sidebar active. Main column is 12.
     * Now, you write the condition above into the function below and return column size value.
     * 
     * @return integer return column size.
     */
    function bootstrapBasicGetMainColumnSize() 
    {
        if (is_active_sidebar('sidebar-left') && is_active_sidebar('sidebar-right')) {
            // if both sidebar actived.
            $main_column_size = 6;
        } elseif (
                (is_active_sidebar('sidebar-left') && !is_active_sidebar('sidebar-right')) || 
                (is_active_sidebar('sidebar-right') && !is_active_sidebar('sidebar-left'))
        ) {
            // if only one sidebar actived.
            $main_column_size = 9;
        } else {
            // if no sidebar actived.
            $main_column_size = 12;
        }

        return $main_column_size;
    }// bootstrapBasicGetMainColumnSize
}


if (!function_exists('bootstrapBasicHasWidgetBlock')) {
    /**
     * Check if currently there are any selected widget block name.
     * 
     * @link https://wordpress.stackexchange.com/a/392496/41315 Original source code.
     * @param string $blockName The widget block name to check.
     * @return bool Return `true` if found, return `false` if not found or this site is using older version of WordPress that is not supported widget blocks.
     */
    function bootstrapBasicHasWidgetBlock($blockName)
    {
        if (!is_string($blockName)) {
            return false;
        }

        $widget_blocks = get_option('widget_block');
        if (
            (is_array($widget_blocks) || is_object($widget_blocks)) && 
            !empty($widget_blocks) && 
            function_exists('has_block')
        ) {
            foreach ($widget_blocks as $widget_block) {
                if (
                    isset($widget_block['content']) && 
                    !empty($widget_block['content']) && 
                    has_block($blockName, $widget_block['content'])
                ) {
                    // if found selected widget block name.
                    unset($widget_block, $widget_blocks);
                    return true;
                }
            }// endforeach;
            unset($widget_block);
        }

        unset($widget_blocks);
        return false;
    }// bootstrapBasicHasWidgetBlock
}