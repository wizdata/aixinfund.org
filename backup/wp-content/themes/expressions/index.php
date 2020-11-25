<?php
/**
 * Master/Default template file
 *
 * This file is the master/default template file, used when no other file matches in
 * the {@link http://codex.wordpress.org/Template_Hierarchy Template Hierarchy}.
 * 
 *
 * @package		Expressions WordPress Theme
 * @copyright	Copyright (c) 2013, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */
?>
<?php 
	global $kaex_options;
	$kaex_options = ka_express_get_options(); 
	$index_sidebar_loc = $kaex_options['kaex_index_sidebar_loc']; 
?>
<?php get_header(); ?>

<div id="main-section">
	<div id="content-wrap">
		<?php if ( $index_sidebar_loc == 'left') { ?>
			<div id="widecolumn-right">
		<?php } else { ?>
			<div id="widecolumn-left">
		<?php } ?>
		
			<?php
				$exclude_categories = '';//Expressions_exclude_categories();
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$temp = $wp_query;
				$wp_query = null;
				$wp_query = new WP_Query();
				/*
				 * WP_Query is used to get the posts....allowing the filtering of posts 
				 * the user does not want to include on the blog page. For WordPress 3.5 
				 * and above the meta query excludes those posts selected in the custom 
				 * field for the post. A second option works for all versions of WordPress.
				 * Create a tag called "exclude" and tag the post with it.
				 */
				$tags = get_tags();
				$exclude_tag_id = 0;
				foreach ($tags as $tag){
					if( $tag->slug == 'exclude') {
						$exclude_tag_id =  $tag->term_id;
					}
				}
				 $args = array(
								'post_status' => 'publish',
								'tag__not_in' => array($exclude_tag_id),
								'meta_query' => array(
									array(
										'key' => 'kaex_metabox_exclude_post',
										'compare' => 'NOT EXISTS'
										)
									),
								'paged' => $paged
								);
				$wp_query -> query( $args);
				if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
						<?php ka_express_post_format(); ?>
						<div class="clearfix"></div>
					</article>
					<div class="bottom-line-1"></div>
				<?php //} ?>
			<?php endwhile;
					if(function_exists('wp_pagenavi')) {
		 				echo '<div class="postpagenav">';
		 					wp_pagenavi();
						echo '</div>';
					} else { ?>
					<nav class="postpagenav">
						<div class="left"><?php next_posts_link(__('&lt;&lt; older entries','ka_express') ); ?></div>
						<div class="right"><?php previous_posts_link(__(' newer entries &gt;&gt;','ka_express') ); ?></div>
						<br/>
					</nav>
			  <?php } 
				$wp_query = null;
				$wp_query = $temp;
				wp_reset_query();
		
				else :
				endif; 
			?>
		
		</div>
		<?php if ( $index_sidebar_loc == 'left') { ?>
			<aside id="sidebar-left">
				<?php get_sidebar('default'); ?>
			</aside>
		<?php } else { ?>
			<aside id="sidebar-right">
				<?php get_sidebar('default'); ?>
			</aside>
		<?php } ?>
	</div>
</div>

<div class="clearfix"></div>

<?php get_footer(); ?>