<?php
/**
 * Handle file actions.
 *
 * @author Emanuele Gennuso
 *
 * @version 0.1
 */
class Common
{
    /**
     * construct is not used.
     */
    public static function get_feed($url)
    {

        $context = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
        $xml = file_get_contents($url, false, $context);

        $xml = self::xml2array(simplexml_load_string(utf8_encode($xml), null, LIBXML_NOCDATA));

        $temp = array();
        if (!isset($xml['post']['old_ID'])) {
            $temp = $xml;
        } else {
            $temp[0] = $xml;
        }

        return $temp;
        $temp = null;
    }

    public static function xml2array($xmlObject, $out = array())
    {
        foreach ((array) $xmlObject as $index => $node) {
            $out[$index] = (is_object($node)) ? self::xml2array($node) : $node;
        }

        return $out;
    }

    public static function get_csv($file)
    {

        
        $temp = [];
        $row = 1;
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                $num = count($data);
                //echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                if ($row > 3) 
                    $temp[] = $data;
                
            }
            fclose($handle);
        }
        return $temp;
        $rowTemp = null;
        $temp = null;
    }

    
    public static function slugify($string) {

        $table = array(
                'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z', 'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
                'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
                'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
                'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
                'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
                'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
                'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r', '/' => '-', ' ' => '-'
        );
        // -- Remove comma
        $string = str_replace(',',' ',$string);
        // -- Remove duplicated spaces
        $string = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $string);
        // -- Returns the slug
        return strtolower(strtr($string, $table));
    }
}
