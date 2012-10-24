<?php
if ( function_exists('register_sidebar') )
    register_sidebar();

function enable_more_buttons($buttons) {
	$buttons[] = 'hr';
	return $buttons;
}
add_filter("mce_buttons", "enable_more_buttons");
?>