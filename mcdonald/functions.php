<?php
// enqueue the child theme stylesheet
Function wp_schools_enqueue_scripts() {
wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css', array(), filemtime( get_stylesheet_directory() . '/style.css' )  );
wp_enqueue_style( 'childstyle' );
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);


// Additional JS plugins
function my_custom_scripts() {
  //Homepage Scripts
  if( is_home() || is_front_page() ) {
 wp_register_script('homepage_scripts', get_stylesheet_directory_uri() . '/js/homepage-scripts.js',array('jquery'), null, true); 
 wp_enqueue_script('homepage_scripts', get_stylesheet_directory_uri() . '/js/homepage-scripts.js',array('jquery'), null, true); 
 wp_register_script('anchor_links', get_stylesheet_directory_uri() . '/js/anchor-links.js',array('jquery'), null, true); 
 wp_enqueue_script('anchor_links', get_stylesheet_directory_uri() . '/js/anchor-links.js',array('jquery'), null, true);  
  }	
  if( is_page(28) ) {
 wp_register_script('anchor_links', get_stylesheet_directory_uri() . '/js/anchor-links.js',array('jquery'), null, true); 
 wp_enqueue_script('anchor_links', get_stylesheet_directory_uri() . '/js/anchor-links.js',array('jquery'), null, true);   
  }	
 wp_register_script('custom_scripts', get_stylesheet_directory_uri() . '/js/custom-scripts.js',array('jquery'), null, true); 
 wp_enqueue_script('custom_scripts', get_stylesheet_directory_uri() . '/js/custom-scripts.js',array('jquery'), null, true);   
}

add_action('wp_enqueue_scripts', 'my_custom_scripts');


// Contact Form 7 Submission Page Redirect
add_action( 'wp_footer', 'mycustom_wp_footer' );

function mycustom_wp_footer() {
?>
<script type="text/javascript">

 document.addEventListener( 'wpcf7mailsent', function( event ) {


   location = '/form-success/';
 

   }, false );

</script>
<?php
}


// Shortcode for adding default sidebar to page content
function sidebar_sc( $atts ) {
   ob_start();
   dynamic_sidebar('SidebarPage');
   $html = ob_get_contents();
   ob_end_clean();
   return '
   <aside class="practice_area_sidebar">'.$html.'</aside>';
   }

   add_shortcode('sidebar', 'sidebar_sc');


// Add excerpts for pages
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}


// limit excerpt length for sidebar recent post
function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);

      if (count($excerpt) >= $limit) {
          array_pop($excerpt);
          $excerpt = implode(" ", $excerpt) . '...';
      } else {
          $excerpt = implode(" ", $excerpt);
      }

      $excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

      return $excerpt;
}


// Shortode to display most recent blog post
function my_recent_post($atts){
$q = new WP_Query(
  array( 'orderby' => 'date', 'posts_per_page' => '1')
);

$list = '<div class="recent_post">';
while($q->have_posts()) : $q->the_post();
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
$list .= '<div class="recent_post_image" style="background:url(' .$url . ');"></div><span class="recent_post_title">' . get_the_title() . '</span><span class="recent_post_date">' . get_the_date() . '</span>' . '<p class="recent_post_excerpt">' . excerpt('19') . ' <a href="' . get_permalink() . '" title="Read the Blog Post">[ read ]</a></p>';
endwhile;
wp_reset_query();
return $list . '</div>';   
}

add_shortcode('recent-post', 'my_recent_post');


// Widget Logic Conditionals (ancestor) 
function is_tree( $pid ) {
global $post;

if ( is_page($pid) )
return true;

$anc = get_post_ancestors( $post->ID );
foreach ( $anc as $ancestor ) {
if( is_page() && $ancestor == $pid ) {
return true;
}
}
return false;
}


// Pagespeed
function qode_styles_child() {
wp_deregister_style('style_dynamic');
wp_register_style('style_dynamic', get_stylesheet_directory_uri() . '/style_dynamic.css');
wp_enqueue_style('style_dynamic');
wp_deregister_style('style_dynamic_responsive');
wp_register_style('style_dynamic_responsive', get_stylesheet_directory_uri() . '/style_dynamic_responsive.css');
wp_enqueue_style('style_dynamic_responsive');
 wp_deregister_style('custom_css');
    wp_register_style('custom_css', get_stylesheet_directory_uri() . '/custom_css.css');
    wp_enqueue_style('custom_css');
}
function qode_scripts_child() {
wp_deregister_script('default_dynamic');
wp_register_script('default_dynamic', get_stylesheet_directory_uri() . '/default_dynamic.js');
wp_enqueue_style('default_dynamic', array(),false,true);
wp_deregister_script('custom_js');
    wp_register_script('custom_js', get_stylesheet_directory_uri() . '/custom_js.js');
    wp_enqueue_style('custom_js', array(),false,true);
}
add_action( 'wp_enqueue_scripts', 'qode_styles_child', 11);
add_action( 'wp_enqueue_scripts', 'qode_scripts_child', 11);

function retrieve_latest_gform_submissions() {
    $site_url = get_site_url();
    $search_criteria = [
        'status' => 'active'
    ];
    $form_ids = 1; //search all forms
    $sorting = [
        'key' => 'date_created',
        'direction' => 'DESC'
    ];
    $paging = [
        'offset' => 0,
        'page_size' => 5
    ];
    
    $submissions = GFAPI::get_entries($form_ids, null, $sorting, $paging);
    $start_date = date('Y-m-d H:i:s', strtotime('-5 day'));
    $end_date = date('Y-m-d H:i:s');
    $entry_in_last_5_days = false;
    
    foreach ($submissions as $submission) {
        if( $submission['date_created'] > $start_date  && $submission['date_created'] <= $end_date ) {
            $entry_in_last_5_days = true;
        } 
    }
    if( !$entry_in_last_5_days ) {
        wp_mail('webdev@postali.com', 'Submission Status', "No submissions in last 5 days on $site_url");
    }
}
add_action('check_form_entries', 'retrieve_latest_gform_submissions');

/**
 * Disable Theme/Plugin File Editors in WP Admin
 * - Hides the submenu items
 * - Blocks direct access to editor screens
 */
function postali_disable_file_editors_menu() {
    // Remove Theme File Editor from Appearance menu
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    // Optional: also remove Plugin File Editor from Plugins menu
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}
add_action( 'admin_menu', 'postali_disable_file_editors_menu', 999 );

// Block direct access to the editors even if someone knows the URL
function postali_block_file_editors_direct_access() {
    wp_die( __( 'File editing through the WordPress admin is disabled.' ), 403 );
}
add_action( 'load-theme-editor.php', 'postali_block_file_editors_direct_access' );
add_action( 'load-plugin-editor.php', 'postali_block_file_editors_direct_access' );

/**
 * Disable the Additional CSS panel in the Customizer.
 * Primary method: remove the custom_css component early in load.
 */
function postali_disable_customizer_additional_css_component( $components ) {
    $key = array_search( 'custom_css', $components, true );
    if ( false !== $key ) {
        unset( $components[ $key ] );
    }
    return $components;
}
add_filter( 'customize_loaded_components', 'postali_disable_customizer_additional_css_component' );

/**
 * Fallback: remove the Additional CSS section if it's present.
 */
function postali_remove_customizer_additional_css_section( $wp_customize ) {
    if ( method_exists( $wp_customize, 'remove_section' ) ) {
        $wp_customize->remove_section( 'custom_css' );
    }
}
add_action( 'customize_register', 'postali_remove_customizer_additional_css_section', 20 );
