<?php
/**
 * Bootstrap Basic admin help page.
 * 
 * @package bootstrap-basic
 */
?>
<div class="wrap">
    <h2><?php esc_html_e('Bootstrap Basic help', 'bootstrap-basic'); ?></h2>

    <h3><?php esc_html_e('Menu', 'bootstrap-basic'); ?></h3>
    <p><?php esc_html_e('To display menu correctly, please create at least 1 menu and set as primary and save.', 'bootstrap-basic'); ?></p>
    <h4><?php esc_html_e('Divider', 'bootstrap-basic'); ?></h4>
    <p><?php 
    printf(
        /* translators: %1$s divider CSS class, %2$s the word CSS classes */
        esc_html__('To display dropdown divier, add %1$s class to the menu\'s %2$s.', 'bootstrap-basic'),
        '<code>divider</code>',
        '<strong>' . esc_html__('CSS Classes', 'bootstrap-basic') . '</strong>'
    );
    ?></p>
    <h4><?php esc_html_e('Dropdown header', 'bootstrap-basic'); ?></h4>
    <p><?php 
    printf(
        /* translators: %1$s dropdown header CSS class, %2$s the word CSS classes */
        esc_html__('To display dropdown header, add %1$s class to the menu\'s %2$s.', 'bootstrap-basic'),
        '<code>dropdown-header</code>',
        '<strong>' . esc_html__('CSS Classes', 'bootstrap-basic') . '</strong>'
    );
    ?></p>

    <h3><?php esc_html_e('Bootstrap features', 'bootstrap-basic'); ?></h3>
    <p><?php 
    printf(
        /* translators: $1$s open link to Bootstrap doc, %2$s close link. */
        esc_html__('This theme can use all %1$sBootstrap 3%2$s classes, elements and styles.', 'bootstrap-basic'),
        '<a href="https://getbootstrap.com/docs/3.4/" target="bootstrap_doc">',
        '</a>'
    ); 
    ?></p>

    <h3><?php esc_html_e('Responsive image', 'bootstrap-basic'); ?></h3>
    <p><?php 
    printf(
        /* translators: %1$s sample of responsive image HTML with class. */
        esc_html__('For responsive image please add img-responsive class to img element. Example: %1$s', 'bootstrap-basic'),
        '<code>&lt;img src=&quot;...&quot; alt=&quot;&quot; class=&quot;img-responsive&quot;&gt;</code>'
    );
    ?></p>

    <h3><?php esc_html_e('Responsive video</h3>', 'bootstrap-basic'); ?>
    <?php
    printf(
        /* translators: %1$s sample of responsive video HTML with class. */
        esc_html__('Cloak video element (video element or embeded video) with %1$s.', 'bootstrap-basic'),
        '<code>&lt;div class=&quot;flexvideo&quot;&gt;...&lt;/div&gt;</code>'
    );
    ?>

    <h3><?php esc_html_e('Bootstrap Basic Change log', 'bootstrap-basic'); ?></h3>
    <p>
        <?php 
        printf(
            /* translators: %1$s: Open link, %2$s: Close link. */
            esc_html__('You can see what was changed in each version or each commits on our %1$sGithub page%2$s.', 'bootstrap-basic'), 
            '<a href="https://github.com/Rundiz-WP/bootstrap-basic" target="bb_commits">', '</a>'
        ); 
        ?> 
        <?php esc_html_e('You can also see it on changelog.md file that come with the theme.', 'bootstrap-basic'); ?> 
    </p>

    <?php do_action('bootstrapbasic_theme_help_content'); ?> 

    <footer style="margin-top: 30px;">
        <p><?php 
        printf(
            /* translators: %1$s Open link, %2$s Close link. */
            esc_html__('Thank you for using Bootstrap Basic. Please %1$sdonate%2$s to support the developer.', 'bootstrap-basic'),
            '<a href="https://rundiz.com/en/donate" target="donate">',
            '</a>'
        );
        ?></p>
    </footer>
</div>