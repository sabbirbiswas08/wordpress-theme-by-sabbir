<?php
/**
 * Theme functions: CiviClick
 * - Theme setup & menus
 * - Enqueue assets
 * - Contact Form Submissions CPT (visible in dashboard)
 * - Auto-create pages on activation
 * - Sample posts seeding
 */

/* ============================================================
   1. THEME SETUP
   ============================================================ */
if ( ! function_exists( 'civiclick_setup' ) ) :
function civiclick_setup() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [ 'search-form','comment-form','comment-list','gallery','caption','style','script' ] );

    set_post_thumbnail_size( 800, 500, true );

    register_nav_menus( [
        'primary' => __( 'Primary Menu', 'civiclick' ),
        'footer'  => __( 'Footer Menu', 'civiclick' ),
    ] );
}
endif;
add_action( 'after_setup_theme', 'civiclick_setup' );

/* ============================================================
   2. ENQUEUE SCRIPTS & STYLES
   ============================================================ */
function civiclick_scripts() {
    $ver = wp_get_theme()->get( 'Version' );
    wp_enqueue_style(  'civiclick-style',  get_stylesheet_uri(), [], $ver );
    wp_enqueue_script( 'civiclick-app', get_template_directory_uri() . '/assets/js/app.js', [], $ver, true );
}
add_action( 'wp_enqueue_scripts', 'civiclick_scripts' );

/* ============================================================
   3. CONTACT SUBMISSIONS — CUSTOM POST TYPE
   Saves every form submission as a CPT in the WP dashboard.
   Appearance: Dashboard → Contact Submissions
   ============================================================ */
function civiclick_register_submissions_cpt() {
    register_post_type( 'contact_submission', [
        'label'               => 'Contact Submissions',
        'labels'              => [
            'name'               => 'Contact Submissions',
            'singular_name'      => 'Submission',
            'menu_name'          => 'Contact Submissions',
            'view_item'          => 'View Submission',
            'all_items'          => 'All Submissions',
            'search_items'       => 'Search Submissions',
            'not_found'          => 'No submissions found.',
        ],
        'public'              => false,
        'show_ui'             => true,      // Visible in dashboard
        'show_in_menu'        => true,
        'capability_type'     => 'post',
        'capabilities'        => [
            'create_posts'    => 'do_not_allow', // Nobody can create from dashboard
        ],
        'map_meta_cap'        => true,
        'supports'            => [ 'title' ],
        'menu_icon'           => 'dashicons-email-alt',
        'menu_position'       => 25,
        'rewrite'             => false,
        'query_var'           => false,
    ] );
}
add_action( 'init', 'civiclick_register_submissions_cpt' );

// Add custom columns to the submissions list table
function civiclick_submission_columns( $cols ) {
    return [
        'cb'          => $cols['cb'],
        'title'       => 'Sender Name',
        'email'       => 'Email',
        'subject'     => 'Subject',
        'message'     => 'Message',
        'date'        => 'Date',
    ];
}
add_filter( 'manage_contact_submission_posts_columns', 'civiclick_submission_columns' );

function civiclick_submission_column_data( $col, $post_id ) {
    switch ( $col ) {
        case 'email':
            $email = get_post_meta( $post_id, '_submission_email', true );
            echo '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>';
            break;
        case 'subject':
            echo esc_html( get_post_meta( $post_id, '_submission_subject', true ) ?: '(no subject)' );
            break;
        case 'message':
            $msg = get_post_meta( $post_id, '_submission_message', true );
            echo '<span title="' . esc_attr( $msg ) . '">' . esc_html( wp_trim_words( $msg, 12, '…' ) ) . '</span>';
            break;
    }
}
add_action( 'manage_contact_submission_posts_custom_column', 'civiclick_submission_column_data', 10, 2 );

// Make columns sortable
function civiclick_submission_sortable_columns( $cols ) {
    $cols['email'] = 'email';
    return $cols;
}
add_filter( 'manage_edit-contact_submission_sortable_columns', 'civiclick_submission_sortable_columns' );

// Add a meta box for the full submission details
function civiclick_submission_metabox() {
    add_meta_box(
        'submission_details',
        'Submission Details',
        'civiclick_submission_metabox_html',
        'contact_submission',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'civiclick_submission_metabox' );

function civiclick_submission_metabox_html( $post ) {
    $email   = get_post_meta( $post->ID, '_submission_email', true );
    $subject = get_post_meta( $post->ID, '_submission_subject', true );
    $message = get_post_meta( $post->ID, '_submission_message', true );
    $ip      = get_post_meta( $post->ID, '_submission_ip', true );
    ?>
    <table class="form-table" style="width:100%;">
        <tr><th style="padding:8px;width:120px;font-weight:600;">Name</th><td style="padding:8px;"><?php echo esc_html( $post->post_title ); ?></td></tr>
        <tr><th style="padding:8px;">Email</th><td style="padding:8px;"><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></td></tr>
        <tr><th style="padding:8px;">Subject</th><td style="padding:8px;"><?php echo esc_html($subject ?: '(none)'); ?></td></tr>
        <tr><th style="padding:8px;">IP Address</th><td style="padding:8px;"><?php echo esc_html($ip); ?></td></tr>
        <tr><th style="padding:8px;">Message</th><td style="padding:8px;"><div style="white-space:pre-wrap;background:#f9f9f9;padding:12px;border-radius:4px;border:1px solid #ddd;"><?php echo esc_html($message); ?></div></td></tr>
    </table>
    <?php
}

/* ============================================================
   4. HANDLE FORM SUBMISSION
   ============================================================ */
function civiclick_handle_contact_form() {
    // Verify nonce
    if ( ! isset( $_POST['native_contact_nonce'] ) || ! wp_verify_nonce( $_POST['native_contact_nonce'], 'native_contact_action' ) ) {
        wp_die( 'Security check failed.' );
    }

    // Sanitize fields
    $name    = sanitize_text_field( $_POST['full_name'] ?? '' );
    $email   = sanitize_email( $_POST['email_address'] ?? '' );
    $subject = sanitize_text_field( $_POST['subject_field'] ?? 'New Contact Inquiry' );
    $message = sanitize_textarea_field( $_POST['message_content'] ?? '' );
    $ip      = $_SERVER['REMOTE_ADDR'] ?? '';

    // ---- Save as CPT in Dashboard ----
    $post_id = wp_insert_post( [
        'post_type'   => 'contact_submission',
        'post_title'  => $name,
        'post_status' => 'publish',
        'post_date'   => current_time( 'mysql' ),
    ] );

    if ( $post_id ) {
        update_post_meta( $post_id, '_submission_email',   $email );
        update_post_meta( $post_id, '_submission_subject', $subject );
        update_post_meta( $post_id, '_submission_message', $message );
        update_post_meta( $post_id, '_submission_ip',      $ip );
    }

    // ---- Also send an email notification ----
    $to      = get_option( 'admin_email' );
    $subj    = "New Message from $name: $subject";
    $body    = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";
    $headers = [ 'Content-Type: text/plain; charset=UTF-8', "Reply-To: $name <$email>" ];
    wp_mail( $to, $subj, $body, $headers );

    // ---- Redirect with status ----
    $referer = wp_get_referer() ?: home_url( '/contact' );
    $redirect = add_query_arg( 'contact', $post_id ? 'success' : 'error', $referer );
    wp_safe_redirect( $redirect );
    exit;
}
add_action( 'admin_post_nopriv_submit_native_contact_form', 'civiclick_handle_contact_form' );
add_action( 'admin_post_submit_native_contact_form',        'civiclick_handle_contact_form' );

/* ============================================================
   5. AUTO-CREATE PAGES ON THEME ACTIVATION
   ============================================================ */
function civiclick_create_pages() {
    $pages = [
        [ 'title' => 'Home',    'slug' => 'home',    'template' => 'front-page.php' ],
        [ 'title' => 'About',   'slug' => 'about',   'template' => 'page-about.php' ],
        [ 'title' => 'Blog',    'slug' => 'blog',    'template' => '' ],
        [ 'title' => 'Contact', 'slug' => 'contact', 'template' => 'page-contact.php' ],
    ];

    foreach ( $pages as $page ) {
        $existing = get_page_by_path( $page['slug'] );
        if ( $existing ) {
            $page_id = $existing->ID;
        } else {
            $page_id = wp_insert_post( [
                'post_title'  => $page['title'],
                'post_name'   => $page['slug'],
                'post_content'=> '',
                'post_status' => 'publish',
                'post_type'   => 'page',
            ] );
        }

        if ( $page_id && $page['template'] ) {
            update_post_meta( $page_id, '_wp_page_template', $page['template'] );
        }

        if ( $page['slug'] === 'home' ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $page_id );
        }
        if ( $page['slug'] === 'blog' ) {
            update_option( 'page_for_posts', $page_id );
        }
    }

    // ---- Seed sample posts if site is empty ----
    $count = wp_count_posts();
    if ( (int) $count->publish < 1 ) {
        $sample = [
            [
                'post_title'   => 'The Future of AI in Grassroots Advocacy',
                'post_content' => '<p>Artificial intelligence is not just a buzzword — it is a fundamental shift in how we mobilize stakeholders. By analyzing patterns in civic engagement, AI can now predict which messages will resonate most with specific demographics, which legislators are persuadable, and what timing maximizes impact.</p><p>At CiviClick, we have built a platform that leverages these capabilities to give advocacy organizations a competitive edge. The result is campaigns that are more targeted, more efficient, and more effective than anything previously possible.</p><p>The future of grassroots advocacy is not about more phone calls or more emails. It is about smarter, data-driven engagement that translates individual passion into measurable political outcomes.</p>',
                'post_excerpt' => 'How AI is revolutionizing the way organizations connect with supporters and drive legislative change.',
            ],
            [
                'post_title'   => 'Bridging the Gap: Citizen Intent vs Legislative Action',
                'post_content' => '<p>One of the greatest challenges in modern democracy is the disconnect between what the public wants and what their representatives hear. This gap — between citizen intent and legislative action — is not accidental. It is a structural problem rooted in the limitations of traditional advocacy infrastructure.</p><p>For too long, advocacy has relied on volume: sending thousands of form emails to legislators, organizing phone banks, and hoping that sheer numbers translate into policy change. But volume without precision is noise.</p><p>CiviClick was built to solve this problem by creating infrastructure that converts individual concerns into targeted, high-impact political pressure. The mission is simple: ensure that every citizen\'s voice is not just heard, but amplified in exactly the right way, at exactly the right time.</p>',
                'post_excerpt' => 'Exploring the technological solutions that translate individual passion into collective political pressure.',
            ],
            [
                'post_title'   => 'Persuasion Architecture in the Digital Age',
                'post_content' => '<p>Modern advocacy requires more than high-volume messaging. It requires a deep understanding of persuasion architecture — the science of structuring digital environments to encourage civic participation and drive behavioral change.</p><p>Persuasion architecture draws on behavioral economics, political psychology, and data science to design experiences that guide users toward desired actions. In the context of advocacy, this means creating digital environments that make it easy, intuitive, and emotionally resonant for citizens to engage with their representatives.</p><p>At CiviClick, persuasion architecture is at the core of everything we build. Our platform is designed not just to facilitate communication, but to optimize it — ensuring that every touchpoint in an advocacy campaign is calibrated for maximum impact.</p>',
                'post_excerpt' => 'A deep dive into the psychology and technology behind successful stakeholder mobilization campaigns.',
            ],
        ];

        foreach ( $sample as $p ) {
            wp_insert_post( array_merge( $p, [ 'post_status' => 'publish', 'post_type' => 'post' ] ) );
        }
    }
}
add_action( 'after_switch_theme', 'civiclick_create_pages' );

// Run once immediately if not run before (theme already active)
if ( ! get_option( 'civiclick_v2_setup_done' ) ) {
    add_action( 'init', function() {
        civiclick_create_pages();
        update_option( 'civiclick_v2_setup_done', true );
    }, 20 );
}
