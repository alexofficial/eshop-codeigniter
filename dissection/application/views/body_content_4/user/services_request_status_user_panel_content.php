 <?php
/* 
 *  This php file is for view of services request status 
 */ 
 ?>
<center>
    <table class="orders_table"  cellpadding="7" >


        <tr >
        <ul>
            <h1 id="board">My Services Request</h1>
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
        $options_status = array(
            'Listing' => 'Listing',
            'processed' => 'processed',
            'completion' => 'completion',
            'Cancelled' => 'Cancelled',
            'finished' => 'finished'
        );
/* with help of foreach show on view the the service request of user for all
services request */
        foreach ($selected_request_services as $request_services) {
            

                echo "<tr>";
                echo "<th>";
                echo $request_services['service_name'];
                echo "</th>";
                echo "<th>";
                echo $request_services['services_request_number'];
                echo "</th>";
                echo "<th>";
                echo $request_services['full_name'];
                echo "</th>";
                echo "<th>";
                echo $request_services['user_email'];
                "</th>";
                echo "<th>";
                echo $request_services['city'] . "-" 
                        . $request_services['adress'];
                echo "</th>";
                echo "<th>";
                echo $request_services['postcode'];
                echo "</th>";
                echo "<th>";
                echo $request_services['date'];
                echo "</th>";
                echo "<th>";
                echo $request_services['services_request_status'];
                echo "</th>";
                echo '<td>';
                $attributes_delete_user = array('id' => 'delete_user');
                /* here is a from for show request service */ 
                echo form_open('User_page_controller/'
                        . 'show_service_for_service_request', 
                        $attributes_delete_user);
                echo form_hidden('service_categories', 
                        $request_services['service_categories']);
                echo form_submit('show_service_for_service_request', 
                        'show service', 'class="add_button"');
                echo form_close();
                echo '</td>';
            /* he if request status is Listing we can delete it else we can't */     
             if ($request_services['services_request_status'] == 'Listing') {
             echo '<td>';
             echo form_open('User_page_controller/delete_user_request_service');
             echo form_hidden('services_request_number',
             $request_services['services_request_number']);
             echo form_hidden('user_email', $request_services['user_email']);
             echo form_submit('delete_user_request_service', 'Delete',
                            'class="delete_button"');
             echo form_close();
             echo '</td>';
             }

                echo "</tr>";
        }
        
        ?>




    </table>

    <br />
    <br />







</center>
<br />
</header>


