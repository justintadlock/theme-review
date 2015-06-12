<?php
/*
Plugin Name: Theme Review
Plugin URI:  
Description: This plugin is designed as a guide to help you with your first theme review. It can also be helpful as a check list for theme authors. Version:     1.0.0
Version: 1.0.0
Author:      TRT
Author URI:  https://make.wordpress.org/themes/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: theme-review

*/

/**
 * Load up the menu page
 */
add_action( 'admin_menu', 'theme_review_add_page' );
function theme_review_add_page() {
	  $page_hook_suffix = add_submenu_page( 'index.php', __( 'Theme Review', 'theme-review' ), __( 'Theme Review', 'theme-review' ), 'manage_options', 'theme_review', 'theme_review_do_page' );
	  add_action('admin_print_scripts-' . $page_hook_suffix, 'theme_review_admin_scripts');
}

function theme_review_admin_scripts() {
    wp_enqueue_style('theme-review-style', plugins_url( '/style.css', __FILE__ ) );
}

include( plugin_dir_path( __FILE__ ) . 'customizer.php');

/**
 * Create the options page
 */
function theme_review_do_page() {
?>
<script>
 jQuery(document).ready(function($) {
    $('.welcome-panel').find('.handlediv').click(function(){
      //Expand or collapse this panel
      $(this).next().slideToggle('fast');
      //Hide the other panels
     //'' $(".handlediv").not($(this).next()).slideUp('fast');
    });

  });
 </script>

<div class="wrap">
<div class="welcome-panel">	<h2><?php _e( 'Theme Review', 'theme-review' );?></h2>	
<div title="Click to toggle" class="handlediv"><br></div>
	<div class="welcome-panel-content">
	
		<p class="about-description"><?php _e('This plugin is designed as a guide to help you with your first theme review.','theme-review');?></p>

		<div class="welcome-panel-column-container">
		<div class="welcome-panel-column" style="width:65%;">
		<h3><b><?php _e('Preparing for your review','theme-review');?></b></h3>

		<?php 
		echo __( 'Awesome! You have already completed the first steps in setting up your testing environment:','theme-review');

		if ( defined( 'WP_DEBUG' ) ){
			 echo ' <code>'. __('WP_DEBUG is on.','theme-review') . '</code> ';
		} else {
			echo  '<p>' . __( 'Now, we recommend ou to set the following constants to <code>true</code> in your <code>wp-config.php</code> file. 
				<a href="http://codex.wordpress.org/Editing_wp-config.php" target="_blank">Need help?</a>', 'theme-review' ) . '</p> ';
		}

		//Theme check
		if (is_plugin_active('theme-check/theme-check.php')) {
			echo __('Theme Check is active.','theme-review');
		}else{

			if ( ! current_user_can( 'install_plugins' ) ) {
				return;
			}

			if (file_exists( WP_PLUGIN_DIR . '/' . 'theme-check/theme-check.php' ) && is_plugin_inactive('theme-check/theme-check.php')){
				echo '<p>' . __('Theme Check is installed but not active.','theme-review') . '</p> ';
				//todo: Use activation link with wp_nonce_url
				echo '<a href="' . admin_url('plugins.php') . '" class="button button-primary button-hero">' . esc_html__( 'Activate Theme Check', 'theme-review' ) . '</a>';
			}else{
				echo '<p>' . __( 'We recommend that you also install the Theme Check plugin:', 'theme-review' ) . '</p> ';
				echo '<a href="' . admin_url('plugins.php') . '" class="button button-primary button-hero">' . esc_html__(' Install Theme Check', 'theme-review' ) . '</a>';
			}
		}
		?>

		<div style="margin-top:20px; padding-bottom:40px;">
			<h3><b><?php _e( 'Now, is your ticket ready?', 'theme-review' );?></b></h3>
			<h5>You are reviewing:
			<?php
			$trt_theme = wp_get_theme();
			echo $trt_name =$trt_theme->get( 'Name' );
			?>.  -If this is not your ticket, <a href="<?php admin_url('themes.php');?>"><?php _e( 'install and activate the correct theme.','theme-review');?></a></h5>
			<h4><?php _e( 'Ticket? -What ticket?','theme-review');?></h4>
			A theme trac ticket is a ticket with information about a theme that has been submitted for review.</br>
			First you need to <button class="make-request">Request a theme to review.</button>
			You will then find your tickets here: <a href="https://themes.trac.wordpress.org/query?status=!closed&owner=$USER">https://themes.trac.wordpress.org</a><br>
			In your ticket you will find the theme name, the authors name, and a link to a zip file containing the theme that you should review.<br>
			Below the theme screenshot is a form, so if you haven't already, sa 'Hi' and <b>introduce yourself to your author.</b>
			<br>
		</div>

		</div>
	<div class="welcome-panel-column welcome-panel-last">
		<h4>Stuck?</h4>
		<p><b>If you have questions about reviewing, come talk to other reviewers on <a href="https://make.wordpress.org/chat/">wordpress.slack.com #themereview</a></b></p>
		We also have Weekly Chats:<br>
		Weekly Meeting<br>
		Tuesdays @ 18:00 UTC<br>
		Slack #themereview<br>
		<i>For agenda, visit our make blog below.</i><br><br>
		Theme trac meeting: looking at tickets that relate to themes<br>
		Thursdays @ 18:00 UTC<br>
		Slack #themereview<br><br>
		<a href="https://make.wordpress.org/themes/">Home of the Theme Review Team: make.wordpress.org/themes/</a><br><br>
	</div>
</div>
</div>
</div>

<div class="welcome-panel">			
<h2><b>Performing your review</b></h2>
<div title="Click to toggle" class="handlediv"><br></div>
	<div class="welcome-panel-content">
			<h5>The full guidelines that you will review the theme against can be found <a href="https://make.wordpress.org/themes/handbook/review/required/">here.</a></h5><br>
			
			<b>What you will be checking:</b><br>
			There is more to a review than checking if the content is displayed nicely. You will be checking if the theme is <b>secure</b>, if there are any <b>errors</b>, if it is <b>translatable</b>
			and if all theme <b>options</b> are working correctly.<br>
			You will be reading a lot of code, and one theme will have a different setup than the other, but don't worry, this becomes easier as you gain more experience.<br>

			<b>Reviewing a theme with the help of the plugin:</b><br>
			Each section under the Theme Review panel in the customizer represents a requirement, accompanied with a short statement or a question.<br>
			Once a check has been completed, it will be added to the progress and summary below.<br>
			<i>Example:</i><br>
			<?php echo '<img src="' . plugins_url( 'lang.png', __FILE__ ) . '" > ';?>
			<br>
			<i>Anything in red is a required item that should be noted in your review.</i><br><br>


			<h3><b>Writing your review</b></h3>
			You should take notes as you review each part of the theme, and write down any questions that you have for the author.<br>
			The suggested format for your review is as follows:<br>
				<ul>
				<li><b>‘Welcome wrapper’</b> Say Hi to the author, let them know what you are going to do. This may be their first review.</li>
				<li><b>Say the outcome.</b> Let the author know from the start what the outcome is.<li>
				<li><b>Required.</b> List all the required items, a theme can’t be approved until all of these are met.</li>
				<li><b>Recommended.</b> You can then list all the recommended items. These won’t be a grounds to not approve, but they are good theme practice.</li>
				<li><b>Notes.</b> This could be a section where you add design notes, maybe additional information. Again, this can’t be something you don’t approve because, but it can be a way to educate.</li>
				<li><b>Say what is going to happen next</b>. Keeping the author informed is great. Let them know you will let them upload a new version or what the approval process is.</li>
				</ul>

				<h5>Using the headings ‘Required, Recommended and Notes’ is really helpful for people when viewing the review.</h5>
				<br>
				
			<h3><b>Finishing your review</b></h3>
				It is important that you do not close the ticket when you submit your notes.<br>
				If there are required items that needs to be fixed, the author has seven days to reply. They can then submit a new version, or ask for more time.<br>
				If a new version is submitted, you need to check if all the required items has been fixed. <br>
				When you feel that a theme is ready to be approved, you should ask for feedback from your mentor or an experienced theme reviewer before you close the ticket.<br>
				-If seven days has passed without any word from the theme author, you can close the ticket as not approved.<br>
				<br>
	</div>
</div>

<div class="ready-button">
<h3>You should now have your theme folder and your code editor ready so that you can easilly check the files.</h3>
<a href="customize.php" class="button button-primary button-hero">I understand, take me to the customizer.</a>
</div>

</div><!--end wrap -->
	<?php
}