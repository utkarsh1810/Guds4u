<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to media_center_comment() which is
 * located in the functions.php file.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<?php if ( have_comments() ) : ?>
<section id="comments" class="inner-bottom-xs comments-area">
	<h3>
		<?php
			printf( 
				_n( 
					'One Comment', '%1$s Comments', 
					get_comments_number(), 'mediacenter' ),
					number_format_i18n( get_comments_number() )
				);
		?>
	</h3>

	<ol class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'media_center_comment', 'style' => 'ol' ) ); ?>
	</ol><!-- .commentlist -->

	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav id="comment-nav-below" class="clearfix navigation" role="navigation">
		<h1 class="assistive-text sr-only section-heading"><?php _e( 'Comment navigation', 'mediacenter' ); ?></h1>
		<div class="pull-left flip nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'mediacenter' ) ); ?></div>
		<div class="pull-right flip nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'mediacenter' ) ); ?></div>
	</nav>
	<?php endif; // check for comment navigation ?>

	<?php
	/* If there are no comments and comments are closed, let's leave a note.
	 * But we only want the note on posts and pages that had comments in the first place.
	 */
	if ( ! comments_open() && get_comments_number() ) : ?>
	<p class="nocomments"><?php _e( 'Comments are closed.' , 'mediacenter' ); ?></p>
	<?php endif; ?>
</section><!-- #comments .comments-area -->

<?php endif; // have_comments() ?>

<?php if( comments_open() ) : ?>
<div class="comment-form-wrapper forms">
	<?php comment_form(); ?>
</div>
<?php endif; ?>