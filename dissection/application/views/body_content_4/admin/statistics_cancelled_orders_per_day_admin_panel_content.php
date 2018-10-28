<center>
<?php 
/*
 *  This php file is for admin statistics cancelled orders per day.
 */
//----------------------------------------------------------------------------//
?>
<script>
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {var data = google.visualization.arrayToDataTable([
	   <?php
	   $str=" ['Day', 'Day'] ";
	   $query="select numbers as nu, DATE_FORMAT( date, '%y-%b-%d' )"
                   . " as dat from statistics_cancelled_orders_per_day order"
                   . " by date ASC";   
	   $result=mysql_query($query)  or die(mysql_error());   
	   while($rows=mysql_fetch_array($result,MYSQL_BOTH)){
	    $str =$str . ",['". $rows['dat'] ."'," .$rows['nu'] ."]" ;
	   }
	   echo $str;
	   ?>
	        ]);
	      var options = {
	          hAxis: {title: 'Day', titleTextStyle: {color: 'red'}},
	          vAxis: {title: 'count of registers', titleTextStyle: {color: 
                                  '#FF0000'}, maxValue:'15', minValue:'11'},
	          
	        };
	  var chart = 
       new google.visualization.AreaChart(document.getElementById('chart_div'));
	        chart.draw(data, options);
	      }
		
	</script>	

    
    
    <div id="printableArea">
       <p style="font-size:30px;" id="products_color">
           Cancelled orders per day Stats</p>
   	   <div id="chart_div" "></div>
   	  
    </div>

<input type="button" onclick="printDiv('printableArea')"
       value="print" class="delete_button" />


	    
</center>
<br />
</header>
