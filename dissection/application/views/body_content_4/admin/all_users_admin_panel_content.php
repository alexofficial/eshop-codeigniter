<center>
<?php
/*
 *  This php file is for admin all all users view
 */
//----------------------------------------------------------------------------//
/* echo form validator erros*/
echo "<center>" . validation_errors() . "</center>";
?>
    <div>
        <table class="" >
            <ul>
                <tr>
                <ul><br />
                    <h1 id="users_title">Users</h1>
                    <hr />
                    <br />
                </ul>	
                </tr>

            </ul>

            <tr id="users_title">
                <th>number</th>
                <th>Ονοματεπώνυμο</th>
                <th>Email</th>
                <th>Τρόπος Αποστολής</th>
                <th>Διεύθυνση</th>
                <th>Πόλη</th>
                <th>ΤΚ</th>
                <th>Σταθερό Τηλέφωνο</th>
                <th>Κινητό Τηλέφωνο</th>
            </tr>
            <?php
/* for each selected user echo details*/
foreach ($selected_users as $result) {
    /* attributes of forms*/
    $attributes_user_id = array('name' => 'id','class' => 'content_id_input',
        'value' => $result['id'], 'disabled' => 'disabled', 
        'style' => "height:20px; width:40px");
    $attributes_user_full_name = array('name' => 'fullName', 
        'class' => 'content_input', 'value' => $result['full_name']);
    $attributes_user_email = array('name' => 'email', 
        'class' => 'content_input', 'value' => $result['email']);
    $attributes_user_adress = array('name' => 'adress', 
        'class' => 'content_input', 'value' => $result['adress']);
    $attributes_user_city = array('name' => 'city', 'class' => 'content_input',
        'value' => $result['city'], 'style' => " width:100px;");
    $attributes_user_postcode = array('name' => 'postcode',
        'class' => 'content_input', 'value' => $result['postcode'], 
        'style' => " width:60px;");
    $attributes_user_phone_number = array('name' => 'phoneNumber',
        'class' => 'content_input', 'value' => $result['phone_number'], 
        'style' => " width:100px;");
    $attributes_user_mobileNumber = array('name' => 'mobileNumber',
        'class' => 'content_input', 'value' => $result['mobile_number'], 
        'style' => " width:100px;");
    
    /* dropdown options of user courier*/
    $options = array(
        'ELTA' => 'Elta Courier',
        'ACS' => 'ACS Courier',
        'SPEEDEX' => 'Speedex Courier',
    );


    echo '<tr>';
    /* attributes of forms*/
    $attributes_update_user = array('id' => 'update_user');
    /* form open for update user validator */
    echo form_open('admin_page_controller/update_user',$attributes_update_user);
    echo '<td>';
    echo form_input($attributes_user_id);
    echo '</td>';
    echo '<td>';
    echo form_input($attributes_user_full_name);
    echo '</td>';
    echo '<td>';
    echo form_input($attributes_user_email);
    echo '</td>';
    echo '<td>';
    echo form_dropdown('deliveryMethod', $options, $result['delivery_method'],
            'class="content_input"');
    echo '</td>';
    echo '<td>';
    echo form_input($attributes_user_adress);
    echo '</td>';
    echo '<td>';
    echo form_input($attributes_user_city);
    echo '</td>';
    echo '<td>';
    echo form_input($attributes_user_postcode);
    echo '</td>';
    echo '<td>';
    echo form_input($attributes_user_phone_number);
    echo '</td>';
    echo '<td>';
    echo form_input($attributes_user_mobileNumber);
    echo '</td>';
    echo '<td>';
    /* form submit */
    echo form_submit('update_user_submit', 'update', 'class="update_button"');
    echo form_close();
    echo '</td>';

    echo '<td>';
 /* attributes of forms*/
 $attributes_delete_user = array('id' => 'delete_user');
 /* form open for delete user validator*/
 echo form_open('admin_page_controller/delete_user', $attributes_delete_user);
 echo form_hidden('user_id', $result['id']);
 echo form_submit('delete_user_submit', 'delete user', 'class="delete_button"');
 echo form_close();
 echo '</td>';
echo "</tr>";
 }
            ?>

        </table>


    </div>
</center>
<br />
<br />
</header>
