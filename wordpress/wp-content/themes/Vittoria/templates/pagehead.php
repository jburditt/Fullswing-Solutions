<?php
if (rwmb_meta('vittoria_titlebar')) {
	?>
	<div class="l-submain for_pagehead">
		<div class="l-submain-h g-html i-cf">
			<div class="w-pagehead">
				<h1><?php the_title(); ?></h1>
				<p><?php echo rwmb_meta('vittoria_subtitle') ?></p>
				<?php if (rwmb_meta('vittoria_breadcrumbs')) { ?>
					<!-- breadcrums -->
					<?php us_breadcrumbs(); ?>
				<?php } ?>
			</div>
		</div>
	</div>
<?php
}
