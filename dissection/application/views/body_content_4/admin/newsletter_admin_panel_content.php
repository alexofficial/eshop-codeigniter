<?php
/*
 *  This php file is for admin newletter.
 */
//----------------------------------------------------------------------------//

/* for each selected user contact echo details*/
echo "<span id='validators_color'>" . validation_errors() . "</span>";

/* attributes of forms*/
$attributes_subject = array('name' => 'subject', 'class' => '', 'value' => '', 
    'style' => "height:130px; width:370px");
$attributes_email_message = array('name' => 'message', 'class' => '', 
    'value' => '', 'style' => "height:430px; width:570px");
?>


<table id="label_color">

<?php
/* form open for newsletters validator*/
echo form_open('Admin_page_controller/newsletters_validator');

echo "<tr>";
    echo "<td>";
    echo "<center>";
    echo "Subject:";
    echo "</center>";
    echo "<center>";
    echo form_textarea($attributes_subject);
    echo "</center>";
    echo "</td>";
echo "</tr>";

echo "<tr>";
    echo "<td>";
    echo "<center>";
    echo "Email Message:";
    echo "</center>";
    echo "<center>";
    echo form_textarea($attributes_email_message);
    echo "</center>";
    echo "</td>";
echo "</tr>";

echo "<tr>";
    echo "<td>";
    echo "<br />";
    echo "<br />";
    echo "<center>";
    /* submite button*/
    echo form_submit('NewsLetters_submit', 'Send NewsLetters', 
            'class="register_button"');
    echo form_close();
    echo "</center>";
    echo "</td>";
echo "</tr>";
?>


</table>






<hr >          	  

</table>

</center>		
</header>


<br />
