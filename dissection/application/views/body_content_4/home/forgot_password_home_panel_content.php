<?php
/* This php file is for home page view of user forgot password */
//----------------------------------------------------------------------------//
?>
<?php
echo "<span id='validators_color'>" . validation_errors() . "</span>";
/* attrubutes of forms */
$attributes_email = array('name' => 'email',
    'class' => 'content_order_check_input', 'placeholder' => 'type your email');
/* This php file is for home page view of user forgot password */
?>
<table id="label_color">

    <?php
    echo "<td>";
    echo "<tr>";
    /* open form password recovery validator */
    echo form_open('home_page_controller/password_recovery_validator');
    echo "<center>";
    echo form_input($attributes_email);
    /* submit of password recovery */
    echo form_submit('password_recovery_validator', 'send',
            'class="register_button"');
    echo form_close();
    echo "</center>";

    echo "</td>";

    echo "</tr>";
    ?>
</table>

</center>		
</header>


<br />
