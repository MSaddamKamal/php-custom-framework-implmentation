<?php

return [
    'database' => [
        'name' => 'scandiweb',
        'username' => 'root',
        'password' => '',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            // Displays an error (rather than blank page) if DB access fails:
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
    ],
];
