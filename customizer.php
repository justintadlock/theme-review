<?php
function theme_review_customize_register( $wp_customize ) {
	/*Add sections and panels to the WordPress customizer*/
	
	$wp_customize->add_panel( 'theme_review_panel', array(
		'priority'       => 300,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Theme Review', 'theme-review' ),
		'description'    => __( 'Start your review here.', 'theme-review' ),
	) );


    /* Sections */
     $wp_customize->add_section('theme_review_section_license',      array(
            'title' => __( 'Naming and Licensing', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_links',      array(
            'title' => __( 'Links', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));
 
    $wp_customize->add_section('theme_review_section_lang',      array(
            'title' => __( 'Language', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_scripts',      array(
            'title' => __( 'Stylesheets and Scripts', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_errors',      array(
            'title' => __( 'Errors, warnings and notices', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_core',      array(
            'title' => __( 'Core functionality', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

/*License*/
    $wp_customize->add_setting( 'theme_review_license',    array(
        'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_license_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));

    /*controls*/
    $wp_customize->add_control('theme_review_license_desc',  array(
        'type' => 'hidden',
        'description' => __('The theme name must not contain trademarks, "WordPress" or "Theme".','theme-review')
                   . '<br><br>' . __('The theme needs to be 100% GPL compatible.','theme-review') 
                   . '<br><br>' . __('The theme should: <br> -Use the license and license uri in the header of style.css','theme-review') 
                   . '<br>' .__('-Declare licenses of any resources included such as fonts or images, including images used in the screenshot','theme-review') 
                   . '<br>' . __('-Have a copyright notice:<br> (Copyright Year Name).','theme-review')
                   . '<br><br><span class="dashicons dashicons-media-code"></span>' . __('Open the readme file and make sure that license and copyright has been declared for all included third party resources.','theme-review')
                   . '<br><br><span class="dashicons dashicons-visibility"></span> <a href="http://www.gnu.org/licenses/license-list.html#GPLCompatibleLicenses">' . __('List of GPL compatible licenses','theme-review') . '</a>', 
        'section' => 'theme_review_section_license',
    ));

    $wp_customize->add_control('theme_review_license',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_license',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));
    
/*Links*/
	$trt_theme = wp_get_theme();
	$trt_author_uri =$trt_theme->get( 'AuthorURI' );
	$trt_theme_uri =$trt_theme->get( 'ThemeURI' );

	$trt_author_uri =__('<a href="' . esc_url($trt_author_uri) . '">Check Author URI</a>','theme-review');
	$trt_theme_uri =__('<a href="' . esc_url($trt_theme_uri) . '">Check Theme URI</a>','theme-review');

    /*settings*/
    $wp_customize->add_setting( 'theme_review_links',    array(
      	'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_links_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));

    /*controls*/
 	$wp_customize->add_control('theme_review_links_desc',  array(
        'type' => 'hidden',
        'description' => __('Links should be related to the theme and helpful to the user.','theme-review') . '<br>' . 
        __('WordPress.org links are reserved for official themes.','theme-review') . '<br><br>' . $trt_author_uri . '<br>' . $trt_theme_uri
        . '<br><br>' . __('Check if there is a credit link in the customizer or the footer and if the link is appropriate.','theme-review') 
        . '<br>' . __('There should only be one footer credit link and it needs to be the same as Author URI or Theme URI.','theme-review')
        . '<br><br>' . __('There should be no links to the authors social network pages.','theme-review'),
        'section' => 'theme_review_section_links',
    ));

	$wp_customize->add_control('theme_review_links',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_links',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));

/*Language*/
    /*settings*/
	$trt_textdomain =$trt_theme->get( 'TextDomain' );
	if( !$trt_textdomain){
			$trt_textdomain=__('<b style="color:red">REQUIRED</b>: Text domain is missing or blank in style.css','theme-review');
	}

    $wp_customize->add_setting( 'theme_review_lang',    array(
       'sanitize_callback' => 'theme_review_sanitize_radio',
    ));

    $wp_customize->add_setting( 'theme_review_lang_desc',    array(
        'sanitize_callback' => 'theme_review_sanitize_text',
    ));
    /*controls*/
 	$wp_customize->add_control('theme_review_lang_desc',  array(
        'type' => 'hidden',
        'description' => __('All theme text strings are to be translatable.','theme-review') . '<br><br>' .  __('Text domain: ','theme-review') . '<br>' . $trt_textdomain
                 . '<br><br><b style="color:blue">' . __( 'RECOMMENDED:','theme-review') . '</b>'
                 . '<br><span class="dashicons dashicons-media-code"></span>' . __('Make sure that there is a language file in the theme folder and that it refers to the correct theme.','theme-review')
                . '<br><br><span class="dashicons dashicons-visibility"></span> <a href="https://developer.wordpress.org/themes/functionality/internationalization/">' . __('Theme Handbook: Internationalization.','theme-review') . '</a>'
                
                    . "<br><br>A basic translation string can look like this: <br>
                            <code> __( 'text to be internationalized', 'text-domain' );</code><br><br>
                            If a translation is echoed, it can also look like this:<br> 
                            <code>_e( 'WordPress is the best!', 'text-domain' );</code><br><br>
                            A text that looks like this would fail, since it is not translatable:<br>
                            <code>&lt;h2&gt;Hello World&lt;/h2&gt;</code> should be: <br>
                            <code>&lt;h2&gt;&lt;?php _e('Hello World', 'text-domain'); ?&gt; &lt;/h2&gt;</code><br><br>
                            Translated attributes should be escaped. Example:<br>"
                    
                     . '<code>value="&lt;?php esc_attr_e("Search","text-domain" ); ?&gt;"</code>',
                    
        'section' => 'theme_review_section_lang',
    ));
 
	$wp_customize->add_control('theme_review_lang',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_lang',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));


/*Scripts*/
    $wp_customize->add_setting( 'theme_review_scripts',    array(
        'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_scripts_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));  
    /*controls*/
    $wp_customize->add_control('theme_review_scripts_desc',  array(
        'type' => 'hidden',
        'description' =>__('<b>Enqueuing scripts correctly is vital, and this section has additional information on the plugin page.</b>','theme-review')
                    . '<br><br>' . __('Script and stylesheets must be enqueued, with the exception of browser workaround scripts.','theme-review')
                    . '<br>' . __('The theme must use core-bundled scripts if available, and include all scripts rather than hot-linking. ','theme-review') 
                    . '<br>' . __('If minfied scripts or styles are used, the original file must also be included.','theme-review') 
                    
                   . '<br><br>' . __('','theme-review') , 
        'section' => 'theme_review_section_scripts',
    ));

    $wp_customize->add_control('theme_review_scripts',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_scripts',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));

 /*Errors*/
    $wp_customize->add_setting( 'theme_review_errors',    array(
        'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_errors_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));  
    /*controls*/
    $wp_customize->add_control('theme_review_errors_desc',  array(
        'type' => 'hidden',
        'description' =>__('Check for any php or javascript errors, warnings or notices on different pages of the theme.','theme-review')
                    . '<br>' . __('Make sure that you also test any custom functionality and custom widgets.','theme-review')
                    . '<br>' . __('Check for any broken images.','theme-review')
                    . '<br><br>' . __('Themes are required to have a valid DOCTYPE declaration and include language_attributes.','theme-review') 
                    . '<br> <code> &lt;!DOCTYPE html&gt;&lt;html &lt;?php language_attributes(); ?&gt;></code>'
                   
                    . '<br><br>' . __('Other HTML and css errors are not reasons for not approving a theme, but the theme should not be broken.','theme-review') ,
        'section' => 'theme_review_section_errors',
    ));

    $wp_customize->add_control('theme_review_errors',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_errors',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));


    
 /*Core Functionality*/
    $wp_customize->add_setting( 'theme_review_core',    array(
        'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_core_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));  
    /*controls*/
    $wp_customize->add_control('theme_review_core_desc',  array(
        'type' => 'hidden',
        'description' =>__('The theme should use WordPress functionality and features first, if available. This means that custom functions should not mimic or attempt to replace core functions.','theme-review')
                    . '<br>' . __('Common example of these are custom pagination, hard coded search forms, and custom image resizing.','theme-review')
                    .'<br><br>' . __(' No disabling of the admin tool bar. <br> No removing or modifying non-presentational hooks, for example <code>remove_action( "wp_head", "wp_generator" )</code>.','theme-review')  
                    . '<br>' . __('No pay wall restricting any WordPress feature.','theme-review') 
                    . '<br><br>'. __('<code>comments_template();</code> must be included in singular views.','theme-review'),
        'section' => 'theme_review_section_core',
    ));

    $wp_customize->add_control('theme_review_core',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_core',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));



}
add_action( 'customize_register', 'theme_review_customize_register' );



function theme_review_sanitize_radio( $input ) {
    $valid = array(
		'pass'		=>  __('Pass','theme-review'),
		'fail'	=>	__('Fail','theme-review'),
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}


function theme_review_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );  
}

?>