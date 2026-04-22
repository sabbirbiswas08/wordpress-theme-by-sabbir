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

        // Register Navigation Menus
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary Menu', 'civiclick' ),
        ) );

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
    wp_enqueue_script( 'civiclick-app', get_template_directory_uri() . '/assets/js/app.js', array(), wp_get_theme()->get('Version'), true );
}
add_action( 'wp_enqueue_scripts', 'civiclick_scripts' );

/**
 * Handle Native Contact Form Submission (No Plugin Required!)
 */
function handle_native_contact_form() {
    // Check nonce for security
    if ( ! isset( $_POST['native_contact_nonce'] ) || ! wp_verify_nonce( $_POST['native_contact_nonce'], 'native_contact_action' ) ) {
        wp_die( 'Security check failed' );
    }

    // Sanitize input fields
    $name    = sanitize_text_field( $_POST['full_name'] );
    $email   = sanitize_email( $_POST['email_address'] );
    $message = sanitize_textarea_field( $_POST['message_content'] );

    // Get the site admin email to send the message to
    $to = get_option( 'admin_email' );
    $subject = 'New Contact Form Submission from ' . $name;
    
    $body = "Name: $name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>');

    // Send email
    $sent = wp_mail( $to, $subject, $body, $headers );

    // Redirect back with a status parameter
    $redirect_url = wp_get_referer();
    if ( $sent ) {
        $redirect_url = add_query_arg( 'contact', 'success', $redirect_url );
    } else {
        $redirect_url = add_query_arg( 'contact', 'error', $redirect_url );
    }
    
    // Ensure redirect url includes anchor if needed
    $redirect_url .= '#contact';

    wp_safe_redirect( $redirect_url );
    exit;
}
add_action( 'admin_post_nopriv_submit_native_contact_form', 'handle_native_contact_form' );
add_action( 'admin_post_submit_native_contact_form', 'handle_native_contact_form' );

/**
 * Auto-create required pages on theme activation
 */
function civiclick_create_pages() {
    $pages = array(
        'home' => array(
            'title'    => 'Home',
            'content'  => '',
            'template' => 'front-page.php'
        ),
        'blog' => array(
            'title'    => 'Blog',
            'content'  => '',
            'template' => 'template-blog.php'
        ),
        'contact' => array(
            'title'    => 'Contact',
            'content'  => '',
            'template' => 'page-contact.php'
        ),
    );

    foreach ( $pages as $slug => $page ) {
        $query = new WP_Query( array(
            'pagename' => $slug,
            'post_type' => 'page',
        ) );

        if ( ! $query->have_posts() ) {
            $page_id = wp_insert_post( array(
                'post_title'   => $page['title'],
                'post_content' => $page['content'],
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_name'    => $slug
            ) );

            if ( $page_id && ! empty( $page['template'] ) ) {
                update_post_meta( $page_id, '_wp_page_template', $page['template'] );
            }
            
            // Set static front page settings
            if ($slug === 'home') {
                update_option('show_on_front', 'page');
                update_option('page_on_front', $page_id);
            }
            if ($slug === 'blog') {
                update_option('page_for_posts', $page_id);
            }
        }
    }

    // Create Sample Posts if none exist
    $count_posts = wp_count_posts();
    if ( $count_posts->publish == 0 ) {
        $sample_posts = array(
            array(
                'title'   => 'The Future of AI in Grassroots Advocacy',
                'content' => 'Artificial intelligence is not just a buzzword; it is a fundamental shift in how we mobilize stakeholders. By analyzing patterns in civic engagement, we can now predict which messages will resonate most with specific demographics...',
                'excerpt' => 'Discover how AI is revolutionizing the way organizations connect with their supporters and drive legislative change.'
            ),
            array(
                'title'   => 'Bridging the Gap: Citizen Intent vs Legislative Action',
                'content' => 'One of the greatest challenges in modern democracy is the disconnect between what the public wants and what representatives hear. Our mission at CiviClick is to build the digital infrastructure that closes this gap...',
                'excerpt' => 'Exploring the technological solutions that translate individual passion into collective political pressure.'
            ),
            array(
                'title'   => 'Persuasion Architecture in the Digital Age',
                'content' => 'Modern advocacy requires more than just high-volume messaging. It requires a deep understanding of persuasion architecture—the science of structuring digital environments to encourage civic participation...',
                'excerpt' => 'A deep dive into the psychology and technology behind successful stakeholder mobilization campaigns.'
            )
        );

        foreach ( $sample_posts as $post ) {
            wp_insert_post( array(
                'post_title'   => $post['title'],
                'post_content' => $post['content'],
                'post_excerpt' => $post['excerpt'],
                'post_status'  => 'publish',
                'post_type'    => 'post',
            ) );
        }
    }
}
add_action( 'after_switch_theme', 'civiclick_create_pages' );

// Run once if theme is already active
if ( ! get_option( 'civiclick_pages_created' ) ) {
    civiclick_create_pages();
    update_option( 'civiclick_pages_created', true );
}
