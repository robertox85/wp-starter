<?php

/**
 * Functions
 */

 // Define path and URL to the ACF plugin.
define( 'CORE_PATH', get_template_directory() . '/core/' );
define( 'CORE_URL', get_template_directory_uri() . '/core/' );


// Start Timber
require 'class/StarterSite.php';

// Load functions
require 'core/functions/hook.php';
require 'core/functions/custom.php';
require 'core/actions-filters.php';
// require 'core/inc/admin/customizer.php';


//  Load class
require 'class/Helper.php';
require 'class/WPBootstrapNavwalker.php';
require 'class/Calendario.php';
require 'class/WidgetFactory.php';
require 'class/Widget.php';


// load CORE
require 'core/ThemeManager.php';
require 'core/MenuManager.php';
require 'core/SidebarsManager.php';
require 'core/PostTypesManager.php';
require 'core/CustomizerManager.php';