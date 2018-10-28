<center>
<?php 
/*
 *  This php file is for admin statistics orders money we will get per day.
 */
//----------------------------------------------------------------------------//
?>
<script>
		    google.load("visualization", "1", {packages:["corechart"]});
      		google.setOnLoadCallback(drawChart);
      function drawChart() {var data = google.visualization.arrayToDataTable([
	   <?php
	   $str=" ['Day', 'Day'] ";
	   $query="select money as mon, DATE_FORMAT( date, '%y-%b-%d' ) as dat"
               . " from statistics_orders_money_we_will_get order by date ASC";   
	   $result=mysql_query($query)  or die(mysql_error());   
	   while($rows=mysql_fetch_array($result,MYSQL_BOTH)){
	    $str =$str . ",['". $rows['dat'] ."'," .$rows['mon'] ."]" ;
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
       <p style="font-size:30px;" id="products_color">Orders money per day </p>
   	   <div id="chart_div" "></div>
   	  
    </div>

<input type="button" onclick="printDiv('printableArea')"
       value="print" class="delete_button" />


	    
</center>
<br />
</header>
