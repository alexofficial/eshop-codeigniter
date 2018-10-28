<?php
/* This php file is for home page view of check order check status */


/* validators errors of form check orders status*/
echo "<span id='validators_color'>" . validation_errors() . "</span>";
/* attributes of form input*/
$attributes_order_number = array('name' => 'orderNumber', 
    'class' => 'content_order_check_input','placeholder' => 'order number');

?>

<table id="label_color">

    <?php
    echo "<td>";
    echo "<tr>";
    /* form open check orders status*/
    echo form_open('home_page_controller/check_orders_status');
    echo "<center>";
    echo form_input($attributes_order_number);
    /* submit of send to check the order status*/
    echo form_submit('order_number_check', 'send', 'class="register_button"');
    echo form_close();
    echo "</center>";

    echo "</td>";

    echo "</tr>";
    ?>
</table>

</center>		
</header>


<br />
