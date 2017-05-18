<?php

function us_enqueue_editor_style() {

	add_editor_style( 'functions/tinymce/mce_styles.css' );
}

add_action('init', 'us_enqueue_editor_style');