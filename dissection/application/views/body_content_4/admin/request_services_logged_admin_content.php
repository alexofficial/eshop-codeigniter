<?php
/*
 *  This php file is for admin request services view.
 */
//----------------------------------------------------------------------------//

/* echo validator errors */
echo "<center><span id='validators_color'>" . validation_errors() 
        . "</span></center>";
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
            <h1 id="board">Request services</h1>
        </ul>	
        </tr>
        <tr id="board" >
            <th>Services Request Id</th>
            <th>Services Request Number </th>
            <th>Service Id</th>
            <th>service categories Id</th>
            <th>Service Name</th>
            <th>Ordered On</th>
            <th>User email </th>
            <th>User name </th>
            <th>City</th>
            <th>Adress </th>
            <th>Postcard</th>
            <th>Status</th>
            <th>Notes</th>
            <th></th>


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




/* foreach selected request services */
foreach ($selected_request_services as $request_services) {
    /* attributes of forms*/	
    $attributes_services_request_id = array('name' => 'servicesRequestId',
        'class' => '', 'value' => $request_services['services_request_id'], 
        'disabled' => 'disabled','style' => " width:50px");
    $attributes_services_request_number = array(
        'name' => 'servicesRequestNumber','class' => '', 
        'value' => $request_services['services_request_number'],'style' => "");
    $attributes_service_id = array('name' => 'serviceId','class' => '', 
        'value' => $request_services['service_id'], 'disabled' => 'disabled',
        'style' => "width:50px");
    $attributes_service_categories = array('name' => 'serviceCategories',
        'class' => '', 'value' => $request_services['service_categories'], 
        'disabled' => 'disabled','style' => "");
    $attributes_service_name = array('name' => 'serviceName','class' => '', 
        'value' => $request_services['service_name'], 'disabled' => 'disabled',
        'style' => "");
    $attributes_date = array('name' => 'date','class' => '', 
        'value' => $request_services['date'], 'disabled' => 'disabled',
        'style' => "height:20px; width:70px");
    $attributes_user_email = array('name' => 'userEmail','class' => '', 
        'value' => $request_services['user_email'], 'disabled' => 'disabled',
        'style' => "");
    $attributes_full_name = array('name' => 'fullName','class' => '', 
        'value' => $request_services['full_name'], 'disabled' => 'disabled',
        'style' => "");
    $attributes_adress = array('name' => 'adress','class' => '', 
        'value' => $request_services['adress'], 'disabled' => 'disabled',
        'style' => "");
    $attributes_city = array('name' => 'city',
        'class' => '', 'value' => $request_services['city'],
        'disabled' => 'disabled','style' => "");
    $attributes_postcode = array('name' => 'postcode','class' => '', 
        'value' => $request_services['postcode'], 'disabled' => 'disabled',
        'style' => "");
    $attributes_notes = array('name' => 'notes','class' => '', 
        'value' => $request_services['notes'],
        'style' => "height:30px; width:70px");

echo "<tr>";
    /* form open request services validator*/
    echo form_open('Admin_page_controller/validate_request_services');

            echo '<td><center>';
            echo form_input($attributes_services_request_id);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_services_request_number);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_service_id);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_service_categories);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_service_name);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_date);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_user_email);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_full_name);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_adress);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_city);
            echo '</center></td>';
            echo '<td><center>';
            echo form_input($attributes_postcode);
            echo '</center></td>';

            echo '<td><center>';
            echo form_dropdown('status', $options_status, 
                    $request_services['services_request_status']);
            echo '</center></td>';

            echo '<td><center>';
            echo form_textarea($attributes_notes);
            echo '</center></td>';


            echo "<td>";
            /* hidden form for needs of open form*/
            echo form_hidden('services_request_id',
                    $request_services['services_request_id']);
            echo form_hidden('services_request_number',
                    $request_services['services_request_number']);
            echo form_hidden('service_id', 
                    $request_services['service_id']);
            echo form_hidden('service_categories',
                    $request_services['service_categories']);
            echo form_hidden('service_name', $request_services['service_name']);
            echo form_hidden('date', $request_services['date']);
            echo form_hidden('user_email', $request_services['user_email']);
            echo form_hidden('full_name', $request_services['full_name']);
            echo form_hidden('adress', $request_services['adress']);
            echo form_hidden('city', $request_services['city']);
            echo form_hidden('postcode', $request_services['postcode']);

            echo form_hidden('table_name', 'services_request');
            echo form_submit('update_request_services_by_number', 'update', 
                    'class="update_button"');
            echo form_close();
            echo "</td>";

            echo '<td><center>';
            /* form open view request services of user*/
            echo form_open('Admin_page_controller/view_request_services_user');
            echo form_hidden('user_email', $request_services['user_email']);
            echo form_submit('shop_cart', 'view user', 'class="add_button"');
            echo form_close();
            echo '</center></td>';
            echo "</tr>";
        }
        ?>
        <?php
//----------------------------------------------------------------------------//
        ?>	
 </table>
    <br />
    <br />

    <table class="orders_table"  cellpadding="7" >

        <tr><ul>
            <h1 id="board">Dashboard</h1>
            <hr />
            <br />
        </ul>
        </tr>
        <tr >
        <ul>
            <h1 id="board">Finished Request services</h1>
        </ul>	
        </tr>
        <tr id="board" >

            <th>finished Request Id</th>
            <th>Services Request Id</th>
            <th>Services Request Number </th>
            <th>Service Id</th>
            <th>service categories Id</th>
            <th>Service Name</th>
            <th>Ordered On</th>
            <th>User email </th>
            <th>User name </th>
            <th>City</th>
            <th>Adress </th>
            <th>Postcard</th>
            <th>Status</th>
            <th>Notes</th>
            <th></th>


        </tr>

<?php
/* for each selected finished request service*/
foreach ($selected_finished_request_services as $finished_request_services) {
    /* attributes of forms*/
    $attributes_finished_finished_services_request_id = array(
        'name' => 'finishedServicesRequestId','class' => '', 
        'value' => $finished_request_services['finished_services_request_id'], 
        'disabled' => 'disabled','style' => " width:50px");
    $attributes_finished_services_request_id = array(
        'name' => 'servicesRequestId','class' => '', 
        'value' => $finished_request_services['services_request_id'], 
        'disabled' => 'disabled','style' => " width:50px");
    $attributes_finished_services_request_number = array(
        'name' => 'servicesRequestNumber','class' => '', 
        'value' => $finished_request_services['services_request_number'], 
        'disabled' => 'disabled', 'style' => "");
    $attributes_finished_service_id = array('name' => 'serviceId','class' => '',
        'value' => $finished_request_services['service_id'], 
        'disabled' => 'disabled', 'style' => "width:50px");
    $attributes_finished_service_categories = array(
        'name' => 'serviceCategories','class' => '', 
        'value' => $finished_request_services['service_categories'],
        'disabled' => 'disabled','style' => "");
    $attributes_finished_service_name = array('name' => 'serviceName',
        'class' => '', 'value' => $finished_request_services['service_name'],
        'disabled' => 'disabled','style' => "");
    $attributes_finished_date = array('name' => 'date',
        'class' => '', 'value' => $finished_request_services['date'], 
        'disabled' => 'disabled','style' => "height:20px; width:70px");
    $attributes_finished_user_email = array('name' => 'userEmail',
        'class' => '', 'value' => $finished_request_services['user_email'], 
        'disabled' => 'disabled','style' => "");
    $attributes_finished_notes = array('name' => 'notes','class' => '', 
        'value' => $finished_request_services['notes'],
        'style' => "height:30px; width:70px");
    $attributes_finished_full_name = array('name' => 'fullName',
        'class' => '', 'value' => $finished_request_services['full_name'], 
        'disabled' => 'disabled','style' => "");
    $attributes_finished_adress = array('name' => 'adress','class' => '', 
        'value' => $finished_request_services['adress'], 
        'disabled' => 'disabled','style' => "");
    $attributes_finished_city = array('name' => 'city',
        'class' => '', 'value' => $finished_request_services['city'],
        'disabled' => 'disabled','style' => "");
    $attributes_finished_postcode = array('name' => 'postcode','class' => '', 
        'value' => $finished_request_services['postcode'], 
        'disabled' => 'disabled','style' => "");

    echo "<tr>";
    /* form open update finished request services validator*/
    echo form_open('Admin_page_controller/'
            . 'validate_update_finished_request_services');


    echo '<td><center>';
    echo form_input($attributes_finished_finished_services_request_id);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_services_request_id);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_services_request_number);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_service_id);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_service_categories);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_service_name);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_date);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_user_email);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_full_name);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_adress);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_city);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_finished_postcode);
    echo '</center></td>';
    echo '<td><center>';
    echo form_dropdown('status', $options_status, 
            $finished_request_services['services_request_status']);
    echo '</center></td>';

    echo '<td><center>';
    echo form_textarea($attributes_finished_notes);
    echo '</center></td>';


    echo "<td>";
    /* hidden form for needs of open form*/
    echo form_hidden('finished_services_request_id', 
            $finished_request_services['finished_services_request_id']);
    echo form_hidden('services_request_id', 
            $finished_request_services['services_request_id']);
    echo form_hidden('services_request_number', 
            $finished_request_services['services_request_number']);
    echo form_hidden('service_id', $finished_request_services['service_id']);
    echo form_hidden('service_categories', 
            $finished_request_services['service_categories']);
    echo form_hidden('service_name', 
            $finished_request_services['service_name']);
    echo form_hidden('date', $finished_request_services['date']);
    echo form_hidden('user_email', $finished_request_services['user_email']);
    echo form_hidden('full_name', $finished_request_services['full_name']);
    echo form_hidden('adress', $finished_request_services['adress']);
    echo form_hidden('city', $finished_request_services['city']);
    echo form_hidden('postcode', $finished_request_services['postcode']);
    echo form_hidden('table_name', 'finished_services_request');
    echo form_submit('update_request_services_by_number', 'update',
            'class="update_button"');
    echo form_close();
    echo "</td>";

    echo '<td><center>';
    /* form open request services user view */
    echo form_open('Admin_page_controller/view_request_services_user');
    echo form_hidden('user_email', $finished_request_services['user_email']);
    echo form_submit('shop_cart', 'view user', 'class="add_button"');
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
            <h1 id="board">Dashboard</h1>
            <hr />
            <br />
        </ul>
        </tr>
        <tr >
        <ul>
            <h1 id="board">Cancelled Request services</h1>
        </ul>	
        </tr>
        <tr id="board" >
            <th>Cancelled Request Id</th>
            <th>Services Request Id</th>
            <th>Services Request Number </th>
            <th>Service Id</th>
            <th>service categories Id</th>
            <th>Service Name</th>
            <th>Ordered On</th>
            <th>User email </th>
            <th>User name </th>
            <th>City</th>
            <th>Adress </th>
            <th>Postcard</th>
            <th>Status</th>
            <th>Notes</th>
            <th></th>


        </tr>

<?php

/* for each selected cancelled request services */
foreach ($selected_cancelled_request_services as $cancelled_request_services) {
    /* attributes of forms*/
    $attributes_cancelled_cancelled_services_request_id = array(
        'name' => 'servicesRequestId','class' => '', 
        'value' => $cancelled_request_services['cancelled_services_request_id'],
        'disabled' => 'disabled','style' => " width:50px");
    $attributes_cancelled_services_request_id = array(
        'name' => 'servicesRequestId','class' => '', 
        'value' => $cancelled_request_services['services_request_id'], 
        'disabled' => 'disabled','style' => " width:50px");
    $attributes_cancelled_services_request_number = array(
        'name' => 'servicesRequestNumber','class' => '', 
        'value' => $cancelled_request_services['services_request_number'], 
        'disabled' => 'disabled','style' => "");
    $attributes_cancelled_service_id = array('name' =>'serviceId','class' => '',
        'value' => $cancelled_request_services['service_id'],
        'disabled' => 'disabled','style' => "width:50px");
    $attributes_cancelled_service_categories = array(
        'name' => 'serviceCategories','class' => '', 
        'value' => $cancelled_request_services['service_categories'], 
        'disabled' => 'disabled','style' => "");
    $attributes_cancelled_service_name = array('name' => 'serviceName',
        'class' => '', 'value' => $cancelled_request_services['service_name'],
        'disabled' => 'disabled','style' => "");
    $attributes_cancelled_date = array('name' => 'date',
        'class' => '', 'value' => $cancelled_request_services['date'], 
        'disabled' => 'disabled','style' => "height:20px; width:70px");
    $attributes_cancelled_user_email = array('name' => 'userEmail',
        'class' => '', 'value' => $cancelled_request_services['user_email'], 
        'disabled' => 'disabled','style' => "");
    $attributes_cancelled_notes = array('name' => 'notes',
        'class' => '', 'value' => $cancelled_request_services['notes'],
        'style' => "height:30px; width:70px");
    $attributes_cancelled_full_name = array('name' => 'fullName',
        'class' => '', 'value' => $cancelled_request_services['full_name'],
        'disabled' => 'disabled','style' => "");
    $attributes_cancelled_adress = array('name' => 'adress',
        'class' => '', 'value' => $cancelled_request_services['adress'], 
        'disabled' => 'disabled','style' => "");
    $attributes_cancelled_city = array('name' => 'city',
        'class' => '', 'value' => $cancelled_request_services['city'],
        'disabled' => 'disabled','style' => "");
    $attributes_cancelled_postcode = array('name' => 'postcode',
        'class' => '', 'value' => $cancelled_request_services['postcode'],
        'disabled' => 'disabled','style' => "");

    echo "<tr>";
    /* form open update cancelled request services validator */
    echo form_open('Admin_page_controller/'
            . 'validate_update_cancelled_request_services');

    echo '<td><center>';
    echo form_input($attributes_cancelled_cancelled_services_request_id);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_services_request_id);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_services_request_number);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_service_id);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_service_categories);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_service_name);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_date);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_user_email);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_full_name);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_adress);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_city);
    echo '</center></td>';
    echo '<td><center>';
    echo form_input($attributes_cancelled_postcode);
    echo '</center></td>';
    echo '<td><center>';
    echo form_dropdown('status', $options_status, 
            $cancelled_request_services['services_request_status']);
    echo '</center></td>';

    echo '<td><center>';
    echo form_textarea($attributes_cancelled_notes);
    echo '</center></td>';


    echo "<td>";
    /* hidden form for needs of open form*/
    echo form_hidden('cancelled_services_request_id', 
            $cancelled_request_services['cancelled_services_request_id']);
    echo form_hidden('services_request_id', 
            $cancelled_request_services['services_request_id']);
    echo form_hidden('services_request_number',
            $cancelled_request_services['services_request_number']);
    echo form_hidden('service_id', $cancelled_request_services['service_id']);
    echo form_hidden('service_categories', 
            $cancelled_request_services['service_categories']);
    echo form_hidden('service_name', 
            $cancelled_request_services['service_name']);
    echo form_hidden('date', $cancelled_request_services['date']);
    echo form_hidden('user_email', $cancelled_request_services['user_email']);
    echo form_hidden('full_name', $cancelled_request_services['full_name']);
    echo form_hidden('adress', $cancelled_request_services['adress']);
    echo form_hidden('city', $cancelled_request_services['city']);
    echo form_hidden('postcode', $cancelled_request_services['postcode']);

    echo form_hidden('table_name', 'cancelled_services_request');
    echo form_submit('update_request_services_by_number', 'update', 
            'class="update_button"');
    echo form_close();
    echo "</td>";

    echo '<td><center>';
    /* form open request services user view*/
    echo form_open('Admin_page_controller/view_request_services_user');
    echo form_hidden('user_email', $cancelled_request_services['user_email']);
    echo form_submit('shop_cart', 'view user', 'class="add_button"');
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