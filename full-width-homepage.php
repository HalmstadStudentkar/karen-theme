<?php
/**
 * Template Name: Homepage Template - Full-width
 * Description: Alternate homepage template, with slider, full-width content and widgets
 */
get_header(); ?>

    <div id="content" class="clearfix">
        
        <div id="main" class="clearfix" role="main">
        
        	<div id="slide-wrap">
			  <?php 
                $args = array(
                    'posts_per_page' => 10,
					'post_status' => 'publish',
                    'post__in' => get_option("sticky_posts")
                );
                $fPosts = new WP_Query( $args );
				$countPosts = $fPosts->found_posts;
              ?>
    
                <?php if ( $fPosts->have_posts() ) : ?>
                  
                  <?php if ($countPosts > 1) : ?>
                  <div id="load-cycle"></div>
                  <div class="cycle-slideshow" <?php 
				  	if ( get_theme_mod('magazino_slider_effect') ) {
						echo 'data-cycle-fx="' . wp_kses_post( get_theme_mod('magazino_slider_effect') ) . '" data-cycle-tile-count="10"';
					} else {
						echo 'data-cycle-fx="scrollHorz"';
					}
				  ?> data-cycle-slides="> div.slides" <?php
                  	if ( get_theme_mod('magazino_slider_timeout') ) {
						$slider_timeout = wp_kses_post( get_theme_mod('magazino_slider_timeout') );
						if ( $slider_timeout != 0 || $slider_timeout != '' ) {
							echo 'data-cycle-timeout="' . $slider_timeout . '000" data-cycle-pause-on-hover="true"';
						} else {
							echo 'data-cycle-timeout="0"';
						}
					} else {
						echo 'data-cycle-timeout="0"';
					}
				  ?> data-cycle-prev="#sliderprev" data-cycle-next="#slidernext">
                  	<?php if ( get_theme_mod('magazino_slider_pager') ) : ?>
                  	<div class="cycle-pager"></div>
                    <?php endif; ?>
                    <?php /* Start the Loop */ ?>
                    <?php while ( $fPosts->have_posts() ) : $fPosts->the_post(); ?>
                    
                    <div class="slides">
                      <div id="post-<?php the_ID(); ?>" <?php post_class('post-theme'); ?>>
                         <?php if ( has_post_thumbnail()) : ?>
                            <div class="slide-thumb"><?php the_post_thumbnail( array(1000, 640) ); ?></div>
                         <?php else : ?>
                         
							<?php $postimgs =& get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
                            if ( !empty($postimgs) ) :
                                $firstimg = array_shift( $postimgs );
                                $my_image = wp_get_attachment_image( $firstimg->ID, array( 1000, 640 ), false );
                            ?>
                            <div class="slide-thumb"><?php echo $my_image; ?></div>
                            
                            <?php else : ?>
                         	
                            <div class="slide-noimg"><?php _e('No featured image set for this post.', 'magazino') ?></div>
                            
                           <?php endif; ?>
                           
                         <?php endif; ?>
                         <div class="slide-content">
                            <h2 class="slide-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'magazino' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                         	<?php echo magazino_excerpt(25); ?>	
                         </div>						
                      </div>
                    </div>
                    
                    <?php endwhile; ?>

                    <?php wp_reset_query(); // reset the query ?>

                  </div>
                  
                  <div class="slidernav">
                        <a id="sliderprev" href="#" title="<?php _e('Previous', 'magazino'); ?>"><?php _e('&#9664;', 'magazino'); ?></a>
                        <a id="slidernext" href="#" title="<?php _e('Next', 'magazino'); ?>"><?php _e('&#9654;', 'magazino'); ?></a>
                    </div>
                    
                    <div class="clearfix"></div>
                  
                  <?php else : ?>
                  
                  <?php /* Start the Loop */ ?>
                   <?php while ( $fPosts->have_posts() ) : $fPosts->the_post(); ?>
                  	<div class="slides">
                      <div id="post-<?php the_ID(); ?>" <?php post_class('post-theme'); ?>>
                         <?php if ( has_post_thumbnail()) : ?>
                            <div class="slide-thumb"><?php the_post_thumbnail( array(1000, 640) ); ?></div>
                         <?php else : ?>
                            <div class="slide-noimg"><?php _e('No featured image set for this post.', 'magazino') ?></div>
                         <?php endif; ?>
                         <div class="slide-content">
                            <h2 class="slide-title"><?php the_title(); ?></h2>
                         	<?php echo magazino_excerpt(25); ?>	
                         </div>						
                      </div>
                    </div>
                    <?php endwhile; ?>

                    <?php wp_reset_postdata(); // reset the query ?>
                  
                  <?php endif; ?>
                  
                <?php endif; ?>
                    
              </div>
              
              <div class="grnbar"></div>

              <div class="main-widget"<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Main Sidebar')) : ?>
              <?php endif; ?>
                <div class="news">
			<div class="box-title">
			<?php if(qtranxf_getLanguage()=='sv'): ?>
				<a href="/category/news/">Nyheter</a>
			<?php endif; ?>
			<?php if(qtranxf_getLanguage()=='en'): ?>
				<a href="/en/category/news/">News</a>
			<?php endif; ?>
                      </div>
                      <div class="box-content"><ul>     
                        <?php

                          $args=array(
                            'category_name' => 'news', //Vilken kategori data hämtas in från
                            'post_type' => 'post', //Vad som hämtas in från kategorin
                            'post_status' => 'publish', //Hämtar endast in poster markerade "publish"
                            'posts_per_page' => 5, //Antalet poster som hämtas in
                            'caller_get_posts'=> 1 //I have no idea..
                            );
                          $my_query = null;
                          $my_query = new WP_Query($args);
                          if( $my_query->have_posts() ) {
                            while ($my_query->have_posts()) : $my_query->the_post(); ?>
                            <li>
                        <p><?php the_time('Y-m-d') ?></p>
                        <div class="news-title"><p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></p></div>
                        <div class="excerpt">
                          <?php the_excerpt() ?>
                        </div><!-- end excerpt -->
                            </li>
                        <li><div class="grnbar2"></div></li>
                             <?php
                            endwhile;
                          }
                      wp_reset_query();  // Restore global post data stomped by the_post().
                      ?>
                      </ul>
                      </div><!-- end box-content -->
                    </div> <!-- end news-->
            </div><!-- end main-widget -->

              <div class="right-widget"><?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('Right Sidebar')) : ?>
              <?php endif; ?>
              </div><!--end right-widget"-->

			</div> <!-- end #main -->

        <?php get_sidebar(); ?>

    </div> <!-- end #content -->

<?php get_footer(); ?>
