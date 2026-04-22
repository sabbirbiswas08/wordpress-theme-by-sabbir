<?php
/**
 * The main template file (used for the Blog / Archives)
 */
get_header(); ?>

<section class="blog" id="insights" style="padding-top: 12rem;">
    <div class="container">
        <div class="section-header">
            <h2>Latest Insights</h2>
            <p>Thoughts on political technology, persuasion architecture, and grassroots engagement.</p>
        </div>
        
        <div class="blog-grid" id="blog-grid">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    
                    <article class="blog-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                                </a>
                            <?php else : ?>
                                <!-- Fallback image if no featured image is set -->
                                <a href="<?php the_permalink(); ?>">
                                    <div style="width:100%; height:100%; background:#1e293b; display:flex; align-items:center; justify-content:center; color:#94a3b8;">
                                        No Image
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <span class="card-date"><?php echo get_the_date(); ?></span>
                            <h3 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="card-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                            <a href="<?php the_permalink(); ?>" class="read-more">
                                Read Article 
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </article>

                <?php endwhile; ?>
                
                <!-- Pagination -->
                <div class="pagination" style="grid-column: 1/-1; display:flex; justify-content:center; margin-top:2rem;">
                    <?php 
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => __( 'Previous', 'textdomain' ),
                        'next_text' => __( 'Next', 'textdomain' ),
                    ) ); 
                    ?>
                </div>

            <?php else : ?>
                <p style="grid-column: 1/-1; text-align: center; color: var(--text-secondary);">No posts found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
