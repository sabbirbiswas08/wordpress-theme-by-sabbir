<?php
/**
 * The template for displaying all single posts
 */
get_header(); ?>

<section class="single-post" style="padding: 12rem 0; min-height: 80vh;">
    <div class="container" style="max-width: 800px;">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="post-header" style="margin-bottom: 3rem; text-align: center;">
                    <span class="card-date" style="display: block; margin-bottom: 1rem; color: var(--accent-1);"><?php echo get_the_date(); ?></span>
                    <h1 style="font-size: 3.5rem; margin-bottom: 2rem;"><?php the_title(); ?></h1>
                    
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail" style="border-radius: 20px; overflow: hidden; margin-bottom: 3rem;">
                            <?php the_post_thumbnail( 'full', array( 'style' => 'width: 100%; height: auto; display: block;' ) ); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="post-content" style="font-size: 1.2rem; color: var(--text-secondary); line-height: 1.8;">
                    <?php the_content(); ?>
                </div>

                <footer class="post-footer" style="margin-top: 5rem; padding-top: 3rem; border-top: 1px solid rgba(255,255,255,0.1);">
                    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url('/blog') ); ?>" class="read-more">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transform: rotate(180deg);">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                        Back to Blog
                    </a>
                </footer>
            </article>

        <?php endwhile; endif; ?>
    </div>
</section>

<?php get_footer(); ?>
