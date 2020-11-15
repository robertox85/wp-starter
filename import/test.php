<?php

error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
ini_set('memory_limit', '-1');
setlocale(LC_TIME, 'it_IT');
gc_enable();
define('WP_USE_THEMES', true);
require '../wp/wp-load.php';
require_once '../wp/wp-admin/includes/taxonomy.php';



        //Enter your code here, enjoy!
$content = "Lo sconto è duplice: Amazon Echo (2a generazione) passa da 99,99 euro a 64,99€, con uno sconto complessivo pari a ben il 35%. Ancor più ampia è invece la sforbiciata per Amazon Echo Dot di 3a generazione, la versione dell'assistente vocale: il prezzo in questo caso passa da 59,99 euro a 29,99 euro con uno sconto complessivo pari al 50%. In entrambi i casi lo sconto è valido su tutte e tre le colorazioni disponibili (antracite, grigio chiaro e grigio mélange). Qui i riferimenti per l'acquisto scontato:


Amazon Echo (64,99 euro)
Amazon Echo Dot (29,99 euro)
[gallery_embed id=88385]

Sebbene Amazon non specifichi quanto sia destinata a durare l'offerta, con ogni probabilità durerà appena qualche ora, forse l'intera giornata, in ottemperanza a quelle che sono le politiche di sconto adottate dalla sezione . Non è detto che sconti similari non possano in seguito essere applicati anche su Echo Plus e Echo Spot, le ulteriori due versioni dell'assistente basato su Alexa.";
 

preg_match_all('/\[gallery_embed id=(.*?)\]/', $content, $matches);

foreach($matches[0] as $key=>$gallery_short_code){
    $gallery_post_id = $matches[1][$key];

    // La Query
    $gallery = new WP_Query([post_type => 'gallery', p => $gallery_post_id]);

    if($gallery->have_posts()){
        $native_gallery = ($gallery->posts[0]->post_content);
        $content = str_replace($gallery_short_code, $native_gallery,$content);

    } 
    wp_reset_query();
}


echo $content;

print_r($matches);

/*
$speciali = wp_get_nav_menu_items('speciali_home');

// print_r($speciali);

foreach($speciali as $speciale){
    $img_meta = (get_term_meta( $speciale->object_id, 'immagine'));
    $immagine = (empty($img_meta))? null : wp_get_attachment_metadata($img_meta[0]);
    $base_dir =  explode('/', $immagine['file']);
    array_pop($base_dir); // remove last element
    $base = '/app/uploads/'.implode('/', $base_dir);

    echo 'home '.get_theme_path();

    //print_r($immagine);
    // $credits = wp_get_attachment_metadata ($id_immagine);
    //print_r($speciale);
    //echo "\n\t\t\t\t\t oid >> ".$speciale->object_id;
    echo "\n\t\t\t\t\t mobile >> ".$base.$immagine['sizes']['mobile']['file'];
    echo "\n\t\t\t\t\t mobile_x2 >> ".$base.$immagine['sizes']['mobile_x2']['file'];
    echo "\n\t\t\t\t\t thumbnail >> ".$base.$immagine['sizes']['thumbnail']['file'];
    echo "\n\t\t\t\t\t thumbnail_x2 >> ".$base.$immagine['sizes']['thumbnail_x2']['file'];
    
    //echo "\n\t\t\t\t\t cdt >> "; print_r($immagine);
    
}
*/