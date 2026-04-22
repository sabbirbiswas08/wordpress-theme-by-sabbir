<?php
/**
 * The main blog template — works as the posts archive page
 */
get_header(); ?>

<div class="blog-page">
    <div class="container">
        <div class="section-header" style="text-align:left;margin-bottom:3rem;">
            <h1>The <span class="gradient-text">Blog</span></h1>
            <p>Insights on political technology, advocacy, and civic engagement from Chazz Clevinger.</p>
        </div>

        <div class="blog-grid">
            <?php
            // Force-query all published posts regardless of WordPress reading settings
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
                <div style="grid-column:1/-1;text-align:center;padding:4rem 0;">
                    <p style="color:var(--text-secondary);margin-bottom:1.5rem;">No posts published yet.</p>
                    <a href="<?php echo admin_url('post-new.php'); ?>" class="btn">Create First Post</a>
                </div>
            <?php endif; ?>
        </div>

        <?php if ($q->max_num_pages > 1): ?>
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
