<?php
/**
 * The template for displaying the front page (Home)
 */
get_header(); ?>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="container">
        <div class="hero-content">
            <span class="hero-subtitle">Washington, D.C.</span>
            <h1>Founder & Chief Executive Officer,<br>CiviClick</h1>
            <p>Building the first artificial intelligence-powered stakeholder mobilization platform to fundamentally change how grassroots advocacy campaigns are conceived, executed, and measured.</p>
            <a href="#about" class="btn">Discover My Work</a>
        </div>
    </div>
</section>

<!-- Bio Section -->
<section class="bio" id="about">
    <div class="container">
        <div class="bio-grid">
            <div class="bio-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/chazz_portrait.webp" alt="Chazz Clevinger Portrait">
            </div>
            <div class="bio-content">
                <h2>A Career Defined by Innovation and Public Service</h2>
                <p>Chazz Clevinger stands at the forefront of a transformation reshaping how organizations, advocacy groups, and civic institutions engage with the public. From his earliest days as an intern at the White House to his current role leading one of the most decorated advocacy technology companies in the United States, his career reflects a singular commitment to the principle that technology can and should amplify the voice of every citizen.</p>
                <p>Born and raised in Wilmington, North Carolina, Clevinger developed an early fascination with the mechanics of political power. He pursued that interest at the University of North Carolina at Chapel Hill, where he graduated Phi Beta Kappa with a Bachelor of Arts in Political Science and Ancient History. His senior honors thesis examined the strategic deployment of belief systems in statecraft — a theme that echoes throughout his later work.</p>
                <p>Working 16-hour days in the West Wing during the Bush Administration, he gained a firsthand understanding of how policy is shaped. That gap — between what people want and what their government hears — became the central problem of his professional life. Clevinger subsequently served as a Veterans Affairs staffer in the office of U.S. Senator Richard Burr, and went on to hold positions at CQ Roll Call, SevenTwenty Strategies, before founding Coastal Political Strategies and eventually CiviClick.</p>
                
                <div class="bio-stats">
                    <div class="stat">
                        <h4>UNC Chapel Hill</h4>
                        <p>Phi Beta Kappa, B.A. Political Science & Ancient History</p>
                    </div>
                    <div class="stat">
                        <h4>White House Alum</h4>
                        <p>Office of Strategic Initiatives</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Section -->
<section class="blog" id="insights">
    <div class="container">
        <div class="section-header">
            <h2>Latest Insights</h2>
            <p>Thoughts on political technology, persuasion architecture, and grassroots engagement.</p>
        </div>
        
        <div class="blog-grid" id="blog-grid">
            <?php
            // Custom query for latest posts on front page
            $latest_posts = new WP_Query( array(
                'posts_per_page'      => 3,
                'ignore_sticky_posts' => true,
            ) );

            if ( $latest_posts->have_posts() ) :
                while ( $latest_posts->have_posts() ) : $latest_posts->the_post(); ?>
                    
                    <article class="blog-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                                </a>
                            <?php else : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <div style="width:100%; height:100%; background:#1e293b; display:flex; align-items:center; justify-content:center; color:#94a3b8;">
                                        No Image
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <span class="card-date"><?php echo get_the_date(); ?></span>
                            <h3 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                Read Article 
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </article>

                <?php endwhile;
                wp_reset_postdata(); // Reset the global post object
            else : ?>
                <p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary);">No posts found.</p>
            <?php endif; ?>
        </div>
        
        <div style="text-align: center; margin-top: 3rem;">
            <a href="<?php echo esc_url( home_url( '/blog' ) ); ?>" class="btn">View All Posts</a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact" id="contact">
    <div class="container">
        <div class="section-header">
            <h2>Get In Touch</h2>
            <p>Connect with Chazz for speaking engagements, consulting, or media inquiries.</p>
        </div>
        <div class="contact-container">
            <form id="native-contact-form" class="contact-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
                <input type="hidden" name="action" value="submit_native_contact_form">
                <?php wp_nonce_field( 'native_contact_action', 'native_contact_nonce' ); ?>

                <div class="form-group">
                    <input type="text" name="full_name" id="full_name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <textarea name="message_content" id="message_content" class="form-control" placeholder="Your Message" required></textarea>
                </div>
                
                <button type="submit" class="btn" id="submit-btn">Send Message</button>
                
                <?php if ( isset($_GET['contact']) && $_GET['contact'] == 'success' ) : ?>
                    <div class="form-status success" style="display:block; margin-top:1rem;">Thank you for your message. It has been sent successfully.</div>
                <?php elseif ( isset($_GET['contact']) && $_GET['contact'] == 'error' ) : ?>
                    <div class="form-status error" style="display:block; margin-top:1rem;">There was an error sending your message. Please try again.</div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
