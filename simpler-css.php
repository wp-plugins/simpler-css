<?php
/*
Plugin Name: Simpler CSS
Plugin URI: http://simpler.freddyware.com/
Description: Simplifies custom CSS on WordPress µ blogs.
Version: 0.1
Author: Frederick Ding
Author URI: http://www.frederickding.com/
Forked from Jeremiah Orem's Custom User CSS plugin.
*/

/*  Copyright 2009  Jeremiah Orem, Frederick Ding

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_menu', 'simpler_css_menu');
add_action('wp_head', 'simpler_css_addcss');

function simpler_css_addcss() {
	echo '<style type="text/css">'."\n";	
	echo htmlspecialchars(get_option('simpler_css_css'))."\n";
	echo '</style>'."\n";

}

function simpler_css_menu() {
	add_theme_page('Simpler CSS Options', 'Custom CSS', 8, __FILE__, 'simpler_css_options');
}

function simpler_css_options() {
	$updated = false;
	$opt_name = 'simpler_css_css';
	
	$css_val = get_option( $opt_name );

	if( $_POST['action'] == 'update' ) {
		$css_val = $_POST[ $opt_name ];

		update_option( $opt_name, $css_val );
		$updated = true;
	}

	if ($updated) { ?>
	<div class="updated"><p><strong><?php _e('Options saved.', 'mt_trans_domain' ); ?></strong></p></div>
<?php } ?>
<div class="wrap">
<h2>Simpler CSS Options &mdash; Custom Styles</h2>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']?>">
<?php wp_nonce_field('update-options'); ?>

<table class="form-table">

<tr valign="top">
<th scope="row">Custom CSS</th>
<td><textarea cols="80" rows="25" name="<?php echo $opt_name ?>">
<?php echo $css_val ?>
</textarea>
</tr>
 

</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="<?php echo $opt_name ?>" />

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

</form>
</div>
<?php
}

?>