<?php

/**
 * Used to generate database configuration
 * Save your database configuration here
 */

// Pourquoi pas utiliser un .ENV ?
$env_vars = parse_ini_file(__DIR__ . '/.env');

return array(
    'host' => $env_vars['DB_HOST'],
    'user' => $env_vars['DB_USER'],
    'password' => $env_vars['DB_PASSWORD'],
    'port'=> $env_vars['DB_PORT'],
    'name' => $env_vars['DB_NAME']
);
