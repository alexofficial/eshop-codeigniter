<?php
/* This php file is for home page view of deals products */
//----------------------------------------------------------------------------//
/*
 * @intental <=1 because we take at lease 1 empty result from data base so.. 
 * we have count 1
 */
if(count($selected_products_deals) <= 1){
    
}else{   
    /* for each selected deal product echo details*/
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
            echo '<img  src="data:image;base64,' 
    . base64_encode($result['product_image']) . '" height="270" width="270" >';
            ?>
        </figure>
        <section class="product_section">
            
            <details>
                <summary>Product Features</summary>
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
            echo "<span class='product_price'><b>" 
            . $result['product_sale_price'] . "</b>&nbsp"
            /* symbol of euro*/?>
            &euro;
            <?php
            "</span>";

        ?> 
 </section>
</div>
       

<?php } 

    
}
?>

  



</header>


    <?php
    ?>

