 <?php
/* 
 *  This php file is for admin view spesifically shop cart order.
 */ 
 ?>
<center>
<table class="shop_cart_css">

<tr>
  <th>QTY</th>
  <th>Item Description</th>
  <th style="text-align:right">Item Price</th>
  <th style="text-align:right">Sub-Total</th>
</tr>

<?php $i = 1; ?>

<?php
/*for each content on shop cart print all details*/
foreach ($this->cart->contents() as $items): ?>
  
<tr>
	  <td><?php echo form_input(
                  array('name' =>  $i.'[qty]',
                      'value' => $items['qty'] ,'maxlength' => '3',
                      'size' => '5')); ?>
          </td>
	  <td>
              
    <?php echo "<strong> name: </strong> ".$items['name']; ?>
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
	  
	</tr>
	

       
    <?php 
    /*number of how items we have for later use.*/
    $i++; ?>

<?php endforeach; ?>

    <tr>
      <td colspan="2"> </td>
      <td class="right"><strong>Total</strong></td>
      <td class="right">$<?php 
      /* echo the total of all shop cart with help if cart helper 
      * fuction total().
      */
      echo $this->cart->format_number($this->cart->total()); ?></td>
    </tr>

</table>

<?php 

	
		
?>


</center>
 <br />
</header>
		<?php 
		
    	 ?>

