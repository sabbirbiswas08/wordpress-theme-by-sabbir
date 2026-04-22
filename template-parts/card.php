<?php
/**
 * Template Part: Blog Card
 * Used in front-page.php, index.php, template-blog.php
 */
?>
<article class="blog-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="card-image">
        <?php if (has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large', ['alt' => get_the_title()]); ?>
            </a>
        <?php else: ?>
            <a href="<?php the_permalink(); ?>">
                <div class="card-image-placeholder">
                    <svg width="40" height="40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
            </a>
        <?php endif; ?>
    </div>
    <div class="card-content">
        <div class="card-meta">
            <span class="card-date"><?php echo get_the_date('M j, Y'); ?></span>
            <?php $cats = get_the_category(); if ($cats): ?>
                <span class="card-category"><?php echo esc_html($cats[0]->name); ?></span>
            <?php endif; ?>
        </div>
        <h3 class="card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="card-excerpt"><?php the_excerpt(); ?></div>
        <a href="<?php the_permalink(); ?>" class="read-more">
            Read Article
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/>
            </svg>
        </a>
    </div>
</article>
