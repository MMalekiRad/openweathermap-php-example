<?php
/*
* Mr OK
* 5/29/2019
*/

// constants
define('HOST', 'localhost'); // host
define('USERNAME', 'root'); // database username: pgs: postgres
define('PASSWORD', ''); // database password
define('DATABASE', 'mydb'); // database
define('PORT', 5432); // use your postgres port

define('OPEN_WEATHER_API_URL', 'https://samples.openweathermap.org/data/2.5/weather');
define('OPEN_WEATHER_API_APP_ID', '3ab0e4082fe4f1d1ee04c4cb8698d9cd');

require_once '_classes/class-autoloader.php';


//for using postgres set $db_type = postgres
$db_connection = DbHelper::get_instance('mysql'); // return a db connection

$open_weather_data = OpenWeather::get_data(46, 36); // return json data from https://openweathermap.org

$db_connection->query("CREATE TABLE IF NOT EXISTS `mydb`.`weather_data` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `data` TEXT NOT NULL , PRIMARY KEY (`id`))");

if (!is_null($open_weather_data)) {
    $serialize_weather_data = serialize($open_weather_data);
    $save = $db_connection->query("INSERT INTO `weather_data` (`data`) VALUES ('{$serialize_weather_data}');");
    echo ($save) ? "Information was stored in the database!" : "An error occurred in storing information in the database.";
}


