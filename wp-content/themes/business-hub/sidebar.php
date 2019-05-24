<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package cactus
 */
?>
<div class="col-md-3 cactus-sidebar">

	<div class="cactus-sidebar-content">     
    	<?php
		if(is_active_sidebar('portfolio_sidebar') && is_singular('ct_portfolio') || is_active_sidebar('portfolio_sidebar')&&is_post_type_archive( 'ct_portfolio' )){
			dynamic_sidebar( 'portfolio_sidebar' );
		}elseif(is_active_sidebar('job_sidebar') && is_singular('ct_job') || is_active_sidebar('job_sidebar')&&is_post_type_archive( 'ct_job' )){
			dynamic_sidebar( 'job_sidebar' );
		}elseif(is_active_sidebar('product_sidebar') && is_singular('download') || is_active_sidebar('product_sidebar')&&is_post_type_archive( 'download' )){
			dynamic_sidebar( 'product_sidebar' );
		}else if( (is_active_sidebar('blog_sidebar')) && !is_page() ){
			dynamic_sidebar( 'blog_sidebar' );
		}else if(function_exists('is_bbpress') && is_bbpress()){
			dynamic_sidebar( 'bbpress_sidebar' );
		}else if(class_exists('Woocommerce') && is_woocommerce()){
			dynamic_sidebar( 'woocommerce_sidebar' );
		}else{
			dynamic_sidebar( 'main-sidebar' );
		}
		?>                   
    </div>
    
</div>
