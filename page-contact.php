<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

<div class="contact-page">
    <div class="container">
        <div class="section-header" style="text-align:left;margin-bottom:3rem;">
            <span class="bio-tag">Let's Connect</span>
            <h1>Get In <span class="gradient-text">Touch</span></h1>
            <p>Reach out for speaking engagements, media inquiries, consulting, or to learn more about CiviClick.</p>
        </div>

        <div class="contact-grid">
            <div class="contact-info">
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
                <div class="contact-item">
                    <div class="contact-icon">
                        <svg width="20" height="20" fill="none" stroke="#fff" stroke-width="2" viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div>
                        <h4>Inquiries</h4>
                        <p>Use the form — messages go directly to the dashboard</p>
                    </div>
                </div>
                <!-- What to expect section -->
                <div style="margin-top:2.5rem; padding:2rem; background:var(--bg-card); border:var(--border); border-radius:var(--radius-lg);">
                    <h4 style="margin-bottom:1rem; font-size:1rem;">What to expect</h4>
                    <ul style="display:flex;flex-direction:column;gap:.8rem;">
                        <li style="display:flex;gap:.8rem;align-items:flex-start;">
                            <svg width="16" height="16" style="color:var(--accent-cyan);flex-shrink:0;margin-top:3px" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                            <span style="font-size:.9rem;color:var(--text-secondary)">Response within 48 hours</span>
                        </li>
                        <li style="display:flex;gap:.8rem;align-items:flex-start;">
                            <svg width="16" height="16" style="color:var(--accent-cyan);flex-shrink:0;margin-top:3px" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                            <span style="font-size:.9rem;color:var(--text-secondary)">Speaking &amp; media inquiries welcome</span>
                        </li>
                        <li style="display:flex;gap:.8rem;align-items:flex-start;">
                            <svg width="16" height="16" style="color:var(--accent-cyan);flex-shrink:0;margin-top:3px" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                            <span style="font-size:.9rem;color:var(--text-secondary)">All messages saved to WordPress dashboard</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="contact-form-wrap">
                <?php if (isset($_GET['contact']) && $_GET['contact'] == 'success'): ?>
                    <div style="text-align:center;padding:3rem 2rem;">
                        <div style="width:64px;height:64px;background:rgba(16,185,129,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;">
                            <svg width="30" height="30" fill="none" stroke="#10b981" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <h3 style="margin-bottom:.8rem;">Message Sent!</h3>
                        <p>Thank you for reaching out. Your message has been received and saved. Chazz will get back to you within 48 hours.</p>
                        <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn" style="margin-top:2rem;">Send Another</a>
                    </div>
                <?php elseif (isset($_GET['contact']) && $_GET['contact'] == 'error'): ?>
                    <div class="form-status error" style="display:block;margin-bottom:1.5rem;">Something went wrong. Please try again.</div>
                <?php endif; ?>

                <?php if (!isset($_GET['contact']) || $_GET['contact'] == 'error'): ?>
                <form id="contact-form" class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
                    <input type="hidden" name="action" value="submit_native_contact_form">
                    <?php wp_nonce_field('native_contact_action', 'native_contact_nonce'); ?>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name">Your Name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="John Smith" required>
                        </div>
                        <div class="form-group">
                            <label for="email_address">Email Address</label>
                            <input type="email" name="email_address" id="email_address" class="form-control" placeholder="john@example.com" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="subject_field">Subject</label>
                        <input type="text" name="subject_field" id="subject_field" class="form-control" placeholder="Speaking Engagement / Media / Consulting...">
                    </div>
                    <div class="form-group">
                        <label for="message_content">Your Message</label>
                        <textarea name="message_content" id="message_content" class="form-control" placeholder="Tell me what's on your mind..." required></textarea>
                    </div>
                    <button type="submit" class="btn" style="width:100%;justify-content:center;">
                        Send Message
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>
