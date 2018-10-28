<?php
/*
 *  This php file is for admin add user
 */
?>

     <header id="header">
     <center>
      		  <?php
	      
	         
    /* attributes of forms*/              
    $attributes_register_email = array('name'=>'registerEmail',
        'class' =>'content_input','placeholder'=>'email' );
    $attributes_register_password = array('name'=>'registerPassword',
        'class' =>'content_input','placeholder'=>'password');
    $attributes_register_cpassword = array('name'=>'registerCPassword',
        'class' =>'content_input','placeholder'=>'password'  );
    $attributes_full_name = array('name'=>'registerFullName',
        'class' =>'content_input','placeholder'=>'' );
    $attributes_adress = array('name'=>'registerAdress',
        'class' =>'content_input','placeholder'=>'' );
    $attributes_city = array('name'=>'registerCity',
        'class' =>'content_input','placeholder'=>'' );
    $attributes_postcode = array('name'=>'registerPostcode',
        'class' =>'content_input','placeholder'=>'' );
    $attributes_phone = array('name'=>'registerPhone',
        'class' =>'content_input','placeholder'=>'' );
    $attributes_mobile_phone = array('name'=>'registerMobilePhone',
        'class' =>'content_input','placeholder'=>'' );
	          
	/* option for dropdown menu of user courier*/
        $options = array(
                  'ELTA'      => 'Elta Courier',
                  'ACS'       => 'ACS Courier',
                  'SPEEDEX'   => 'Speedex Courier',
                 
                );
                
                
/* validator errors if validator of add new user have problem*/	          
    echo "<h3>".validation_errors()."</h3>";

//----------------------------------------------------------------------------//    
    ?>          
<table  id='label_color'>

<?php
    echo "<tr>";
       echo "<td>";
       echo "<center>";
       echo " <hr ><b><h1 id='label_color'>Στοιχεία του χρήστη.</h1></b> <hr >";
       echo "</center>";
       echo "</td>";  		
    echo "</tr>"; 
    /* form open for add new user validator*/
    echo form_open('admin_page_controller/add_new_user_validator');
    echo "<tr>";
        echo "<td>";
		echo "<center>";
                echo "Email:";
                echo "</center>";
                echo "<center>";
                echo form_input($attributes_register_email);
                echo "</center>";
                echo "</td>";  		
	echo "</tr>"; 
		        
	 echo "<tr>";
		echo "<td>";
                echo "<center>";
                echo "password:";
                echo "</center>";
                echo "<center>";
                echo form_password($attributes_register_password);
                echo "</center>";
                echo "</td>";  		
	echo "</tr>"; 
		        
	echo "<tr>";
		echo "<td>";
		echo "<center>";
                echo "*repeat password:";
                echo "</center>";
                echo "<center>";
                echo form_password($attributes_register_cpassword);
                echo "</center>";
                echo "</td>";  		
	echo "</tr>"; 
//----------------------------------------------------------------------------//		
    echo "<tr>";
        echo "<td>";
        echo "<center>";
        echo " <hr ><b><h1 id='label_color'>Στοιχεία αποστολής.</h1></b> <hr >";
	echo "</center>";
	echo "</td>";  		
    echo "</tr>"; 
		        
    echo "<tr>";
	echo "<td>";
        echo "<center>";
        echo "*Τρόπος Αποστολής:";
        echo "</center>";
        echo "<center>";
        echo form_dropdown('registerCourier', $options,
                'ELTA','class="content_input"');     
        echo "</center>";
	echo "</td>";  		
    echo "</tr>"; 
		        
    echo "<tr>";
	echo "<td>";
	echo "<center>";
        echo "*Ονοματεπώνυμο :";
        echo "</center>";
        echo "<center>";
        echo form_input($attributes_full_name);
        echo "</center>";
        echo "</td>";  		
    echo "</tr>"; 
                
    echo "<tr>";
	echo "<td>";
	echo "<center>";
        echo "*Διεύθυνση :";
        echo "</center>";
        echo "<center>";
        echo form_input($attributes_adress);
        echo "</center>";
        echo "</td>";  		
    echo "</tr>"; 
                
    echo "<tr>";
	echo "<td>";
        echo "<center>";
        echo "*Πόλη :";
        echo "</center>";
        echo "<center>";
        echo form_input($attributes_city);
        echo "</center>";
        echo "</td>";  		
	echo "</tr>"; 
                  
          	  	          
    echo "<tr>";
	echo "<td>";
	echo "<center>";
        echo "*ΤΚ :";
        echo "</center>";
        echo "<center>";
        echo form_input($attributes_postcode);
        echo "</center>";
        echo "</td>";  		
 echo "</tr>"; 
	
 echo "<tr>";
	echo "<td>";
	echo "<center>";
        echo "*Σταθερό Τηλέφωνο :";
        echo "</center>";
        echo "<center>";
        echo form_input($attributes_phone);
        echo "</center>";
        echo "</td>";  		
        echo "</tr>"; 
	          
    echo "<tr>";
	echo "<td>";
        echo "<center>";
        echo "Κινητό Τηλέφωνο :";
        echo "</center>";
        echo "<center>";
        echo form_input($attributes_mobile_phone);
        echo "</center>";
        echo "</td>";  		
    echo "</tr>"; 

  echo "<tr>";
    echo "<td>";
    echo "<center>";
    /*submit of add new user*/
    echo form_submit('add_new_user_submit','add new user','class="add_button"');
    echo form_close(); 
    echo "</center>";
    echo "</td>";  		
  echo "</tr>"; 
?>
     </table>
  </center>	
      
    <br />	
</header>
    

