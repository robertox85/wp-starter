<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Class Log (static).
 *
 * This class is used to output log script (to be redirected into files)
 * Required by init.php
 *
 * PHP versions >= 5
 *
 *
 * @category   Class
 *
 * @author     Original Author <e.gennuso@f2innovation.com>
 * @copyright  2018 F2Innovation.com
 * @license    F2Innovation.com
 *
 * @version    1.0
 */
class Log
{
    private static $logFile = './logs/log.txt';

    public static function start_script($name, $onlyShow = false)
    {
        $text = '**** START SCRIPT - '.$name.' - '.date('Y-m-d h:m:s')." - **********\n";
        if (!$onlyShow) {
            file_put_contents(self::$logFile, $text, FILE_APPEND | LOCK_EX);
        }
        echo $text;
        $text = null;
    }

    public static function stop_script($name, $onlyShow = false)
    {
        $text = '**** END SCRIPT - '.$name.' - '.date('Y-m-d h:m:s')." - **********\n";
        if (!$onlyShow) {
            file_put_contents(self::$logFile, $text, FILE_APPEND | LOCK_EX);
        }
        echo $text;
        $text = null;
    }

    public static function note($text, $onlyShow = false)
    {
        if (!is_string($text)) {
            $text = 'Note: '.json_encode($text).' - '.date('Y-m-d h:m:s')."\n";
        } else {
            $text = 'Note: '.$text.' - '.date('Y-m-d h:m:s')."\n";
        }
        if (!$onlyShow) {
            file_put_contents(self::$logFile, $text, FILE_APPEND | LOCK_EX);
        }
        echo $text;
        $text = null;
    }

    public static function warning($text, $onlyShow = false)
    {
        $text = 'WARNING!!: '.$text.' - '.date('Y-m-d h:m:s')."\n";
        if (!$onlyShow) {
            file_put_contents(self::$logFile, $text, FILE_APPEND | LOCK_EX);
        }
        echo $text;
        $text = null;
    }

    public static function error($text, $onlyShow = false)
    {
        $text = 'ERROR!!: '.$text.' - '.date('Y-m-d h:m:s')."\n";
        if (!$onlyShow) {
            file_put_contents(self::$logFile, $text, FILE_APPEND | LOCK_EX);
        }
        echo $text;
        $text = null;
        self::stop_script();
        exit();
    }
    public static function override($text, $onlyShow = false)
    {
        //$text = 'ERROR!!: '.$text.' - '.date('Y-m-d h:m:s')."\n";
        //echo $text;
        $text = null;
    }
}
