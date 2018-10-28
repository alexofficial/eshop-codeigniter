<?php
/**
 * This code is the navigator of site view.
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
             <img src=" <?php echo base_url().$path_home_image ?>"/></a>
              
            <li><span id="title">EASY SHOP</span></li>
            <li>     
                <ul id="sddm">
                 <li>
                   <a href="<?php echo base_url() ?>Home_page_controller/index">
                      Αρχική</a>
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
                          echo "<a href=" . base_url() . "home_page_controller/"
                                  . "show_products?category=" . $category . " >"
                                  . $category . "</a>";
                        }
                        ?>
                        </div>
                 </li>
                 <li>
                  <a href="#" 
                    onmouseover="mopen('m2')" 
                    onmouseout="mclosetime()">Υπηρεσίες</a>
                    <div id="m2" 
                      onmouseover="mcancelclosetime()" 
                      onmouseout="mclosetime()">
                      <?php
                      foreach ($selected_services_categories as $row) {
                      $service_category = $row['service_categories'];
                      echo "<a href=" . base_url() . "home_page_controller/"
                          . "show_service?category=" . $service_category . " >"
                          . $service_category . "</a>";
                      }
                      ?>
                    </div>
                 </li>
                 <li><a href="
                   <?php echo base_url() ?>Home_page_controller/register_page">
                         Εγγραφή</a></li>

                            </ul>
                        </li>


          <?php
          /* login form of navigator */
        echo "<li>";
        $attributes_login = array('id' => 'login');
        $attributes_username = array('name' => 'email', 
            'class' => 'navigator_input', 'placeholder' => 'email');
        $attributes_password = array('name' => 'password', 
            'class' => 'navigator_input', 'placeholder' => 'password');
        echo form_open('home_page_controller/login_validator', $attributes_login);
        echo form_input($attributes_username);
        echo form_password($attributes_password);
        echo form_submit('login_submit', 'login', 'class="navigator_button"');
        echo form_close();
        echo "</li>";
        ?>


        <?php
        /* search form of navigator */
        echo "<li>";
        $attributes_search = array('class' => 'searchbox');
        $attributes_search_input = array('class' => 'navigator_input', 
            'placeholder' => 'search...', 'name' => 'search_input');

        echo form_open('home_page_controller/search_view', $attributes_search);
        echo form_input($attributes_search_input);
        echo form_submit('search_button', 'search', 'class="navigator_button"');
        echo form_close();
        echo "</li>"
        ?>
    <a href="<?php echo base_url() ?>Home_page_controller/forgot_password_view">
         Ξέχασες τον Κωδικό σου;</a>
                    </h3> 

                </ul>
            </div>
        </nav>