<?php
/*
 *  This php file is for admin user contacts
 */
//----------------------------------------------------------------------------//

/* for each selected user contact echo details*/
foreach($selected_users_contacts as $contact){
/* checks if status is not done echo this details*/    
if(!($contact['message_status']=='done')){
        /* attributes of forms*/
	$attributes_id = array('name'=>'email','class' =>'',
            'value'=>$contact['contact_id'],'disabled'=>'disabled');
        $attributes_Email = array('name'=>'email','class' =>'',
            'value'=>$contact['email_from'],'disabled'=>'disabled');
        $attributes_contact_message = array('name'=>'message','class' =>'',
            'value'=>$contact['message'],'disabled'=>'disabled',
            'style'=>"height:130px; width:570px");
        $attributes_answer_message = array('name'=>'answer','class' =>'',
            'value'=>$contact['answer'],'style'=>"height:130px; width:570px");
?>
<table id="label_color">
<?php
/* form open contact answer validator */
echo form_open('Admin_page_controller/contact_answer_validator');   
    echo "<tr>";
	echo "<td>";
            echo "<center>";
            echo "ID:";
            echo "</center>";
            echo "<center>";
            echo form_input($attributes_id,'','class="register_input"');
            echo "</center>";
        echo "</td>";  		
		      
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
            /* hidden form for needs of open form functions*/ 
            echo form_hidden('contact_id', $contact['contact_id']);
            echo form_hidden('email_from', $contact['email_from']);
            /* form submit */
            echo form_submit('answer_submit','answer','class="add_button"');
            echo form_close();
            echo "</center>";
        echo "</td>";  	
			        	
    echo "</tr>"; 
 echo "<hr >";
 
 }else{

 }
}  
          	  ?>
      	  
          	   
          	  </table>
          	  
      </center>		
      </header>
    
    
 <br />
