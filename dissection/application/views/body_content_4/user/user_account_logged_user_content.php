    
 <?php
/* 
 *  This php file is for view of user account of a user 
 */ 	
foreach ($user_account as $user) {
                /*
                * this code is for attributes of forms inputs,dropdown\
                * and others forms
                */ 
	        $attributes_user_email = array('name' => 'userEmail',
		        'class' => '', 'value' => $user['email'], 
                        'disabled' => 'disabled','style' => "");  
                $attributes_full_name = array('name' => 'userFullName',
		        'class' => '', 'value' => $user['full_name'], 
		        'style' => "");  
                $attributes_adress = array('name' => 'userAdress',
		        'class' => '', 'value' => $user['adress'], 
		        'style' => "");  
                $attributes_city = array('name' => 'userCity',
		        'class' => '', 'value' => $user['city'], 
		        'style' => "");  
                $attributes_postcode = array('name' => 'userPostcode',
		        'class' => '', 'value' => $user['postcode'], 
		                    'style' => "");  
                $attributes_phone = array('name' => 'userPhone',
		        'class' => '', 'value' => $user['phone_number'], 
		        'style' => "");  
                $attributes_mobile_phone = array('name' => 'userMobilePhone',
		        'class' => '', 'value' => $user['mobile_number'], 
		        'style' => "");  
                /*
                * options is for dropdown items. 
                */  
                $options = array(
                  'ELTA'      => 'Elta Courier',
                  'ACS'       => 'ACS Courier',
                  'SPEEDEX'   => 'Speedex Courier',
                );
                
                
/* echo errors if something wrong */           
echo   "<span id='validators_color'>".validation_errors()."</span>";
?>
<!----------------------------------------------------------------------------->
<table id="label_color">
<?php
	echo "<tr>";
            echo "<td>";
		echo "<center>";
                echo " <hr ><b><h3>Στοιχεία του χρήστη.". "</h3></b> <hr >";
		echo "</center>";	          	
	echo "</tr>"; 
		        
/* here open a form for update user account validator*/  	          
echo form_open('User_page_controller/update_user_account_validator');
	         
	          	
	echo "<tr>";
            echo "<td>";
            echo "<center>";
            echo "Email:";
            echo "</center>";
            echo "<center>";
            echo form_input($attributes_user_email,'','class="register_input"');
            echo "</center>";
			          	
            echo "</td>";  		
	echo "</tr>"; 		
?>
<!----------------------------------------------------------------------------->
	          
<?php
	          
echo "<tr>";
	echo "<td>";
	echo "<center>";
	echo " <hr ><b><h3>Στοιχεία αποστολής.</h3></b> <hr >";
	echo "</center>";
	echo "</td>";  		
echo "</tr>"; 
		        
echo "<tr>";
        echo "<td>";
	echo "<center>";
            echo "*Τρόπος Αποστολής:";
        echo "</center>";
	echo "<center>";
	echo form_dropdown('userCourier', $options, $user['delivery_method'],
                'class="register_input"');
	echo "</center>";
        echo "</td>";  		
	 echo "</tr>"; 
		     echo "<tr>";
		          	echo "<td>";
		          		echo "<center>";
			          	echo "*Ονοματεπώνυμο :";
			          	echo "</center>";
			          	echo "<center>";
			          	  echo form_input($attributes_full_name,
                                                  '','class="register_input"');
			          	echo "</center>";
			          	
			        echo "</td>";  		
		        echo "</tr>"; 
                
          	   echo "<tr>";
		          	echo "<td>";
		          		echo "<center>";
			          	echo "*Διεύθυνση :";
			          	echo "</center>";
			          	echo "<center>";
			          	  echo form_input($attributes_adress,'',
                                                  'class="register_input"');
			          	echo "</center>";
			          	
			        echo "</td>";  		
		        echo "</tr>"; 
                
                
                 echo "<tr>";
		          	echo "<td>";
		          		echo "<center>";
			          	echo "*Πόλη :";
			          	echo "</center>";
			          	echo "<center>";
			          	  echo form_input($attributes_city,'',
                                                  'class="register_input"');
			          	echo "</center>";
			          	
			        echo "</td>";  		
		        echo "</tr>";  
                        
	          echo "<tr>";
		          	echo "<td>";
		          		echo "<center>";
			          	echo "*ΤΚ :";
			          	echo "</center>";
			          	echo "<center>";
			          	  echo form_input($attributes_postcode,
                                                  '','class="register_input"');
			          	echo "</center>";
			        echo "</td>";  		
		        echo "</tr>"; 
	        
			 echo "<tr>";
		          	echo "<td>";
		          		echo "<center>";
			          	echo "*Σταθερό Τηλέφωνο :";
			          	echo "</center>";
			          	echo "<center>";
			          	  echo form_input($attributes_phone,'',
                                                  'class="register_input"');
			          	echo "</center>";
			        echo "</td>";  		
		        echo "</tr>"; 
	          
	         echo "<tr>";
		          	echo "<td>";
                                       echo "<center>";
			               echo "Κινητό Τηλέφωνο :";
			               echo "</center>";
			               echo "<center>";
			               echo form_input($attributes_mobile_phone,
                                               '','class="register_input"');
			               echo "</center>";	
			        echo "</td>";  		
		        echo "</tr>"; 
				
				
	              echo "<tr>";
		          	echo "<td>";
		          	echo "<br />";
			     	echo "<br />";
                                    echo "<center>";
                                    echo form_hidden('email',$user['email']);
                                    /* here is the submit button */  
                                    echo form_submit('update_submit','update',
                                            'class="register_button"');
			          	echo form_close(); 
			          	echo "</center>";
			          	
			        echo "</td>";  	
			      
		         echo "</tr>"; 
	     
}         	  
?>   
          	  </table>
          	  
      </center>		
      </header>
    
    
 <br />
