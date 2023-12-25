<div class="wrap">
    <h2><?php _e('Bootstrap Basic help', 'bootstrap-basic'); ?></h2>

    <h3><?php _e('Menu', 'bootstrap-basic'); ?></h3>
    <p><?php _e('To display menu correctly, please create at least 1 menu and set as primary and save.', 'bootstrap-basic'); ?></p>
    <h4><?php _e('Divider', 'bootstrap-basic'); ?></h4>
    <p><?php 
    printf(
        /* translators: %1$s divider CSS class, %2$s the word CSS classes */
        __('To display dropdown divier, add %1$s class to the menu\'s %2$s.', 'bootstrap-basic'),
        '<code>divider</code>',
        '<strong>' . __('CSS Classes', 'bootstrap-basic') . '</strong>'
    );
    ?></p>
    <h4><?php _e('Dropdown header', 'bootstrap-basic'); ?></h4>
    <p><?php 
    printf(
        /* translators: %1$s dropdown header CSS class, %2$s the word CSS classes */
        __('To display dropdown header, add %1$s class to the menu\'s %2$s.', 'bootstrap-basic'),
        '<code>dropdown-header</code>',
        '<strong>' . __('CSS Classes', 'bootstrap-basic') . '</strong>'
    );
    ?></p>

    <h3><?php _e('Bootstrap features', 'bootstrap-basic'); ?></h3>
    <p><?php 
    printf(
        /* translators: $1$s open link to Bootstrap doc, %2$s close link. */
        __('This theme can use all %1$sBootstrap 3%2$s classes, elements and styles.', 'bootstrap-basic'),
        '<a href="https://getbootstrap.com/docs/3.4/" target="bootstrap_doc">',
        '</a>'
    ); 
    ?></p>

    <h3><?php _e('Responsive image', 'bootstrap-basic'); ?></h3>
    <p><?php 
    printf(
        /* translators: %1$s sample of responsive image HTML with class. */
        __('For responsive image please add img-responsive class to img element. Example: %1$s', 'bootstrap-basic'),
        '<code>&lt;img src=&quot;...&quot; alt=&quot;&quot; class=&quot;img-responsive&quot;&gt;</code>'
    );
    ?></p>

    <h3><?php _e('Responsive video</h3>', 'bootstrap-basic'); ?>
    <?php
    printf(
        /* translators: %1$s sample of responsive video HTML with class. */
        __('Cloak video element (video element or embeded video) with %1$s.', 'bootstrap-basic'),
        '<code>&lt;div class=&quot;flexvideo&quot;&gt;...&lt;/div&gt;</code>'
    );
    ?>

    <h3><?php _e('Bootstrap Basic Change log', 'bootstrap-basic'); ?></h3>
    <p>
        <?php 
        printf(
            /* translators: %1$s: Open link, %2$s: Close link */
            __('You can see what was changed in each version or each commits on our %1$sGithub page%2$s.', 'bootstrap-basic'), 
            '<a href="https://github.com/Rundiz-WP/bootstrap-basic" target="bb_commits">', '</a>'
        ); 
        ?> 
        <?php _e('You can also see it on changelog.md file that come with the theme.', 'bootstrap-basic'); ?> 
    </p>

    <?php do_action('bootstrapbasic_theme_help_content'); ?>
</div>