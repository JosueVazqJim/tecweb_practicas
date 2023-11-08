<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit894cfcc8da0f546a8d1352e1e35fcf1a
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

        spl_autoload_register(array('ComposerAutoloaderInit894cfcc8da0f546a8d1352e1e35fcf1a', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit894cfcc8da0f546a8d1352e1e35fcf1a', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit894cfcc8da0f546a8d1352e1e35fcf1a::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
