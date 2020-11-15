<?php

/**
 * Header
 *
 * Main header file for the theme.
 *
 * @package    WordPress
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>

	<!--=== META TAGS ===-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="description" content="<?php bloginfo( 'description' ); ?>">
	<meta name="author" content="<?php wp_get_theme()->get( 'Author' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!--=== LINK TAGS ===-->
	<link rel="shortcut icon" href="<?php bloginfo( 'url' ); ?>/favicon.ico" />

	<!--=== TITLE ===-->
	<title><?php wp_title(); ?> - <?php bloginfo( 'name' ); ?></title>

	<!--=== WP_HEAD() ===-->
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	
	<?php starter_get_template_version('header'); ?>

	<main id="swup" class="site-content container-fluid transition-fade">
	
