<center >
<?php
/*
 *  This php file is for admin add product view.
 */
//----------------------------------------------------------------------------//

/* for each selected user contact echo details*/
echo   "<span id='validators_color'>".validation_errors()."</span>";
   
    /* attributes of forms*/	
    $attributes_product_name = array('name'=>'productName','id' =>'',
        'placeholder'=>'product name..' );
    $attributes_dropdown_product_enabled = array(true => 'yes',false => 'no');
    $attributes_textarea_description = array('name'=> 'productDescription',
        'class'=> 'product_text_area','maxlength'=> '550');
   $attributes_product_available_quantity = array(
       'name'=>'productAvailableQuantity','id' =>'',
       'placeholder'=>'product name..' );
    $attributes_product_Weight = array('name'=>'productWeight','id' =>'',
        'placeholder'=>'product weight..' );
    $attributes_product_price = array('name'=>'productPrice','id' =>'',
        'placeholder'=>'product price..' );
    $attributes_product_sale_price = array('name'=>'productSalePrice','id' =>'',
        'placeholder'=>'product sales price..' );

/* for each selected categories */
foreach($selected_categories as $result) {
     /* data is all products categories for later user*/   
     $data[] = array(
        $result['product_categories'] => $result['product_categories']);			  
		}
             	
	         
?>
<table class="product_table"  id="add_products_color" >
<?php
/* form open for add product validator*/
echo form_open('Admin_page_controller/add_product');
    echo "<tr>";
	echo "<td>";
           echo "<center>";
           echo "<b><h2>Item Name:</h2></b>";
           echo "</center>";
           echo "<center>";
           echo form_input($attributes_product_name,'','class="content_input"');
           echo "</center>";
           echo "</td>";  		
    echo "</tr>"; 

    echo "<tr>";
        echo "<td>";
            echo "<center>";
            echo "<b><h2>Enabled:</h2></b>";
            echo "</center>";
            echo "<center>";
            echo form_dropdown('productEnabled',
            $attributes_dropdown_product_enabled,'yes','class="content_input"');
            echo "</center>";
    echo "</td>";  		

    echo "</tr>";  
        echo "<tr>";
            echo "<td>";
            echo "<center>";
            echo "<b><h2>Add description:</h2></b>";
            echo "</center>";
            echo "<center>";
            echo form_textarea($attributes_textarea_description,'',
                    'content_input');
            echo "</center>";
            echo "</td>";  		
    echo "</tr>"; 	

    echo "<tr>";
        echo "<td>";
            echo "<center>";
            echo "<b><h2> Available Quantity:</h2></b>";
            echo "</center>";
            echo "<center>";
            echo form_input($attributes_product_available_quantity,'',
                    'class="content_input"');
            echo "</center>";
        echo "</td>";  		
    echo "</tr>";
         
    echo "<tr>";
            echo "<td>";
            echo "<center>";
            echo "<b><h2>  Weight:</h2></b>";
            echo "</center>";
         echo "<center>";
         echo form_input($attributes_product_Weight,'','class="content_input"');
         echo "</center>";
         echo "</td>";  		
     echo "</tr>";

     echo "<tr>";
        echo "<td>";
            echo "<center>";
            echo "<b><h2> Price:</h2></b>";
            echo "</center>";
            echo "<center>";
          echo form_input($attributes_product_price,'','class="content_input"');
            echo "</center>";
        echo "</td>";  		
    echo "</tr>";
    
    echo "<tr>";
        echo "<td>";
            echo "<center>";
            echo "<b><h2> Sale Price:</h2></b>";
            echo "</center>";
            echo "<center>";
            echo form_input($attributes_product_sale_price,'',
                    'class="content_input"');
            echo "</center>";
        echo "</td>";  		
    echo "</tr>";

    echo "<tr>";
        echo "<td>";
            echo "<center>";
            echo "<b><h2> Category:</h2></b>";
            echo "</center>";
            echo "<center>";
            /* here we add data of categories*/
            echo form_dropdown('productCategories',$data,'',
                    'class="content_input"');
            echo "</center>";
        echo "</td>";  		
    echo "</tr>";
    
 echo "<tr>";
    echo "<td>";
    echo "<center>";
    /* submit button*/
    echo form_submit('add_product_submit','Add Product','class="add_button"');
    echo form_close();
    echo "</center>";
    echo "</td>";  		
 echo "</tr>";
?>
 </table>  
</center> 

 <br />
</header>