<?php
/**
 * This code is the navigator of admin panel view.
 * @package views/body_navigator_2
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 */
?>
<body>
<div>
<?php /* Navigator*/?>
<nav id="navigation">
    <div class="container">
    <ul class="navlinks">
        <h3>
            <ul id="sddm">
            <li><a href="<?php echo base_url() ?>Home_page_controller/index">Αρχική</a></li>
            <li><a href="#" 
                onmouseover="mopen('menu_open1')" 
                onmouseout="mclosetime()">Χρήστες</a>
                <div id="menu_open1" 
                    onmouseover="mcancelclosetime()" 
                    onmouseout="mclosetime()">
                    <a href="<?php echo base_url() ?>Admin_page_controller/users">Χρήστες</a>
                </div>
                </li>
                <li><a href="#" 
                    onmouseover="mopen('menu_open2')" 
                    onmouseout="mclosetime()">Κατηγορίες</a>
                    <div id="menu_open2" 
                        onmouseover="mcancelclosetime()" 
                        onmouseout="mclosetime()">
                    <a href="<?php echo base_url() ?>Admin_page_controller/show_categories">Προσθήκη Κατηγοριών</a>
                    <a href="<?php echo base_url() ?>Admin_page_controller/item_add_view">Προσθήκη Προιόντος</a>
                    <a href="<?php echo base_url() ?>Admin_page_controller/service_add_view">Προσθήκη Υπηρεσιών</a>
                                    
                </div>
                </li>
                <li><a href="#" 
                    onmouseover="mopen('menu_open3')" 
                    onmouseout="mclosetime()">Υπολογιστές</a>
                    <div id="menu_open3" 
                        onmouseover="mcancelclosetime()" 
                        onmouseout="mclosetime()">
                    <?php
                        foreach ($selected_categories as $row) {
                        $category = $row['product_categories'];
                        echo "<a href=" . base_url() 
                          . "Admin_page_controller/show_products?category=" 
                          . $category . " > " . $category . "</a>";
                        }
                    ?>
                    </div>
                </li>
                <li><a href="#" 
                    onmouseover="mopen('m2')" 
                    onmouseout="mclosetime()">Υπηρεσίες</a>
                    <div id="m2" 
                        onmouseover="mcancelclosetime()" 
                        onmouseout="mclosetime()">
                    <?php
                        foreach ($selected_services_categories as $row) {
                        $category = $row['service_categories'];
                        echo "<a href=" . base_url() 
                          . "Admin_page_controller/show_service?category=" 
                          . $category . " >" . $category . "</a>";
                        }
                    ?>
                    </div>
                </li>
                <li><a href="<?php echo base_url() ?>Admin_page_controller/deals_view">Προσφορές</a>
                </li>
                <li><a href="#" 
                  onmouseover="mopen('m3')" 
                  onmouseout="mclosetime()">Contacts</a>
                  <div id="m3" 
                  onmouseover="mcancelclosetime()" 
                  onmouseout="mclosetime()">
                  <a href="<?php echo base_url() ?>Admin_page_controller/users_contacts">user contact</a>
                  <a href="<?php echo base_url() ?>Admin_page_controller/history_users_contacts">contact history</a>
                  </div>
                </li>
                <li><a href="<?php echo base_url() ?>Admin_page_controller/newsletter_view">Newsletter</a></li>
             </ul>

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
         /* logout form of navigator */
        echo "<li>";
        $attributes_logout = array('id' => 'logout');
        echo form_open('user_page_controller/user_logout', $attributes_logout);
        echo form_submit('logout_submit', 'logout', 'class="logout_submit"');
        echo form_close();
        echo "</li>";
        ?>
        <?php
        echo "<li>";
        echo "welcome admin:";
        echo $this->session->userdata("admin_email");
        echo "</li>";
        ?>
                 </h3>   
            </ul>
        </div>
      </nav>
</div>