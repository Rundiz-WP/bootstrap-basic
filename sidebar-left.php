<?php 
/**
 * Sidebar left.
 * 
 * @package bootstrap-basic
 * 
 * phpcs:disable Generic.WhiteSpace.ScopeIndent.Incorrect, Generic.WhiteSpace.ScopeIndent.IncorrectExact
 */
if (is_active_sidebar('sidebar-left')) { 
?> 
                <div class="col-md-3" id="sidebar-left">
                    <?php do_action('before_sidebar'); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound ?> 
                    <?php dynamic_sidebar('sidebar-left'); ?> 
                </div>
<?php 
}
