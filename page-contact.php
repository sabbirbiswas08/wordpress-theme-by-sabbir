<?php
/**
 * Template Name: Contact Page
 */
get_header(); ?>

<section class="contact" id="contact" style="padding-top: 12rem; min-height: 80vh;">
    <div class="container">
        <div class="section-header">
            <h2>Get In Touch</h2>
            <p>Connect with Chazz for speaking engagements, consulting, or media inquiries.</p>
        </div>
        <div class="contact-container">
            <!-- Native WordPress Contact Form without CF7 -->
            <form id="native-contact-form" class="contact-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
                <!-- Action hook for admin-post.php -->
                <input type="hidden" name="action" value="submit_native_contact_form">
                <!-- Security Nonce -->
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
