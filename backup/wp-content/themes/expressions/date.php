<?php
/**
 * Date template file
 *
 * This file is the Date Page template file, which is output whenever
 * a author link is clicked
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
	$date_sidebar_loc = $kaex_options['kaex_date_sidebar_loc']; 
?>
<?php get_header(); ?>
<div id="main-section">
	<div id="content-wrap">
		<?php if ( $date_sidebar_loc == 'left') { ?>
			<div id="widecolumn-right">
		<?php } else { ?>
			<div id="widecolumn-left">
		<?php } ?>
			<div class="category-page">
				<h2><?php 
						_e('Posts for : ','ka_express'); 
						if( is_day() ) {
							the_time('F j, Y');
						} elseif ( is_month() ) {
							echo single_month_title(' ');
						} elseif( is_year() ) {
							echo the_time( 'Y' );
						}
					?>
				</h2>
			</div>
			<div class="clearfix"></div>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
						<?php ka_express_post_format(); ?>
						<div class="clearfix"></div>
					</article>
					<div class="bottom-line-1"></div>
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
			else : ?>
				<!-- search found nothing -->
				<div class="nosearch">
					<h2><?php _e('Sorry about that but we could not find any posts!','ka_express'); ?></h2>
					<p><?php _e('You may want to try another tag.','ka_express'); ?></p>
					<h2><?php _e('Something to read?','ka_express'); ?></h2>
					<p><?php _e('Want to read something else? These are the latest posts:','ka_express'); ?><br/><br/></p>
					<ul><?php wp_get_archives('type=postbypost&limit=20&format=html'); ?></ul>
				</div>
			<?php endif; ?>
			<br/>
		</div>
		<?php if ( $date_sidebar_loc == 'left') { ?>
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