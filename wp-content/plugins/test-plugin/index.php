<?php

/*
Plugin Name: Test plugin
Plugin URI: http://index.co/integrations/wordpress
Description: The Test plugin for Wordpress
Version: 1.0
Author: YB
*/

//Add plugin to the admin menu
add_action("admin_menu", "test_plugin");

function test_plugin()
{
    //Add the plugin page
    add_menu_page('Test plugin', 'Import categories', 'administrator', 'test-plugin', 'plugin_page');
    //Add the plugin sub page
    add_submenu_page('test-plugin', 'Test plugin', 'Create posts', "administrator", 'sub-plugin', 'plugin_sub_page');

}

function plugin_page()
{
    echo "<h1>Test plugin</h1>";
    include_once("import_categories_form.php");
}

function plugin_sub_page()
{
    echo "<h1>Test plugin</h1>";
    include_once("create_posts_form.php");
}

/*
 * shortcode [last_brand]
 */
add_shortcode('last_brand', 'last_brand');
function last_brand($atts) {
    shortcode_atts([
        "brand" => "Alfa Romeo", // default category
    ], $atts);
    //Get category id
    $cat_id = get_cat_ID($atts["brand"]);
    //Get category children
    $children = get_term_children($cat_id, "category");
    $html = "";
    //Browse category chilren to retreive last posts
    foreach($children as $child) {
        $args = array("numberposts" => 2, "category" => $child, "orderby" => "date", "order" => "DESC");
        $posts = get_posts($args);
        foreach($posts as $post) {
            $html .= "<a href='". get_permalink($post->ID) ."'><h4>$post->post_title</h4></a><hr/>";
        }
    }
    return $html;
}