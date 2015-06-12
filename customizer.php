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
    $wp_customize->add_section('theme_review_section_links',      array(
            'title' => __( 'Links', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_license',      array(
            'title' => __( 'License', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_lang',      array(
            'title' => __( 'Language', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

   $wp_customize->add_section('theme_review_section_access',      array(
            'title' => __( 'Accessibility', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
   ));

    $wp_customize->add_section('theme_review_section_options',      array(
            'title' => __( 'Options and functionality', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
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
        . '<br><br>' . __('Check if there is a credit link in the customizer or the footer and if the link is appropriate.','theme-review'),
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
        'description' => __('All theme text strings are to be translatable.','theme-review') . '<br><br>' .  __('Text domain: ','theme-review') . '<br>' . $trt_textdomain,

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
        'description' => __('The theme needs to be 100% GPL compatible.','theme-review') . '<br>' . __('The theme should have a copyright notice (Copyright Year Name).','theme-review'),
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