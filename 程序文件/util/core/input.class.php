<?php
/**
 * Input Class 
 *
 * To init the request variables 
 *
 * @author  Eric,<wangyinglei@yeah.net;QQ:31301678>Aimosoft Studio
 * @update 2013/8/22 14:11
 * @version $Id: class_input.php 101 2013-10-15 06:43:41Z Eric $
 */
class Input{

    /**
     * Boolean Input::isPost()
     *
     * Check if is HTTP POST method
     *
     * @return Boolean
     */
    public static function isPost()
    {
        if( ($_SERVER['REQUEST_METHOD'] == 'POST') && 
            empty($_SERVER['HTTP_X_FLASH_VERSION']) && 
            ( empty($_SERVER['HTTP_REFERER']) ||
              preg_replace("/https?:\/\/([^\:\/]+).*/i", "\\1", $_SERVER['HTTP_REFERER']) == preg_replace("/([^\:]+).*/", "\\1", $_SERVER['HTTP_HOST']) 
            )
        ) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * mixed  Input::get(string $key,string $filter)
     *
     * Get variables from $_GET
     *
     * @param   string  $key    key
     * @param   string  $filter filter type
     * @return  mixed
     */
    public static function get($key, $filter='')
    { 
        if(isset($_GET[$key])){
            return $filter ? self::$filter($_GET[$key]) : $_GET[$key];   
        }
        return FALSE;
    }

    /**
     * mixed  Input::post(string $key,string $filter)
     *
     * Get variables from $_POST
     *
     * @param   string  $key    key
     * @param   string  $filter filter type
     * @return  mixed
     */
    public static function post($key, $filter='')
    { 
        if(isset($_POST[$key])){
            return $filter ? self::$filter($_POST[$key]) : $_POST[$key]; 
        }
        return FALSE;
    }

    /**
     * mixed  Input::request(string $key,string $filter)
     *
     * Get variables from $_REQUEST
     *
     * @param   string  $key    key
     * @param   string  $filter filter type
     * @return  mixed
     */
    public static function request($key, $filter='')
    { 
        if(isset($_REQUEST[$key])){
            return $filter ? self::$filter($_REQUEST[$key]) : $_REQUEST[$key]; 
        }
        return FALSE;
    }

    /**
     * Get text and prevent html 
     */
    private static function text($str){ return htmlspecialchars(trim($str));}

    /**
     * return intval
     */
    private static function int($n){ return intval($n);}

    /**
     * return [0-9]+
     */
    private static function num($str){ return preg_replace('/[^0-9]+/i','',strval($str));}

    /**
     * return floatval
     */
    private static function float($n){ return floatval($n);}

    /**
     * return [a-z]+
     */
    private static function char($str){ return preg_replace('/[^a-z]+/i','',$str);}

    /**
     * return safe html
     */
    private static function html($str){ return RXSS($str);}
    
    private static function date($str){ return strtotime($str) ? $str : false;}
}