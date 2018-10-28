 <?php
/* 
 *  This php file is for view of user orders status.
 */ 
 ?>
<center>
    <table class="orders_table"  cellpadding="7" >


        <tr >
        <ul>
            <h1 id="board">My Orders</h1>
        </ul>	
        </tr>
        <tr id="board" >

            <th >Order Number</th>
            <th>Bill To</th>
            <th>User Email</th>
            <th>Ship To</th>
            <th>Postcode</th>
            <th>delivery</th>
            <th>Ordered On</th>
            <th>Status</th>
            <th>Notes</th>
            <th></th>

        </tr>

<?php
/*
 * here is the options for order status
 */
$options_status = array(
    'Listing' => 'Listing',
    'processed' => 'processed',
    'completion' => 'completion',
    'Cancelled' => 'Cancelled',
    'finished' => 'finished'
);
/* for each selected order print all details*/
foreach ($selected_orders as $orders) {
    echo "<tr>";
    echo "<th>";
    echo $orders['order_number'];
    echo "</th>";
    echo "<th>";
    echo $orders['user_name'];
    echo "</th>";
    echo "<th>";
    echo $orders['user_email'];
    echo "</th>";
    echo "<th>";
    echo $orders['city'] . "-" . $orders['ship_to'];
    echo "</th>";
    echo "<th>";
    echo $orders['postcode'];
    echo "</th>";
    echo "<th>";
    echo $orders['delivery_method'];
    echo "</th>";
    echo "<th>";
    echo $orders['ordered_on'];
    echo "</th>";
    echo "<th>";
    echo $orders['status'];
    echo "</th>";
    echo "<th>";
    echo $orders['notes'];
    echo "</th>";

    echo '<td><center>';
    /* form open for view specifically the shop cart of order*/
    echo form_open('User_page_controller/view_order_shop_cart');
    echo form_hidden('order_number', $orders['order_number']);
    echo form_hidden('user_email', $orders['user_email']);
    echo form_hidden('table_name', 'orders');
    echo form_hidden('column_var', 'order_number');
    echo form_submit('shop_cart', 'shop cart', 'class="add_button"');
    echo form_close();
    echo '</center></td>';
    /* here checks if status is Listing we can delete it if we want else
     * we cant
     */
    if ($orders['status'] == 'Listing') {
        echo '<td><center>';
        echo form_open('User_page_controller/delete_user_order_view');
        echo form_hidden('order_number', $orders['order_number']);
        echo form_hidden('user_email', $orders['user_email']);
        echo form_submit('delete_user_order', 'Delete', 'class="add_button"');
        echo form_close();
        echo '</center></td>';
    }
    echo "</tr>";
}
?>




    </table>
</center>
<br />

</header>


<br />