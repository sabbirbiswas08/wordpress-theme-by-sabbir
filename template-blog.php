<?php
/**
 * Template Name: Blog Archive
 * Used as the page template for the /blog page
 */
get_header(); ?>

<div class="blog-page">
    <div class="container">
        <div class="section-header" style="text-align:left;margin-bottom:3rem;">
            <span class="bio-tag">Insights &amp; Commentary</span>
            <h1>The <span class="gradient-text">Blog</span></h1>
            <p>Chazz Clevinger on political technology, AI advocacy, persuasion architecture, and civic engagement.</p>
        </div>

        <div class="blog-grid">
            <?php
            $paged = max(1, get_query_var('paged'));
            $q = new WP_Query([
                'post_type'      => 'post',
                'post_status'    => 'publish',
                'posts_per_page' => 9,
                'paged'          => $paged,
            ]);

            if ($q->have_posts()):
                while ($q->have_posts()): $q->the_post();
                    get_template_part('template-parts/card');
                endwhile;
                wp_reset_postdata();
            else: ?>
                <div style="grid-column:1/-1;text-align:center;padding:5rem 0;">
                    <div style="font-size:3rem;margin-bottom:1rem;">✍️</div>
                    <h3 style="margin-bottom:.8rem;">No posts yet</h3>
                    <p style="margin-bottom:1.5rem;color:var(--text-secondary)">Check back soon for insights on political technology and advocacy.</p>
                    <?php if (current_user_can('edit_posts')): ?>
                        <a href="<?php echo admin_url('post-new.php'); ?>" class="btn">Write First Post</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if (isset($q) && $q->max_num_pages > 1): ?>
            <div class="pagination-wrap">
                <?php echo paginate_links([
                    'total'     => $q->max_num_pages,
                    'current'   => $paged,
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ]); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
