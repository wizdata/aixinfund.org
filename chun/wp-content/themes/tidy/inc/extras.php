<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Tidy
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function tidy_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'tidy_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tidy_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'tidy_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function tidy_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() ) {
		return $title;
	}

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'tidy' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'tidy_wp_title', 10, 2 );

/**
 * Filters excerpt_more.
 * @param string $more.
 * @return string.
*/
function tidy_excerpt_more( $more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'tidy_excerpt_more' );

/**
 * Filters excerpt_length.
 * @param num $length.
 * @return num.
*/
function tidy_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'tidy_excerpt_length', 999 );

/**
 * Filters post-format name.
 * @param string $query Default query.
 * @return array.
*/
function tidy_rename_post_formats( $safe_text ) {
	if ( $safe_text == 'Gallery' )
		return __( 'Portfolio', 'tidy' );

	return $safe_text;
}
add_filter( 'esc_html', 'tidy_rename_post_formats' );

//rename Aside in posts list table
function tidy_live_rename_formats() { 
	global $current_screen;

	if ( $current_screen->id == 'edit-post' ) { ?>
		<script type="text/javascript">
		jQuery('document').ready(function() {
			jQuery("span.post-state-format").each(function() { 
				if ( jQuery(this).text() == "Gallery" )
					jQuery(this).text("<?php _e( 'Portfolio', 'tidy' ); ?>");
			});
		});
		</script>
<?php }
}
add_action('admin_head', 'tidy_live_rename_formats');

/**
 * Filters pre_get_posts.
 * @param string $query Default query.
 * @return Void.
*/
function tidy_modify_main_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	$tidy_posts_per_page = get_option( 'posts_per_page' );

	// post_type = post_format=gallery
	$tidy_port_num = tidy_of_get_option( 'port_num', $tidy_posts_per_page );
	if ( $query->is_tax( 'post_format' ) ) {
		if ( $query->is_tax( 'post_format', 'post-format-gallery' ) ) {
			$query->set( 'posts_per_page', $tidy_port_num );
		} else {
			$query->set( 'posts_per_page', $tidy_port_num );
		}
		return;
	}

	// is_archive or is_search
	$arc_num = tidy_of_get_option( 'arc_num', $tidy_posts_per_page );
	if ( $query->is_archive() or $query->is_search() ) {
		$query->set( 'posts_per_page', $arc_num );
		return;
	}


}
add_action( 'pre_get_posts', 'tidy_modify_main_query' );

/*
function tidy_query_format_standard($query) {
	if (isset($query->query_vars['post_format']) && $query->query_vars['post_format'] == 'post-format-standard') {
		if (($post_formats = get_theme_support('post-formats')) && is_array($post_formats[0]) && count($post_formats[0])) {
			$terms = array();
			foreach ($post_formats[0] as $format) {
				$terms[] = 'post-format-'.$format;
			}
			$query->is_tax = null;
			unset($query->query_vars['post_format']);
			unset($query->query_vars['taxonomy']);
			unset($query->query_vars['term']);
			unset($query->query['post_format']);
			$query->set('tax_query', array(
				'relation' => 'AND',
				array(
				'taxonomy' => 'post_format',
				'terms' => $terms,
				'field' => 'slug',
				'operator' => 'NOT IN'
				)
			));
		}
	}
}
add_action('pre_get_posts', 'tidy_query_format_standard');
*/

/**
 * add action showtime.
 * @param none.
 * @return Void.
*/
function tidy_showtime() {
	if ( function_exists( 'showtime' ) ) showtime();
}
add_action( 'tidy_before_content', 'tidy_showtime' );

/**
 * Remove filters GMO_Ads_Master in pages and attachment.
 */
if ( class_exists( 'GMO_Ads_Master' ) ) :
function tidy_remove_ad() {
	if ( is_singular( array( 'page','attachment' ) ) ) {
		global $gmoadsmaster;
		remove_filter( 'the_content', array($gmoadsmaster, 'the_content') );
	}
}
add_action( 'template_redirect', 'tidy_remove_ad' );
endif; //class_exists( 'GMO_Ads_Master' )
