<?php
/**
 * From: https://gist.github.com/4148529
 *
 * @method Menu db_id
 * @method Menu object_id
 * @method Menu object
 * @method Menu parent_id
 * @method Menu position
 * @method Menu type
 * @method Menu title
 * @method Menu url
 * @method Menu description
 * @method Menu attr-title
 * @method Menu target
 * @method Menu classes
 * @method Menu xfn
 * @method Menu status
 */
class Menu
{

    /**
     * @var null 
     */
    public $id = null;

    /**
     * @var null 
     */
    public $menu = null;

    /**
     * @var int 
     */
    public $position = 1;

    /**
     * @var array 
     */
    public $item = null;

    public $is_new_menu = false;
    
    public $data = null;

    /**
     * @param $name
     * @param bool $delete
     */
    public function __construct($name, $delete = true, $data)
    {
        if ($delete) { 
            wp_delete_nav_menu($name);
        }

        $this->data = $data;

        if (is_nav_menu($name)) {
            $this->menu = wp_get_nav_menu_object($name);
            $this->id = (int)$this->menu->term_id;
        } else {
            $this->id = (int)wp_create_nav_menu($name);
            $this->menu = wp_get_nav_menu_object($name);
            $this->is_new_menu = true;
        }
    }

    public function create()
    {

        // The WordPress functions changed since the answers here in 2014.
        // As of today (Version 4.6.1) this code will create a main menu named "My Menu" , main item and sub item.
        // To run code just paste and saves in your functions.php file in your child theme.

        // $menu_id = wp_create_nav_menu('My Menu');

        // $parent_item = wp_update_nav_menu_item($menu_id, 0, array(
        //     'menu-item-title' =>  __('Main Page'),
        //     'menu-item-url' => home_url( '/main-page/' ), 
        //     'menu-item-status' => 'publish', 
        //     )
        // );

        // wp_update_nav_menu_item($menu_id, 0, array(
        //     'menu-item-title' =>  __('Sub Item Page'),
        //     'menu-item-url' => home_url( '/sub-item-page/' ), 
        //     'menu-item-status' => 'publish', 
        //     'menu-item-parent-id' => $parent_item)
        // );

    }
    /**
     * @return object
     */
    public function save()
    {
        // upravim pole pred save
        $this->item['menu-item-position'] = isset($this->item['menu-item-position']) ? $this->item['menu-item-position'] : $this->position++;
        $this->item['menu-item-status']   = isset($this->item['menu-item-status']) ? $this->item['menu-item-status'] : 'publish';
        $this->item['menu-item-type']     = isset($this->item['menu-item-type']) ? $this->item['menu-item-type'] : 'custom';

        $id = wp_update_nav_menu_item($this->id, 0, (array)$this->item);
        $this->item = array(); // smazu po ulozeni

        // WILL be fix in new Wordpess 3.5
        // FIXME https://github.com/WordPress/WordPress/commit/ae96b842f9f55ecfb22da705a4902b9d25580259#wp-includes/nav-menu.php
        if ($this->id && (!is_object_in_term($id, 'nav_menu', (int)$this->id))) {
            wp_set_post_terms($id, array((int)$this->id), 'nav_menu');
        }

        return wp_setup_nav_menu_item($id);
    }

    /**
     * @param string $location
     */
    public function setLocation($location = 'primary')
    {
        $locations = get_nav_menu_locations();
        $locations[$location] = $this->menu->term_id;
        set_theme_mod('nav_menu_locations', $locations);
    }

    /**
     * @return array|WP_Error
     */
    public static function getAllMenus()
    {
        return get_terms('nav_menu', array('hide_empty' => true));
    }

    /**
     * @param  $name
     * @param  $value
     * @return Menu
     */
    public function __call($name, $value)
    {
        $this->item['menu-item-' . str_replace('_', '-', $name)] = reset($value);
        return $this;
    }
}