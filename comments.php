<?php

if(!comments_open() && '0' == get_comments_number()) {
	return;
}
if(post_password_required()) {
	return;
}

?>
<div class="fl-comments">
	
	<?php do_action( 'fl_comments_open' ); ?>

	<?php if(have_comments()) : ?>
	<div class="fl-comments-list">

		<h3 class="fl-comments-list-title"><?php

			if ( $num_comments = get_comments_number() ) {

				printf(
					esc_html( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'Comments list title.', 'fl-automator' ) ),
					number_format_i18n( $num_comments )
				);

			} else {

				_e( 'No Comments', 'fl-automator' );

			}

		?></h3>

		<ol id="comments">
		<?php wp_list_comments(array('callback' => 'FLTheme::display_comment')); ?>
		</ol>

		<?php if(get_comment_pages_count() > 1) : ?>
		<nav class="fl-comments-list-nav clearfix">
			<div class="fl-comments-list-prev"><?php previous_comments_link() ?></div>
			<div class="fl-comments-list-next"><?php next_comments_link() ?></div>
		</nav>
		<?php endif; ?>

	</div>
	<?php endif; ?>
	<?php 
	$req      = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	$html_req = ( $req ? " required='required'" : '' );
	$html5    = true;

	comment_form( array(
		'id_form'               => 'fl-comment-form',
		'class_form'            => 'fl-comment-form',
		'id_submit'             => 'fl-comment-form-submit',
		'class_submit'          => 'btn btn-primary',
		'name_submit'           => 'submit',
		'label_submit'          => __( 'Submit Comment', 'fl-automator' ),
		'title_reply_before'	=> '<div id="reply-title" class="comment-reply-title" role="heading" aria-level="2">',
		'title_reply_after'		=> '</div>',
		'title_reply'           => _x( 'Leave a Comment', 'Respond form title.', 'fl-automator' ),
		'title_reply_to'        => __( 'Leave a Reply', 'fl-automator' ),
		'cancel_reply_link'     => __( 'Cancel Reply', 'fl-automator' ),
		'format'                => 'xhtml',
		'comment_notes_before'  => '',
		'comment_notes_after'   => '',

		
		
		'comment_field'         => '<div class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'Comment form label: comment content.', 'fl-automator' ) . ( $req ? ' <span class="required">'. __( ' (required)', 'fl-automator' ) .'</span>' : '' ) . '</label>
									<textarea id="comment" name="comment" cols="60" rows="8" maxlength="65525" class="form-control" '. $aria_req . $html_req .'></textarea></div>',

		'must_log_in'           => '<p>' . sprintf( _x( 'You must be <a%s>logged in</a> to post a comment.', 'Please, keep the HTML tags.', 'fl-automator' ), ' href="' . esc_url( home_url( '/wp-login.php' ) ) . '?redirect_to=' . urlencode( get_permalink() ) . '"' ) . '</p>',

		'logged_in_as'          => '<p>' . sprintf( __( 'Logged in as %s.', 'fl-automator' ), '<a href="' . esc_url( home_url( '/wp-admin/profile.php' ) ) . '">' . $user_identity . '</a>' ) . ' <a href="' . wp_logout_url( get_permalink() ) . '" title="' . __( 'Log out of this account', 'fl-automator' ) . '">' . __( 'Log out &raquo;', 'fl-automator' ) . '</a></p>',

		'fields'                => apply_filters( 'comment_form_default_fields', array(

			'author' => '<div class="comment-form-author">' . '<label for="author">' . _x( 'Name', 'Comment form label: comment author name.', 'fl-automator' ) . ( $req ? ' <span class="required">'. __( ' (required)', 'fl-automator' ) .'</span>' : '' ) . '</label> ' .
						'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></div>',
						
			'email'  => '<div class="comment-form-email"><label for="email">' . _x( 'Email (will not be published)', 'Comment form label: comment author email.', 'fl-automator' ) . ( $req ? ' <span class="required">'. __( ' (required)', 'fl-automator' ) .'</span>' : '' ) . '</label> ' .
						'<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></div>',
						
			'url'    => '<div class="comment-form-url"><label for="url">' . _x( 'Website', 'Comment form label: comment author website.', 'fl-automator' ) . '</label> ' .
		            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></div>',

		) ),
	) );

	?>
	<?php do_action( 'fl_comments_close' ); ?>
</div>
