<?php

/*
Plugin Name: Test plugin
Plugin URI: http://index.co/integrations/wordpress
Description: The Test plugin for Wordpress
Version: 1.0
Author: YB
*/

add_action("admin_menu", "test_plugin");

function test_plugin()
{
    add_menu_page('Test plugin', 'Import categories', 'administrator', 'test-plugin', 'plugin_page');
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