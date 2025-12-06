cd "%~dp0"\app

REM Starts the webserver.
START cmd /k CALL server.bat

REM Opens browser and points to the localhost after a couple of seconds.
SET WAIT_TIME=2
START http://localhost:8000/ctf.php