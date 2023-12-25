<?php
/**
 * Auto register widgets.
 * 
 * @package bootstrap-basic
 * @since 1.2.0
 * @license http://opensource.org/licenses/MIT MIT
 */


if (!class_exists('BootstrapBasicAutoRegisterWidgets')) {
    class BootstrapBasicAutoRegisterWidgets
    {


        /**
         * Register all widgets that come with this theme.
         */
        public function registerAll()
        {
            $widgets_folder = __DIR__;
            $DirectoryIterator = new \DirectoryIterator($widgets_folder);

            foreach ($DirectoryIterator as $fileinfo) {
                if (!$fileinfo->isDot() && $fileinfo->isFile() && strtolower($fileinfo->getExtension()) === 'php') {
                    $file_name_only = $fileinfo->getBasename('.php');
                    $namespace = __NAMESPACE__;
                    $class_name = $namespace . (!empty($namespace) ? '\\' : '') . $file_name_only;
                    require_once($fileinfo->getRealPath());// needs require to use `class_exists()`.

                    if ($class_name !== __CLASS__ && class_exists($class_name)) {
                        add_action('widgets_init', function () use ($class_name) {
                            return register_widget($class_name);
                        });
                    }

                    unset($class_name, $file_name_only, $namespace);
                }
            }// endforeach;
            unset($DirectoryIterator, $fileinfo, $widgets_folder);
        }// registerAll


    }// BootstrapBasicAutoRegisterWidgets
}
