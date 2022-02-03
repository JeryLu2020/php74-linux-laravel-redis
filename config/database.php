<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'jery-mysql.mysql.database.azure.com'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'jery@jery-mysql'),
            'password' => env('DB_PASSWORD', 'Qazxsw521'),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => 'g5C8VHlQNjSnbfR28zgy5Qa1lcTR9fkI8AzCaNHLXe4=',
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'test-redis-cluster.redis.cache.windows.net'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        'redis' => [

            'client' => env('REDIS_CLIENT', 'predis'),
            'cluster' => env('REDIS_CLUSTER_ENABLED', true),
            'prefix_indexes' => false,

            // 'clusters' => [
            //     'default' => [
            //         [
            //             'scheme'   => env('REDIS_SCHEME', 'tcp'),
            //             'host' => env('REDIS_HOST', 'test-redis-cluster.redis.cache.windows.net'),
            //             'password' => env('REDIS_PASSWORD', 'g5C8VHlQNjSnbfR28zgy5Qa1lcTR9fkI8AzCaNHLXe4='),
            //             'port' => env('REDIS_PORT', 6379),
            //             'database' => env('REDIS_DATABASE', 0),
            //         ],
            //     ],
            //     'options' => [ // Clustering specific options
            //         'cluster' => 'redis', // This tells Redis Client lib to follow redirects (from cluster)
            //     ]
            // ],
            // 'options' => [
            //     'parameters' => [ // Parameters provide defaults for the Connection Factory
            //         'password' => env('REDIS_PASSWORD', 'g5C8VHlQNjSnbfR28zgy5Qa1lcTR9fkI8AzCaNHLXe4='), // Redirects need PW for the other nodes
            //         'scheme'   => env('REDIS_SCHEME', 'tcp'),  // Redirects also must match scheme
            //     ],
            //     'ssl'    => ['verify_peer' => false], // Since we dont have TLS cert to verify
            // ]

            'clustered' => [
                'client' => 'predis',
                'cluster' => true,
                'options' => [ 'cluster' => 'redis' ],
                'clusters' => [
                            [
                                'host' => env('REDIS_SHARD_1_HOST', 'test-redis-cluster.redis.cache.windows.net'),
                                'password' => env('REDIS_PASSWORD', 'g5C8VHlQNjSnbfR28zgy5Qa1lcTR9fkI8AzCaNHLXe4='),
                                'port' => env('REDIS_SHARD_1_PORT', 6379),
                                'database' => 0,
                            ],
                            [
                                'host' => env('REDIS_SHARD_2_HOST', 'test-redis-cluster.redis.cache.windows.net'),
                                'password' => env('REDIS_PASSWORD', 'g5C8VHlQNjSnbfR28zgy5Qa1lcTR9fkI8AzCaNHLXe4='),
                                'port' => env('REDIS_SHARD_2_PORT', 6379),
                                'database' => 0,
                            ],
                            [
                                'host' => env('REDIS_SHARD_3_HOST', 'test-redis-cluster.redis.cache.windows.net'),
                                'password' => env('REDIS_PASSWORD', 'g5C8VHlQNjSnbfR28zgy5Qa1lcTR9fkI8AzCaNHLXe4='),
                                'port' => env('REDIS_SHARD_3_PORT', 6379),
                                'database' => 0,
                            ],
                ],
            ],

            // 'default' => [
            //     'host' => env('REDIS_HOST', 'test-redis-cluster.redis.cache.windows.net'),
            //     'password' => env('REDIS_PASSWORD', 'g5C8VHlQNjSnbfR28zgy5Qa1lcTR9fkI8AzCaNHLXe4='),
            //     'port'     => 6379,
            //     'database' => 0,
            //     'cluster' => false,
            // ],


        ],


    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', 'test-redis-cluster.redis.cache.windows.net'),
            'password' => env('REDIS_PASSWORD', 'g5C8VHlQNjSnbfR28zgy5Qa1lcTR9fkI8AzCaNHLXe4='),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', 'test-redis-cluster.redis.cache.windows.net'),
            'password' => env('REDIS_PASSWORD', 'g5C8VHlQNjSnbfR28zgy5Qa1lcTR9fkI8AzCaNHLXe4='),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
