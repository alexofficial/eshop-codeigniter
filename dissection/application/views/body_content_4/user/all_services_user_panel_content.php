<?php
/*
 * This php file is for view of logged user service panel
 */
?>
<center>
    <table class="services_css"  >
        <tr id="products_color" >
            
            <th>Name</th>
            <th>Details</th>
            <th>Notes</th>
            <th>Price(work)</th>
            <th>Price(home)</th>
            <th></th>
        </tr>
 <?php
/* here check if $selected_services exist */
if (!$selected_services == NULL) {
    /* if exist for each selected service echo details of services*/
    foreach ($selected_services as $result) {

    echo '<tr class="">';
	echo '<td>';
        echo $result['service_name'];
        echo '</td>';
        echo '<td>';
        echo $result['service_details'];
        echo '</td>';
        echo '<td>';
        echo $result['service_notes'];
        echo '</td>';

        echo '<td>';
        echo $result['service_price_at_work'].'€';
        echo '</td>';
        echo '<td>';
        echo $result['service_price_at_home'].'€';
        echo '</td>';
               
        echo "<th>";
        /* open form for add service to user*/
        echo form_open('User_page_controller/add_service_to_user');
        echo form_hidden('service_id', $result['service_id']);
        echo form_hidden('category', $category);
        echo form_hidden('service_name', $result['service_name']);
        echo form_submit('add_to_service_cart', 'Αίτηση', 'class="add_button"');
        echo form_close();
        echo "</th>";
        echo "</tr>";
    }
}else{
    
}
?>
</table>
        <br />
        <br />

</center>
<br />
</header>


