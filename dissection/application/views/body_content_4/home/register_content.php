<?php
/* This php file is for home page view of register */
//----------------------------------------------------------------------------//

/* attribues of forms */
$attributes_register_email = array('name'=>'registerEmail','id' =>'',
    'placeholder'=>'email' );
$attributes_register_password = array('name'=>'registerPassword','id' =>'',
    'placeholder'=>'password');
$attributes_register_cpassword = array('name'=>'registerCPassword','id' =>'',
    'placeholder'=>'password'  );
$attributes_full_name = array('name'=>'registerFullName','id' =>'',
    'placeholder'=>'' );
$attributes_adress = array('name'=>'registerAdress','id' =>'',
    'placeholder'=>'' );
$attributes_city = array('name'=>'registerCity','id' =>'',
    'placeholder'=>'' );
$attributes_postcode = array('name'=>'registerPostcode','id' =>'',
    'placeholder'=>'' );
$attributes_phone = array('name'=>'registerPhone','id' =>'',
    'placeholder'=>'' );
$attributes_mobile_phone = array('name'=>'registerMobilePhone','id' =>'',
    'placeholder'=>'' );
	 
        /* option from dropdown form of courier*/
	$options = array(
                  'ELTA'      => 'Elta Courier',
                  'ACS'       => 'ACS Courier',
                  'SPEEDEX'   => 'Speedex Courier',
                 
                );
                
/* validator errors print if something is wrong of register validator form*/
echo   "<span id='validators_color'>".validation_errors()."</span>";
	          
//----------------------------------------------------------------------------//
?>	       	      
<table id="label_color">
    <?php
    echo "<tr>";
            echo "<td>";
		echo "<center>";
                echo " <hr ><b><h3>Στοιχεία του χρήστη.</h3></b> <hr >";
                echo "</center>";
            echo "</td>";  		
    echo "</tr>"; 
    /* open form of register validator*/
    echo form_open('home_page_controller/register_validator');
    echo "<tr>";
        echo "<td>";
            echo "<center>";
            echo "Email:";
            echo "</center>";
            echo "<center>";
            echo form_input($attributes_register_email,'',
                    'class="register_input"');
            echo "</center>";		          	
	echo "</td>";  		
    echo "</tr>"; 
		        
    echo "<tr>";
	echo "<td>";
            echo "<center>";
            echo "password:";
            echo "</center>";
            echo "<center>";
            echo form_password($attributes_register_password,'',
                    'class="register_input"');
            echo "</center>";		          	
        echo "</td>";  		
    echo "</tr>"; 		             
    
    echo "<tr>";
	echo "<td>";
            echo "<center>";
            echo "*repeat password:";
            echo "</center>";
            echo "<center>";
            echo form_password($attributes_register_cpassword,'',
                    'class="register_input"');
            echo "</center>";
        echo "</td>";  		
    echo "</tr>"; 
//----------------------------------------------------------------------------//
	          
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
            echo form_dropdown('registerCourier', $options, 'ELTA',
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
            echo form_input($attributes_full_name,'','class="register_input"');
            echo "</center>";
        echo "</td>";  		
    echo "</tr>";             
    
    echo "<tr>";
        echo "<td>";
            echo "<center>";
            echo "*Διεύθυνση :";
            echo "</center>";
            echo "<center>";
            echo form_input($attributes_adress,'','class="register_input"');
            echo "</center>";
       echo "</td>";  		
    echo "</tr>";             
    
    echo "<tr>";
	echo "<td>";
            echo "<center>";
            echo "*Πόλη :";
            echo "</center>";
            echo "<center>";
            echo form_input($attributes_city,'','class="register_input"');
            echo "</center>";		          	
        echo "</td>";  
    echo "</tr>";               
          	          
    echo "<tr>";
        echo "<td>";
            echo "<center>";
            echo "*ΤΚ :";
            echo "</center>";
            echo "<center>";
            echo form_input($attributes_postcode,'','class="register_input"');
            echo "</center>";
        echo "</td>";  		
    echo "</tr>"; 
	        
    echo "<tr>";
        echo "<td>";	          	
            echo "<center>";
            echo "*Σταθερό Τηλέφωνο :";
            echo "</center>";
            echo "<center>";
            echo form_input($attributes_phone,'','class="register_input"');
            echo "</center>";
        echo "</td>";  		
    echo "</tr>"; 
    
    echo "<tr>";
        echo "<td>";
            echo "<center>";
            echo "Κινητό Τηλέφωνο :";
            echo "</center>";
            echo "<center>";
            echo form_input($attributes_mobile_phone,'',
                    'class="register_input"');
            echo "</center>";		          	
        echo "</td>";  		
    echo "</tr>"; 						
    
    echo "<tr>";
        echo "<td>";
                echo "<br />";
                echo "<br />";
                echo "<center>";
                /* submit button of register*/
                echo form_submit('register_submit','signup',
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
