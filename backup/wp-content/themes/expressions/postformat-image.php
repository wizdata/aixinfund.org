<?php
/**
 * Expressions Post Format Image
 *
 *The Image Post Format is basically the same as the Standard Post Format. The only 
 * difference is that there is a drop shadow on the images. Thus not ideal for embedding 
 * in your post, but you can if you want. It is really designed for single images with a 
 * little text.
 *
 *
 * @package		Expressions WordPress Theme
 * @copyright	Copyright (c) 2013, Kevin Archibald
 * @license		http://www.gnu.org/licenses/quick-guide-gplv3.html  GNU Public License
 * @author		Kevin Archibald <www.kevinsspace.ca/contact/>
 */

//load user defined options
global $kaex_options;
$kaex_options = ka_express_get_options();
$display_post_icon = $kaex_options['kaex_display_post_icons'];
$display_post_author = $kaex_options['kaex_author_in_blog'];
$display_post_timestamp = $kaex_options['kaex_timestamp_in_blog'];
$display_post_categories = $kaex_options['kaex_category_in_blog'];
$display_post_tags = $kaex_options['kaex_tags_in_blog'];
	
 if ( $display_post_icon == 1 ) { ?>
	<div class="post-icon">
		<?php if(is_sticky()) {
			echo '<img class="post-icon-format" src="'.get_template_directory_uri().'/images/sticky.png" alt="sticky" />';
		} else {	
			echo '<img class="post-icon-format" src="'.get_template_directory_uri().'/images/format-image_24.png" alt="image" />';
		}?>			
	</div>
	<div class="post-wrap">
<?php } else { ?>
	<div class="post-wrap-no-icons">
<?php } ?> 
	<h2>
		<?php if( is_sticky() && $display_post_icon == 0 ) {
			echo '<img src="'.get_template_directory_uri().'/images/sticky_16.png" alt="sticky" />';
		} ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		<?php if ( comments_open()) { ?>
			<span class="comments"><a class="comments-button" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a></span>
		<?php } ?>
	</h2>
	<div class="clearfix"></div>
	<div class="postmetatop">
		<?php if($display_post_timestamp == 1) { ?><span class="timestamp"><?php the_time(get_option('date_format')); ?></span> <?php } ?>
		<?php if($display_post_author == 1) { ?><span class="author"><?php _e('By:','ka_express'); ?>&nbsp;<?php the_author_posts_link(); ?></span> <?php } ?>
		<?php if($display_post_categories == 1) { ?><span class="categories"><?php _e('In:','ka_express'); ?>&nbsp;<?php the_category(', '); ?></span> <?php } ?>
		<div class="clearfix"></div>
	</div>
	
	<?php  if (has_post_thumbnail()) {
		echo '<div class="image-post-feature">';
			the_post_thumbnail();
		echo '</div>';
	} ?>
	
	<div class="image-entry respimg">
		<?php the_content(__('Read more','ka_express')); ?>
	</div>
	<div class="clearfix"></div>
	<div class="postmetabottom">
		<span class="pagelist"><?php $page_text = __('Pages','ka_express'); wp_link_pages('before='.$page_text.':&after='); ?></span>
		<span class="edit"><?php edit_post_link(__('Edit','ka_express')); ?></span>
		<?php if($display_post_tags == 1) { ?><span class="taglist"><?php the_tags(__('Tags: ','ka_express')); ?></span> <?php } ?>
		<?php if(get_the_title()=="") echo '<span class="no-title"><a href="'.get_permalink().'" rel="bookmark" title="Untitled Link" >'.__("Single Page Link","ka_express").'</a></span>'; ?>
	</div>
</div>
<div class="clearfix"></div>