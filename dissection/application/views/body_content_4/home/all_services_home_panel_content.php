<?php
/* This php file is for home page view of services */
//----------------------------------------------------------------------------//
?>
<center>
    <table class="services_css"  >
        <tr id="products_color" >

            <th>Name</th>
            <th>Details</th>
            <th>Notes</th>
            <th>Price(work)</th>
            <th>Price(home)</th>
            <th></th>


        </tr>


<?php
 /* here check if $selected_services exist */ 
 if (!$selected_services == NULL) {

        /* if exist for each selected service echo details of services*/
            foreach ($selected_services as $result) {


                echo '<tr class="">';
                echo '<td>';
                echo $result['service_name'];
                echo '</td>';
                echo '<td>';
                echo $result['service_details'];
                echo '</td>';
                echo '<td>';
                echo $result['service_notes'];
                echo '</td>';
                echo '<td>';
                echo $result['service_price_at_work'];
                ?>&euro; <?php
                echo '</td>';
                echo '<td>';
                echo $result['service_price_at_home'];
                ?>&euro; <?php
                echo '</td>';


                echo "</tr>";
            }
        }
        ?>

    </table>

    <br />
    <br />







</center>
<br />
</header>


