<?php
/**
 * Single post template
 */
get_header(); ?>

<div class="single-post-wrap">
    <div class="container">
        <?php if (have_posts()): while (have_posts()): the_post(); ?>

            <div class="single-post-header">
                <div class="card-meta">
                    <span class="card-date"><?php echo get_the_date('M j, Y'); ?></span>
                    <?php $cats = get_the_category(); if ($cats): ?>
                        <span class="card-category"><?php echo esc_html($cats[0]->name); ?></span>
                    <?php endif; ?>
                </div>
                <h1><?php the_title(); ?></h1>
            </div>

            <?php if (has_post_thumbnail()): ?>
                <div class="single-featured-image">
                    <?php the_post_thumbnail('full'); ?>
                </div>
            <?php endif; ?>

            <div class="single-post-content">
                <?php the_content(); ?>
            </div>

            <div class="single-post-footer">
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog')); ?>" class="read-more" style="color:var(--text-secondary)">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transform:rotate(180deg)">
                        <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
                    </svg>
                    Back to Blog
                </a>
                <div style="display:flex;gap:1rem;">
                    <?php
                    $prev = get_previous_post();
                    $next = get_next_post();
                    if ($prev): ?>
                        <a href="<?php echo get_permalink($prev); ?>" class="btn-outline" style="font-size:.8rem;padding:.6rem 1.2rem;">← Previous</a>
                    <?php endif;
                    if ($next): ?>
                        <a href="<?php echo get_permalink($next); ?>" class="btn" style="font-size:.8rem;padding:.6rem 1.2rem;">Next →</a>
                    <?php endif; ?>
                </div>
            </div>

        <?php endwhile; endif; ?>
    </div>
</div>

<?php get_footer(); ?>
