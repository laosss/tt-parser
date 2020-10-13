<?php

return [
    'database' => [
        'type' => 'mysql',
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'name' => 'db1',
        'enc'  => 'utf8',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];