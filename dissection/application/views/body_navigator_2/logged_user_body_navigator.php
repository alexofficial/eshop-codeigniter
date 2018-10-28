<?php
/**
 * This code is the navigator of logged user view.
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
          <a href="<?php echo base_url() ?>Home_page_controller/index">
              <img src=" <?php echo base_url() . $path_home_image ?>"/></a>
          <li><span id="title">EASY SHOP</span></li>
          <li>      
        <ul id="sddm">
           <li><a href="<?php echo base_url() ?>Home_page_controller/index">
                   Αρχική</a></li>
             <li><a href="#" 
              onmouseover="mopen('m1')" 
              onmouseout="mclosetime()">Υπολογιστές</a>
                <div id="m1" 
                    onmouseover="mcancelclosetime()" 
                    onmouseout="mclosetime()">
                    <?php
                        foreach ($selected_categories as $row) {
                        $category = $row['product_categories'];
                        echo "<a href=" . base_url() ."user_page_controller/"
                                . "show_products?category=" . $category . " >" 
                                . $category . "</a>";
                        }
                    ?>
                </div>
             </li>
             <li><a href="#" 
                    onmouseover="mopen('m2')" 
                    onmouseout="mclosetime()">Υπηρεσίες</a>
                    <div id="m2" 
                    nmouseover="mcancelclosetime()" 
                    onmouseout="mclosetime()">
                    <?php
                        foreach ($selected_services_categories as $row) {
                        $service_category = $row['service_categories'];
                        echo "<a href=" . base_url() . "user_page_controller/"
                          . "show_service?category=" . $service_category . " >" 
                          . $service_category . "</a>";
                        }
                    ?>
                    </div>
             </li>
             <li><a href="#" 
                   onmouseover="mopen('m3')" 
                   onmouseout="mclosetime()">Παραγγελίες</a>
                   <div id="m3" 
                   onmouseover="mcancelclosetime()" 
                   onmouseout="mclosetime()">
                   <a href="<?php echo base_url() ?>User_page_controller/orders_status" >Κατάσταση Παραγγελίας</a>
                   <a href="<?php echo base_url() ?>User_page_controller/services_status" >Κατάσταση Αιτημάτων Υπηρεσιών </a>
                   <a href="<?php echo base_url() ?>User_page_controller/history_orders_status" >Ιστορικό Παραγγελιών</a>
                   <a href="<?php echo base_url() ?>User_page_controller/history_services_request_status" >Ιστορικό Υπηρεσιών</a>
                 </div>
             </li> 
             <li>
              <a  href="#" 
                  onmouseover="mopen('m4')" 
                  onmouseout="mclosetime()">Επικοινωνία</a>
                  <div id="m4" 
                    onmouseover="mcancelclosetime()" 
                    onmouseout="mclosetime()">
                 <a href="<?php echo base_url() ?>User_page_controller/contact">Επικοινωνία</a>
                 <a href="<?php echo base_url() ?>User_page_controller/contact_history" >Ιστορικό Επικοινωνίας</a>

                                    </div>
            </li>
            <li>
            <a href=""
                onmouseover="mopen('m5')" 
                onmouseout="mclosetime()">Λογαριασμός</a>
                <div id="m5" 
                    onmouseover="mcancelclosetime()" 
                    onmouseout="mclosetime()">
                <a href="<?php echo base_url() ?>User_page_controller/user_account_view" >Ο Λογαριασμός σας</a>

                </div>
            </li>
          </ul>
      </li>

        &nbsp;
        <?php
        /* search form of navigator */
        echo "<li>";
        $attributes_search = array('class' => 'searchbox');
        $attributes_search_input = array(
            'class' => 'navigator_input', 
            'placeholder' => 'search...', 
            'name' => 'search_input');

        echo form_open('User_page_controller/search_view', $attributes_search);
        echo form_input($attributes_search_input);
        echo form_submit('search_button', 'search', 'class="navigator_button"');
        echo form_close();
        echo "</li>"
        ?>
        &nbsp;
        <?php
        echo "<li>";
        echo "welcome:";
        echo $this->session->userdata("user_email");
        echo "</li>";
        ?>
        &nbsp;
        <?php
        /* logout form of navigator */
        echo "<li>";
        $attributes_logout = array('class' => 'position');
        echo form_open('user_page_controller/user_logout', $attributes_logout);
        echo form_submit('logout_submit', 'logout', 'class="logout_submit"');
        echo form_close();
        echo "</li>";
        ?>


            </h3>
        </ul>
     </div>
</nav>