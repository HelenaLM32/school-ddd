<?php

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Dotenv\Dotenv;

return function (): EntityManager {
    if (file_exists(__DIR__ . '/../.env') && class_exists(Dotenv::class)) {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }

    $paths = [__DIR__ . '/../src/Domain'];
    $isDevMode = true;

    $config = ORMSetup::createAttributeMetadataConfig(
        $paths,
        $isDevMode
    );

    $proxyDir = __DIR__ . '/../var/proxies';
    if (!is_dir($proxyDir)) {
        mkdir($proxyDir, 0777, true);
    }

    $config->setProxyDir($proxyDir);
    $config->setProxyNamespace('App\Proxies');
    $config->setAutoGenerateProxyClasses($isDevMode);

    $dbParams = [
        'driver'   => $_ENV['DB_DRIVER']   ?? 'pdo_mysql',
        'host'     => $_ENV['DB_HOST']     ?? '127.0.0.1',
        'port'     => $_ENV['DB_PORT']     ?? '3306',
        'user'     => $_ENV['DB_USER']     ?? 'root',
        'password' => $_ENV['DB_PASSWORD'] ?? 'linuxlinux',
        'dbname'   => $_ENV['DB_NAME']     ?? 'school_db',
    ];

    if (file_exists('/run/mysqld/mysqld.sock')) {
        $dbParams['unix_socket'] = '/run/mysqld/mysqld.sock';
    }

    $connection = DriverManager::getConnection($dbParams, $config);

    return new EntityManager($connection, $config);
};
