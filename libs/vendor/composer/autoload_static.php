<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit85eacf9d891278a72e9dff12f96366de
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LibDNS\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LibDNS\\' => 
        array (
            0 => __DIR__ . '/..' . '/daverandom/libdns/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit85eacf9d891278a72e9dff12f96366de::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit85eacf9d891278a72e9dff12f96366de::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
