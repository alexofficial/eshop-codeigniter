<?php 
/*
 *  This php file is for admin all categories view
 */
/* validator error if add categories validator have error*/
echo validation_errors(); ?>
<br />
<center>
    <table  class="category_table" >
        <tr id="category_color">
            <th>Category ID</th>
            <th>Product Category Name</th>

        </tr>
        <?php
        /* form attributes*/
        $attributes_input_category_id = array('name' => 'categoryId',
            'id' => '','placeholder' => 'auto', 'disabled' => 'disabled');
        $attributes_input_category_name = array('name' => 'categoryName', 
            'id' => '', 'placeholder' => 'name');
        $attributes_add_category = array('id' => 'add_category');

/* open form for add category validator*/
echo form_open('admin_page_controller/add_category', $attributes_add_category);
       echo '<td><center>';
       echo form_input($attributes_input_category_id);
       echo '</center></td>';
       echo '<td><center>';
       echo form_input($attributes_input_category_name);
       echo '</center></td>';
       echo '<td><center>';
       echo form_submit('add_category_submit', 'add new', 'class="add_button"');
       echo '</center></td>';
echo form_close();
    /* for each selected categories echo detalis of categories*/
    foreach ($selected_categories as $result) {


    $attributes_category = array('id' => 'update_category');
    /* form open for update category validator*/
    echo form_open('admin_page_controller/update_category',
            $attributes_category);
        $attributes_input_product_categories = array('name' =>'categoryName',
            'id' => '', 'value' => $result['product_categories']);

        echo '<tr >';
        echo '<td id="category_background_color"><center>';
        echo $result['product_categories_id'];
        echo '</center></td>';
        echo '<td id="category_background_color"><center>';
        echo form_input($attributes_input_product_categories);
        echo '</center></td>';
        
        echo '<td>';
        echo '<center>';

        /* hidden form for needs of open form*/
        echo form_hidden('product_categories', 
                $result['product_categories']);   
        echo form_hidden('product_categories_id',
                $result['product_categories_id']);
        echo form_submit('update_category_submit', 'update',
                'class="update_button"');
    echo form_close();
            

        echo '</center>';
        echo '</td>';
        
        echo '<td>';
        echo '<center>';

        $attributes_category = array('id' => 'delete_category');
        /* form open for delete a category validator*/
        echo form_open('admin_page_controller/delete_category',
                    $attributes_category);
        /* hidden form for needs of open form*/
        echo form_hidden('product_categories', $result['product_categories']);
        /* submit button of delete a category*/
        echo form_submit('delete_category_submit', 'delete',
                'class="delete_button"');
        echo form_close();

        echo '</center>';
        echo '</td>';

        echo '</tr>';
}
        ?>

    </table>
    <br />
    <hr>
    <table  class="category_table" >
        <tr id="category_color">
            <th>Category ID</th>
            <th>Services Category Name</th>

        </tr>
        <?php
        /* form attributes*/
        $attributes_input_category_id = array('name' => 'categoryServiceId',
            'id' => '','placeholder' => 'auto', 'disabled' => 'disabled');
        $attributes_input_category_name = array('name' => 'categoryServiceName'
            , 'id' => '', 'placeholder' => 'name');
        $attributes_add_category = array('id' => 'add_category');
    /* form open for add service category validator*/    
    echo form_open('admin_page_controller/add_service_category', 
            $attributes_add_category);
       echo '<td><center>';
       echo form_input($attributes_input_category_id);
       echo '</center></td>';
       echo '<td><center>';
       echo form_input($attributes_input_category_name);
       echo '</center></td>';
       echo '<td><center>';
       echo form_submit('add_category_submit', 'add new', 'class="add_button"');
       echo '</center></td>';
       echo form_close();
        /* for each selected services categories echo details of services 
         * categories*/
        foreach ($selected_services_categories as $result) {

         /* form attributes*/   
         $attributes_services_category = array('id' => 
             'update_services_category');
             /* for open for update */
            echo form_open('admin_page_controller/update_services_category', 
                    $attributes_category);
            /* form attributes*/ 
            $attributes_input_services_categories = array(
                'name' => 'serviceName', 
                'id' => '', 'value' => $result['service_categories']);

            echo '<tr >';
            echo '<td id="category_background_color"><center>';
            echo $result['service_categories_id'];
            echo '</center></td>';
            echo '<td id="category_background_color"><center>';
            echo form_input($attributes_input_services_categories);
            echo '</center></td>';

            echo '<td>';
            echo '<center>';
            /* hidden form for needs of open form*/
            echo form_hidden('service_categories', 
                    $result['service_categories']);
            echo form_hidden('service_categories_id', 
                    $result['service_categories_id']);
            echo form_submit('update_category_submit', 
                    'update', 'class="update_button"');
            echo form_close();

            echo '</center>';
            echo '</td>';

            echo '<td>';
            echo '<center>';
            /* form attributes*/ 
            $attributes_category = array('id' => 'delete_service_category');
            /*form open for delete service catagory validator */
            echo form_open('admin_page_controller/delete_service_category',
                    $attributes_category);
             /* hidden form for needs of open form*/
            echo form_hidden('service_categories',
                    $result['service_categories']);
            /* submit of delete service category*/
            echo form_submit('delete_service_category_submit', 'delete', 
                    'class="delete_button"');
            echo form_close();

            echo '</center>';
            echo '</td>';

            echo '</tr>';
        }
        ?>

    </table>
</center>
<br />
<hr>
</header>
