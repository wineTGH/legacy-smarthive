<?php
    ini_set('error_reporting', E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1); 

echo get_user_time('Asia/Vladivostok');

function get_user_time($user_timezone):string {
    $url       = "http://worldtimeapi.org/api/timezone/".$user_timezone;
    $result    = file_get_contents ($url);
    $result    = json_decode($result, true);
    
    if(isset($result)) {
        //TODO Время уходит в минус, если на часах 23:00
        $unix_time = $result["unixtime"];
        $output = shell_exec("python3 ./time.py {$unix_time}");
        return $output;
    }
}

?>