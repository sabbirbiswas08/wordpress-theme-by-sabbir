<?php
/**
 * Theme functions and definitions
 */

if ( ! function_exists( 'civiclick_setup' ) ) :
    function civiclick_setup() {
        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        // Let WordPress manage the document title.
        add_theme_support( 'title-tag' );

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support( 'post-thumbnails' );

        // Switch default core markup for search form, comment form, and comments
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );
    }
endif;
add_action( 'after_setup_theme', 'civiclick_setup' );

/**
 * Enqueue scripts and styles.
 */
function civiclick_scripts() {
    wp_enqueue_style( 'civiclick-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version') );
    
    // Load custom script
    wp_enqueue_script( 'civiclick-app', get_template_directory_uri() . '/app.js', array(), wp_get_theme()->get('Version'), true );
}
add_action( 'wp_enqueue_scripts', 'civiclick_scripts' );
