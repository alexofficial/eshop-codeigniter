<?php
/*
 *  This php file is for admin add order status view.
 */
//----------------------------------------------------------------------------//

/* echo validator errors */
echo "<center><span id='validators_color'>" . validation_errors() .
        "</span></center>";
?>
<center>
    <table class="orders_table"  cellpadding="7" >

        <tr><ul>
            <h1 id="board">Dashboard</h1>
            <hr />
            <br />
        </ul>
        </tr>
        <tr >
        <ul>
            <h1 id="board">Orders</h1>
        </ul>	
        </tr>
        <tr id="board" >
            <th >order_id</th>
            <th >Order Number</th>
            <th>Bill To</th>
            <th>User Email</th>
            <th>Ship To</th>
            <th>Postcode</th>
            <th>delivery</th>
            <th>Status</th>
            <th>Ordered On</th>
            <th>Notes</th>
            <th></th>
            <th>shop</th>

        </tr>

        <?php
        /* dropdown option for order status*/
        $options_status = array(
            'Listing' => 'Listing',
            'Processed' => 'Processed',
            'Completion' => 'Completion',
            'Cancelled' => 'Cancelled',
            'Finished' => 'Finished'
        );

        /* for each selected order */
        foreach ($selected_orders as $orders) {
            
            /* attributes of forms*/	
            $attributes_order_id = array('name' => 'orderId','class' => '', 
                'value' => $orders['order_id'], 'disabled' => 'disabled',
                'style' => " width:50px");
            $attributes_order_number = array('name' => 'orderNumber',
                'class' => '', 'value' => $orders['order_number'], 
                'disabled' => 'disabled','style' => "");
            $attributes_user_name = array('name' => 'userName','class' => '', 
                'value' => $orders['user_name'],'style' => "");
            $attributes_user_email = array('name' => 'userEmail','class' => '', 
                'value' => $orders['user_email'], 'disabled' => 'disabled',
                'style' => "");
            $attributes_city_ship_to = array('name' => 'city','class' => '', 
                'value' => $orders['city'] . '-' . $orders['ship_to'],
                'style' => "");
            $attributes_postcode = array('name' => 'postcode','class' => '',
                'value' => $orders['postcode'],
                'style' => "width:50px");
            $attributes_delivery_method = array('name' => 'deliveryMethod',
                'class' => '', 'value' => $orders['delivery_method'],
                'style' => "width:80px");
            $attributes_ordered_on = array('name' => 'orderedOn','class' => '',
                'value' => $orders['ordered_on'], 'disabled' => 'disabled',
                'style' => "height:20px; width:70px");
            $attributes_shop_cart = array('name' => 'shopCart','class' => '',
                'value' => $orders['shop_cart'], 'disabled' => 'disabled',
                'style' => "height:20px; width:50px");
            $attributes_notes = array('name' => 'notes',
                'class' => '', 'value' => $orders['notes'],
                'style' => "height:30px; width:70px");


            echo "<tr>";
            /* form open viladate update orders*/
            echo form_open('Admin_page_controller/validate_update_orders');

            echo '<td><center>';
            echo form_input($attributes_order_id);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_order_number);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_user_name);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_user_email);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_city_ship_to);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_postcode);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_delivery_method);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_ordered_on);
            echo '</center></td>';
            echo '<td><center>';
            echo form_dropdown('status', $options_status, $orders['status']);
            echo '</center></td>';
           
            echo '<td><center>';
            echo form_textarea($attributes_notes);
            echo '</center></td>';


            echo "<td>";
            /* hidden form for needs of open form*/
            echo form_hidden('order_number', $orders['order_number']);
            echo form_hidden('order_id', $orders['order_id']);
            echo form_hidden('user_email', $orders['user_email']);
            echo form_hidden('city', $orders['city']);
            echo form_hidden('ship_to', $orders['ship_to']);
            echo form_hidden('ordered_on', $orders['ordered_on']);
            echo form_hidden('table_name', 'orders');
            echo form_submit('update_orders_by_order_number', 'update', 
                    'class="update_button"');
            echo form_close();
            echo "</td>";

            echo '<td><center>';
            /* form open view order shop cart*/
            echo form_open('Admin_page_controller/view_order_shop_cart');
            /* hidden form for needs of open form*/
            echo form_hidden('order_number', $orders['order_number']);
            echo form_hidden('user_email', $orders['user_email']);
            echo form_hidden('table_name', 'orders');
            echo form_hidden('column_var', 'order_number');
            echo form_submit('shop_cart', 'shop cart', 'class="add_button"');
            echo form_close();
            echo '</center></td>';
            echo "</tr>";
        }
//----------------------------------------------------------------------------//
        ?>
    </table>

    <br />
    <br />

    <table class="orders_table"  cellpadding="7" >

        <tr><ul>
            <hr />
            <br />
            <h1 id="board">Finished Orders</h1>
            <br />
        </ul>
        </tr>

        <tr id="board" >
            <th >id</th>
            <th >order id</th>
            <th >Order Number</th>
            <th>Bill To</th>
            <th>User Email</th>
            <th>Ship To</th>
            <th>Postcode</th>
            <th>delivery</th>
            <th>Status</th>
            <th>Ordered On</th>
            <th>Notes</th>
            <th></th>
            <th>shop</th>

        </tr>


<?php
/* for each selected finished order*/
foreach ($selected_finished_orders as $finished_orders) {
/* attributes of forms*/
    $attributes_finished_id = array('name' => 'finishedId',
        'class' => '', 'value' => $finished_orders['finished_order_id'], 
        'disabled' => 'disabled','style' => " width:50px");
    $attributes_finished_order_id = array('name' => 'orderId','class' => '', 
        'value' => $finished_orders['order_id'], 'disabled' => 'disabled',
        'style' => " width:50px");
    $attributes_finished_order_number = array('name' => 'orderNumber',
        'class' => '', 'value' => $finished_orders['order_number'], 
        'disabled' => 'disabled','style' => "");
    $attributes_finished_user_name = array('name' => 'userName',
        'class' => '', 'value' => $finished_orders['user_name'],'style' => "");
    $attributes_finished_user_email = array('name' => 'userEmail',
        'class' => '', 'value' => $finished_orders['user_email'], 
        'disabled' => 'disabled','style' => "");
    $attributes_finished_city_ship_to = array('name' => 'city','class' => '',
        'value' => $finished_orders['city'] . '-' . $finished_orders['ship_to'],
        'style' => "");
    $attributes_finished_postcode = array('name' => 'postcode','class' => '',
        'value' => $finished_orders['postcode'],'style' => "");
    $attributes_finished_delivery_method = array('name' => 'deliveryMethod',
        'class' => '', 'value' => $finished_orders['delivery_method'],
        'style' => "");
    $attributes_finished_ordered_on = array('name' => 'orderedOn','class' => '',
        'value' => $finished_orders['ordered_on'], 'disabled' => 'disabled',
        'style' => "height:20px; width:70px");
    $attributes_finished_shop_cart = array('name' => 'shopCart','class' => '', 
        'value' => $finished_orders['shop_cart'], 'disabled' => 'disabled',
        'style' => "height:20px; width:50px");
    $attributes_finished_notes = array('name' => 'notes',
        'class' => '', 'value' => $finished_orders['notes'],
        'style' => "height:30px; width:70px");


    echo "<tr>";
    /* form open validate update finished orders*/
    echo form_open('Admin_page_controller/validate_update_finished_orders');

    echo '<td><center>';
    echo form_input($attributes_finished_id);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_order_id);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_order_number);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_user_name);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_user_email);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_city_ship_to);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_postcode);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_delivery_method);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_ordered_on);
    echo '</center></td>';
    echo '<td><center>';
    echo form_dropdown('status', $options_status, $finished_orders['status']);
    echo '</center></td>';

    echo '<td><center>';
    echo form_textarea($attributes_finished_notes);
    echo '</center></td>';


    echo "<td>";
    /* hidden form for needs of open form*/
    echo form_hidden('order_number', $finished_orders['order_number']);
    echo form_hidden('order_id', $finished_orders['order_id']);
    echo form_hidden('user_email', $finished_orders['user_email']);
    echo form_hidden('city', $finished_orders['city']);
    echo form_hidden('ship_to', $finished_orders['ship_to']);
    echo form_hidden('ordered_on', $finished_orders['ordered_on']);
    echo form_hidden('shop_cart', $finished_orders['shop_cart']);
    echo form_hidden('table_name', 'finished_orders');
    echo form_submit('update_orders_by_order_number', 'update', 
            'class="update_button"');
    echo form_close();
    echo "</td>";

    echo '<td><center>';
    /* form open view order shop cart*/
    echo form_open('Admin_page_controller/view_order_shop_cart');
    echo form_hidden('order_number', $finished_orders['order_number']);
    echo form_hidden('user_email', $finished_orders['user_email']);
    echo form_hidden('table_name', 'finished_orders');
    echo form_hidden('column_var', 'order_number');
    echo form_submit('shop_cart', 'shop cart', 'class="add_button"');
    echo form_close();
    echo '</center></td>';
    echo "</tr>";
}
?>

    </table>
        <?php
//----------------------------------------------------------------------------//
        ?>			

    <br />
    <br />

    <table class="orders_table"  cellpadding="7" >

        <tr><ul>
            <hr />
            <br />
            <h1 id="board">Cancelled Orders</h1>
            <br />
        </ul>
        </tr>

        <tr id="board" >
            <th >id</th>
            <th >order id</th>
            <th >Order Number</th>
            <th>Bill To</th>
            <th>User Email</th>
            <th>Ship To</th>
            <th>Postcode</th>
            <th>delivery</th>
            <th>Status</th>
            <th>Ordered On</th>
            <th>Notes</th>
            <th></th>
            <th>shop</th>

        </tr>

<?php
/* for each selected cancelled order*/
foreach ($selected_cancelled_orders as $cancelled_orders) {
    /* attributes of forms*/
   $attributes_cancelled_id = array('name' => 'finishedId', 'class' => '', 
   'value' => $cancelled_orders['cancelled_order_id'], 'disabled' => 'disabled',
   'style' => " width:50px");
    $attributes_cancelled_order_id = array('name' => 'orderId','class' => '', 
        'value' => $cancelled_orders['order_id'], 'disabled' => 'disabled',
        'style' => " width:50px");
    $attributes_cancelled_order_number = array('name' => 'orderNumber',
        'class' => '', 'value' => $cancelled_orders['order_number'], 
        'disabled' => 'disabled','style' => "");
    $attributes_cancelled_user_name = array('name' => 'userName','class' => '',
        'value' => $cancelled_orders['user_name'],'style' => "");
    $attributes_cancelled_user_email = array('name' => 'userEmail','class' =>'',
        'value' => $cancelled_orders['user_email'], 'disabled' => 'disabled',
        'style' => "");
    $attributes_cancelled_city_ship_to = array('name' => 'city','class' => '', 
      'value' => $cancelled_orders['city'] . '-' . $cancelled_orders['ship_to'],
        'style' => "");
    $attributes_cancelled_postcode = array('name' => 'postcode','class' => '', 
        'value' => $cancelled_orders['postcode'],'style' => "");
    $attributes_cancelled_delivery_method = array('name' => 'deliveryMethod',
        'class' => '', 'value' => $cancelled_orders['delivery_method'],
        'style' => "");
    $attributes_cancelled_ordered_on = array('name' => 'orderedOn','class' =>'',
        'value' => $cancelled_orders['ordered_on'], 'disabled' => 'disabled',
        'style' => "height:20px; width:70px");
    $attributes_cancelled_shop_cart = array('name' => 'shopCart','class' => '',
        'value' => $cancelled_orders['shop_cart'], 'disabled' => 'disabled',
        'style' => "height:20px; width:50px");
    $attributes_cancelled_notes = array('name' => 'notes',
        'class' => '', 'value' => $cancelled_orders['notes'],
        'style' => "height:30px; width:70px");


    echo "<tr>";
    /* form open validate update cancelled orders*/
    echo form_open('Admin_page_controller/validate_update_cancelled_orders');

    echo '<td><center>';
    echo form_input($attributes_cancelled_id);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_order_id);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_order_number);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_user_name);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_user_email);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_city_ship_to);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_postcode);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_delivery_method);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_ordered_on);
    echo '</center></td>';
    echo '<td><center>';
    echo form_dropdown('status', $options_status, $cancelled_orders['status']);
    echo '</center></td>';

    echo '<td><center>';
    echo form_textarea($attributes_cancelled_notes);
    echo '</center></td>';


    echo "<td>";
    /* hidden form for needs of open form*/
    echo form_hidden('order_number', $cancelled_orders['order_number']);
    echo form_hidden('order_id', $cancelled_orders['order_id']);
    echo form_hidden('user_email', $cancelled_orders['user_email']);
    echo form_hidden('city', $cancelled_orders['city']);
    echo form_hidden('ship_to', $cancelled_orders['ship_to']);
    echo form_hidden('ordered_on', $cancelled_orders['ordered_on']);
    echo form_hidden('shop_cart', $cancelled_orders['shop_cart']);
    echo form_hidden('table_name', 'cancelled_orders');
    echo form_submit('update_orders_by_order_number', 'update', 
            'class="update_button"');
    echo form_close();
    echo "</td>";

    echo '<td><center>';
    /* form open view order shop cart*/
    echo form_open('Admin_page_controller/view_order_shop_cart');
    /* hidden form for needs of open form*/
    echo form_hidden('order_number', $cancelled_orders['order_number']);
    echo form_hidden('user_email', $cancelled_orders['user_email']);
    echo form_hidden('table_name', 'cancelled_orders');
    echo form_hidden('column_var', 'order_number');
    echo form_submit('shop_cart', 'shop cart', 'class="add_button"');
    echo form_close();
    echo '</center></td>';
    echo "</tr>";
}
?>



    </table>
</center>
<br />

</header>


<br />