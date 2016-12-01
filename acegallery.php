<?php 
    /*
    Plugin Name: Ace Gallery
    Plugin URI: http://www.ace.net
    Description: Gallery PLugin For a friend
    Author: Abhinav Kumar
    Version: 1.0
    Author URI: http://www.ace.net
    */
	
	function ace_admin()
	{
		include('ace_admin.php');
	}
	
	function gallery_upload()
	{
		include('upload_gallery.php');
	}
	
	function sgallery_show()
	{
		include('gallery.php');
	}
	
	function mgallery_show()
	{
		include('minigallery.php');
	}
	
	function tp_post()
	{
		include('tp_post.php');
	}
	
	function ace_admin_actions()
	{
		add_menu_page("Ace Gallery","Ace Gallery",1,"Ace_Gallery","ace_admin");
		add_submenu_page("Ace_Gallery","Add Gallery","Add Gallery",1,"gallery","gallery_upload");
		add_submenu_page("Ace_Gallery","Show all Gallery","Show all Gallery",1,"sgallery","sgallery_show");
		add_submenu_page("Ace_Gallery","Update Mini Gallery","Update Mini Gallery",1,"mgallery","mgallery_show");
		add_submenu_page("Ace_Gallery","tp","tp",1,"tp","tp_post");
	}
	
	add_action('admin_menu','ace_admin_actions');
?>