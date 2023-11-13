<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf6216c17afdfb9c24b035e3fac0b783b
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Webtechnologies\\Controllers\\AccountController' => __DIR__ . '/../..' . '/app/Webtechnologies/controllers/UserController.php',
        'Webtechnologies\\Controllers\\UserController' => __DIR__ . '/../..' . '/app/Webtechnologies/controllers/AccountController.php',
        'Webtechnologies\\Models\\Account' => __DIR__ . '/../..' . '/app/Webtechnologies/Models/Account.php',
        'Webtechnologies\\Models\\User' => __DIR__ . '/../..' . '/app/Webtechnologies/Models/User.php',
        'Webtechnologies\\Views\\AccountTemplate' => __DIR__ . '/../..' . '/app/Webtechnologies/views/AccountTemplate.php',
        'Webtechnologies\\Views\\UserTemplate' => __DIR__ . '/../..' . '/app/Webtechnologies/views/UserTemplate.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitf6216c17afdfb9c24b035e3fac0b783b::$classMap;

        }, null, ClassLoader::class);
    }
}