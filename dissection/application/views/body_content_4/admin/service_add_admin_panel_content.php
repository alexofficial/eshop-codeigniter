<?php 
/*
 *  This php file is for admin request services view.
 */
//----------------------------------------------------------------------------//

/* echo validator errors */
 echo "<span id='validators_color'>" . validation_errors() . "</span>";
?>
<center >
<?php
    /* attributes of forms*/
    $attributes_service_name = array('name' => 'serviceName', 'id' => '', 
        'placeholder' => 'product name..');
    $attributes_textarea_service_details = array( 'name' => 'servicedetails',
        'class' => 'product_text_area','maxlength' => '2000' );
    $attributes_textarea_service_notes = array('name' => 'serviceNotes',
        'class' => 'product_text_area','maxlength' => '2000');
     $attributes_service_price_at_work = array('name' => 'servicePriceAtWork',
         'id' => '', 'placeholder' => 'price at work..');
    $attributes_service_price_at_home = array('name' => 'servicePriceAtHome', 
        'id' => '', 'placeholder' => 'price at home..');

    /* for each selected services categories*/
    foreach ($selected_services_categories as $result) {
        /* data of all services categories for later use*/
      $data[] = [$result['service_categories'] => $result['service_categories']
        ];
    }
    ?>

    <table class="product_table"  id="add_products_color" >

        <?php
        /* form open add service validator*/
        echo form_open('Admin_page_controller/add_service');


        echo "<tr>";
        echo "<td>";
        echo "<center>";
        echo "<b><h2>Service name:</h2></b>";
        echo "</center>";
        echo "<center>";
        echo form_input($attributes_service_name, '', 'class="content_input"');
        echo "</center>";
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>";
        echo "<center>";
        echo "<b><h2>Service details:</h2></b>";
        echo "</center>";
        echo "<center>";
        echo form_textarea($attributes_textarea_service_details, '', 
                'content_input');
        echo "</center>";
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>";
        echo "<center>";
        echo "<b><h2>Service notes:</h2></b>";
        echo "</center>";
        echo "<center>";
        echo form_textarea($attributes_textarea_service_notes, '', 
                'content_input');
        echo "</center>";
        echo "</td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>";
        echo "<center>";
        echo "<b><h2> Price:</h2></b>";
        echo "</center>";
        echo "<center>";
        echo form_input($attributes_service_price_at_work, '', 
                'class="content_input"');
        echo "</center>";
        echo "</td>";
        echo "</tr>";


        echo "<tr>";
        echo "<td>";
        echo "<center>";
        echo "<b><h2> Price:</h2></b>";
        echo "</center>";
        echo "<center>";
        echo form_input($attributes_service_price_at_home, '',
                'class="content_input"');
        echo "</center>";
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>";
        echo "<center>";
        echo "<b><h2> Service Category:</h2></b>";
        echo "</center>";
        echo "<center>";
        echo form_dropdown('serviceCategories', $data, '', 
                'class="content_input"');
        echo "</center>";
        echo "</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>";
        echo "<center>";
        /* submit button*/
        echo form_submit('add_product_submit', 'Add Service', 
                'class="add_button"');
        echo form_close();
        echo "</center>";
        echo "</td>";
        echo "</tr>";
        ?>

    </table>  

</center> 





<br />
</header>