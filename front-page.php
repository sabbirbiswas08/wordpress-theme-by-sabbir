<?php get_header(); ?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-badge">
            <span></span> Washington, D.C. &bull; CiviClick
        </div>
        <h1>Where <span class="gradient-text">Technology</span><br>Meets Democracy</h1>
        <p class="hero-subtitle">Chazz Clevinger is the Founder & CEO of CiviClick — the first AI-powered stakeholder mobilization platform transforming how advocacy campaigns are built and measured.</p>
        <div class="hero-actions">
            <a href="#insights" class="btn">Read the Blog</a>
            <a href="<?php echo esc_url(home_url('/about')); ?>" class="btn-outline">About Chazz</a>
        </div>
    </div>
    <div class="hero-scroll">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
    </div>
</section>

<!-- STATS BAR -->
<div class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <h4>15+</h4>
                <p>Years in Public Policy</p>
            </div>
            <div class="stat-item">
                <h4>UNC</h4>
                <p>Phi Beta Kappa Graduate</p>
            </div>
            <div class="stat-item">
                <h4>White House</h4>
                <p>West Wing Alumni</p>
            </div>
            <div class="stat-item">
                <h4>#1</h4>
                <p>AI Advocacy Platform</p>
            </div>
        </div>
    </div>
</div>

<!-- BIO PREVIEW -->
<section class="bio">
    <div class="container">
        <div class="bio-grid">
            <div class="bio-image-wrap">
                <div class="bio-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/chazz_portrait.webp"
                         alt="Chazz Clevinger">
                </div>
            </div>
            <div class="bio-content">
                <span class="bio-tag">Founder &amp; CEO</span>
                <h2>A Career Defined by Innovation and Public Service</h2>
                <p>Chazz Clevinger stands at the forefront of a transformation reshaping how organizations, advocacy groups, and civic institutions engage with the public. His career reflects a singular commitment to the principle that technology can and should amplify the voice of every citizen.</p>
                <p>From working 16-hour days in the West Wing during the Bush Administration, to building one of the most decorated advocacy technology companies in the United States — Clevinger has dedicated his professional life to closing the gap between citizen intent and legislative action.</p>
                <div class="bio-highlights">
                    <div class="bio-highlight">
                        <div class="bio-highlight-icon">
                            <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                        </div>
                        <h4>UNC Chapel Hill</h4>
                        <p>Phi Beta Kappa — B.A. Political Science &amp; Ancient History</p>
                    </div>
                    <div class="bio-highlight">
                        <div class="bio-highlight-icon">
                            <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <h4>White House</h4>
                        <p>Office of Strategic Initiatives, Bush Administration</p>
                    </div>
                    <div class="bio-highlight">
                        <div class="bio-highlight-icon">
                            <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 010 20M12 2a15.3 15.3 0 000 20"/></svg>
                        </div>
                        <h4>CiviClick</h4>
                        <p>First AI-Powered Stakeholder Mobilization Platform</p>
                    </div>
                    <div class="bio-highlight">
                        <div class="bio-highlight-icon">
                            <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        </div>
                        <h4>Senator Burr</h4>
                        <p>Veterans Affairs Staffer, U.S. Senate</p>
                    </div>
                </div>
                <div style="margin-top: 2.5rem;">
                    <a href="<?php echo esc_url(home_url('/about')); ?>" class="btn">Read Full Bio</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- LATEST BLOG POSTS -->
<section class="blog" id="insights">
    <div class="container">
        <div class="section-header">
            <h2>Latest <span class="gradient-text">Insights</span></h2>
            <p>Thoughts on political technology, AI-powered advocacy, and civic engagement.</p>
        </div>
        <div class="blog-grid">
            <?php
            $args = array('post_type' => 'post', 'posts_per_page' => 3, 'ignore_sticky_posts' => true);
            $q = new WP_Query($args);
            if ($q->have_posts()):
                while ($q->have_posts()): $q->the_post();
                    get_template_part('template-parts/card');
                endwhile;
                wp_reset_postdata();
            else: ?>
                <p style="grid-column:1/-1;text-align:center;color:var(--text-secondary)">No posts yet. <a href="<?php echo admin_url('post-new.php'); ?>" style="color:var(--accent-cyan)">Create your first post</a>.</p>
            <?php endif; ?>
        </div>
        <div class="blog-more">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog')); ?>" class="btn-outline">View All Posts</a>
        </div>
    </div>
</section>

<!-- CONTACT PREVIEW -->
<section class="contact" id="contact">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-info">
                <span class="bio-tag">Get In Touch</span>
                <h2>Let's Start a Conversation</h2>
                <p>Connect with Chazz for speaking engagements, media inquiries, consulting opportunities, or to learn more about CiviClick.</p>
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <h4>Location</h4>
                        <p>Washington, D.C.</p>
                    </div>
                </div>
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="3" width="20" height="14" rx="2"/><polyline points="8 21 12 17 16 21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <div>
                        <h4>Company</h4>
                        <p>CiviClick — AI Advocacy Platform</p>
                    </div>
                </div>
            </div>
            <div class="contact-form-wrap">
                <form id="contact-form" class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                    <input type="hidden" name="action" value="submit_native_contact_form">
                    <?php wp_nonce_field('native_contact_action', 'native_contact_nonce'); ?>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name">Your Name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="John Smith" required>
                        </div>
                        <div class="form-group">
                            <label for="email_address">Your Email</label>
                            <input type="email" name="email_address" id="email_address" class="form-control" placeholder="john@example.com" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject_field">Subject</label>
                        <input type="text" name="subject_field" id="subject_field" class="form-control" placeholder="Speaking Engagement Inquiry">
                    </div>
                    <div class="form-group">
                        <label for="message_content">Message</label>
                        <textarea name="message_content" id="message_content" class="form-control" placeholder="Tell me what's on your mind..." required></textarea>
                    </div>
                    <button type="submit" class="btn" style="width:100%;justify-content:center;">Send Message</button>
                    <?php if (isset($_GET['contact']) && $_GET['contact'] == 'success'): ?>
                        <div class="form-status success">Thank you! Your message has been sent and saved to the dashboard.</div>
                    <?php elseif (isset($_GET['contact']) && $_GET['contact'] == 'error'): ?>
                        <div class="form-status error">Something went wrong. Please try again.</div>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
