<?php

if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="w-comments has_form">
	<div class="w-comments-h">

		<h3 class="w-comments-title"><?php comments_number(__('No comments', 'Vittoria'), __('1 Comment. <a href="#comment">Leave new</a>', 'Vittoria'), __('% Comments. <a href="#comment">Leave new</a>', 'Vittoria') );?></h3>


		<div class="w-comments-list">
			<?php wp_list_comments(array( 'callback' => 'vittoria_comment_start', 'end-callback' => 'vittoria_comment_end', 'walker' => new Walker_Comments_Vittoria() )); ?>
		</div>

		<div class="w-blog-pagination">
			<div class="g-pagination">
				<?php previous_comments_link() ?>
				<?php next_comments_link() ?>
			</div>
		</div>

		<?php if ( comments_open() ) : ?>

		<div id="respond" class="w-comments-form">
			<div class="w-comments-form-title"><?php comment_form_title(__('Leave comment', 'Vittoria'), __('Leave comment', 'Vittoria')); ?></div>
			<?php if ( get_option('comment_registration') && !is_user_logged_in() ) { ?>
			<div class="w-comments-form-text"><?php printf(__('You must be %slogged in%s to post a comment.', 'Vittoria'), '<a href="'.wp_login_url( get_permalink() ).'">', '</a>'); ?></div>
			<?php } else { ?>
			<form class="g-form" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">
				<div class="g-form-group">
					<div class="g-form-group-rows">
					<?php if ( ! is_user_logged_in()) { ?>
						<div class="g-form-row">
							<div class="g-form-row-label">
								<label class="g-form-row-label-h" for="input1x1"><?php echo __('Your name', 'Vittoria') ?> *</label>
							</div>
							<div class="g-form-row-field">
								<div class="g-input">
									<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>">
								</div>
							</div>
						</div>
						<div class="g-form-row">
							<div class="g-form-row-label">
								<label class="g-form-row-label-h" for="input1x2"><?php echo __('Your email', 'Vittoria') ?> *</label>
							</div>
							<div class="g-form-row-field">
								<div class="g-input">
									<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>">
								</div>
							</div>
						</div>
						<?php } ?>
						<div class="g-form-row">
							<div class="g-form-row-label">
								<label class="g-form-row-label-h" for="input1x3"><?php echo __('Your message', 'Vittoria') ?> *</label>
							</div>
							<div class="g-form-row-field">
								<div class="g-input">
									<textarea name="comment" id="comment" cols="30" rows="10"></textarea>
								</div>
							</div>
						</div>
						<div class="g-form-row">
							<div class="g-form-row-label"></div>
							<div class="g-form-row-field">
								<button class="g-btn type_color"><?php echo __('Submit Comment', 'Vittoria') ?></button>
							</div>
						</div>
						<?php comment_id_fields(); ?>
						<?php do_action('comment_form', $post->ID); ?>
					</div>
				</div>
			</form>
			<?php } ?>


		</div>
		<?php endif;?>



	</div>
</div>