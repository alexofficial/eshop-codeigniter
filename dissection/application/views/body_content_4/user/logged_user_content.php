<?php
/*
 * This php file is for view of index page of logged user and have all deals
 * products
 */

/*@intental <=1 because we take at lease 1 empty result from data base so..
 * we have count 1*/
if(count($selected_products_deals) <= 1){
    
}else{   
/* foe each selected deal product echo details */
foreach ($selected_products_deals as $result) {
    ?>
    
    <div class="product_show">
    <header>
        <hgroup>
                    <h1><?php echo $result['product_name']; ?></h1>
                </hgroup>
            </header>
            <figure class="product_figure">
                <?php
            /*
            * we use correct Content-type and after with help of base64_encode
            * encode the image and then we print it.
            */  
            echo '<img  src="data:image/jpeg;base64,' 
                    . base64_encode($result['product_image'])
                    . '" height="240" width="240"  >';
                ?>
            </figure>
            <section class="product_section">
                <p><?php echo $result['product_name']; ?></p>
                <details>
                    <summary><b>Product Features</b></summary>

		<ul class="product_feutures">
		 <li>Enabled :&nbsp;
                    <?php
                    /*
                    * here checks if profucts is enabled or disabled
                    * and print it.
                    */
                    if ($result['product_enabled'] == 1) {
			$product_enabled = "yes";
			echo $product_enabled;
                    } else {
			$product_disabled = "no";
                    echo $product_disabled;
                    };
                    ?>
    </li>
    <li>Quantity:&nbsp;<?php echo $result['product_available_quantity']; ?></li>
    <li>Weight  :&nbsp;<?php echo $result['product_weight']; ?></li>
    <li>Category:&nbsp;<?php echo $result['product_categories']; ?></li>
		</ul>
                </details>
    <?php
    echo "&nbsp&nbsp";
    
    echo "<span class='product_price'><b>".$result['product_sale_price']
            ."</b>&nbsp€</span>";
    /*
    * form open for add a product to shop cart.
    */
    echo form_open('User_page_controller/add_to_shop_cart');
    /* some hidden parameters for add_to_sho_cart function needs*/
    echo form_hidden('product_id', $result['product_id']);
    echo form_hidden('category', $result['product_categories']);
    echo form_hidden('product_enabled', $product_enabled);
    echo form_submit('add_to_shop_cart', 'buy now','class="add_button"');
    echo form_close();
    ?> 
                
            </section>
        </div>
       

<?php }

}?>

    <hr> 
    <?php 
    /*
    * if dont have something to shop cart dont do nothing
    */
    if(!$this->cart->contents()){
		
    }
	else{
		
	
	?>
	    <center> 
    <?php 
    /*
    * if have someting in contents open form for show the shop cart
    */
    echo form_open('User_page_controller/update_shop_cart?category_name=' 
            . $result['product_categories']); ?>

   <table class="shop_cart_css">
            
            <tr>
                <th>QTY</th>
                <th>Item Description</th>
                <th style="text-align:right">Price</th>
                <th style="text-align:right">Total</th>
                <th></th>
            </tr>
            
            <?php
            
            $i = 1; ?>

  <?php foreach ($this->cart->contents() as $items): ?>
                
                <?php
                /* we must echo form hidden for want the update */
                echo form_hidden($i . '[rowid]', $items['rowid']); ?>
                <?php echo form_hidden($i . '[qty]', $items['qty']); ?>

                <tr>
                    <?php
                    ?>
                    <td><?php
                    echo form_input(
                    array('name' => $i . '[qty]',
                        'onchange' => 'jquery:message_qty_change();',
                        'value' => $items['qty'], 'maxlength' => '3',
                        'size' => '5'));
                    ?>
                    </td>
                    <td>
                    <?php echo "<strong> name: </strong> " . $items['name']; ?>

        <?php 
        /*check if item of cart shop has a option */
        if ($this->cart->has_options($items['rowid']) == TRUE): ?>
        <p>
        <?php 
        /*
        * if has a option for each item echo the name and value of option.
        */
        foreach ($this->cart->product_options($items['rowid']) 
        as $option_name => $option_value): ?>
        <strong><?php echo $option_name; ?>:
        </strong> <?php echo $option_value; ?>
        <?php endforeach; ?>
        </p>
        <?php endif; ?>

                    </td>
  <td style="text-align:right"><?php 
        /* is a format for float numbers*/
        echo $this->cart->format_number($items['price']); ?></td>
  <td style="text-align:right">$<?php 
        /* is a format for float numbers*/
        echo $this->cart->format_number($items['subtotal']); ?></td>

   <?php
   /* this code if for delete a cart shop item spesifically*/
   echo"<th>" . anchor('User_page_controller/remove_item_from_cart?rowid='
      . $items['rowid'] . '&category_name=' . $option_value, 'X') . "</th>"; ?>
                </tr>



                <?php
                /*number of how items we have for later use.*/
                $i++; ?>

  <?php endforeach; ?>

            <tr>
               <td colspan="2"> </td>
               <td class="right"><strong>Total</strong></td>
               <td class="shop_cart_css_total">&euro;<?php
               /* echo the total of all shop cart with help if cart helper 
                * fuction total().
                */
               echo $this->cart->format_number($this->cart->total()); ?></td>
            </tr>

        </table>

    <p><?php
//----------------------------------------------------------------------------//
    echo "<div class='test_1'>";    
    echo form_hidden('i', $i);
    echo form_submit('', 'Save your Cart','class="add_button"');
    echo form_close();
    ?></p>
    <?php
//----------------------------------------------------------------------------//
    echo "<th>";
    echo form_open('User_page_controller/final_shop_add');
    /*form open for final shop add*/
    echo form_hidden('category', $result['product_categories']);
    echo form_submit('final_shop_add','Finish shop','class="delete_button"');
    echo form_close();
    echo "</th>";
//----------------------------------------------------------------------------//
    echo "<th>";
    /*form open for clear shop cart*/
    echo form_open('User_page_controller/clear_cart_shop');
    echo form_hidden('category', $result['product_categories']);
    echo form_submit('clear_cart', 'Clear Cart','class="update_button"');
    echo form_close();
    echo "</th>";
    echo "</tr>";
    echo "</div>";
//----------------------------------------------------------------------------// 
        ?>


</center>
<?php }?>
</header>


    <?php
    ?>

