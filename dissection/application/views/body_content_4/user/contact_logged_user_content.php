<?php
/*
 * This php file is for view of user contacts
 */
/*here echo validator erros if is something wrong*/
echo   "<span id='validators_color'>".validation_errors()."</span>";
	         
/*attributes for forms */	     
$attributes_Email = array('name'=>'email','class' =>'','value'=>$user_email,
    'disabled'=>'disabled');
$attributes_contact_message = array('name'=>'message','class' =>'','value'=>'',
    'style'=>"height:430px; width:570px");
	       

	          ?>

<table id="label_color">
<?php
    /*open form contact validator*/
	echo form_open('User_page_controller/contact_validator');
	    echo "<tr>";
                echo "<td>";
                echo "<center>";
                echo "Email:";
                echo "</center>";
                echo "<center>";
                echo form_input($attributes_Email,'','class="register_input"');
                echo "</center>";
                echo "</td>";  		
            echo "</tr>"; 
		        
            echo "<tr>";
		echo "<td>";
                echo "<center>";
                echo "Contact Message:";
                echo "</center>";
                echo "<center>";
                echo form_textarea($attributes_contact_message);
                echo "</center>";			          	
                echo "</td>";  		
            echo "</tr>"; 
		        
		       
            echo "<tr>";
		echo "<td>";
                echo "<br />";
                echo "<br />";               
                echo "<center>";
                echo form_submit('Contact_submit','Contact',
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
