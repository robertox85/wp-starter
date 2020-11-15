<?php

require_once 'posts.php';
require_once 'tax.php';
require_once 'common.php';
require_once 'log.php';
require_once 'menu.php';
/**
 * Class Importer (static).
 *
 * This class extend common class and it called by jobs for importing contents in wordpress blog
 * Required by posts.php,comments.php,taxonomy.php,users.php,common.php,Log.php
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
class Importer extends common
{
    /**
     * construct is not used.
     */

  
    public static function posts($postType)
    {
        $posts = new Posts($postType);
        $posts->load_csv();
        $posts->insert();
        $posts = null;
    }


    public static function tax($taxonomy,$data)
    {
        Log::start_script('start Import tax '.$taxonomy);
        $tax = new Tax($taxonomy,$data);
        $tax->insert();
        Log::stop_script('end Import tax '.$taxonomy);
    }

    public static function menu($name, $location, $data)
    {
        Log::start_script('start Import menu ' . $name);
        $menu = new Menu( $name, true, $data );
        $menu->setLocation($location);
        $menu->create();
        Log::stop_script('end Import menu '.$name);
    }
}
