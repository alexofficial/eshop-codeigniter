<?php
/* This php file is for home page view of order status*/
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
/* for each selected order echo details*/
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
    echo "</tr>";
}
?>
    </table>
</center>
<br />

</header>


<br /><?php ?>