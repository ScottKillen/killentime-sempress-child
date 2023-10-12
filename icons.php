<?php
defined('ABSPATH') || exit;

add_action('wp_body_open', 'the_icons');
function the_icons()
{
?>
	<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
		<symbol id="fa-chevron-right" viewBox="0 0 320 512">
			<path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
		</symbol>
		<symbol id="fa-calendar" viewBox="0 0 448 512">
			<path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192H400V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192z" />
		</symbol>
		<symbol id="fa-pipe" viewBox="0 0 64 512">
			<path d="M32 0C45.3 0 56 10.7 56 24V488c0 13.3-10.7 24-24 24s-24-10.7-24-24V24C8 10.7 18.7 0 32 0z" />
		</symbol>
	</svg>
<?php
}
