<?php
/*
* Mr OK
* 5/29/2019
*/

class AutoLoader
{
    private static $instance;

    public static function get_instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
    }

    private function __construct()
    {
        $this->register_auto_load();
    }

    private function __clone()
    {
    }

    private function register_auto_load()
    {
        try {
            @spl_autoload_register(array($this, 'autoload'));
        } catch (Exception $e) {
        }
    }

    private function autoload($class_name)
    {
        $class_name = @strtolower($class_name);
        $class_name = 'class-' . $class_name;
        $file = $this->to_file($class_name);

        if ($this->check_for_file($file)) {
            @include_once "{$file}";
        }
    }

    private function to_file($class_name)
    {
        return '_classes' . DIRECTORY_SEPARATOR . $class_name . '.php';
    }

    private function check_for_file($file)
    {

        return (isset($file)
            && file_exists($file)
            && is_file($file)
            && is_readable($file));
    }
}

AutoLoader::get_instance();