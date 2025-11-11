<?php 
global $qode_options_passage; 

$title_in_grid = false;
if(isset($qode_options_passage['title_in_grid'])){
if ($qode_options_passage['title_in_grid'] == "yes") $title_in_grid = true;
}

?>	

<?php get_header(); ?>
			<div class="title animate" >
				<?php if($title_in_grid){ ?>
				<div class="container">
					<div class="container_inner clearfix">
				<?php } ?>
				<h1><?php if($qode_options_passage['404_title'] != ""): echo $qode_options_passage['404_title']; else: ?> <?php _e('404', 'qode'); ?> <?php endif;?></h1>	
				<?php if($title_in_grid){ ?>
					</div>
				</div>
				<?php } ?>
			</div>
			
			
			<?php
if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb('
<div class="breadcrumbHolder"><div class="container_inner"><p id="breadcrumbs">','</p></div></div>
');
}
?>
			
			
			<div class="container top_move">
				<div class="container_inner">
					<div class="container_inner2 clearfix">
						<div class="page_not_found">
							<h2><?php if($qode_options_passage['404_text'] != ""): echo $qode_options_passage['404_text']; else: ?> <?php _e('Page not found', 'qode'); ?> <?php endif;?></h2>
							
							<p>Our apologies, but the page you requested could not be found.<p>

<p><strong>This might be because:</strong>

   <ul>
   <li>You typed the web address wrong</li>
   <li>The page you were looking for may have been moved or deleted</li>
   </ul>
   
   </p>

<p>Maybe these links are what you are looking for?</p>

<ul>
<li><a href="/about-our-attorneys/">Our Attorneys</a>
<ul>
	<li><a href="/about-our-attorneys/jeff-mcdonald/">Attorney Jeff McDonald</a></li>
	<li><a href="/about-our-attorneys/jon-porter/">Attorney Jon Porter</a></li>
	<li><a href="/about-our-attorneys/taralynn-mackay/">Attorney Taralynn R. Mackay</a></li>
	<li><a href="/about-our-attorneys/tim-weitz/">Attorney Tim Weitz</a></li>
</ul>
</li>
					
															
<li><a href="/health-license-defense/">Health &amp; Professional License Defense Attorneys</a>
<ul>
	<li><a href="/health-license-defense/acupuncturist/">Acupuncturist License Defense Attorneys</a></li>
	<li><a href="/health-license-defense/lpc/">Licensed Professional Counselor License Defense Attorneys</a></li>
	<li><a href="/health-license-defense/marriage-family-therapist/">Marriage and Family Therapist License Defense Attorneys</a></li>
	<li><a href="/health-license-defense/physician-assistant/">Physician Assistant Lifense Defense Attorneys</a></li>
	<li><a href="/health-license-defense/psychologist/">Psychologist License Defense Attorneys</a></li>
	<li><a href="/health-license-defense/social-worker/">Social Worker License Defense Attorneys</a></li>
	<li><a href="/health-license-defense/dentist/">Texas Dental License Defense Attorneys</a></li>
	<li><a href="/health-license-defense/nursing/">Texas Nursing License Defense Attorneys</a></li>
	<li><a href="/health-license-defense/pharmacist/">Texas Pharmacist License Defense Attorneys</a></li>
	<li><a href="/health-license-defense/physician/">Texas Physician License Defense Attorneys</a></li>
	<li><a href="/health-license-defense/veterinarian/">Veterinarian License Defense Attorneys</a></li>
</ul>
</li>				
<li><a href="/government-affairs/">Government Affairs and Lobbying</a></li>
<ul>
<li><a href="/government-affairs/health-care-reform/">Health Care Law Reform</a></li>
</ul>
<li><a href="/other-services/">Other Services</a></li>
</ul>
						
							<p><a href="<?php echo home_url(); ?>/"><?php if($qode_options_passage['404_backlabel'] != ""): echo $qode_options_passage['404_backlabel']; else: ?> <?php _e('Back to homepage', 'qode'); ?> <?php endif;?></a></p>
						</div>
					</div>
				</div>
			</div>
			
<?php get_footer(); ?>	