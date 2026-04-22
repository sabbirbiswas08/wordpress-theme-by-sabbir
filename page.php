<?php
/**
 * Generic page template — only used as fallback for un-templated pages.
 * About, Contact have their own page-{slug}.php templates.
 */
get_header(); ?>

<div style="padding: 9rem 0 5rem; min-height: 80vh;">
    <div class="container" style="max-width: 860px;">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <h1 style="font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 2.5rem;"><?php the_title(); ?></h1>
            <div style="font-size: 1.1rem; line-height: 1.85; color: var(--text-secondary);">
                <?php the_content(); ?>
            </div>
        <?php endwhile; endif; ?>
    </div>
</div>

<?php get_footer(); ?>
