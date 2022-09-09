<?php
    
    define('DATABASE_HOST', 'localhost');           // Database host
    define('DATABASE_NAME', 'im_done_2');           // Name of the database to be used
    define('DATABASE_USERNAME', 'root');       // User name for access to database
    define('DATABASE_PASSWORD', '');   // Password for access to database
    
    define('DB_PREFIX', '');		        // Unique prefix of all tables in the database

    define('PASSWORDS_ENCRYPTION_TYPE',  'MD5');  // AES|MD5
    define('PASSWORDS_ENCRYPTION',  true);              // true|false
    define('PASSWORDS_ENCRYPT_KEY', 'php_easy_installer');

    define('FOLDER_ROOT', 'imdone');
    define('SITE_URL', 'localhost'.('imdone' == '' ? '' : '/'.'imdone'));
    
