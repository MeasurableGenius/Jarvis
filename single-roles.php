<?php

get_header();

$show_default_title = get_post_meta( get_the_ID(), '_et_pb_show_title', true );

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">
	<?php
		if ( et_builder_is_product_tour_enabled() ):
			// load fullwidth page in Product Tour mode
			while ( have_posts() ): the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
					<?php
						the_content();
					?>
					</div> <!-- .entry-content -->

				</article> <!-- .et_pb_post -->

		<?php endwhile;
		else:
	?>
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php if (et_get_option('divi_integration_single_top') <> '' && et_get_option('divi_integrate_singletop_enable') == 'on') echo(et_get_option('divi_integration_single_top')); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'et_pb_post' ); ?>>
					<?php if ( ( 'off' !== $show_default_title && $is_page_builder_used ) || ! $is_page_builder_used ) { ?>
						<div class="et_post_meta_wrapper">

						<?php
							if ( ! post_password_required() ) :


								$thumb = '';

								$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

								$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
								$classtext = 'et_featured_image';
								$titletext = get_the_title();
								$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
								$thumb = $thumbnail["thumb"];

								$post_format = et_pb_post_format();

								if ( 'video' === $post_format && false !== ( $first_video = et_get_first_video() ) ) {
									printf(
										'<div class="et_main_video_container">
											%1$s
										</div>',
										$first_video
									);
								} else if ( ! in_array( $post_format, array( 'gallery', 'link', 'quote' ) ) && 'on' === et_get_option( 'divi_thumbnails', 'on' ) && '' !== $thumb ) {
									print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
								} else if ( 'gallery' === $post_format ) {
									et_pb_gallery_images();
								} else if(get_field('lucidchart_id')) {
									echo'<div style="width: 100%; height: 500px; margin: 10px 0; position: relative;"><iframe allowfullscreen frameborder="0" style="width:100%; height:500px" src="https://www.lucidchart.com/documents/embeddedchart/' . get_field('lucidchart_id') . '"></iframe></div>';
								}
							?>
							
							<h1 class="entry-title"><?php the_title(); ?></h1>

							<?php
	
									et_divi_post_meta();

							?>
							

							<?php
								$text_color_class = et_divi_get_post_text_color();

								$inline_style = et_divi_get_post_bg_inline_style();

								switch ( $post_format ) {
									case 'audio' :
										$audio_player = et_pb_get_audio_player();

										if ( $audio_player ) {
											printf(
												'<div class="et_audio_content%1$s"%2$s>
													%3$s
												</div>',
												esc_attr( $text_color_class ),
												$inline_style,
												$audio_player
											);
										}

										break;
									case 'quote' :
										printf(
											'<div class="et_quote_content%2$s"%3$s>
												%1$s
											</div> <!-- .et_quote_content -->',
											et_get_blockquote_in_content(),
											esc_attr( $text_color_class ),
											$inline_style
										);

										break;
									case 'link' :
										printf(
											'<div class="et_link_content%3$s"%4$s>
												<a href="%1$s" class="et_link_main_url">%2$s</a>
											</div> <!-- .et_link_content -->',
											esc_url( et_get_link_url() ),
											esc_html( et_get_link_url() ),
											esc_attr( $text_color_class ),
											$inline_style
										);

										break;
								}
	
							endif;
			
						?>
					</div> <!-- .et_post_meta_wrapper -->
				<?php  } ?>

					<div class="entry-content">
					<?php
						do_action( 'et_before_content' );

						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->
					
					<!-- Reports to -->
					<?php
					global $reports_to;
					$reports_to = get_field('reports_to');
					
					the_field('reports_to');
					
					?>
					
					<h2>Reports to</h2>
					
					
					<!-- TEAM MEMBERS -->
					<?php
					global $team_members;
					$team_members = get_field('assigned_team_members');
					?>
					
					<h2>Team Members</h2>
					<ul>
					<?php
					foreach( $team_members as $member_details ):
						$member_profile_url	= bp_core_get_userlink($member_details['ID']);
					?>
						<li><?php echo $member_profile_url; ?></li>
					<?php
					endforeach;
					?>
					</ul>
					
					<!-- KPIS -->
					<?php
					global $kpis; // Global KPI variable to be filled with the KPIs related to the Role
					$args_kpi = array(
						'post_type' => 'kpi', //search for the KPI custom post type
						'posts_per_page' => 10000, // Should never be set to -1 as it's a risk not setting boundaries. Good code practise!
						'no_found_rows' => true, //Disables the use of pagination BUT saves us an additional query. Remove if you need pagination
						'update_post_term_cache' => false, //Does not update a potentially old cache of the queried posts term relationships BUT saves us an additional query. Remove if you're going to display term info
						'meta_query' => array( //Query the serialized array. Putting the value in quotes makes sure we dont get a hit on 1234 when we search for 123. 
							array(
								'key' => 'who_is_accountable',
								'value' => '"' . $post->ID . '"',
								'compare' => 'LIKE'
							)
						)
					);
					
					$kpis = get_posts($args_kpi); // Fill the KPIs into the array
					
					if( $kpis ): ?>
					<h2>KPIs</h2>
					<ul>
					<?php
						foreach( $kpis as $post ): 
							setup_postdata( $post );
					?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>
					<?php
						endforeach;
					?>
					</ul>
						
					<?php
						wp_reset_postdata();
						endif;
					?>
					
					<!-- Service Boards -->
					<?php
					global $service_boards;
					$args_service_boards = array(
						'post_type' => 'service_boards',
						'posts_per_page' => 10000, // Should never be set to -1 as it's a risk not setting boundaries. Good code practise!
						'no_found_rows' => true, //Disables the use of pagination BUT saves us an additional query. Remove if you need pagination
						'update_post_term_cache' => false, //Does not update a potentially old cache of the queried posts term relationships BUT saves us an additional query. Remove if you're going to display term info
						'meta_query' => array( //Query the serialized array. Putting the value in quotes makes sure we dont get a hit on 1234 when we search for 123. 
							array(
								'key' => 'who_is_accountable',
								'value' => '"' . $post->ID . '"',
								'compare' => 'LIKE'
							)
						)
					);
					
					$service_boards = get_posts($args_service_boards); // Fill the KPIs into the array
										
					if( $service_boards ): ?>
					<h2>Service Boards</h2>
					<ul>
					<?php
						foreach( $service_boards as $post ): 
							setup_postdata( $post );
					?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>
					<?php
						endforeach;
					?>
					</ul>
						
					<?php
						wp_reset_postdata();
						endif;
					?>
					
					<!-- Processes -->
					<?php
					global $processes;
					$args_processes = array(
						'post_type' => 'processes',
						'posts_per_page' => 10000, // Should never be set to -1 as it's a risk not setting boundaries. Good code practise!
						'no_found_rows' => true, //Disables the use of pagination BUT saves us an additional query. Remove if you need pagination
						'update_post_term_cache' => false, //Does not update a potentially old cache of the queried posts term relationships BUT saves us an additional query. Remove if you're going to display term info
						'meta_query' => array( //Query the serialized array. Putting the value in quotes makes sure we dont get a hit on 1234 when we search for 123. 
							array(
								'key' => 'who_is_accountable',
								'value' => '"' . $post->ID . '"',
								'compare' => 'LIKE'
							)
						)
					);
					
					$processes = get_posts($args_processes); // Fill the KPIs into the array
										
					if( $processes ): ?>
					<h2>Processes</h2>
					<ul>
					<?php
						foreach( $processes as $post ): 
							setup_postdata( $post );
					?>
							<li>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>
					<?php
						endforeach;
					?>
					</ul>
						
					<?php
						wp_reset_postdata();
						endif;
					?>
					
					<div class="et_post_meta_wrapper">
					<?php
					if ( et_get_option('divi_468_enable') == 'on' ){
						echo '<div class="et-single-post-ad">';
						if ( et_get_option('divi_468_adsense') <> '' ) echo( et_get_option('divi_468_adsense') );
						else { ?>
							<a href="<?php echo esc_url(et_get_option('divi_468_url')); ?>"><img src="<?php echo esc_attr(et_get_option('divi_468_image')); ?>" alt="468" class="foursixeight" /></a>
				<?php 	}
						echo '</div> <!-- .et-single-post-ad -->';
					}
				?>

					<?php if (et_get_option('divi_integration_single_bottom') <> '' && et_get_option('divi_integrate_singlebottom_enable') == 'on') echo(et_get_option('divi_integration_single_bottom')); ?>

					<hr />
					
					<div class="shorten_url">
						<?php
							$unbreakablelinkname = get_post_type_object(get_post_type());
						?>						
						<strong>Unbreakable Link to This <?php echo esc_html($unbreakablelinkname->labels->singular_name); ?></strong><br />
						<p class="unbreakable_link"><?php echo wp_get_shortlink(get_the_ID()); ?></p>
					</div>
								
					<?php
						if ( ( comments_open() || get_comments_number() ) && 'on' == et_get_option( 'divi_show_postcomments', 'on' ) ) {
							comments_template( '', true );
						}
					?>
					</div> <!-- .et_post_meta_wrapper -->
				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>
			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->
	<?php endif; ?>
</div> <!-- #main-content -->

<?php get_footer(); ?>
