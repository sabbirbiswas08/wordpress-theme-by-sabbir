<?php
/**
 * The template for displaying all pages
 */
get_header(); ?>

<section class="page-content" style="padding: 12rem 0; min-height: 80vh;">
    <div class="container" style="max-width: 900px;">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="page-header" style="margin-bottom: 4rem;">
                    <h1 style="font-size: 4rem;"><?php the_title(); ?></h1>
                </header>

                <div class="entry-content" style="font-size: 1.15rem; color: var(--text-secondary);">
                    <?php the_content(); ?>
                </div>
            </article>

        <?php endwhile; endif; ?>
    </div>
</section>

<?php get_footer(); ?>
