<?php

require_once 'common.php';
require_once 'log.php';
/**
 * Class Posts.
 *
 * This class is used to import all posts from xml feed to wordpress
 * Required by common.php & log.php
 *
 * PHP versions >= 5
 *
 * @category Class
 *
 * @author    Original Author <e.gennuso@f2innovation.com>
 * @copyright 2018 F2Innovation.com
 * @license   F2Innovation.com
 *
 * @version 1.0
 */
class Posts extends Common
{
    private $postType;
    private $loadedData;
    private $debug = true;

    /**
     * construct is not used.
     */
    public function __construct($postType)
    {
        $this->postType = $postType;
    }

    public function load_csv()
    {  
        if ($this->postType == "corsi-online") { 
            $this->loadedData = $this->get_csv('./data/corsi-di-laurea-online.csv');
        }    
        if ($this->postType == "sedi") { 
            $this->loadedData = $this->get_csv('./data/sedi.csv');
        }  
        if ($this->postType == "ateneo") { 
            $this->loadedData = $this->get_csv(get_template_directory() . '/import/data/atenei.csv');
        }  
        if ($this->postType == "page") { 
            $this->loadedData = $this->get_csv(get_template_directory() . '/import/data/pages.csv');
        }  
    }

    public function insert()
    {
        if ($this->postType == "corsi-online") {   
            $this->insertCorsiOnline();
        }
        if ($this->postType == "sedi") {   
            $this->insertSedi();
        }
        if ($this->postType == "ateneo") {   
            $this->insertPagesAtenei();
        }
        if ($this->postType == "page") {   
            $this->insertPages();
        }
    }

    public function insertSedi()
    {
        global $wpdb;

        $postData = new StdClass;
        
        /*
        foreach($this->loadedData as $loadedData){
            if( !term_exists($loadedData[1], 'citta' ) ) 
                wp_insert_term($loadedData[1],"citta");
        
            $parent_term = get_term_by('name', $loadedData[1], 'citta');
            if( !term_exists($loadedData[2], 'citta' ) ) 
                wp_insert_term($loadedData[2],"citta",["parent"=>$parent_term->term_id]);
            
            Log::note('Tax citta created : '.$loadedData[1].' - '.$loadedData[2], $this->debug);
        }
        */
        foreach($this->loadedData as $loadedData){
            $category = $loadedData[0];
            
            $postData->post_type = $this->postType;
            $postData->indirizzo = trim($loadedData[3]);
            $postData->category = get_category_by_slug($this->slugify($category));
            $postData->citta = get_term_by('name', trim($loadedData[2]), 'citta');
            $postData->hq = strtolower(trim($loadedData[4]));
            
            $postData->post_title = "Sede ".$postData->indirizzo." ".$postData->citta->name." ".$postData->category->name;
            
            $postData->post_name = "sede-".$this->slugify($postData->indirizzo)."-".$postData->citta->slug."-".$postData->category->slug;
          
            $new_post = array(
                'ID' => '',
                'post_title' => $postData->post_title,
                'post_name' => $postData->post_name,
                'post_type' => $postData->post_type,
                'post_status' => 'publish',
                'post_author' => 2,
            );   
               
            $postID = wp_insert_post($new_post);
            if (!is_wp_error($postID)) {
                wp_set_object_terms($postID, $postData->category->term_id, "category");
                wp_set_object_terms($postID, intval($postData->citta->term_id), "citta");
                update_field('hq', $postData->hq, $postID);
                update_field('indirizzo', $postData->indirizzo, $postID);
                Log::note('Post created : '.$postID.' - '.$postData->post_title, $this->debug);
            } else {
                Log::error('POST WP ERROR: ', $this->debug);
            }
            /*
            print_r($loadedData);
            print_r($postData);
            print_r("\n");
            exit;
            */
            $postData = new StdClass;



        }

    }

    public function insertCorsiOnline()
    {
        global $wpdb;

        $postData = null;
        
        foreach($this->loadedData as $loadedData){
            $postData->post_type = $this->postType;
            $postData->post_title = trim($loadedData[1]);
            $category = (strpos($loadedData[0], ".") !== false) ? trim(explode(".", $loadedData[0])[1]) : trim($loadedData[0]);
            $postData->category = get_category_by_slug($this->slugify($category));
            $postData->area = get_term_by('name', trim($loadedData[3]), 'area');
            $postData->tipologia = get_term_by('name', trim($loadedData[4]), 'tipologia');
            $postData->classe = get_term_by('name', trim($loadedData[5]), 'classe');
            $postData->note = trim($loadedData[7]);
            $postData->costo = trim($loadedData[8]);
            $curricula = [];
            if (!empty($loadedData[9])) {
                if (strpos($loadedData[9], "\"") !== false) {
                    $curricula_arr = explode("\",\"", $loadedData[9]);  
                } elseif (strpos($loadedData[9], ",") !== false) {
                    $curricula_arr = explode(",", $loadedData[9]);
                }

                foreach ($curricula_arr as $cur) {
                    $curricula[] = ["curricula" => str_replace("\"", "", $cur)];
                }
            }
            $postData->curricula = $curricula;
            $postData->CFU = trim($loadedData[10]);
            $postData->post_name = $postData->tipologia->slug."-".$postData->classe->slug."-".$this->slugify($postData->post_title)."-".$postData->category->slug;
            
            //if (!empty($postData->curricula)){
                 //print_r($loadedData);
                 //print_r($postData);
                 //print_r("\n");
               // exit;
            //}
            
            $new_post = array(
                'ID' => '',
                'post_title' => $postData->post_title,
                'post_name' => $postData->post_name,
                'post_type' => $postData->post_type,
                'post_status' => 'publish',
                'post_author' => 2,
            );   
            
            $postID = wp_insert_post($new_post);
            if (!is_wp_error($postID)) {
                wp_set_object_terms($postID, intval($postData->category->term_id), "category");
                wp_set_object_terms($postID, intval($postData->tipologia->term_id), "tipologia");
                wp_set_object_terms($postID, intval($postData->classe->term_id), "classe");
                wp_set_object_terms($postID, intval($postData->area->term_id), "area");
                if (!empty($postData->note)) { update_field('note', $postData->note, $postID);
                }
                if (!empty($postData->costo)) { update_field('costo', $postData->costo, $postID);
                }
                if (!empty($postData->CFU)) { update_field('cfu', $postData->CFU, $postID);
                }
                if (!empty($postData->curricula)) { update_field('curricola_list', $postData->curricula, $postID);
                }
                Log::note('Post created : '.$postID.' - '.$postData->post_title, $this->debug);
            } else {
                Log::error('POST WP ERROR: ', $this->debug);
            }
            $postData = null;
            //exit;
        }

        // exit;
                
    }

    public function insertPagesAtenei()
    {
        global $wpdb;

        $postData = null;
        
        foreach($this->loadedData as $loadedData){
           
            $postData->post_type = $this->postType;
            $postData->post_title = trim($loadedData[0]);
            $postData->post_name = $loadedData[1];
            $category = $loadedData[2];
            $postData->category = get_category_by_slug($this->slugify($category));
                 
            //if (!empty($postData->curricula)){
                 //print_r($loadedData);
                 //print_r($postData);
                 //print_r("\n");
               // exit;
            //}
            
            $new_post = array(
                'ID' => '',
                'post_title' => $postData->post_title,
                'post_name' =>  $postData->post_name,
                'post_type' =>  $postData->post_type,
                'post_status' => 'publish',
                'post_author' => 2,
            );   
            
            $postID = wp_insert_post($new_post);
            if (!is_wp_error($postID)) {
                wp_set_object_terms($postID, intval($postData->category->term_id), "category");
                Log::note('Post created : '.$postID.' - '.$postData->post_title, $this->debug);
            } else {
                Log::error('POST WP ERROR: ', $this->debug);
            }
            $postData = null;
            //exit;
        }

        // exit;
                
    }

    

    
}