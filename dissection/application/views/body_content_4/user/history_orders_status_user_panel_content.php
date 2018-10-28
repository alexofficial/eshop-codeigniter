<?php
/*
 * This php file is for view of history orders user status
 */
?>
     <center>
     <table class="orders_table"  cellpadding="7" >
      
      
      	<tr >
      		<ul>
      			<h1 id="board">Finished Orders</h1>
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
        /*this is the status option for all orders status*/	
 	$options_status = array(
                    'Listing'      => 'Listing',
                    'processed'       => 'processed',
                    'completion'       => 'completion',
                    'Cancelled'       => 'Cancelled',
                    'finished'       => 'finished' 
                );
/*for each selected finished orders status echo details*/
foreach ($selected_finished_orders as $finished_orders){	
    echo "<tr>";
     echo "<th>"; echo $finished_orders['order_number']; echo "</th>";					
     echo "<th>"; echo $finished_orders['user_name']; echo "</th>";	
     echo "<th>"; echo $finished_orders['user_email']; echo "</th>";	
     echo "<th>"; echo $finished_orders['city']."-".$finished_orders['ship_to'];
     echo "</th>";	
     echo "<th>"; echo $finished_orders['postcode']; echo "</th>";	
     echo "<th>"; echo $finished_orders['delivery_method']; echo "</th>";	
     echo "<th>"; echo $finished_orders['ordered_on']; echo "</th>";	
     echo "<th>"; echo $finished_orders['status']; echo "</th>";	
    echo "<th>"; echo $finished_orders['notes']; echo "</th>";
        echo '<td><center>';
        /*form open for view of spesifically shop cart*/
            echo form_open('User_page_controller/view_order_shop_cart');
            echo form_hidden('order_number',$finished_orders['order_number']);
            echo form_hidden('user_email',$finished_orders['user_email']);
            echo form_hidden('table_name','finished_orders');
            echo form_hidden('column_var','order_number');
            echo form_submit('shop_cart', 'shop cart', 'class="add_button"');
            echo form_close();
        echo '</center></td>';	
    echo "</tr>";								
	    }

?>
</table>
</center>
<br />
<?php
//----------------------------------------------------------------------------//
?>      
<center>
     <table class="orders_table"  cellpadding="7" >
      
      
      	<tr >
      		<ul>
      			<h1 id="board">Cancelled Orders</h1>
      		</ul>	
      	</tr>
      	<tr id="board" >
      		
			    <th>Order Number</th>
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
       
/*for each selected cancelled orders status echo details*/
foreach ($selected_cancelled_orders as $cancelled_orders){	
   echo "<tr>";
   echo "<th>"; echo $cancelled_orders['order_number']; echo "</th>";					
   echo "<th>"; echo $cancelled_orders['user_name']; echo "</th>";	
   echo "<th>"; echo $cancelled_orders['user_email']; echo "</th>";	
   echo "<th>"; echo $cancelled_orders['city']."-".$cancelled_orders['ship_to'];
   echo "</th>";	
   echo "<th>"; echo $cancelled_orders['postcode']; echo "</th>";	
   echo "<th>"; echo $cancelled_orders['delivery_method']; echo "</th>";	
   echo "<th>"; echo $cancelled_orders['ordered_on']; echo "</th>";	
   echo "<th>"; echo $cancelled_orders['status']; echo "</th>";	
   echo "<th>"; echo $cancelled_orders['notes']; echo "</th>";						
    echo '<td><center>';
    /*form open for view of spesifically shop cart*/
     echo form_open('User_page_controller/view_order_shop_cart');
     echo form_hidden('order_number',$cancelled_orders['order_number']);
     echo form_hidden('user_email',$cancelled_orders['user_email']);
     echo form_hidden('table_name','cancelled_orders');
     echo form_hidden('column_var','order_number');
     echo form_submit('shop_cart', 'shop cart', 'class="add_button"');
     echo form_close();
    echo '</center></td>';
   echo "</tr>";								
}

?>
</table>
</center>
</header>
    

 <br />