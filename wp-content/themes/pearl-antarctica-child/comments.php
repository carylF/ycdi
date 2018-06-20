<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;
?>

<div id="comments" class="comments-area">
    <?php if ( have_comments() ) { ?>
    <h2 class="comments-title"><?php comments_number( esc_html__( 'no comment', 'pearl-antarctica' ), esc_html__( 'one comment', 'pearl-antarctica' ), esc_html__( 'comments (%)', 'pearl-antarctica' ) ); ?></h2>

    <ol class="comment-list">
        <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'callback'  => 'pearl_comment_list',
                'avatar_size' => 54,
            ) );
        ?>
    </ol>
    <?php
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
            ?>
            <nav class="navigation comment-navigation">
                <h1 class="screen-reader-text section-heading"><?php esc_html_e('Comment navigation', 'pearl-antarctica'); ?></h1>
                <div
                    class="nav-previous"><?php previous_comments_link( esc_html__('&larr; Older Comments', 'pearl-antarctica') ); ?></div>
                <div
                    class="nav-next"><?php next_comments_link( esc_html__('Newer Comments &rarr;', 'pearl-antarctica') ); ?></div>
            </nav><!-- .comment-navigation -->
            <?php

        } // Check for comment navigation


        if ( ! comments_open() && get_comments_number() ) { ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.' , 'pearl-antarctica' ); ?></p>
    <?php }

    } // have_comments() ?>
    <?php comment_form(); ?>
</div>