<?php

//Database Connection
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_USER', 'root');
define('DB_PASS', '');

// Images configs
define('MAX_IMAGE_SIZE', 5242880); // 5MB
define('ALLOWED_IMAGE_TYPE',['image/jpeg', 'image/png', 'image/jpg']);

define('COOKIE_EXP_TIME', 2592000); // 30 days in seconds


// fields constraints 
define('MAX_USERNAME_LENGTH', 20);
define('MINIMUM_AGE', 10);