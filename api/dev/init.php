<?php
//_____________Config Class_____________\\
/**
 * @method init 
 */
class Config
{  
    public static $data;
    public static $composer;
    /**
     * @return null
     */
    public static function init(){
        $data = file_get_contents('app_config.json');
        self::$data = json_decode($data);

        $composer = file_get_contents('composer.json');
        self::$composer = json_decode($composer);

        foreach(self::$composer->load as $comp){
            include_once($comp);
        }
    }
    
}

//_____________Initiation Config Class_____________\\
Config::init();





