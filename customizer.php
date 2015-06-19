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

    $wp_customize->add_section('theme_review_section_custom',      array(
            'title' => __( 'Custom functionality & options', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_content',      array(
            'title' => __( 'Custom content creation', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_hooks',      array(
            'title' => __( 'Hooks', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_prefix',      array(
            'title' => __( 'Prefixing', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_escaping',      array(
            'title' => __( 'Sanitizing and escaping', 'theme-review' ),
            'priority' => 100,
            'panel' => 'theme_review_panel',
    ));

    $wp_customize->add_section('theme_review_section_misc',      array(
            'title' => __( 'Miscellaneous', 'theme-review' ),
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

	$trt_author_uri ='<a href="' . esc_url($trt_author_uri) . '">' . __('Check Author URI','theme-review') . '</a>';
	$trt_theme_uri ='<a href="' . esc_url($trt_theme_uri) . '">' . __('Check Theme URI','theme-review') . '</a>';

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
                   . '<br><br>' . __( 'WordPress must be spelled with a capital W and P. -A theme can be in any language, but only one.','theme-review') . ''
                   . '<br><br><b style="color:blue">' . __( 'RECOMMENDED:','theme-review') . '</b>'
                   . '<br><span class="dashicons dashicons-media-code"></span>' . __('Make sure that there is a language file in the theme folder and that it refers to the correct theme.','theme-review')
                   . '<br><br><span class="dashicons dashicons-visibility"></span> <a href="https://developer.wordpress.org/themes/functionality/internationalization/">' . __('Theme Handbook: Internationalization.','theme-review') . '</a>'
               
                   . "<br><br>" . __('A basic translation string can look like this:','theme-review') . '<br>'
                   . "<code> __( 'text to be internationalized', 'text-domain' );</code><br><br>"
                   .  __('If a translation is echoed, it can also look like this:','theme-review') . '<br>'
                   . "<code>_e( 'WordPress is the best!', 'text-domain' );</code><br><br>"
                   .  __('A text that looks like this would fail, since it is not translatable:','theme-review') . '<br>'
                   . "<code>&lt;h2&gt;Hello World&lt;/h2&gt;</code> "
                   . __('should be:','theme-review') . '<br>'
                   . "<code>&lt;h2&gt;&lt;?php _e('Hello World', 'text-domain'); ?&gt; &lt;/h2&gt;</code><br><br>"
                   . __('Translated attributes should be escaped','theme-review')
                   . __('Example:','theme-review') . '<br>'
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
                    . '<br><br>' . __('The theme must use core-bundled scripts if available, and include all scripts rather than hot-linking. ','theme-review') 
                    . '<br>' . __('Themes must not deregister core scripts.','theme-review')
                    . '<br><br>' . __('If minfied scripts or styles are used, the original file must also be included.','theme-review'), 
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
                    . '<br>' . __('Check for broken images and test header, logo, and background settings.','theme-review')
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
                   . '<br>' . __('(Function parameters and filters should be used instead.)','theme-review')
                   . '<br>' . __('Common example of these are custom pagination, hard coded search forms, options to disable comments, and custom image resizing.','theme-review')
                   . '<br><br>'. __('<code>comments_template();</code> must be included in singular views.','theme-review')
                   . '<br><br><span class="dashicons dashicons-visibility"></span> ' . __('It is often helpful to look up the WordPress functions that are used in the theme. The best resource for this is <a href="https://developer.wordpress.org/reference/">the WordPress.org Developer Reference.</a>','theme-review'),
                  
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

/*Custom Theme Functionality and options*/
    $wp_customize->add_setting( 'theme_review_custom',    array(
        'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_custom_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));  
    /*controls*/
    $wp_customize->add_control('theme_review_custom_desc',  array(
        'type' => 'hidden',
        'description' =>__('-Is there enough documentation for you to easilly set-up the theme?','theme-review')
                    . '<br><br>' . __('Are all options in the customizer? New themes are no longer allowed to create a separate options page.','theme-review')
                    . '<br><br>' . __('<b>Plugin territory</b>','theme-review')
                    . '<br>' . __('When we talk about plugin territory, we mean content or functionality that users wants, indepedent of what theme they are using. Themes are meant to present content.')
                    . '<br>' . __('Examples include: custom post types, shortcodes, analytics, ads, SEO. It also includes making changes to login forms, admin interface, editors etc.')
                    . '<br><br>' . __('If you are not sure what a function does, please ask the theme author. If you are not sure if something is allowed or not, you can ask an admin.')
                    ,
        'section' => 'theme_review_section_custom',
    ));

    $wp_customize->add_control('theme_review_custom',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_custom',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));

/*Custom Tcontent creation*/
    $wp_customize->add_setting( 'theme_review_content',    array(
        'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_content_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));  
    /*controls*/
    $wp_customize->add_control('theme_review_content_desc',  array(
        'type' => 'hidden',
        'description' =>__('If the theme uses meta boxes, make sure that they are used for presentation only, for example background color or sidebar positions.','theme-review')
                    . '<br>' . __('Examples of common meta boxes that are not allowed includes:','theme-review')
                    . '<br>' . __('content attribution, video source, link source, event dates, and quotes.','theme-review')
                    . '<br><br>' . __('Trivial content creation as customizer options is allowed:','theme-review')
                    . '<br>' . __('Site footer text,  Call-to-Action, descriptive content blocks (about us/profile/etc.), <br>
                        Custom presentation of existing user data, with trivial content additions <br>such as a widget/content block with a static page link, 
                        custom icon, custom title/description.','theme-review')
                    . '<br><br>' . __('Larger text options are generally not allowed, if it is designed to hold more than a few lines, it should be a post or a page.','theme-review')
                    ,
        'section' => 'theme_review_section_content',
    ));

    $wp_customize->add_control('theme_review_content',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_content',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));

 /*Hooks*/
    $wp_customize->add_setting( 'theme_review_hooks',    array(
        'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_hooks_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));  
    /*controls*/
    $wp_customize->add_control('theme_review_hooks_desc',  array(
        'type' => 'hidden',
        'description' => __('Removing or modifying non-presentational hooks is not allowed, this includes disabling the admin tool bar.','theme-review')    
                        . '<br><br>' . __('Examples:','theme-review')
                        . '<br><code>remove_action( "wp_head", "wp_generator" )</code> '
                        . "<br><br><code>add_filter( show_admin_bar', '__return_false' );</code> "      
                        . "<br><br><code>remove_filter( 'the_content','wpautop' );</code> "                       
                        . '<br><br>'. __('Themes should use the right hooks for their functions.','theme-review')
                        . '<br>' . __('load_theme_textdomain, add_theme_support, and register_nav_menu(s) should be in a function, added with <br><code>add_action( "after_setup_theme", "function_name" );</code>','theme-review')
                        ,
        'section' => 'theme_review_section_hooks',
    ));

    $wp_customize->add_control('theme_review_hooks',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_hooks',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));

 /*Prefixing*/
    $wp_customize->add_setting( 'theme_review_prefix',    array(
        'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_prefix_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));  
    /*controls*/
    $wp_customize->add_control('theme_review_prefix_desc',  array(
        'type' => 'hidden',
        'description' =>__('The theme should use a unique prefix for everything the Theme defines in the public namespace.','theme-review')
                    . '<br>' . __('It is not uncommon for authors to forget to prefix their functions or Classes. The recommended prefix is the theme-slug.','theme-review')      
                    . '<br><br>'. __('Tip: use a text editor that can search entire directories to create a list of all functions.','theme-review')
                    . '<br><br><span class="dashicons dashicons-visibility"></span> <a href="http://themereview.co/prefix-all-the-things/">Prefix all the things</a>',
        'section' => 'theme_review_section_prefix',
    ));

    $wp_customize->add_control('theme_review_prefix',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_prefix',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));

 /*Sanitizing and escaping*/
    $wp_customize->add_setting( 'theme_review_escaping',    array(
        'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_escaping_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));  
    /*controls*/
    $wp_customize->add_control('theme_review_escaping_desc',  array(
        'type' => 'hidden',
        'description' =>__('Sanitize <b>everything</b>.','theme-review')
                    . '<br>' . __('By now you should be somewhat familiar with the themes custom functions.','theme-review')
                    . '<br>' . __('If the theme uses the customizer, then each setting should have a <code>sanitize_callback</code>. Make sure that the callback function is appropriate and working.','theme-review')
                    . '<br><br><span class="dashicons dashicons-visibility"></span> <a href="https://make.wordpress.org/themes/2015/06/02/a-guide-to-writing-secure-themes-part-3-sanitization/">A Guide to Writing Secure Themes – Part 3: Sanitization</a>' 
                    . '<br><br>' . __('If the theme uses meta boxes, the options needs to be sanitized before they are added or updated.','theme-review')
                    . '<br><br><span class="dashicons dashicons-visibility"></span> <a href="https://make.wordpress.org/themes/2015/06/09/a-guide-to-writing-secure-themes-part-4-securing-post-meta/">A Guide to Writing Secure Themes – Part 4: Securing Post Meta</a>'
                    . '<br><br>'. __('All untrusted data should be escaped before output. This is a very common problem.','theme-review')
                    . '<br>' . __('esc_url() should be used on all URLs, including those in the "src" and "href" attributes of an HTML element.','theme-review')
                    . '<br>' . '<code>&lt;img src="&lt;?php echo esc_url( $great_user_picture_url ); ?&gt;" /&gt;</code><br>'
                    . '<br>' . __(' esc_attr() can be used in other attributes. esc_attr_e() can be used when echoing a translation inside an attribute.','theme-review')
                    . '<br><code>class="&lt;?php echo esc_attr( $stored_class ); ?&gt;"</code><br>'
                    . '<br>' . __('Recommended:','theme-review')
                    . '<br>' . __('esc_html() is used anytime our HTML element encloses a section of data we are outputting. esc_html_e() can be used when echoing a translation.','theme-review')
                    . '<br><code>&lt;h4&gt;&lt;?php echo esc_html( $title ); ?&gt;&lt;/h4&gt;</code>'
                    . '<br><br><span class="dashicons dashicons-visibility"></span> <a href="https://codex.wordpress.org/Data_Validation">Data Validation</a>, <a href="https://codex.wordpress.org/Validating_Sanitizing_and_Escaping_User_Data#Escaping:_Securing_Output">Escaping: Securing Output</a>',
        'section' => 'theme_review_section_escaping',
    ));

    $wp_customize->add_control('theme_review_escaping',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_escaping',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));

 /*Misc*/
    $wp_customize->add_setting( 'theme_review_misc',    array(
        'sanitize_callback' => 'theme_review_sanitize_radio',
    ));
    $wp_customize->add_setting( 'theme_review_misc_desc',    array(
        'sanitize_callback' => 'example_sanitize_text',
    ));  
    /*controls*/
    $wp_customize->add_control('theme_review_misc_desc',  array(
        'type' => 'hidden',
        'description' =>__('Check to make sure there are no unused or empty files, zip files or .git files in the theme folder.','theme-review')
                    . '<br><br>' . __('If there are large sections of code that is commented it out, encourage the author to delete them.','theme-review')      
                    . '<br><br>' . __('Themes must not collect user data without asking for permission.','theme-review')   
                    . '<br><br>' . __('There should be no pay wall restricting any WordPress feature.','theme-review')
                    . '<br><br>' . __('The Screenshot should be of the actual theme as it appears with default options, not a logo or mockup. It should be no bigger than 1200 x 900px.','theme-review'),
        'section' => 'theme_review_section_misc',
    ));

    $wp_customize->add_control('theme_review_misc',  array(
        'type' => 'radio',
        'label' => __('Mark as completed:' ,'theme-review'),
        'section' => 'theme_review_section_misc',
        'choices' => array(
            'pass' => __('Pass','theme-review'),
            'fail' => __('Fail','theme-review'),
        ),
    ));

/*Check for accessibility-ready tag*/
    $trt_theme = wp_get_theme();
    $trt_tags =$trt_theme->get( 'Tags' );
    if (in_array ('accessibility-ready' , $trt_tags) ){

        /* Section */
         $wp_customize->add_section('theme_review_section_access',      array(
                'title' => __( 'Accessibility', 'theme-review' ),
                'priority' => 100,
                'panel' => 'theme_review_panel',
        ));
        /*Setting*/
        $wp_customize->add_setting( 'theme_review_access_desc',    array(
               'sanitize_callback' => 'example_sanitize_text',
        ));
        /*control*/
        $wp_customize->add_control('theme_review_access_desc',  array(
            'type' => 'hidden',
            'description' => __('This theme has an accessibility-ready tag and it needs an additional review by an accessibility expert. 
                                It is important that you do not close the ticket when you are finished with the basic review.','theme-review'),
            'section' => 'theme_review_section_access',
        ));
    }

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