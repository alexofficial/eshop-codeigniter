<?php
/*
 * This php file is for view of user contacts
 */

//----------------------------------------------------------------------------//

/* for each user contact echo details of contact */
foreach($user_contacts as $contact){

    /*attributes for forms*/	 		 	
    $attributes_Email = array('name'=>'email','class' =>'',
        'value'=>$contact['email_from'],'disabled'=>'disabled');
    $attributes_contact_message = array('name'=>'message','class' =>'',
        'value'=>$contact['message'],'style'=>"height:130px; width:570px");
    $attributes_answer_message = array('name'=>'message','class' =>'',
        'value'=>$contact['answer'],'style'=>"height:130px; width:570px");
?>
    <table id="label_color">

<?php   
//----------------------------------------------------------------------------//
    /*open form contact delete validator*/         
    echo form_open('User_page_controller/contact_delete_view');
	echo "<tr>";
            echo "<td>";
		echo "<center>";
                echo "Email:";
                echo "</center>";
                echo "<center>";
                echo form_input($attributes_Email,'','class="register_input"');
                echo "</center>";			          	
            echo "</td>";  		
		       
            echo "<td>";
		echo "<center>";
                echo "Contact Message:";
                echo "</center>";
                echo "<center>";
                echo form_textarea($attributes_contact_message);
                echo "</center>";
			          	
            echo "</td>";  
			       
            echo "<td>";
		echo "<center>";
                echo "Answer Message:";
                echo "</center>";
                echo "<center>";
                echo form_textarea($attributes_answer_message);
                echo "</center>";		
            echo "</td>";  
                                 
            echo "<td>";
		echo "<center>";
                /*for hidden form is for take the contact id for delete it*/
                echo form_hidden('contact_id', $contact['contact_id']);
                echo form_submit('delete_submit','delete',
                        'class="delete_button"');
                echo form_close();
                echo "</center>";
            echo "</td>";  	
	echo "</tr>"; 
//----------------------------------------------------------------------------//		        
		       		
    echo "<hr >";
 }  
?>
    </table>
 </center>		
</header>
    
    
 <br />
