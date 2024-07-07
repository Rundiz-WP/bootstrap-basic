# Theme change log.
Started since v1.1

### v1.2.6
2024-07-07

* Update style.css on these classes ( `.screen-reader-text`, `.aligncenter` ).

### v1.2.5
2023-12-25

* Add dropdown header supported in navbar.
* Update BootstrapBasic help message.

### v1.2.4
2022-12-29

* Remove paypal link as never use.
* Fix "Warning: Missing singular placeholder" error.
* Fix missing active class on parent menu item that have child item active.
* Update theme help page to properly use translation.
* Update help page, add link to Bootstrap 3 doc.

### v1.2.3
2022-12-18

* Fix incorrect check type scalar.
* Fix "Overriding WordPress globals is prohibited" error.
* Fix using `var_export()`.

### v1.2.2
2022-12-18

* Fix missing `$depth` argument cause fatal error in WP 6.2.

### v1.2.1
2022-01-24

* Add more condition to check calendar widget block.
* Removed fixed Bootstrap CSS.
* Add check function exists in inc/BootstrapBasicWp5.php.

### v1.2.0
2022-01-14

* Use common search elements from searchform.php template. The search form in these files were changed: **404.php**, **inc/widgets/BootstrapBasicSearchWidget.php**
* Add legacy search widget to use on sidebar.
* Add CSS to override widget block **calendar** to its original style.
* Wrap calendar table with responsive table class.
* Tested with WordPress 5.9-RC2-52567

### v1.1.7
2021-12-14

* Prevent PHP 8.1 non-string argument errors.
* Update `Tested up to` to `major.minor` version only as suggested by theme check plugin.

### v1.1.5
2021-08-18

* Fix errors in PHP 8.0.
* Minor bugs fix.
* Now supported PHP 8.0.
* Fix missing `wp_body_open()` function.

### v1.1.3
2019-03-14

* Fix comment-reply does not enqueue.

### v1.1.2
2019-03-14

* Un-depreacated wp_title
* Update Bootstrap, Modernizr

### v1.1.1
2018-12-14

* Update to [Bootstrap 3.4.0](https://blog.getbootstrap.com/2018/12/13/bootstrap-3-4-0/).
* Update Modernizr.
* Removed old, outdated, unnecessary document.

### v1.1
2018-12-08

This release is for WordPress 5.0+. It is still support older version of WordPress.
* Make better Gutenberg support.
* Add more help text.
* Add translators help message. `/* translators: xxx */`
* Add translation template file (.POT).