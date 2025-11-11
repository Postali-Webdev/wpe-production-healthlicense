<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<?php 
global $qode_options_passage;
global $wp_query;
$disable_qode_seo = "";
$seo_title = "";
if (isset($qode_options_passage['disable_qode_seo'])) $disable_qode_seo = $qode_options_passage['disable_qode_seo'];
if ($disable_qode_seo != "yes") {
	$seo_title = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_title", true);
	$seo_description = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_description", true);
	$seo_keywords = get_post_meta($wp_query->get_queried_object_id(), "qode_seo_keywords", true);
}
?>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<?php
	$responsiveness = "yes";
	if (isset($qode_options_passage['responsiveness'])) $responsiveness = $qode_options_passage['responsiveness'];
	if($responsiveness != "no"):
	?>
	<meta name=viewport content="width=device-width,initial-scale=1">
	<?php 
	endif;
	?>
	<title><?php if($seo_title) { ?><?php bloginfo('name'); ?> | <?php echo $seo_title; ?><?php } else {?><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?><?php } ?></title>
	<?php if ($disable_qode_seo != "yes") { ?>
	<?php if($seo_description) { ?>
	<meta name="description" content="<?php echo $seo_description; ?>">
	<?php } else if($qode_options_passage['meta_description']){ ?>
	<meta name="description" content="<?php echo $qode_options_passage['meta_description'] ?>">
	<?php } ?>
	<?php if($seo_keywords) { ?>
	<meta name="keywords" content="<?php echo $seo_keywords; ?>">
	<?php } else if($qode_options_passage['meta_keywords']){ ?>
	<meta name="keywords" content="<?php echo $qode_options_passage['meta_keywords'] ?>">
	<?php } ?>
	<?php } ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $qode_options_passage['favicon_image']; ?>">
	<?php wp_head(); ?>


	<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5DLZC7P');</script>
<!-- End Google Tag Manager -->

<?php
$global_schema = get_field('global_schema', 'options');
if ( !empty($global_schema) ) :
    echo '<script type="application/ld+json">' . strip_tags($global_schema) . '</script>';
endif;

$single_schema = get_field('single_schema');
if ( !empty($single_schema) ) :
    echo '<script type="application/ld+json">' . strip_tags($single_schema) . '</script>';
endif;
?>

<meta name="google-site-verification" content="LquFka_cphYUO69yUXFFdP5K_pVJ4qE__wQJfiOXIUU" />
	
</head>

<body <?php body_class(); ?>>
	
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DLZC7P"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<div class="preload">
	<?php if(isset($qode_options_passage['pattern_background_image']) && $qode_options_passage['pattern_background_image'] != ""){  ?>
		<img alt="" src="<?php echo $qode_options_passage['pattern_background_image']; ?>" />
	<?php } ?>
	<?php if(isset($qode_options_passage['background_image']) && $qode_options_passage['background_image'] != ""){  ?>
		<img alt="" src="<?php echo $qode_options_passage['background_image']; ?>" />
	<?php } ?>
	<img alt="" src="<?php echo get_template_directory_uri(); ?>/css/img/pattern_background.png" />
</div>
	
<?php
	$header_in_grid = false;
	if ($qode_options_passage['header_in_grid'] == "yes") $header_in_grid = true;

	$centered_logo = false;
	if (isset($qode_options_passage['center_logo_image'])){ if($qode_options_passage['center_logo_image'] == "yes") { $centered_logo = true; }};
?>
<div class="wrapper">
<header class="animate <?php if(isset($qode_options_passage['header_fixed']) && $qode_options_passage['header_fixed'] == "no"){ echo "no_fixed"; } ?><?php if($centered_logo){ echo " centered_logo"; } ?>">
	
	<?php if($header_in_grid){ ?>
		<div class="container">
			<div class="container_inner">
	<?php } ?>
				<div class="header_inner clearfix">
								
				<!-- no lawpay link for now <div class="lawpay"><a href="#" title="Law Pay">LAW PAY</a></div> -->
		
					<div class="logo"><a href="<?php echo home_url(); ?>/"><img src="<?php echo $qode_options_passage['logo_image']; ?>" alt="Logo"/></a></div>
					<div class="header_inner_right">
									<div class="searchbox-header"><div class="searchbox-position"><div class="search-container" tabindex="1"><a class="button"><i class="wp-svg-custom-McDonald_search McDonald_search"></i></a><?php get_search_form(); ?></div></div></div>

						<?php
						$menu_type = $qode_options_passage['top_menu'];
						
						?>
						<nav class="main_menu <?php  if($menu_type == "drop_down") { echo "drop_down"; } elseif($menu_type == "drop_down2") { echo "drop_down2"; } else { echo "drop_down"; } ?>">
						<?php
							
							if($menu_type == "drop_down") :
								wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type1_walker_nav_menu()
							 ));
							
							elseif($menu_type == "drop_down2"):
								wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type2_walker_nav_menu()
								 ));
							
							
							else :
								wp_nav_menu( array( 'theme_location' => 'top-navigation' , 
																		'container'  => '', 
																		'container_class' => '', 
																		'menu_class' => '', 
																		'menu_id' => '',
																		'fallback_cb' => 'top_navigation_fallback',
																		'link_before' => '<span>',
																		'link_after' => '</span>',
																		'walker' => new qode_type1_walker_nav_menu()
								 ));
							endif;
						?>
						<span id="magic"></span>
						</nav>
						
						<!-- comment out baked-in mobile nav 
						<div class='selectnav_button'><span>&nbsp;</span></div>
						-->
						
						</div>
						
						<div id="menu-icon">
    <a href="#"><hr><hr><hr></a>
  </div>
</header>
<div id="mobile-nav" class="mobile">
   <ul><li><a href="/about/">About</a>
<ul>
	<li ><a href="/about-our-attorneys/jeff-mcdonald/" >Attorney Jeff McDonald</a></li>
	<li ><a href="/about-our-attorneys/jon-porter/" >Attorney Jon Porter</a></li>
	<li ><a href="/about-our-attorneys/taralynn-mackay/" >Attorney Taralynn R. Mackay</a></li>
	<li ><a href="/about-our-attorneys/tim-weitz/" >Attorney Tim Weitz</a></li>
	<li ><a href="/about-our-attorneys/" >Our Attorneys</a></li>
</ul>
</li>
<li ><a href="/medical-license-defense/"  >Medical License Defense</a>
<ul>
	<li><a href="/medical-license-defense/acupuncturist/">Acupuncturist License</a></li>
	<li><a href="/medical-license-defense/lpc/">Licensed Professional Counselor License</a></li>
	<li><a href="/medical-license-defense/marriage-family-therapist/">Marriage and Family Therapist License</a></li>
	<li><a href="/medical-license-defense/physician-assistant/">Physician Assistant License</a></li>
	<li><a href="/medical-license-defense/social-worker/">Social Worker License</a></li>
	<li><a href="/medical-license-defense/psychologist/">Psychologist License</a></li>
	<li><a href="/medical-license-defense/dentist/">Dental License</a></li>
	<li><a href="/medical-license-defense/nursing/">Nursing License</a></li>
	<li><a href="/medical-license-defense/pharmacist/">Pharmacist License</a></li>
	<li><a href="/medical-license-defense/physician/">Physician License</a></li>
	<li><a href="/medical-license-defense/veterinarian/">Veterinarian License</a></li>
</ul>
</li>
<li><a href="/government-affairs/">Government Affairs</a>
<ul>
	<li><a href="/government-affairs/health-care-reform/" >Health Care Law Reform</a></li>
</ul>
</li>
<li><a href="/other-services/">Other Services</a></li>
<li><a href="/faq/">Frequently Asked Questions</a></li>
<li><a href="/blog/">Legal Blog</a></li>
<li><a href="/contact-us/">Contact</a></li>
</ul>
</div>
						
						
						<?php	
						$display_header_widget = $qode_options_passage['header_widget_area'];
						if($display_header_widget == "yes"){ ?> 
							<div class="header_right_widget">
								<?php dynamic_sidebar('header_right'); ?>
							</div>
						<?php } ?>
					</div>

					<nav class="selectnav"></nav>
				</div>
	<?php if($header_in_grid){ ?>
			</div>

	<?php } ?>
	
</header>
	<div class="content">
		<?php 
global $wp_query;
$id = $wp_query->get_queried_object_id();
$animation = get_post_meta($id, "qode_show-animation", true);

?>
			<?php if($qode_options_passage['page_transitions'] == "1" || $qode_options_passage['page_transitions'] == "2" || $qode_options_passage['page_transitions'] == "3" || $qode_options_passage['page_transitions'] == "4" || ($animation == "updown") || ($animation == "fade") || ($animation == "updown_fade") || ($animation == "leftright")){ ?>
				<div class="meta">				
					<?php if($seo_title){ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php echo $seo_title; ?></div>
					<?php } else{ ?>
						<div class="seo_title"><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></div>
					<?php } ?>
					<?php if($seo_description){ ?>
						<div class="seo_description"><?php echo $seo_description; ?></div>
					<?php } else if($qode_options_passage['meta_description']){?>
						<div class="seo_description"><?php echo $qode_options_passage['meta_description']; ?></div>
					<?php } ?>
					<?php if($seo_keywords){ ?>
						<div class="seo_keywords"><?php echo $seo_keywords; ?></div>
					<?php }else if($qode_options_passage['meta_keywords']){?>
						<div class="seo_keywords"><?php echo $qode_options_passage['meta_keywords']; ?></div>
					<?php }?>
					<span id="qode_page_id"><?php echo $wp_query->get_queried_object_id(); ?></span>
					<div class="body_classes"><?php echo implode( ',', get_body_class()); ?></div>
				</div>
			<?php } ?>
			<div class="content_inner <?php echo $animation;?> ">
				
			