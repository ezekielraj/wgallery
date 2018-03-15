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
	foreach( $category_query as $cq ){
?>
//		$cont .= $cq->post_title;	
//		$cont .= $cq->post_content;	
<?php
	}

     return $cont;

}

function wporg_shortcodes_init()
{
    add_shortcode('widget_gallery', 'wgallery_func');
}
 
add_action('init', 'wporg_shortcodes_init');
