<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdcdea62bb52c16c1be5c384681ad4a02
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdcdea62bb52c16c1be5c384681ad4a02::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdcdea62bb52c16c1be5c384681ad4a02::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}