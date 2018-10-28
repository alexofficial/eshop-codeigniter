<?php
/*
 *  This php file is for view of recovery password of no logged user
 */
/* print errors if something wrong with validator*/
echo "<span id='validators_color'>" . validation_errors() . "</span>";

/* attributes of forms*/
$attributes_register_password = array('name' => 'password', 'id' => '',
    'placeholder' => 'password');
$attributes_register_cpassword = array('name' => 'cPassword', 'id' => '',
    'placeholder' => 'password');
//----------------------------------------------------------------------------//
?>
<table id="label_color">

    <?php
    echo "<tr>";
        /* form open for add a new password validator*/
        echo form_open('home_page_controller/add_new_password_validator');
        echo "<center>";

            echo form_password($attributes_register_password);

            echo form_password($attributes_register_cpassword);
            /* is the key of password recovery*/
            echo form_hidden('key',$key);
            /*button of add a new password*/
            echo form_submit('password_recovery_validator', 'save passowrd',
                    'class="register_button"');
            echo form_close();
        echo "</center>";
    echo "</tr>";
//----------------------------------------------------------------------------//
    ?>


</table>

</center>		
</header>


<br />
