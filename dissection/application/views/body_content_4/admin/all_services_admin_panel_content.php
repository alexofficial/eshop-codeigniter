<?php
/*
 *  This php file is for admin all services view
 */
//----------------------------------------------------------------------------//

/* echo form validator erros*/
echo "<center>" . validation_errors() . "</center>";
?>
<center>
    <table class="products_table">
        <tr id="products_color">
            <th>Id</th>
            <th>Categories id</th>
            <th>Categories</th>
            <th>Name</th>
            <th>Details</th>
            <th>Notes</th>
            <th>Price at work</th>
            <th>Price at home</th>
            <th></th>
            <th></th>
            <th></th>

        </tr>


        <?php
/* checks if selected services is null if dont moves next*/
if (!$selected_services == NULL) {
    /* foreach selected services echo details*/
    foreach ($selected_services as $result) {
        /* attributes of forms*/
        $attributes_service_id = array('name' => 'serviceId','class' => '', 
            'value' => $result['service_id'], 'disabled' => 'disabled',
            'style' => "height:20px; width:50px");
         $attributes_service_category_id = array('name' =>'serviceCategoriesId',
             'class' => 'content_input', 
             'value' => $result['service_categories_id'],
             'disabled' => 'disabled');
         $attributes_service_categories = array('name' => 'serviceCategories',
             'class' => 'content_input', 
             'value' => $result['service_categories'],'disabled' => 'disabled');
         $attributes_service_name = array('name' => 'serviceName',
             'class' => 'content_input', 'value' => $result['service_name']);
         $attributes_service_details = array('name' => 'serviceDetails',
             'class' => 'content_input', 'value' => $result['service_details'],
             'style' => " width:230px; height:70px");
         $attributes_service_notes = array('name' => 'serviceNotes',
             'class' => 'content_input', 'value' => $result['service_notes'],
             'style' => " width:230px; height:70px");
         $attributes_service_price_at_work = array(
             'name' => 'servicePriceAtWork','class' => 'content_input', 
             'value' => $result['service_price_at_work'],
             'style' => " width:50px");
         $attributes_service_price_at_home = array(
             'name' => 'servicePriceAtHome','class' => 'content_input',
             'value' => $result['service_price_at_home'],
             'style' => " width:50px");

    echo '<tr>';
                /* attributes of forms*/
                $attributes_update_product = array('id' => 'update_service');
    /* check if product_id is null if is do nothing*/            
    if ($result['service_id'] == "NULL") {
    
    /*else open form for update_service validator*/
    } else {
        echo form_open('admin_page_controller/update_service',
                $attributes_update_product);
                }

                echo '<td><center>';
                echo form_input($attributes_service_id);
                echo '</center></td>';
                echo '<td><center>';
                echo form_input($attributes_service_category_id);
                echo '</center></td>';
                echo '<td><center>';
                echo form_input($attributes_service_categories);
                echo '</td>';
                echo '<td><center>';
                echo form_input($attributes_service_name);
                echo '</center></td>';

                echo '<td><center>';
                echo form_textarea($attributes_service_details);
                echo '</center></td>';
                echo '<td><center>';
                echo form_textarea($attributes_service_notes);
                echo '</center></td>';
                echo '<td><center>';
                echo form_input($attributes_service_price_at_work);
                echo '</center></td>';
                
                echo '<td><center>';
                echo form_input($attributes_service_price_at_home);
                echo '</center></td>';

        /* hidden form for needs of open form functions*/   
        echo form_hidden('service_id', $result['service_id']);
        echo form_hidden('service_categories', $result['service_categories']);
    /* check if service_id is null.. if is echo null*/
    if ($result['service_id'] == "NULL") {
      echo '<td>NULL</td>';
    } else {
    /*
    *  else echo form submit.              
    */ 
      echo '<td>';
      echo form_submit('update_user_submit', 'update', 'class="update_button"');
      echo form_close();
      echo '</td>';
    }

/* check if service_id is null.. if is echo null*/
  if ($result['service_id'] == "NULL") {
    echo '<td>';
    echo "NULL";
    echo '</td>';
    echo "<th>";
    echo "NULL";
    echo "</th>";
    /*
    *  else form open delete service validator.              
    */ 
  } else {
    echo "<td>";
    echo form_open('Admin_page_controller/delete_service_by_id');
     /* hidden form for needs of open form functions*/   
    echo form_hidden('service_id', $result['service_id']);
    echo form_hidden('service_categories', $result['service_categories']);
    /* form submit*/
    echo form_submit('delete_service_by_id', 'delete', 'class="delete_button"');
    echo form_close();
    echo "</td>";
  }

echo "</tr>";
 }
        }
        ?>

    </table>

</center>

<br />
<br />
</header>


