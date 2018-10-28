 <?php 
 /*
 * This php file is for view of history services request user status
 */
?>
<center>
<table class="orders_table"  cellpadding="7" >
 <tr >
    <ul>
      	<h1 id="board">My Cancelled Services Request</h1>
    </ul>	
</tr>
    <tr id="board" >
      	
      	<th>Request Name</th>
	<th>Order Number</th>
        <th>Bill To</th>
        <th>User Email</th>
        <th>Adress</th>
        <th>Postcode</th>
        <th>Ordered On</th>
        <th>Status</th>
        <th></th>
			   
    </tr>
 		
<?php 
 	/*this is the status option for all services status*/	
        $options_status = array(
                    'Listing'      => 'Listing',
                    'processed'       => 'processed',
                    'completion'       => 'completion',
                    'Cancelled'       => 'Cancelled',
                    'finished'       => 'finished' 
                );
/*for each selected finished service status echo details*/
foreach ($selected_finished_services_request as $request_services ){	
			
				
    echo "<tr>";
    echo "<th>"; echo $request_services['service_name'];echo "</th>";
    echo "<th>"; echo $request_services['services_request_number'];echo "</th>";					
    echo "<th>"; echo $request_services['full_name'];echo "</th>";	
    echo "<th>"; echo $request_services['user_email'];echo "</th>";	
    echo "<th>"; echo $request_services['city']."-".$request_services['adress'];
    echo "</th>";	
    echo "<th>"; echo $request_services['postcode'];echo "</th>";		
    echo "<th>"; echo $request_services['date'];echo "</th>";	
    echo "<th>"; echo $request_services['services_request_status'];echo "</th>";	
    echo '<td>';
    $attributes_delete_user = array('id' => 'delete_user' );
    /*form open for go to services request*/
    echo form_open('User_page_controller/show_service_for_service_request',
            $attributes_delete_user);
    echo form_hidden('service_categories',
            $request_services['service_categories']);
    echo form_submit('show_service_for_service_request',
            'show service','class="delete_button"');
    echo form_close();
    echo '</td>';	         							
    echo "</tr>";	
				
										
	    }

?>    
      </table>
      </center>
<?php
//----------------------------------------------------------------------------//
?>
      <center>
      <br />
      
           <table class="orders_table"  cellpadding="7" >
      
      
      	<tr >
      		<ul>
      			<h1 id="board">My Finished Services Request</h1>
      		</ul>	
      	</tr>
      	<tr id="board" >
      	
      			<th>Request Name</th>
			    <th>Order Number</th>
			    <th>Bill To</th>
			    <th>User Email</th>
			    <th>Adress</th>
			    <th>Postcode</th>
			    <th>Ordered On</th>
			    <th>Status</th>
			    
			    <th></th>
			   
 		</tr>
 		
<?php 
        /*this is the status option for all services status*/
 	$options_status = array(
                    'Listing'      => 'Listing',
                    'processed'       => 'processed',
                    'completion'       => 'completion',
                    'Cancelled'       => 'Cancelled',
                    'finished'       => 'finished' 
                );
/*for each selected cancelled service status echo details*/
foreach ($selected_cancelled_services_request as $request_services ){	
    echo "<tr>";
    echo "<th>"; echo $request_services['service_name'];echo "</th>";
    echo "<th>"; echo $request_services['services_request_number'];echo "</th>";					
    echo "<th>"; echo $request_services['full_name'];echo "</th>";	
    echo "<th>"; echo $request_services['user_email'];  echo "</th>";	
    echo "<th>"; echo $request_services['city']."-".$request_services['adress'];
    echo "</th>";	
    echo "<th>"; echo $request_services['postcode'];echo "</th>";	
    echo "<th>"; echo $request_services['date'];echo "</th>";	
    echo "<th>"; echo $request_services['services_request_status'];echo "</th>";	
    echo '<td>';
    $attributes_delete_user = array('id' => 'delete_user' );
    /*form open for go to services request*/
    echo form_open('User_page_controller/show_service_for_service_request',
            $attributes_delete_user);
    echo form_hidden('service_categories',
            $request_services['service_categories']);
    echo form_submit('show_service_for_service_request','show service',
            'class="delete_button"');
    echo form_close();
    echo '</td>';
    echo "</tr>";	
				
}							
	    

?>
 			
 		
      		         
      
      </table>
      </center>
       
      </header>
    

 <br /><?php

?>