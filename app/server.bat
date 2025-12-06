ECHO OFF

REM Sets temporary path for libs
SET PATH=php

SET FILES=dir

IF EXIST database.sqlite (
    DEL database.sqlite
)

REM Starts database connection
php database_connect.php

REM Populate database
php database_startup.php

REM Opens web app in browser.
php -S localhost:8000

REM Note that when you close the window, the server closes automatically