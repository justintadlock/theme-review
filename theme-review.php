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

/**
 * Init plugin options to white list our options
 */
add_action( 'admin_init', 'theme_review_init' );
function theme_review_init(){

	// register_setting( $option_group, $option_name, $sanitize_callback );
	register_setting( 'theme_review_group', 'theme_review_options');

	//add_settings_section( $id, $title, $callback, $page );
	add_settings_section('theme_review_section','','', 'theme_review_group');

	//add_settings_field( $id, $title, $callback, $page, $section, $args );
	//link
	add_settings_field( 'theme_review_link', '', 'theme_review_link_render', 'theme_review_group', 'theme_review_section');
	//license
	add_settings_field( 'theme_review_license', '', 'theme_review_license_render', 'theme_review_group', 'theme_review_section');
	//lang
	add_settings_field( 'theme_review_lang', '', 'theme_review_lang_render', 'theme_review_group', 'theme_review_section');
	//accesibility
	add_settings_field( 'theme_review_ally', '', 'theme_review_ally_render', 'theme_review_group', 'theme_review_section');
	//customizer -THEME OPTIONS
	add_settings_field( 'theme_review_customizer', '', 'theme_review_customizer_render', 'theme_review_group', 'theme_review_section');
	//Review notes
	add_settings_field( 'theme_review_notes', '', 'theme_review_notes_render', 'theme_review_group', 'theme_review_section');

}
function themeslug_get_option_defaults() {
	$defaults = array(
		'theme_review_link' => '0',
		'theme_review_license' => '0',
		'theme_review_lang' => '0',
		'theme_review_customizer' => '0',
		'theme_review_notes' => '',
	);
	return apply_filters( 'themeslug_option_defaults', $defaults );
}

function theme_review_link_render(){
	$options = get_option( 'theme_review_options', 'themeslug_get_option_defaults' );
   ?>
   			<div class="postbox">
					<h3><i class="dashicons dashicons-admin-links"></i> 
					<?php
					if( $options['theme_review_link']==0){
						echo '<span class="fail-title">' . __('Links','theme-review') . ' ' . __('<i style="float:right; margin-right:40px;">Did not pass</i>','theme-review') . '</span>';
					}else{
						_e('Links','theme-review');
					}
					?>
					</h3>
					<div title="Click to toggle" class="handlediv"><br></div>
				
					<div class="inside">
					<i>Links should be related to the theme and helpful to the user.</i>
					<i>WordPress.org links are reserved for official themes.</i>
					<?php
					$trt_theme = wp_get_theme();
					$trt_author_uri =$trt_theme->get( 'AuthorURI' );
					$trt_theme_uri =$trt_theme->get( 'ThemeURI' );
					//Soon?
					//$trt_demo_uri =$trt_theme->get( 'DemoURI' );
					//$trt_support_uri =$trt_theme->get( 'SupportURI' );

					?>
						<div class="main">
							<ul>
							<li><a href="<?php echo esc_url($trt_author_uri); ?>">Check Author URI</a></li>		
							<li><a href="<?php echo esc_url($trt_theme_uri); ?>">Check Theme URI</a></li>
							<!---
							<li class=""><a href="#">Check Demo URI</a></li>		
							<li class=""><a href="#">Check Support URI</a></li>
							-->
							<li><br><span class="dashicons dashicons-media-code"></span> Open footer.php and check if there is a footer credit link and if it is appropriate.</li>
							
							</ul>
						</div>
						<div class="complete">
								<input type='radio' name='theme_review_options[theme_review_link]' <?php checked( $options['theme_review_link'], 1 ); ?> value='1'>Pass
								<input type='radio' name='theme_review_options[theme_review_link]' <?php checked( $options['theme_review_link'], 0 ); ?> value='0'>Fail
								<?php submit_button( 'Mark as Completed', 'secondary' );?>
						</div>


					</div>
				</div>     
   <?php
}

function theme_review_license_render(){
	$options = get_option( 'theme_review_options', 'themeslug_get_option_defaults' );
	?>
		<div class="postbox">
			<h3><i class="dashicons dashicons-info"></i> 
				<?php
					if( $options['theme_review_license']==0){
						echo '<span class="fail-title">' . __('License and Copyright','theme-review') . ' ' . __('<i style="float:right; margin-right:40px;">Did not pass</i>','theme-review') . '</span>';
					}else{
						_e( 'License and Copyright','theme-review');
					}
				?>
			</h3>
			<div title="Click to toggle" class="handlediv"><br></div>
			<div class="inside">
				<div class="main">
					<ul>
						<li><i>The theme needs to be 100% GPL compatible. </i></li>
						<li><i>The theme should have a copyright notice (Copyright Year Name).</i></li>	
						<li><br><span class="dashicons dashicons-media-code"></span> Open the readme file and make sure that license and copyright has been declared for all included third party resources.<li>
						<li><br><span class="dashicons dashicons-visibility"></span> <a href="http://www.gnu.org/licenses/license-list.html#GPLCompatibleLicenses">List of GPL compatible licenses</a></li>
					</ul>
				</div>
					<div class="complete">
						<input type='radio' name='theme_review_options[theme_review_license]' <?php checked( $options['theme_review_license'], 1 ); ?> value='1'>Pass
						<input type='radio' name='theme_review_options[theme_review_license]' <?php checked( $options['theme_review_license'], 0 ); ?> value='0'>Fail
						<?php submit_button( 'Mark as Completed', 'secondary' );?>
					</div>
			</div>
		</div>
<?php
}

function theme_review_lang_render(){
	$options = get_option( 'theme_review_options', 'themeslug_get_option_defaults' );
	?>
		<div class="postbox">
			<h3><i class="dashicons dashicons-translation"></i> 
					<?php
					if( $options['theme_review_lang']==0){
						echo '<span class="fail-title">' . __('Language','theme-review') . ' ' . __('<i style="float:right; margin-right:40px;">Did not pass</i>','theme-review') . '</span>';
					}else{
						_e( 'Language','theme-review');
					}
				?>
			</h3>
			<div title="Click to toggle" class="handlediv"><br></div>
			<div class="inside">
			<i>All theme text strings are to be translatable.</i>
			<?php
			$trt_theme = wp_get_theme();
			$trt_textdomain =$trt_theme->get( 'TextDomain' );
			//$trt_translation_path =$trt_theme->get( 'DomainPath' );
			?>
				<div class="main">
					<ul>
						<li><?php _e('Text domain: ','theme-review');?>
						<?php
						if( !$trt_textdomain){
							 _e('<b style="color:red">REQUIRED</b>: Text domain is missing or blank in style.css','theme-review');
						}else{
							echo esc_html__( $trt_textdomain ); 
						}
						?>
						</li>		
						<li><br><b style="color:blue"><?php _e( 'RECOMMENDED:','theme-review');?> </b></li>
						<li><span class="dashicons dashicons-media-code"></span> Make sure that there is a language file in the theme folder and that it refers to the correct theme.</li>
						<li><br><span class="dashicons dashicons-visibility"></span> <a href="https://developer.wordpress.org/themes/functionality/internationalization/">Theme Handbook: Internationalization.</a><br>
						<br>A basic translation string can look like this: <br>
						<code>__( 'text to be internationalized', 'text-domain' );</code><br>
						If a translation is echoed, it can also look like this:<br> 
						<code>_e( 'WordPress is the best!', 'text-domain' );</code><br><br>
						A text that looks like this would fail, since it is not translatable:<br>
						<code>&lt;h2&gt;Hello World&lt;/h2&gt;</code> should be: <br>
						<code>&lt;h2&gt;&lt;?php _e('Hello World', 'text-domain'); ?&gt; &lt;/h2&gt;</code><br><br>
						Translated attributes should be escaped. Example:<br>
						<code>&lt;input type="submit" name="submit" value="&lt;?php esc_attr_e( 'Search','text-domain' ); ?&gt;" /&gt;</code>


						</li>
					</ul>
				</div>

				<div class="complete">
						<input type='radio' name='theme_review_options[theme_review_lang]' <?php checked( $options['theme_review_lang'], 1 ); ?> value='1'>Pass
						<input type='radio' name='theme_review_options[theme_review_lang]' <?php checked( $options['theme_review_lang'], 0 ); ?> value='0'>Fail
						<?php submit_button( 'Mark as Completed', 'secondary' );?>
				</div>

			</div>
		</div>
<?php
}

function theme_review_ally_render(){
	$trt_theme = wp_get_theme();
	$trt_tags =$trt_theme->get( 'Tags' );
	if (in_array ('accessibility-ready' , $trt_tags) ){

		$options = get_option( 'theme_review_options', 'themeslug_get_option_defaults' );
		?>
	            <div class="postbox">
						<h3><?php _e('Accessibility ','theme-review');?></h3>
						<div title="Click to toggle" class="handlediv"><br></div>
						<div class="inside">
							<b style="color:green"> IMPORTANT:</b> This theme has an accessibility-ready tag and it needs an additional review by an accessibility expert. 
								It is important that you do not close the ticket when you are finished with the basic review.
						</div>
					</div>
		<?php
		}
}

function theme_review_customizer_render(){
	$options = get_option( 'theme_review_options', 'themeslug_get_option_defaults' );
	?>
	<div class="postbox">
		<h3>Options and Settings</h3>
		<div title="Click to toggle" class="handlediv"><br></div>
		<div class="inside">
			<div class="main">
				Go to the customizer and make sure that all options are working. 
				Are the theme specific options easy to use or is more documentation needed?
			</div>
			<div class="complete">
				<input type='radio' name='theme_review_options[theme_review_customizer]' <?php checked( $options['theme_review_customizer'], 1 ); ?> value='1'>Pass
				<input type='radio' name='theme_review_options[theme_review_customizer]' <?php checked( $options['theme_review_customizer'], 0 ); ?> value='0'>Fail
				<?php submit_button( 'Mark as Completed', 'secondary' );?>
			</div>
		</div>

	</div>
<?php
}

function theme_review_notes_render(){
	$options = get_option( 'theme_review_options', 'themeslug_get_option_defaults' );
	?>
	<div class="postbox">
			<h3>Review notes</h3>
			<div title="Click to toggle" class="handlediv"><br></div>
			<div class="inside">
				You may keep your review notes here and cut and paste them into your ticket.<br>
				You should keep your required items, recommendations and notes separate.<br><br><br>
			<textarea rows='12' name='theme_review_options[theme_review_notes]' class="notes"><?php echo $options['theme_review_notes']; ?></textarea>
			</div>
		</div>
<?php
}

/**
 * Create the options page
 */
function theme_review_do_page() {
?>
<script>
 jQuery(document).ready(function($) {
    $('.postbox').find('.handlediv').click(function(){
      //Expand or collapse this panel
      $(this).next().slideToggle('fast');

      //Hide the other panels
     //'' $(".handlediv").not($(this).next()).slideUp('fast');

    });
  });
 </script>

<div class="wrap">
<div class="welcome-panel">
	<div class="welcome-panel-content">
		<h2><?php _e( 'Theme Review', 'theme-review' );?></h2>
		<p class="about-description"><?php _e('This plugin is designed as a guide to help you with your first theme review.','theme-review');?></p>

		<div class="welcome-panel-column-container">
		<div class="welcome-panel-column" style="width:65%">
		<h3><b><?php _e('Get Started','theme-review');?></b></h3>

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
			<h4><a href="<?php admin_url('themes.php');?>"><?php _e( 'Yes -install and activate the theme.','theme-review');?></a></h4>
			<h4><?php _e( 'Ticket? -What ticket?','theme-review');?></h4>
			A theme trac ticket is a ticket with information about a theme that has been submitted for review.</br>
			First you need to <button class="make-request">Request a theme to review.</button>
			You will then find your tickets here: <a href="https://themes.trac.wordpress.org/query?status=!closed&owner=$USER">https://themes.trac.wordpress.org</a><br>
			In your ticket you will find the theme name, the authors name, and a link to a zip file containing the theme that you should review.<br>
			Below the theme screenshot is a form, so if you haven't already, go and say 'Hi' to your author, you will be working close together.<br>

			<p></p>
			<h3><b>Starting your review -Warming up</b></h3>
			The full guidelines that you will review the theme against can be found <a href="https://make.wordpress.org/themes/handbook/review/required/">here.</a>
			Make sure that the theme is activated and open your theme folder.<br>
			-In each box below you will find a statement or a question. Some boxes will tell you what files to look closer at, and some have links to reference pages.<br>
			<b>Anything in red is a required item that should be noted in your review.</b> You can save your review notes at any time and continue later.
		</div>
	</div>
	<div class="welcome-panel-column welcome-panel-last" style="float:right;">
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
		<form action='options.php' method='post'>
		
		<div id="dashboard-widgets-wrap">
			<div class="metabox-holder" id="dashboard-widgets">

			<div class="progress-wrap"><h3>Progress: 20%</h3> <div class="progressbar"></div></div>

			<!--left container -->
			<div class="postbox-container" id="postbox-container-1">
			<div class="meta-box-sortables ui-sortable" id="normal-sortables">
			<div class="postbox">
			<h3>Part 1:    Start here</h3>
			</div>

		<?php
		settings_fields( 'theme_review_group' );
		//do_settings_sections( 'theme_review_section' );
		
		theme_review_link_render();
		theme_review_license_render();
		theme_review_lang_render();
		?>

			</div><!--end meta-box-sortables ui-sortable-->
			</div><!--end postbox-container-1-->
			<!--mid container -->

			<div class="postbox-container" id="postbox-container-2">
			<div class="meta-box-sortables ui-sortable" id="side-sortables">
			<div class="postbox">
				<h3>Part 2:    </h3>
			</div>
			<div class="postbox">
					<h3>TO DO:</h3>
					<div title="Click to toggle" class="handlediv"><br></div>
					<div class="inside">
              			 -Sane defaults <br>
              			 -Validation and sanitizing <br>
              			 -Reset button<br>
						-Make sure that completed steps are collapsed as default.<br>
						-Completed steps should add to the progress bar (the current progress bar is only a placeholder)<br>
					</div>
					
				</div>
			<?php
			theme_review_ally_render();
			theme_review_customizer_render();
			?>
			</div><!--end meta-box-sortables ui-sortable-->
			</div><!--end postbox-container-2-->
			<div class="postbox-container" id="postbox-container-3" style="width:45%;">
			<div class="meta-box-sortables ui-sortable" id="side-sortables">

				<?php
				theme_review_notes_render();
				?>

			</div><!--end meta-box-sortables ui-sortable-->
			</div><!--end postbox-container-3-->
	</div>
		<?php
		submit_button();
		?>
	</form>
</div><!--end dashboard widget wrapper-->
</div><!--end wrap -->
	<?php
}