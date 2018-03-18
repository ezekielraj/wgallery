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

function wporg_shortcodes_init()
{
    add_shortcode('widget_gallery', 'wgallery_func');
    add_shortcode('single_post', 'singlepost_func');
	
}
 
add_action('init', 'wporg_shortcodes_init');


