<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1eb0aa6f88dbec6fd3fc28f7526b334e
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chriskacerguis\\RestServer\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chriskacerguis\\RestServer\\' => 
        array (
            0 => __DIR__ . '/..' . '/chriskacerguis/codeigniter-restserver/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1eb0aa6f88dbec6fd3fc28f7526b334e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1eb0aa6f88dbec6fd3fc28f7526b334e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1eb0aa6f88dbec6fd3fc28f7526b334e::$classMap;

        }, null, ClassLoader::class);
    }
}