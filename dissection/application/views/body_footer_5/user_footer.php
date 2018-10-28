<?php
/*
 *  This php file is for view of footer user
 */
?>
<hr > 
<footer id="footer">

    <table id="footer_header" align="center">

        <tr >
            <td><h3>Παραγγελίες</h3></td>
            <td><h3>Εταιρία</h3></td>
            <td><h3>Επικοινωνία</h3></td>	
            <td><h3>Υπηρεσίες</h3></td>	

        </tr>
        <tr>
            <td><a href="<?php echo base_url() ?>User_page_controller/orders_status">Εξέλιξη παραγγελίας</a></td>
            <td><a href="">Η εταιρεία</a></td>
            <td><a href="<?php echo base_url() ?>User_page_controller/contact">Εποικοινωνία</a></td>
            <td><a href="<?php echo base_url() ?>User_page_controller/fix_view">Service</a></td>


        </tr>
        <tr>
            <td><a href="<?php echo base_url() ?>User_page_controller/how_to_order_view">Τρόποι Παραγγελίας</a></td>
            <td><a href="<?php echo base_url() ?>User_page_controller/fix_view">Οροι χρήσης</td>
            <td><a href="<?php echo base_url() ?>User_page_controller/fix_view">FAQ</a></td>
            <td><a href="<?php echo base_url() ?>User_page_controller/fix_view">downloads</a></td>

        </tr>
        <tr>
            <td><a href="<?php echo base_url() ?>User_page_controller/payment_methods_view">Τρόποι Πληρωμής</td>
            <td><a href="<?php echo base_url() ?>User_page_controller/fix_view">Feedback</a></td>
            <td><a href=""></a></td>
            <td><a href=""></a></td>

        </tr>
        <tr>
            <td><a href="<?php echo base_url() ?>User_page_controller/shipping_methods_view">Τρόποι Αποστολής</a></td>

        </tr>

    </table>






    <p align="center">Copyright (c) 2014 afoiPatsani.gr All rights reserved </p>
</footer>

</body>
</html>