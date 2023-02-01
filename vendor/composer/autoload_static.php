<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7553fc8a42102567e02a852230169de8
{
    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Ifaqih\\Ifnaivebayes\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Ifaqih\\Ifnaivebayes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7553fc8a42102567e02a852230169de8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7553fc8a42102567e02a852230169de8::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7553fc8a42102567e02a852230169de8::$classMap;

        }, null, ClassLoader::class);
    }
}