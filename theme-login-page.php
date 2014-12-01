<?php
/*
Plugin Name: Theme Login Page
Plugin URI: http://dauid.us
Description: Theme your default WordPress login page to include your header.php and custom styles.
Version: 1.1
Author: Dave Winter (dauidus)
Author URI: http://dauid.us
License: GPL2
*/

add_action( 'login_head', 'dauidus_login_head_javascript' );
function dauidus_login_head_javascript() {
?>
	<script type="text/javascript">
		wp_custom_login_remove_element('wp-admin-css');
		wp_custom_login_remove_element('colors-fresh-css');

		function dauidus_login_remove_element(id) {
			var element = document.getElementById(id);
			element.parentNode.removeChild(element);
		}
	</script>
<?php
}


// need settings logic
// add header.php to login page
add_action( 'login_head', 'dauidus_login_header' );
function dauidus_login_header() {
	do_action('dauidus_login_header_before');
	get_header();
	do_action('dauidus_login_header_after');
}

// need settings logic to add custom css
// move .css file(s) out of theme and into plugin	
// load login.css
add_action('login_head', 'dauidus_login_css');
function dauidus_login_css() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_stylesheet_directory_uri().'/css/login.css" />';
}

/*
// need settings logic
// fade in login box
add_action( 'login_head', 'dauidus_untame_fadein',30);
function dauidus_untame_fadein() {
	echo '<script type="text/javascript">// <![CDATA[
		jQuery(document).ready(function() { jQuery("#loginform,#nav,#backtoblog").css("display", "none");          jQuery("#loginform,#nav,#backtoblog").fadeIn(2500);     
		});
		// ]]>
	</script>';
}
*/			

// need settings logic			
// WordPress custom logo & link redirect -- doesn't matter, cause we're hiding it
 add_filter( 'login_headerurl', 'dauidus_login_header_url' );
 function dauidus_login_header_url($url) {
 	return 'http://dauid.us';  // check this
 }

// need settings logic				
// Hide login errors for security
add_filter('login_errors',create_function('$a', "return null;"));
