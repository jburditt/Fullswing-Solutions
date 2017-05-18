<?php

class Walker_Comments_Vittoria extends Walker_Comment {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;

		echo '<div class="w-comments-childlist">'."\n";

	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$GLOBALS['comment_depth'] = $depth + 1;

		echo '</div>'."\n";
	}
}

function vittoria_comment_start( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>

	<div class="w-comments-item" id="comment-<?php comment_ID() ?>">
		<div class="w-comments-item-meta">
			<div class="w-comments-item-icon">
				<?php echo get_avatar($comment, $size = '50'); ?>
			</div>
			<div class="w-comments-item-author"><?php echo get_comment_author() ?></div>
			<div class="w-comments-item-date"><?php echo get_comment_date().' '.get_comment_time() ?></div>
			<?php /*<a class="w-comments-item-number" href="#comment-<?php comment_ID() ?>"></a>*/ ?>
		</div>
		<div class="w-comments-item-text"><?php comment_text() ?></div>
<!--		<a class="w-comments-item-answer" href="javascript:void(0);">Reply</a>-->
		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'before' => '<span class="w-comments-item-answer">', 'after' => '</span>'))) ?>
	</div>


<?php
}

function vittoria_comment_end( $comment, $args, $depth ) {
	return;
}