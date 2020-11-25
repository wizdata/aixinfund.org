<?php
/**
 * Template Name: Portfolio
 * 
 * Page for displaying special feature posts
 *
 *
 * @package		Expressions WordPress Theme
 * @copyright	Copyright (c) 2013, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php get_header(); ?>

<?php 	
	$exclude_page_title = ( get_post_meta($post->ID,'kaex_metabox_include_page_title',true) == ''? false : get_post_meta($post->ID,'kaex_metabox_include_page_title',true) );
	$category =  ( get_post_meta($post->ID,'kaex_portfolio_category',true) == ''? false : get_post_meta($post->ID,'kaex_portfolio_category',true) );
	$portfolio_columns = ( get_post_meta($post->ID,'kaex_portfolio_columns',true) == ''? false : get_post_meta($post->ID,'kaex_portfolio_columns',true) );
	$display_post_content = ( get_post_meta($post->ID,'kaex_metabox_include_post_content',true) == ''? false : get_post_meta($post->ID,'kaex_metabox_include_post_content',true) );
	$display_image_caption = ( get_post_meta($post->ID,'kaex_metabox_include_image_caption',true) == ''? false : get_post_meta($post->ID,'kaex_metabox_include_image_caption',true) );
	$display_image_description = ( get_post_meta($post->ID,'kaex_metabox_include_image_description',true) == ''? false : get_post_meta($post->ID,'kaex_metabox_include_image_description',true) );
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( $exclude_page_title == false) {
			echo '<div class="page-title-wide">';
				echo '<div class="page-title-wrap">';
					echo '<h2 class="portfolio">'.get_the_title().'</h2>' ;
				echo '</div>';
			echo '</div>';
		}
		echo '<div id="portfolio-post-wide">';
			echo '<div id="portfolio-post-wrap">';
				echo '<div class="portfolio-post respimg">';
					the_content('Read more');
				echo '</div>';
			echo '</div>';
		echo '</div>'; ?>
	</div>
<?php endwhile; else : endif; ?>
<div class="clearfix"></div>	
<div id="main-section">
	<div id="content-wrap">
		<div id="portfolio-full-width">		 		
		 	<?php // additional loop via get_posts
			$category_ID = get_cat_ID(sanitize_text_field($category));
			global $post,$feature_pic_count;
			$args = array('category'=>$category_ID,'numberposts'=>999);
			$custom_posts = get_posts($args);
			if ($category_ID !== 0 && $custom_posts){
				$feature_pic_count == 0;
				if ( sanitize_text_field($portfolio_columns) == "2" ) {
					echo '<div class="portfolio_two_column_wrap">';
				} elseif ( sanitize_text_field($portfolio_columns) == "3" ) {
					echo '<div class="portfolio_three_column_wrap">';
				} elseif ( sanitize_text_field($portfolio_columns) == "4" ) {
					echo '<div class="portfolio_four_column_wrap">';
				}
				foreach($custom_posts as $post) : setup_postdata($post);
					if ( sanitize_text_field($portfolio_columns) == "1" ) {
		 				if (has_post_thumbnail()) {
		 					if ( $feature_pic_count != 0 ) echo '<div class="thin-border"></div>';
		 					echo '<div class="portfolio_one_column">';
		 					$feature_pic_count ++;
							echo '<div class="left_col">';
        						echo '<a href="';the_permalink();echo '" title="';the_title_attribute(); echo '" >';
  									the_post_thumbnail('large');
      							echo '</a>';
      							if( $display_image_caption == 1 || $display_image_caption == 'on' ) {
      								echo '<div class="display_caption">';
      									//echo '<h4>';echo get_post(get_post_thumbnail_id())->post_excerpt;echo '</h4>';
										$content = get_post(get_post_thumbnail_id())->post_excerpt;
										echo '<h4>';
	      								ka_express_portfolio_titles($content,75);
	      								echo '</h4>';
									echo '</div>';
								}
      							if( $display_image_description == 1 || $display_image_caption == 'on' ) {
      								echo '<div class="display_description">';
										//echo get_post(get_post_thumbnail_id())->post_content;
										$content = get_post(get_post_thumbnail_id())->post_content;
										ka_express_portfolio_feature_description($content,350);
									echo '</div>';
								}
      						echo '</div>';
      						echo '<div class="right_col">';
      							echo '<h3>';echo the_title_attribute();echo '</h3>';
       							ka_express_the_excerpt_dynamic(600);
							echo '</div>';
	   						echo '<div class="clearfix"></div>';
							echo '</div>';					
						}
					} elseif ( sanitize_text_field($portfolio_columns) == "2" ) {
						if( is_int( $feature_pic_count/2 ) && has_post_thumbnail() ){
							echo '<div class="clearfix" ></div>';
							if ( $feature_pic_count != 0 ) echo '<div class="thin-border"></div>';
						}
			 			if (has_post_thumbnail()) {
							echo '<div class="portfolio_two_column">';
							$feature_pic_count ++;
								echo '<div class="image_container">';
									echo '<a href="';the_permalink();echo'" title="';the_title_attribute();echo '" >';
		  								the_post_thumbnail('large');
										//the_post_thumbnail('large');
		      						echo '</a>';
								echo '</div>';
	      						if( $display_image_caption == 1 || $display_image_caption == 'on' ) {
	      							echo '<div class="display_caption">';
										$content = get_post(get_post_thumbnail_id())->post_excerpt;
										echo '<h3>';
	      								ka_express_portfolio_titles($content,75);
	      								echo '</h3>';
									echo '</div>';
								}
	      						if( $display_image_description == 1 || $display_image_description == 'on' ) {
	      							echo '<div class="display_description">';
										$content = get_post(get_post_thumbnail_id())->post_content;
										ka_express_portfolio_feature_description($content,500);
									echo '</div>';
								}
	      						if( $display_post_content == 1 || $display_post_content == 'on' ) {
	      							$content = the_title_attribute('echo=0');
									echo '<h3>';
	      								ka_express_portfolio_titles($content,75);
	      							echo '</h3>';
	      							echo '<div class="display_post">';
	      								ka_express_the_excerpt_dynamic(500);
									echo '</div>';
								}
		   						echo '</div>';
							}
					} elseif ( sanitize_text_field($portfolio_columns) == "3" ) {
						if( is_int( $feature_pic_count/3 ) && has_post_thumbnail() ){
							echo '<div class="clearfix" ></div>';
							if ( $feature_pic_count != 0 ) echo '<div class="thin-border"></div>';
						}
							if (has_post_thumbnail()) {
								echo '<div class="portfolio_three_column">';
								$feature_pic_count ++;
								echo '<div class="image_container">';
									echo '<a href="';the_permalink();echo'" title="';the_title_attribute();echo '" >';
	  									the_post_thumbnail('medium');
	      							echo '</a>';
								echo '</div>';
		      					if( $display_image_caption == 1 || $display_image_caption == 'on' ) {
		      						echo '<div class="display_caption">';
										$content = get_post(get_post_thumbnail_id())->post_excerpt;
										echo '<h5>';
											ka_express_portfolio_titles($content,75);
		      							echo '</h5>';
									echo '</div>';
									}
		      					if( $display_image_description == 1 || $display_image_description == 'on' ) {
		      						echo '<div class="display_description">';
		      							$content = get_post(get_post_thumbnail_id())->post_content;
										ka_express_portfolio_feature_description($content,400);
									echo '</div>';
								}
								if( $display_post_content == 1 || $display_post_content == 'on' ) {
		      						$content = the_title_attribute('echo=0');
										echo '<h5>';
		      								ka_express_portfolio_titles($content,75);
		      							echo '</h5>';
		      							echo '<div class="display_post">';
		      								ka_express_the_excerpt_dynamic(400);
										echo '</div>';
								}
								echo '</div>';
							}
					} else {
						if( is_int( $feature_pic_count/4)  && has_post_thumbnail() ){
							echo '<div class="clearfix" ></div>';
							if ( $feature_pic_count != 0 ) echo '<div class="thin-border"></div>';
						}
							if (has_post_thumbnail()) {
								echo '<div class="portfolio_four_column">';
								$feature_pic_count ++;
								echo '<div class="image_container">';
									echo '<a href="';the_permalink();echo'" title="';the_title_attribute();echo '" >';
		  								the_post_thumbnail('medium');
		      						echo '</a>';
								echo '</div>';
		      					if( $display_image_caption == 1 || $display_image_caption == 'on' ) {
		      						echo '<div class="display_caption">';
										$content = get_post(get_post_thumbnail_id())->post_excerpt;
										echo '<h5>';
		      								ka_express_portfolio_titles($content,50);
		      							echo '</h5>';
									echo '</div>';
									}
		      					if( $display_image_description == 1 || $display_image_description == 'on' ) {
		      						echo '<div class="display_description">';
		      							$content = get_post(get_post_thumbnail_id())->post_content;
										ka_express_portfolio_feature_description($content,300);
									echo '</div>';
								}
								if( $display_post_content == 1 || $display_post_content == 'on' ) {
		      						$content = the_title_attribute('echo=0');
										echo '<h5>';
		      								ka_express_portfolio_titles($content,50);
		      							echo '</h5>';
		      							echo '<div class="display_post">';
		      								ka_express_the_excerpt_dynamic(300);
										echo '</div>';
								}
								echo '</div>';
							}
						}
					endforeach;
					echo '</div>';
				} else {
					echo '<div class="portfolio_error">';
					echo '<h3>'.__('Error: no posts or categories are wrong!','ka_express').'</h3>';
					echo '</div>';
				}
				if ($feature_pic_count == 0){
					echo '<div class="portfolio_error">';
					echo '<h3>'.__('Error: There were no feature images found?','ka_express').'</h3>';
					echo '</div>';
				}
		
				?>
				<div class="clearfix" ></div>
		</div>
	</div>
</div>

<div class="clearfix"></div>

<?php get_footer(); ?>