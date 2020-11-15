<?php

require_once 'common.php';
require_once 'log.php';
/**
 * Class Users.
 *
 * This class is used to import users from xml feed to wordpress
 * Required by common.php & log.php
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
class Tax extends Common
{

    private $taxonomy;
    private $data;
    private $debug = true;
    /**
     * construct is not used.
     */
    public function __construct($taxonomy,$data)
    {
        $this->taxonomy = $taxonomy;
        $this->data = $data;
    }

    public function insert()
    {
        foreach ($this->data as $data){
            wp_insert_term($data["label"],$this->taxonomy,['description' => $data["descr"]]);
            Log::note('Tax created : '.$data["label"].' - '.$data["descr"], $this->debug);
        }
    }
}
