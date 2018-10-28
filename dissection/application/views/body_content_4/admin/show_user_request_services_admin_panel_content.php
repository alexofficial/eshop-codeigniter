<center>
<?php 
/*
 *  This php file is for admin show user request service.
 */
//----------------------------------------------------------------------------//

/* echo validator errors */
echo "<center>".validation_errors()."</center>";

?>
<div>
  <center>
    <table class="" >
       <ul>
		<tr>
			<ul>
				<h1 id="users_title">User now detals</h1>
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
/* for each selected user */
 foreach($selected_user as $result) { 	
    /* attributes of forms*/ 
    $attributes_user_id = array('name'=>'id','class' =>'content_id_input',
        'value'=>$result['id'],'disabled'=>'disabled',
        'style'=>"height:20px; width:40px");
    $attributes_user_full_name = array('name'=>'fullName',
        'class' =>'content_input','value'=>$result['full_name'] );
    $attributes_user_email = array('name'=>'email','class' =>'content_input',
        'value'=>$result['email'] );
    $attributes_user_adress = array('name'=>'adress','class' =>'content_input',
        'value'=>$result['adress'] );
    $attributes_user_city = array('name'=>'city','class' =>'content_input',
        'value'=>$result['city'],'style'=>" width:100px;");
    $attributes_user_postcode = array('name'=>'postcode',
        'class' =>'content_input','value'=>$result['postcode'],
        'style'=>" width:60px;");
    $attributes_user_phone_number = array('name'=>'phoneNumber',
        'class' =>'content_input','value'=>$result['phone_number'],
        'style'=>" width:100px;" );
    $attributes_user_mobileNumber = array('name'=>'mobileNumber',
        'class' =>'content_input','value'=>$result['mobile_number'],
        'style'=>" width:100px;" );
	
    /* dropdown options*/
    $options = array(
        'ELTA'      => 'Elta Courier',
        'ACS'       => 'ACS Courier',
        'SPEEDEX'   => 'Speedex Courier',
    );

    echo '<tr>';
      echo '<td>'; echo form_input($attributes_user_id) ; echo '</td>'; 
      echo '<td>';echo  form_input($attributes_user_full_name); echo '</td>';
      echo '<td>'; echo form_input($attributes_user_email);echo '</td>';
      echo '<td>'; echo form_dropdown('deliveryMethod', $options,
               $result['delivery_method'],'class="content_input"');echo '</td>';
      echo '<td>'; echo form_input($attributes_user_adress);echo '</td>';
      echo '<td>'; echo form_input($attributes_user_city);echo '</td>';
      echo '<td>'; echo form_input($attributes_user_postcode);echo '</td>';
      echo '<td>'; echo form_input($attributes_user_phone_number);echo '</td>';
      echo '<td>'; echo form_input($attributes_user_mobileNumber) ;echo '</td>';
    echo "</tr>";
}			
?>
         

</table>
      
        </div>
</center>
 <br />
  <br />
</header>
