<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0eabf7429262032f7de3b98e14a75b66
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0eabf7429262032f7de3b98e14a75b66::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0eabf7429262032f7de3b98e14a75b66::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
