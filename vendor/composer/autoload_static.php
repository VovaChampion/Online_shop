<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc97a4cb8f0360873f291c8bbd480a9ce
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc97a4cb8f0360873f291c8bbd480a9ce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc97a4cb8f0360873f291c8bbd480a9ce::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
