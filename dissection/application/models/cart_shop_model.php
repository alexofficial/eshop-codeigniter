<?php

//============================================================================// 
/**
 * This class  : have all methods for cart shop.
 * @name Cart_shop_model.
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 * @filesource 
 * @api
 * @package application\models
 * @copyright Copyright (c) 2014-2015, Alexander Patsanis
 * 
 */
class Cart_shop_model extends CI_Model {
//============================================================================// 	
     /**
     * This function is for send a general message.
     * @name general_send_email
     * <p>Description:</p>
     * makes a send mail with  subject and  message which 
     * will give.
     * @param  $subject
     * @param  $message
     * @param  $send_to
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return true if email send success or faild if dont
     */
    function general_send_email($subject, $message,$send_to){
      $this->load->model('email_model');
      return $this->email_model->general_send_email($subject,$message,$send_to);
    }
//============================================================================// 
    /**
     * This function get product.
     * <p>Description:</p>
     * This function make a get query into database.
     * @name get product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return null data.
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function get_product() {
     $this->db->where('product_id', $this->input->get_post('product_id'));
     $this->db->where('product_categories', $this->input->get_post('category'));
        $result = $this->db->get('products');
        if ($result) {
            $row = $result->row();
            $data = array(
                'product_sale_price' => $row->product_sale_price,
                'product_name' => $row->product_name,
            );
            return $data;
        } else {
            return $data = null;
        }
    }

//============================================================================// 
    /**
     * Boolean function set cart shop to user.
     * <p>Description:</p>
     * This function make a update query into database.
     * @name set cart shop to user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success to update cart shop of user return true else 
     * return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function set_cart_shop_to_user() {
        $user_email = $this->session->userdata('user_email');
        /**
         * {@internal $this->cart->contents() takes cart shop with cart helper 
         * of codeingiter and then make serialize this cart to a string.
         * }}
         */
        $cartContentString = serialize($this->cart->contents());

        $query = $this->db->query("UPDATE users	SET cart_shop='" 
                . $cartContentString . "' WHERE email='" . $user_email . "' ");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

//============================================================================// 
    /**
     * This function select data of ship to .
     * <p>Description:</p>
     * This function make a get query into database.
     * @param string $user_email 
     * @name select ship to.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return null data.
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function select_ship_to($user_email) {
        $this->db->where('email', $user_email);
        $user = $this->db->get('users');

        if ($user) {
            $row = $user->row();

            $data = array(
                'delivery_method' => $row->delivery_method,
                'full_name' => $row->full_name,
                'adress' => $row->adress,
                'city' => $row->city,
                'postcode' => $row->postcode,
            );
            return $data;
        } else {
            return $data = null;
        }
    }

//============================================================================// 
    /**
     * Boolean function generate md5 number from cart shop.
     * <p>Description:</p>
     * This function make a loop when while generate a uniqid number.
     * @name generate md5 number cart shop.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return uniqid number.
     * @internal with help of check_if_order_number_exist check if generate 
     * number exist 
     */
    function generate_md5_number_cart_shop() {
        $number = md5(uniqid());
        $if_exist_order_number = $this->check_if_order_number_exist($number);

        while ($if_exist_order_number) {
            $number = md5(uniqid());
            $if_exist_order_number = $this->check_if_order_number_exist($number);
        }
        return $number;
    }
//============================================================================// 
    /**
     * This function gives as system date with mdate format..
     * @name date.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return date.
     */
    function date() {
        $datestring = "%Y-%m-%d";
        $time = time();
        $mdate = mdate($datestring, $time);
        return $mdate;
    }
//============================================================================// 
    /**
     * Boolean function user success finish shop mail.
     * <p>Description:</p>
     * This function send email with order number to user if success take 
     * a shop.
     * @name set cart shop to user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success send mail return true else return false.
     * @internal with help of check_if_order_number_exist check if generate 
     * number exist 
     */
    function user_success_finish_shop_mail($send_to,$order_number) {
        $subject = "Easy Shop : id of shopping cart";
        $message = "<p>Thanks you for shopping!</p>";
        $message .= "<p>your id is " . $order_number . "</p>";
        $success_send_email = $this->general_send_email($subject, $message,$send_to);
        if ($success_send_email) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * Boolean function clear user cart shop.
     * <p>Description:</p>
     * This function send email to user if success take a shop.
     * @param string $user_email 
     * @param int $order_number 
     * @name clear user cart shop.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if update return true else return false.
     * @internal first update cart shop = null and then with help of 
     * user_success_finish_shop_mail send email with id
     */
    function clear_user_cart_shop($user_email, $order_number) {
        $clear_user_cart_shop = $this->db->query('
			UPDATE users
			SET cart_shop=""
			WHERE email="' . $user_email . '"
			');
     if ($clear_user_cart_shop) {
      $success_send_email = 
              $this->user_success_finish_shop_mail($user_email,$order_number);
            if ($success_send_email) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
      }
    }
//============================================================================// 
    /**
     * Boolean function if user add cart shop into orders.
     * <p>Description:</p>
     * This function if all is success insert a new order. 
     * @name if user add cart shop.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success insert return true else return false.
     */
    function if_user_add_cart_shop() {
        $this->load->library('session');

        $user_email = $this->session->userdata('user_email');
        $order_number = $this->generate_md5_number_cart_shop();
        /**
         * {@internal gives as a date with out time.}}
         */
        $mdate = $this->date();
        /**
         * {@internal $this->cart->contents() takes cart shop with cart helper 
         * of codeingiter and then
         * make serialize this cart to a string.}}
         */
        $cartContentString = serialize($this->cart->contents());
        /**
         * {@internal takes ship to data from user.}}
         */
        $ship_to = $this->select_ship_to($user_email);
        $data = array(
            'order_number' => $order_number,
            'user_name' => $ship_to['full_name'],
            'user_email' => $user_email,
            'delivery_method' => $ship_to['delivery_method'],
            'city' => $ship_to['city'],
            'postcode' => $ship_to['postcode'],
            'ship_to' => $ship_to['adress'],
            'ordered_on' => $mdate,
            'status' => "Listing",
            'shop_cart' => $cartContentString,
            'notes' => ""
        );

        $insert_orders = $this->db->insert('orders', $data);
        if ($insert_orders) {
            /**
             * {@internal clear user cart shop and then send email.Email function 
             * into clear_user_cart_shop.}}
             */
            
            $clear_user_cart_shop=$this->clear_user_cart_shop($user_email, 
                    $order_number);
            if ($clear_user_cart_shop) {
                return true;
            } else {
                
               return false;
            }
        } else {
            
            return false;
        }
    }
//============================================================================// 
    /**
     * Boolean function if clear cart shop.
     * <p>Description:</p>
     * This function clear user cart shop with update query.
     * @name if clear cart shop
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success query return true else return false.
     */
    function if_clear_cart_shop() {
        $this->load->library('session');
        $user_email = $this->session->userdata('user_email');

        $query = $this->db->query("UPDATE users SET cart_shop=NULL WHERE "
                . "email='" . $user_email . "' ");
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * Boolean function check if order number exist.
     * @name check_if_order_number_exist
     * <p>Description:</p>
     * This function select all orders and check if $order_number exist.
     * @param string $order_number
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if find this $order_number return true else return false.
     */
    function check_if_order_number_exist($order_number) {
        $query = $this->db->query("SELECT * FROM orders WHERE order_number='" 
                . $order_number . "'");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================//
    /**
     * This function select a user shop cart.
     * <p>Description:</p>
     * takes user data with user cart shop and insert it to cart shop.
     * @name select shop cart
     * @param string $user_email
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success select insert into shop cart else do nothing.
     */
    function select_shop_cart($user_email) {
        $this->load->database();
        $this->db->where('email', $user_email);
        $query = $this->db->get("users");
        if ($query) {
            foreach ($query->result() as $row) {
                $cartContentString = $row->cart_shop;
            }
            $cartArray = unserialize($cartContentString);
            $this->cart->insert($cartArray);
        } else {
            /**
             * {@internal if user dont have saved shop cart just dont 
             * do nothing.}}
             */
        }
    }
//============================================================================// 
    /**
     * This function get a get shop cart from N_table.
     * <p>Description:</p>
     * This function make a query and take $table where $var_where=$data_where
     * @name select shop cart
     * @param string $table
     * @param string $var_where
     * @param string $data_where
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return the cart shop else return null cart shop.
     */
    public function get_shop_cart($table, $var_where, $data_where) {

        $this->load->database();
        $this->db->where($var_where, $data_where);
        $query = $this->db->get($table);

        if ($query) {
            /**
             * {@internal if table has that we want go on.}}
             */
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $cartContentString = $row->shop_cart;
                }
                return $cartContentString;
            } else {
                return $cartContentString = NULL;
            }
        } else {
            return $cartContentString = NULL;
        }
    }

    
}

?>