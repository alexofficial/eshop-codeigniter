<?php
/**
 * This code is the navigator of logged admin view.
 * @package views/body_navigator_2
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 */
?>
<body>	
<div>
<!--Navigator -->
<nav id="navigation">
    <div class="container">
        <ul class="navlinks">
          <h3>
            <img src=" <?php echo base_url() . $path_home_image ?>"/>
            <li><span id="title">EASY SHOP</span></li>
            <li>      
            <ul id="sddm">
                <li><a href="<?php echo base_url() ?>Admin_page_controller/index_admin_page" 
                onmouseover="mopen('menu_open')" 
                onmouseout="mclosetime()">Αρχική</a>
                    <div id="menu_open" 
                    onmouseover="mcancelclosetime()" 
                    onmouseout="mclosetime()">
                    <a href="<?php echo base_url() ?>Admin_page_controller/request_services_view">services request</a>
                    </div>
                </li>
                <li><a href="#" 
                onmouseover="mopen('menu_open1')" 
                onmouseout="mclosetime()">Στατιστικά</a>
                <div id="menu_open1" 
                    onmouseover="mcancelclosetime()" 
                    onmouseout="mclosetime()">
                    <a href="<?php echo base_url() ?>Admin_page_controller/statistics_registers_per_day_view">Χρήστες register ανά μέρα</a>
                    <a href="<?php echo base_url() ?>Admin_page_controller/statistics_logins_per_day_view">Χρήστες logins ανά μέρα</a>
                    <a href="<?php echo base_url() ?>Admin_page_controller/statistics_finished_orders_per_day_view">Finished orders ανά μέρα</a>
                    <a href="<?php echo base_url() ?>Admin_page_controller/statistics_cancelled_orders_per_day_view">Cancelled orders ανά μέρα</a>
                    <a href="<?php echo base_url() ?>Admin_page_controller/statistics_orders_money_we_will_get_view">Orders money ανά μέρα</a>
                </div>
                </li>
                <li><a href="#" 
                    onmouseover="mopen('menu_open2')" 
                    onmouseout="mclosetime()">documents</a>
                    <div id="menu_open2" 
                        onmouseover="mcancelclosetime()" 
                        onmouseout="mclosetime()">
                    <a href="<?php echo base_url() ?>Admin_page_controller/php_doc">Version info doc</a>
                    <a href="<?php echo base_url() ?>user_guide">codeingiter doc</a>
                    <a href="<?php echo base_url() ?>documentation/phpdoc">phpdoc</a>
                    <a href="<?php echo base_url() ?>documentation/apigen">apigen doc</a>

                    </div>
                </li>
                <li><a href="<?php echo base_url() ?>Admin_page_controller/admin_panel">Διαχείριση </a>
                </li>
              </ul>
            </li>
        <?php
        /* search form of navigator */
        echo "<li>";
        $attributes_search = array('class' => 'searchbox');
        $attributes_search_input = array('class' => 'navigator_input',
            'placeholder' => 'search...', 'name' => 'search_input');
        echo form_open('Admin_page_controller/search_view', $attributes_search);
        echo form_input($attributes_search_input);
        echo form_submit('search_button', 'search', 'class="navigator_button"');
        echo form_close();
        echo "</li>"
        ?>
        <?php
        echo "<li>";
        echo "welcome admin:";
        echo "<b>" . $this->session->userdata("admin_email") . "</b>";
        echo "</li>";
        ?>
        <?php
        /* logout form of navigator */
        echo "<li>";
        $attributes_logout = array('id' => 'logout');
        echo form_open('user_page_controller/user_logout',$attributes_logout);
        echo form_submit('logout_submit', 'logout', 'class="logout_submit"');
        echo form_close();
        echo "</li>";
        ?>
            </h3>   
        </ul>
    </div>
</nav>