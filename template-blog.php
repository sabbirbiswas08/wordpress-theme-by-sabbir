<?php
/**
 * Template Name: Blog Page
 */
get_header(); ?>

<section class="blog" id="insights" style="padding-top: 12rem; min-height: 80vh;">
    <div class="container">
        <div class="section-header">
            <h2>Latest Insights</h2>
            <p>Thoughts on political technology, persuasion architecture, and grassroots engagement.</p>
        </div>
        
        <div class="blog-grid" id="blog-grid">
            <?php
            // Custom query to ensure posts show up even if not set as "Posts Page"
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            $blog_query = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 6,
                'paged'          => $paged
            ) );

            if ( $blog_query->have_posts() ) :
                while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
                    
                    <article class="blog-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="card-image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                                </a>
                            <?php else : ?>
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
                <div class="pagination" style="grid-column: 1/-1; display:flex; justify-content:center; gap: 1rem; margin-top:3rem;">
                    <?php 
                    echo paginate_links( array(
                        'total'   => $blog_query->max_num_pages,
                        'current' => $paged,
                        'prev_text' => '&laquo; Prev',
                        'next_text' => 'Next &raquo;',
                    ) );
                    ?>
                </div>

                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <div style="grid-column: 1/-1; text-align: center;">
                    <p style="color: var(--text-secondary); margin-bottom: 2rem;">No posts have been published yet.</p>
                    <a href="<?php echo esc_url( admin_url( 'post-new.php' ) ); ?>" class="btn">Create Your First Post</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
