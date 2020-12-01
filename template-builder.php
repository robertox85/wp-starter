<?php
/**
 * Template Name: Page builder
 *
 * @package WordPress
 **/

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;

Timber::render( 'page-builder.twig', $context );
