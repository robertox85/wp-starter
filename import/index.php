<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
ini_set('memory_limit', '-1');
setlocale(LC_TIME, 'it_IT');
gc_enable();
//define('WP_USE_THEMES', true);
$wp_root_path = dirname(dirname(__DIR__, 3)) . '/';

require $wp_root_path . '/wp-load.php';
require_once $wp_root_path . '/wp-admin/includes/taxonomy.php';
require_once get_template_directory() . '/import/class/importer.php';

if (isset($argv)) {
    parse_str(
        join(
            '&', array_slice($argv, 1)
        ), $_GET
    );
}


//Importer::posts_by_date('20170101', '20170201');
if ($_GET['key'] == 'import') {
    switch ($_GET['type']) {
    case 'tax':
        $classi = [
                
        ];
        Importer::tax("classi", $classi);
        break;
    case 'corsiOnline':
        Log::start_script('Import corsi-online', true);
            Importer::posts("corsi-online");
            gc_collect_cycles();
            //Log::warning('MEMORY USAGE: '.memory_get_peak_usage(), true);
        Log::stop_script('END Import corsi-online', true);
        break;
    case 'sedi':
            Log::start_script('Import sedi', true);
                Importer::posts("sedi");
                gc_collect_cycles();
                //Log::warning('MEMORY USAGE: '.memory_get_peak_usage(), true);
            Log::stop_script('END Import sedi', true);
        break; 
    case 'ateneo':
        Log::start_script('Import ateneo', true);
            Importer::posts("ateneo");
            gc_collect_cycles();
            //Log::warning('MEMORY USAGE: '.memory_get_peak_usage(), true);
        Log::stop_script('END Import ateneo', true);
        break;   
    case 'page':
        Log::start_script('Import pagine', true);
            Importer::posts("page");
            gc_collect_cycles();
            //Log::warning('MEMORY USAGE: '.memory_get_peak_usage(), true);
        Log::stop_script('END Import pagine', true);
        break;   
    case 'menu':
        Log::start_script('Import menu', true);
            Importer::menu("menu", "primary", array());
            gc_collect_cycles();
            //Log::warning('MEMORY USAGE: '.memory_get_peak_usage(), true);
        Log::stop_script('END Import menu', true);
        break; 
    default:
        echo 'PARAMETRO MANCANTE';
    }
} else {
    echo 'CHIAMATA NON VALIDA';
}
?>