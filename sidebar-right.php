<?php 
/**
 * Sidebar right.
 * 
 * @package bootstrap-basic
 * 
 * phpcs:disable Generic.WhiteSpace.ScopeIndent.Incorrect, Generic.WhiteSpace.ScopeIndent.IncorrectExact
 */
if (is_active_sidebar('sidebar-right')) { 
?> 
                <div class="col-md-3" id="sidebar-right">
                    <?php do_action('before_sidebar'); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound ?> 
                    <?php dynamic_sidebar('sidebar-right'); ?> 
                </div>
<?php 
} 
