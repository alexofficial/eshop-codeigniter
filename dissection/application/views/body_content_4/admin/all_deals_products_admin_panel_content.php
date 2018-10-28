<?php
/*
 *  This php file is for admin all deals products view.
 */
//----------------------------------------------------------------------------//

/* echo form validator erros*/
echo "<center>" . validation_errors() . "</center>";
?>
<center>
    <table class="products_table">
        <tr id="products_color">
            <th>deals_products_id</th>
            <th>Id</th>
            <th>Name</th>
            <th>Enabled</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Weight</th>
            <th>Price</th>
            <th>Sale price</th>
            <th>Categories</th>
            <th>Image</th>
            <th></th>
            <th></th>
            <th></th>

        </tr>
<?php
/* check if selected deals products isnt null*/
 if (!$selected_products_deals == NULL) {
     /* if isnt null for each selected deal product echo details */
    foreach ($selected_products_deals as $result) {
    
    /* attributes of forms*/       
    $attributes_deals_products_id= array('name' => 'dealsProductsId',
        'class' => 'content_id_input', 'value' => $result['deals_products_id'],
        'disabled' => 'disabled','style' => "height:20px; width:50px");
    $attributes_product_id = array('name' => 'productId',
        'class' => 'content_id_input', 'value' => $result['product_id'],
        'disabled' => 'disabled','style' => "height:20px; width:50px");
    $attributes_product_name = array('name' => 'productName',
        'class' => 'content_input', 'value' => $result['product_name']);
    $attributes_product_description = array('name' => 'productDescription',
        'class' => 'content_input', 'value' => $result['product_description']);
    $attributes_product_available_quantity = array(
        'name' => 'productAvailableQuantity','class' => 'content_input', 
        'value' => $result['product_available_quantity'],
        'style' => "height:20px; width:50px");
    $attributes_product_weight = array('name' => 'productWeight',
        'class' => 'content_input', 'value' => $result['product_weight'], 
        'style' => "height:20px;width:50px");
    $attributes_product_price = array('name' => 'productPrice',
        'class' => 'content_input', 'value' => $result['product_price'], 
        'style' => "height:20px; width:50px");
    $attributes_product_sale_price = array('name' => 'productSalePrice',
         'class' => 'content_input', 'value' => $result['product_sale_price'], 
        'style' => "height:20px;width:50px");
    $attributes_product_categories = array('name' => 'productCategories',
        'class' => 'content_id_input', 'value' => $result['product_categories'],
        'disabled' => 'disabled','style' => "  width:150px");
    
     /* selected product id*/   
    $id = $result['product_id'];
    
    /* option for dropdown menu*/
    $options = array(
        1 => 'Yes',
        0 => 'no'
    );

                echo '<tr>';
                /* attributes of forms*/ 
               
                
                echo '<td><center>';
                echo form_input($attributes_deals_products_id);
                echo '</center></td>';    
                echo '<td><center>';
                echo form_input($attributes_product_id);
                echo '</center></td>';
                echo '<td><center>';
                echo form_input($attributes_product_name);
                echo '</center></td>';
                echo '<td><center>';
                echo form_dropdown('productEnabled', $options,
                        $result['product_enabled'], 'class="content_input"');
                echo '</center></td>';
                echo '<td><center>';
                echo form_input($attributes_product_description);
                echo '</td>';
                echo '<td><center>';
                echo form_input($attributes_product_available_quantity);
                echo '</center></td>';

                echo '<td><center>';
                echo form_input($attributes_product_weight);
                echo '</center></td>';
                echo '<td><center>';
                echo form_input($attributes_product_price);
                echo '</center></td>';
                echo '<td><center>';
                echo form_input($attributes_product_sale_price);
                echo '</center></td>';
                ;
                echo '<td><center>';
                echo form_input($attributes_product_categories);
                echo '</center></td>';

                echo '<td>';
                echo '<div class="product_images" >';
                
                /*
                * we use correct Content-type and after with help of
                *  base64_encode encode the image and then we print it.
                */  
                echo '<img  src="data:image/jpeg;base64,' .
                base64_encode($result['product_image']) 
                        . '" height="60" width="60"  >';
            
                echo '</div >';
                echo '</td>';

/* check if product id is null if is echo null*/
 if ($result['product_id'] == "NULL") {
    echo '<td>';
    echo "NULL";
    echo '</td>';
    echo "<th>";
    echo "NULL";
    echo "</th>";
/* if isnt null echo form open for delete deals products validator*/
  } else {

    echo "<td>";
    echo form_open('Admin_page_controller/delete_deals_product_by_id');
    /* hidden form for needs of open form*/
    echo form_hidden('deals_products_id', $result['deals_products_id']);
    echo form_hidden('product_categories', $result['product_categories']);
    /* submit button of delete a deal product*/
    echo form_submit('delete_product_by_id', 'delete', 'class="delete_button"');
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


