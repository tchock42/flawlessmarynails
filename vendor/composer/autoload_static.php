<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7cb8864c4ea8d6e3dac5c56a2b7b2dfa
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'M' => 
        array (
            'Model\\' => 6,
            'MVC\\' => 4,
        ),
        'I' => 
        array (
            'Intervention\\Image\\' => 19,
            'Intervention\\Gif\\' => 17,
        ),
        'C' => 
        array (
            'Controllers\\' => 12,
            'Classes\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'MVC\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
        'Intervention\\Image\\' => 
        array (
            0 => __DIR__ . '/..' . '/intervention/image/src',
        ),
        'Intervention\\Gif\\' => 
        array (
            0 => __DIR__ . '/..' . '/intervention/gif/src',
        ),
        'Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'Classes\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7cb8864c4ea8d6e3dac5c56a2b7b2dfa::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7cb8864c4ea8d6e3dac5c56a2b7b2dfa::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit7cb8864c4ea8d6e3dac5c56a2b7b2dfa::$classMap;

        }, null, ClassLoader::class);
    }
}
