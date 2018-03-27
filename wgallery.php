<?php
/**
 * Plugin Name: Widget Gallery
 * Plugin URI: 
 * Description: This plugin gets the image from the pages under some gallery and flash with text
 * Version: 1.0.0
 * Author: Ezekiel Angel Raj R
 * Author URI: 
 * License: GPL2
 */

function wgallery_func( $atts )
{

	$atts = shortcode_atts(
		array(
			'categoryid' => '0',
		), $atts, 'widget_gallery' );


$category_query_args = array(
    'category' => $atts['categoryid']
);

     $category_query = get_posts( $category_query_args );
$cont = "";
$cont .= "<script type='text/javascript' src='".get_template_directory_uri()."/js/widget_banner.js'></script>";
$cont .= "<link rel=\"stylesheet\" href=\"".get_template_directory_uri()."/css/widget_banner.css\" type=\"text/css\" />";
	$cont .= "<div id=\"widget_banner\">";
	foreach( $category_query as $cq ){
//		$cont .= $cq->post_title;	
//		$cont .= $cq->post_content;	

	$cont .= "<div>"; 
	$cont .= "<p>".$cq->post_title."</p>"; 
	$cont .= $cq->post_content; 
	$cont .= "</div>"; 

	}

$cont .= "</div>";
     return $cont;

}

function singlepost_func( $atts ){

	$atts = shortcode_atts(
		array(
			'postid' => '0',
		), $atts, 'single_post' );

		$category_query = get_post( $atts['postid'] );		
		
		$cont = "";
		$cont .= "<script type='text/javascript' src='".get_template_directory_uri()."/js/single-post.js'></script>";
		$cont .= "<link rel=\"stylesheet\" href=\"".get_template_directory_uri()."/css/single-post.css\" type=\"text/css\" />";
		
		$cont .= "<div id='single-post'>";
		$cont .= $category_query->post_content;
		$cont .= "</div>";
		$cont .= "<div id='sp_readmore'><a href='".$category_query->guid."'>Read more</a></div>";
		return $cont;
	
}

function testimonial_func( $atts ){
	
	$atts = shortcode_atts(
		array(
			'categoryid' => '0',
		), $atts, 'testimonial_post' );

		// $catquery = new WP_Query( 'cat='.$atts['categoryid'] );
		// $output="";
		// while($catquery->have_posts()) : $output .= $catquery->the_post();
		
		// 	get_template_part( 'content', 'excerpt' );
		
		// endwhile;
$cont="";
$cont .= "<script type='text/javascript' src='".get_template_directory_uri()."/js/testimonial.js'></script>";
$cont .= "<link rel=\"stylesheet\" href=\"".get_template_directory_uri()."/css/testimonial.css\" type=\"text/css\" />";
		$category_query_args = array(
			'category' => $atts['categoryid']
		);

		$cont .= "<div id='testimonial_post'>";
		
			 $category_query = get_posts( $category_query_args );
			 foreach( $category_query as $cq ){
				//		$cont .= $cq->post_title;	
				//		$cont .= $cq->post_content;	
					$cf = get_post_custom( $cq->ID );
					$cont .= "<div><div>"; 
					
					//$cont .= "<p>".$cq->post_title."</p>"; 
					$cont .=  "<p>".$cq->post_content."</p>"; 
					$cont .= "</div>"; 
					
					$cont .= "<p>".$cf['Author Name'][0]."</p>"; 
					$cont .= "<p>".$cf['Designation'][0]."</p>"; 
					
					$cont .= "</div>"; 
				
					}
			$cont .= "</div>";
		return $cont;
		 
}

function mediacontent_func( $atts )
{


	$atts = shortcode_atts(
		array(
			'categoryid' => '0',
		), $atts, 'media_cont' );

		$cont="";
		$cont .= "<script type='text/javascript' src='".get_template_directory_uri()."/js/media-cont.js'></script>";
		$cont .= "<link rel=\"stylesheet\" href=\"".get_template_directory_uri()."/css/media-cont.css\" type=\"text/css\" />";
				$category_query_args = array(
					'category' => $atts['categoryid']
				);


				$cont .= "<div id='media-cont'>";
				
					 $category_query = get_posts( $category_query_args );
					 foreach( $category_query as $cq ){
						//		$cont .= $cq->post_title;	
						//		$cont .= $cq->post_content;	
						$cont .= "<div>";
							$cf = get_post_custom( $cq->ID );
							
							//$cont .= "<p>".$cq->post_title."</p>"; 
							$cont .=  "<p>".$cq->post_content."</p>"; 
							$cont .=  "<p>".$cf['Text Content'][0]."</p>";
							$cont .=  "<p>".$cf['Link'][0]."</p>";
							
						$cont .= "</div>";
						
							
						
					}
					$cont .= "</div>";
		





	return $cont;
}

function wporg_shortcodes_init()
{
    add_shortcode('widget_gallery', 'wgallery_func');
    add_shortcode('single_post', 'singlepost_func');
	add_shortcode('testimonial_post', 'testimonial_func');
	add_shortcode('media_cont','mediacontent_func');	
}
 
add_action('init', 'wporg_shortcodes_init');


