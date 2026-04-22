<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@700;800&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

    <header>
        <div class="container nav-content">
            <div class="logo">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <?php echo get_bloginfo( 'name' ); ?>
                </a>
            </div>
            <nav>
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => false, // We'll provide a fallback if no menu exists
                ) );
                ?>
                <!-- Fallback static menu for ease of use before assigning WP menu -->
                <?php if ( ! has_nav_menu( 'primary' ) ) : ?>
                    <ul>
                        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a></li>
                        <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                    </ul>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main>
