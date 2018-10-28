<?php
/**
 * This code is the head of html register user.
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
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(),$css_path_home_page;
	?>" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_url(),$css_path_search;
	?>" />
	
	 <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> 
         <?php 
        /*
         * here call js files from js foler.
         */
        ?>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.js" ></script>
</head>
