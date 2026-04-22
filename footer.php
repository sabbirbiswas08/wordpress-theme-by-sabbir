</main>

<footer>
    <div class="container footer-content">
        <div class="footer-logo">
            <div class="logo">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
            </div>
            <p>Founder & CEO, CiviClick — Washington, D.C.</p>
        </div>
        <nav class="footer-links">
            <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
            <a href="<?php echo esc_url(home_url('/about')); ?>">About</a>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog')); ?>">Blog</a>
            <a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a>
        </nav>
        <p class="footer-copy">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
