<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action( 'fl_head', 'FLChildTheme::stylesheet' );



add_action( 'wp_enqueue_scripts', 'tp_bb_scripts', 999 );
function tp_bb_scripts() {
}


add_action( 'after_setup_theme', '_tp_setup' );
function _tp_setup() {
	global $cap, $content_width;

	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'index_rel_link' ); // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version


	remove_action( 'wp_head', 'rest_output_link_wp_head' );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

}


add_filter('xmlrpc_enabled', '__return_false');




/** Gravity Forms **/
add_filter( 'gform_submit_button', 'tp_form_submit_beaver_style', 10, 2 );
function tp_form_submit_beaver_style( $button, $form ) {
	return '<button target="_self" class="fl-button" role="button" id="gform_submit_button_'. $form['id'] .'"><span class="fl-button-text">'. $form['button']['text'] .'</span></button>';
}


/** Woocommerce **/
/**
 * @desc Remove in all product type
 */
function wpp_remove_all_quantity_fields( $return, $product ) {
    return true;
}
add_filter( 'woocommerce_is_sold_individually', 'wpp_remove_all_quantity_fields', 10, 2 );


//* Remove tab product
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['description'] );          // Remove the description tab
    unset( $tabs['reviews'] );          // Remove the reviews tab
    unset( $tabs['additional_information'] );   // Remove the additional information tab

    return $tabs;

}

// Long Description in short Description
/** Remove short description */
function dot_reorder_product_page() {
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
}
add_action( 'woocommerce_before_main_content', 'dot_reorder_product_page' );
/** Display product description the_content */
// le 19/11/2015 contenu masqué pour l'instant
function dot_do_product_desc() {

    global $woocommerce, $post;

    if ( $post->post_content ) : ?>
        <div itemprop="description" class="item-description">
            <?php $heading = apply_filters('woocommerce_product_description_heading', __('Product Description', 'woocommerce')); ?>

            <!-- <h2><?php echo $heading; ?></h2> -->
            <?php the_content(); ?>

        </div>
    <?php endif;
}
add_action( 'woocommerce_single_product_summary', 'dot_do_product_desc', 20 );


add_filter( 'woocommerce_checkout_fields' , 'alter_woocommerce_checkout_fields' );
function alter_woocommerce_checkout_fields( $fields ) {
     unset($fields['order']['order_comments']);
     return $fields;
}

/**
  * Remove link wrapping main product image in single product view.
  * @param $html
  * @param $post_id
  * @return string
*/
add_filter('woocommerce_single_product_image_html', 'custom_unlink_single_product_image', 10, 2);
function custom_unlink_single_product_image( $html, $post_id ) {
    return get_the_post_thumbnail( $post_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
}


/** Gravity Forms **/
add_filter( 'gform_tabindex', '__return_false' );


/** Comments **/
// add_filter( 'comment_form_default_fields', 'wearewp_comment_form_default_fields', 100, 1 );
function wearewp_comment_form_default_fields( $fields ){
	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	$html5    = true;

	$fields   =  array(
		'author' => '<div class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></div>',
		'email'  => '<div class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
		            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div>',
		'url'    => '<div class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
		            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></div>',
		'comment_field' => '<div class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="60" rows="8" maxlength="65525" class="form-control" aria-required="true" required="required"></textarea></div>',
	);
	
	
	return $fields;
}


// add_filter( 'comment_form_defaults', 'wearewp_comment_form_defaults', 100, 1 );
function wearewp_comment_form_defaults( $defaults ){
	
	$defaults['title_reply_before'] = '<div id="reply-title" class="comment-reply-title">';
	$defaults['title_reply_after'] = '</div>';
	
	$defaults['comment_field'] = '';

	
	return $defaults;
}