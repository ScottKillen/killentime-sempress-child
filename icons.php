<?php
defined('ABSPATH') || exit;

add_action('wp_body_open', 'the_icons');
function the_icons()
{
?>
	<svg display="none" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
		<symbol id="fa-chevron-right" viewBox="0 0 320 512">
			<path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z" />
		</symbol>
		<symbol id="fa-calendar" viewBox="0 0 448 512">
			<path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H64C28.7 64 0 92.7 0 128v16 48V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V192 144 128c0-35.3-28.7-64-64-64H344V24c0-13.3-10.7-24-24-24s-24 10.7-24 24V64H152V24zM48 192H400V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16V192z" />
		</symbol>
		<symbol id="fa-pipe" viewBox="0 0 64 512">
			<path d="M32 0C45.3 0 56 10.7 56 24V488c0 13.3-10.7 24-24 24s-24-10.7-24-24V24C8 10.7 18.7 0 32 0z" />
		</symbol>
		<symbol id="fa-user-large" viewBox="0 0 512 512">
			<path d="M256 288A144 144 0 1 0 256 0a144 144 0 1 0 0 288zm-94.7 32C72.2 320 0 392.2 0 481.3c0 17 13.8 30.7 30.7 30.7H481.3c17 0 30.7-13.8 30.7-30.7C512 392.2 439.8 320 350.7 320H161.3z" />
		</symbol>
		<symbol id="fa-book-open-reader" viewBox="0 0 512 512">
			<path d="M160 96a96 96 0 1 1 192 0A96 96 0 1 1 160 96zm80 152V512l-48.4-24.2c-20.9-10.4-43.5-17-66.8-19.3l-96-9.6C12.5 457.2 0 443.5 0 427V224c0-17.7 14.3-32 32-32H62.3c63.6 0 125.6 19.6 177.7 56zm32 264V248c52.1-36.4 114.1-56 177.7-56H480c17.7 0 32 14.3 32 32V427c0 16.4-12.5 30.2-28.8 31.8l-96 9.6c-23.2 2.3-45.9 8.9-66.8 19.3L272 512z" />
		</symbol>
		<symbol id="fa-folder" viewBox="0 0 512 512">
			<path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z" />
		</symbol>
		<symbol id=fa-slash-foward-light viewBox="0 0 320 512">
			<path d="M312.2 2.3c7.6 4.5 10 14.4 5.5 22l-288 480c-4.5 7.6-14.4 10-22 5.5s-10-14.4-5.5-22l288-480c4.5-7.6 14.4-10 22-5.5z" />
		</symbol>
	</svg>
<?php
}
