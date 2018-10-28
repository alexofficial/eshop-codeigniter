<?php
/**
 * This code is the head of html view of logged admin header 
 * @package views/html_header_1
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 */
echo doctype("html5"); 
?>
<html lang="en">
<head>
	
	<title> <?php 
        /*
         * $page_title is the title of the page and comes from controller data
        */
        echo $page_title ?> 
        </title>
        <?php 
        /*
         * here call css files from style foler for css view.
         */
        ?>
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(),
                $css_path_home_page;
	?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(),
                $css_path_user_logged;
	?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(),
                $css_path_admin_logged;
	?>" />
	
	 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <?php 
        /*
         * here calls js google jsapi for graphs. 
         */
        ?>
	 <script type="text/javascript" src="https://www.google.com/jsapi">
         </script> 
        <?php 
        /*
         * here call js files from js foler.
         */
        ?>
	 <script type="text/javascript" src="<?php echo base_url();?>js/jquery.js" >
         </script>
	 <script type="text/javascript" src="<?php echo base_url();?>js/statis_print.js" >
         </script>
	
	
</head>

