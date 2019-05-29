<?php
/*
* Mr OK
* 5/29/2019
*/

class OpenWeather
{
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function get_data($lat, $lon)
    {
        $app_id = OPEN_WEATHER_API_APP_ID;
        $api_url = OPEN_WEATHER_API_URL . "?lat={$lat}&lon={$lon}&appid={$app_id}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $content = curl_exec($ch);
        curl_close($ch);

        return $content;
    }
}