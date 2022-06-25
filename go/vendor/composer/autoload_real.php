<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitb4e58bc5c8e645a0a5a4cc459c51986b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitb4e58bc5c8e645a0a5a4cc459c51986b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitb4e58bc5c8e645a0a5a4cc459c51986b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitb4e58bc5c8e645a0a5a4cc459c51986b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
