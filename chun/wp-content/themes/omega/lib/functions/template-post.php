<?php
/**
 * Template functions related to posts.
 */

/**
 * Checks if a post has any content. Useful if you need to check if the user has written any content 
 * before performing any actions.
 *
 * @since  0.9.0
 * @access public
 * @param  int    $id  The ID of the post.
 * @return bool
 */
function omega_post_has_content( $id = 0 ) {
	$post = get_post( $id );
	return !empty( $post->post_content ) ? true : false;
}

/**
 * Outputs a link to the post format archive.
 *
 * @since  0.9.0
 * @access public
 * @return void
 */
function omega_post_format_link() {
	echo omega_get_post_format_link();
}

/**
 * Generates a link to the current post format's archive.  If the post doesn't have a post format, the link 
 * will go to the post permalink.
 *
 * @since  0.9.0
 * @access public
 * @return string
 */
function omega_get_post_format_link() {

	$format = get_post_format();
	$url    = empty( $format ) ? get_permalink() : get_post_format_link( $format );

	return sprintf( '<a href="%s" class="post-format-link">%s</a>', esc_url( $url ), get_post_format_string( $format ) );
}

/**
 * Outputs a post's taxonomy terms.
 *
 * @since  0.9.0
 * @access public
 * @param  array   $args
 * @return void
 */
function omega_post_terms( $args = array() ) {
	echo omega_get_post_terms( $args );
}

/**
 * This template tag is meant to replace template tags like `the_category()`, `the_terms()`, etc.  These core 
 * WordPress template tags don't offer proper translation and RTL support without having to write a lot of 
 * messy code within the theme's templates.  This is why theme developers often have to resort to custom 
 * functions to handle this (even the default WordPress themes do this).  Particularly, the core functions 
 * don't allow for theme developers to add the terms as placeholders in the accompanying text (ex: "Posted in %s"). 
 * This funcion is a wrapper for the WordPress `get_the_terms_list()` function.  It uses that to build a 
 * better post terms list.
 *
 * @since  0.9.0
 * @access public
 * @param  array   $args
 * @return string
 */
function omega_get_post_terms( $args = array() ) {

	$html = '';

	$defaults = array(
		'post_id'    => get_the_ID(),
		'taxonomy'   => 'category',
		'text'       => '%s',
		'before'     => '',
		'after'      => '',
		'items_wrap' => '<span %s>%s</span>',
		/* Translators: Separates tags, categories, etc. when displaying a post. */
		'sep'        => _x( ', ', 'taxonomy terms separator', 'omega' )
	);

	$args = wp_parse_args( $args, $defaults );

	$terms = get_the_term_list( $args['post_id'], $args['taxonomy'], '', $args['sep'], '' );

	if ( !empty( $terms ) ) {
		$html .= $args['before'];
		$html .= sprintf( $args['items_wrap'], omega_get_attr( 'entry-terms', $args['taxonomy'] ), sprintf( $args['text'], $terms ) );
		$html .= $args['after'];
	}

	return $html;
}

/**
 * Produces the link to the current post comments.
 *
 * Supported shortcode attributes are:
 *   after (output after link, default is empty string),
 *   before (output before link, default is empty string),
 *   hide_if_off (hide link if comments are off, default is 'enabled' (true)),
 *   more (text when there is more than 1 comment, use % character as placeholder
 *     for actual number, default is '% Comments')
 *   one (text when there is exactly one comment, default is '1 Comment'),
 *   zero (text when there are no comments, default is 'Leave a Comment').
 *
 * Output passes through 'omega_post_comments_shortcode' filter before returning.
 *
 * @since 0.9.0
 *
 * @param array|string $atts Shortcode attributes. Empty string if no attributes.
 * @return string Shortcode output
 */
function omega_post_comments( $atts = array() ) {

	$defaults = array(
		'after'       => '',
		'before'      => '',
		'hide_if_off' => 'enabled',
		'more'        => __( '% Comments', 'omega' ),
		'one'         => __( '1 Comment', 'omega' ),
		'zero'        => __( 'Leave a Comment', 'omega' ),
	);
	$atts = shortcode_atts( $defaults, $atts, 'post_comments' );

	if ( ( ! comments_open() ) && 'enabled' === $atts['hide_if_off'] )
		return;

	// Darn you, WordPress!
	ob_start();
	comments_number( $atts['zero'], $atts['one'], $atts['more'] );
	$comments = ob_get_clean();

	$comments = sprintf( '<a href="%s">%s</a>', get_comments_link(), $comments );

	$output = '<span class="entry-comments-link">' . $atts['before'] . $comments . $atts['after'] . '</span>';

	return apply_filters( 'omega_post_comments_shortcode', $output, $atts );

}

/* === Galleries === */

/**
 * Gets the gallery *item* count.  This is different from getting the gallery *image* count.  By default, 
 * WordPress only allows attachments with the 'image' mime type in galleries.  However, some scripts such 
 * as Cleaner Gallery allow for other mime types.  This is a more accurate count than the 
 * omega_get_gallery_image_count() function since it will count all gallery items regardless of mime type.
 *
 * @todo Check for the [gallery] shortcode with the 'mime_type' parameter and use that in get_posts().
 *
 * @since  0.9.0
 * @access public
 * @return int
 */
function omega_get_gallery_item_count() {

	/* Check the post content for galleries. */
	$galleries = get_post_galleries( get_the_ID(), true );

	/* If galleries were found in the content, get the gallery item count. */
	if ( !empty( $galleries ) ) {
		$items = '';

		foreach ( $galleries as $gallery => $gallery_items )
			$items .= $gallery_items;

		preg_match_all( '#src=([\'"])(.+?)\1#is', $items, $sources, PREG_SET_ORDER );

		if ( !empty( $sources ) )
			return count( $sources );
	}

	/* If an item count wasn't returned, get the post attachments. */
	$attachments = get_posts( 
		array( 
			'fields'         => 'ids',
			'post_parent'    => get_the_ID(), 
			'post_type'      => 'attachment', 
			'numberposts'    => -1 
		) 
	);

	/* Return the attachment count if items were found. */
	if ( !empty( $attachments ) )
		return count( $attachments );

	/* Return 0 for everything else. */
	return 0;
}

/**
 * Returns the number of images displayed by the gallery or galleries in a post.
 *
 * @since  0.9.0
 * @access public
 * @return int
 */
function omega_get_gallery_image_count() {

	/* Set up an empty array for images. */
	$images = array();

	/* Get the images from all post galleries. */
	$galleries = get_post_galleries_images();

	/* Merge each gallery image into a single array. */
	foreach ( $galleries as $gallery_images )
		$images = array_merge( $images, $gallery_images );

	/* If there are no images in the array, just grab the attached images. */
	if ( empty( $images ) ) {
		$images = get_posts( 
			array( 
				'fields'         => 'ids',
				'post_parent'    => get_the_ID(), 
				'post_type'      => 'attachment', 
				'post_mime_type' => 'image', 
				'numberposts'    => -1 
			) 
		);
	}

	/* Return the count of the images. */
	return count( $images );
}

/* === Links === */

/**
 * Gets a URL from the content, even if it's not wrapped in an <a> tag.
 *
 * @since  0.9.0
 * @access public
 * @param  string  $content
 * @return string
 */
function omega_get_content_url( $content ) {

	/* Catch links that are not wrapped in an '<a>' tag. */
	preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', make_clickable( $content ), $matches );

	return !empty( $matches[1] ) ? esc_url_raw( $matches[1] ) : '';
}

/**
 * Filters 'get_the_post_format_url' to make for a more robust and back-compatible function.  If WP did 
 * not find a URL, check the post content for one.  If nothing is found, return the post permalink.
 *
 * @since  0.9.0
 * @access public
 * @param  string  $url
 * @param  object  $post
 * @note   Setting defaults for the parameters so that this function can become a filter in future WP versions.
 * @return string
 */
function omega_get_the_post_format_url( $url = '', $post = null ) {

	if ( empty( $url ) ) {

		$post = is_null( $post ) ? get_post() : $post;

		$content_url = omega_get_content_url( $post->post_content );

		$url = !empty( $content_url ) ? $content_url : get_permalink( $post->ID );
	}

	return $url;
}
