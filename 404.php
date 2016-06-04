<?php get_header(); ?>

    <div id="content" class="clearfix">

        <div id="main" class="clearfix" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Error 404 - Page Not Found', 'magazino' ); ?></h1>
                    <div class="grnbar"></div>
				</header>
				<div class="404-info">
					<?php if( $q_config[ 'language' ] == 'en'): ?>
						<p><img src="/files/2016/03/404_image.png" /></p>
						<p>It looks like the page you are trying to find, does not exist. Please try one of the links below, or contact <a href="mailto:kaos@karen.hh.se">kaos@karen.hh.se</a> and attach the link to the page you were trying to reach.<br /></p>
					<?php endif; ?>

					<?php if( $q_config[ 'language' ] == 'sv'): ?>
						<p><img src="/files/2016/03/404_image.png" /></p>
						</p>Det ser ut som att sidan du försöker nå inte finns. Testa någon av länkarna nedan, eller skicka länken till <a href="mailto:kaos@karen.hh.se">kaos@karen.hh.se</a> om du misstänker att en sida är trasig.<br /><br /></p>
					<?php endif; ?>
				</div>

				<div class="entry-content post_content">
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<div class="widget">
						<h2 class="widget-title">
							<?php if( $q_config[ 'language' ] == 'en'): ?>Most used categories<?php endif; ?>
							<?php if( $q_config[ 'language' ] == 'sv'): ?>Mest använda kategorier<?php endif; ?>
						</h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>

					<?php
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives.', 'magazino' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

        </div> <!-- end #main -->

        <?php get_sidebar(); ?>

    </div> <!-- end #content -->

<?php get_footer(); ?>
