<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
//============================================================================// 
/**
 * This class  : have all methods for admin business administrator
 * @name Model_admin.
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 * @filesource 
 * @api
 * @package application\models
 * @copyright Copyright (c) 2014-2015, Alexander Patsanis
 * 
 */
class Model_admin extends CI_Model {
//============================================================================// 	
     /**
     * This function is for send a general message.
     * <p>Description:</p>
     * makes a send mail with subject and message which will give.
     * @param undefined $subject
     * @param undefined $message
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return true if email send success or faild if dont
     */
    function general_send_email($subject, $message,$send_to){
     $this->load->model('email_model');
     return $this->email_model->general_send_email($subject, $message,$send_to);
    }
//============================================================================// 
    /**
     * boolean function check if admin exist.
     * <p>Description:</p>
     * This function make a get query and then checks if exist.
     * @name check_admin_exist.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if admin exist return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */	
	public function check_admin_exist(){
		
            $this->db->where('email',$this->input->post('email'));
            $this->db->where('password', md5($this->input->post('password')));
		
		$query = $this->db->get('admins');
		
		if($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}
//============================================================================// 
    /**
     * boolean function if admin add a user.
     * <p>Description:</p>
     * This function make a data array of input post and insert it into users 
     * table.
     * @name if admin add user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to insert return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function if_admin_add_user() {

        $data = array(
            'email' => $this->input->post('registerEmail'),
            'password' => md5($this->input->post('registerPassword')),
            'delivery_method' => $this->input->post('registerCourier'),
            'full_name' => $this->input->post('registerFullName'),
            'adress' => $this->input->post('registerAdress'),
            'city' => $this->input->post('registerCity'),
            'postcode' => $this->input->post('registerPostcode'),
            'phone_number' => $this->input->post('registerPhone'),
            'mobile_number' => $this->input->post('registerMobilePhone'),
        );

        $query = $this->db->insert('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if admin update a user.
     * <p>Description:</p>
     * This function make a update query into database with input posts of 
     * changed.
     * @param int $user_id 
     * @name if admin update user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function if_admin_update_user($user_id) {
        


        $query = $this->db->query('UPDATE users SET '
                . 'full_name="' . $this->input->post('fullName') 
                . '", email="' . $this->input->post('email') . '" ,'
                . 'delivery_method="' . $this->input->post('deliveryMethod') 
                . '", adress="' . $this->input->post('adress') . '",'
                . 'city="' . $this->input->post('city') . '", postcode="' 
                . $this->input->post('postcode') . '",phone_number="' 
                . $this->input->post('phoneNumber') . '", mobile_number="' 
                . $this->input->post('mobileNumber') . '"'
                . 'WHERE email="' . $this->input->post('email') . '" ');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if admin update a product.
     * <p>Description:</p>
     * This function make a update query into database with input posts of changed.
     * The params is the wheres into db query.
     * @param int $product_id 
     * @param string $product_categories 
     * @name if admin update product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function if_admin_update_product($product_id, $product_categories) {


        $query = $this->db->query('UPDATE products SET product_name="' 
            . $this->input->post('productName') . '",product_enabled="' 
            . $this->input->post('productEnabled') . '",product_description="'
            . $this->input->post('productDescription') 
            . '",product_available_quantity="' 
            . $this->input->post('productAvailableQuantity') . '",'
            . 'product_weight="' . $this->input->post('productWeight') 
            . '",product_price="' . $this->input->post('productPrice') . '"'
            . ',product_sale_price="' . $this->input->post('productSalePrice') 
            . '"WHERE product_id="' . $product_id . '" AND product_categories="'
            . $product_categories . '" ');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if admin update service.
     * @name if admin update service.
     * <p>Description:</p>
     * This function make a update query into database with input posts of 
     * changed.
     * The params is the wheres into db query.
     * @param int $service_id 
     * @param string $service_categories 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function if_admin_update_service($service_id, $service_categories) {
        $query = $this->db->query('UPDATE services SET service_name="' 
            . $this->input->post('serviceName') . '",service_details="' 
            . $this->input->post('serviceDetails') . '",service_notes="' 
            . $this->input->post('serviceNotes') . '",service_price_at_work="' 
            . $this->input->post('servicePriceAtWork') 
            . '",service_price_at_home="' 
            . $this->input->post('servicePriceAtHome') . '"WHERE service_id="' 
            . $service_id . '" AND service_categories="' . $service_categories 
            . '" ');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function insert product image.
     * <p>Description:</p>
     * This function make a update query into database with image data.
     * The params $config and $file_data is the wheres into db query.
     * @param array $item_data 
     * @param string $config 
     * @param string $file_data
     * @name insert product image.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function insert_product_image($item_data = array(), $config, $file_data) {

        $this->load->helper('file');
        $image_data = read_file($file_data['full_path']);

        $data = array(
            'product_image' => $image_data
        );

       $this->db->where('product_id', $item_data['product_id']);
       $this->db->where('product_categories', $item_data['product_categories']);
       $query = $this->db->update('products', $data);


        if ($query) {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/dissection/images/' 
                    . $config['logo_thumb'];
            if (is_file($path)) {
                if (unlink($path)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * This function select a category id by category name.
     * <p>Description:</p>
     * This function make a get query into database.
     * The params $category_name is the wheres into db query.
     * @param array $category_name 
     * @name select category id by name.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return message.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function select_category_id_by_name($category_name) {
        $this->load->database();
        $this->db->where('product_categories', $category_name);
        $query = $this->db->get("product_category");

        if ($query) {
            foreach ($query->result() as $row) {
                $data = $row->product_categories_id;
            }
            return $data;
        } else {
            echo "cant select this category id";
        }
    }
//============================================================================// 
    /**
     * This function select a service category id by category name.
     * <p>Description:</p>
     * This function make a get query into database.
     * The params $category_name is the wheres into db query.
     * @param array $category_name 
     * @name select service category id by name.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return message.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function select_service_category_id_by_name($category_name) {
        $this->load->database();
        $this->db->where('service_categories', $category_name);
        $query = $this->db->get("service_category");

        if ($query) {
            foreach ($query->result() as $row) {
                $data = $row->service_categories_id;
            }
            return $data;
        } else {
            echo "cant select this category id";
        }
    }
//============================================================================// 
    /**
     * Boolean function insert a product.
     * <p>Description:</p>
     * This function make a insert query into database with product data.
     * @name insert product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success to insert a new product return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function insert_product() {
        $data_category_id = $this->select_category_id_by_name(
                $this->input->post('productCategories'));

        $data = array(
            'product_categories_id' => $data_category_id,
            'product_categories' => $this->input->post('productCategories'),
            'product_name' => $this->input->post('productName'),
            'product_enabled' => $this->input->post('productEnabled'),
            'product_description' => $this->input->post('productDescription'),
            'product_available_quantity' => 
            $this->input->post('productAvailableQuantity'),
            'product_weight' => $this->input->post('productWeight'),
            'product_price' => $this->input->post('productPrice'),
            'product_sale_price' => $this->input->post('productSalePrice')
        );
        $query = $this->db->insert('products', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * Boolean function insert product to deals.
     * <p>Description:</p>
     * This function make a insert query into database with product data.
     * @name insert product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success to insert a new product return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function insert_product_to_deals($product_data) {
    
        foreach ($product_data as $value) {
           $data = array(
            'product_id' => $value['product_id'], 
            'product_categories_id' => $value['product_categories_id'],
            'product_categories' => $value['product_categories'],
            'product_name' => $value['product_name'],
            'product_enabled' => $value['product_enabled'],
            'product_description' => $value['product_description'],
            'product_available_quantity' => $value['product_available_quantity'],
            'product_weight' => $value['product_weight'],
            'product_price' => $value['product_price'],
            'product_sale_price' => $value['product_sale_price'],
            'product_image' => $value['product_image']
            );
        }
        $query = $this->db->insert('deals_products', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
        
         
    }
//============================================================================// 
    /**
     * Boolean function insert a service.
     * <p>Description:</p>
     * This function make a insert query into database with data.
     * @name insert service.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success to insert a new service return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function insert_service() {

        $data_category_id = $this->select_service_category_id_by_name(
                $this->input->post('serviceCategories'));

        $data = array(
            'service_categories_id' => $data_category_id,
            'service_categories' => $this->input->post('serviceCategories'),
            'service_name' => $this->input->post('serviceName'),
            'service_details' => $this->input->post('servicedetails'),
            'service_notes' => $this->input->post('serviceNotes'),
            'service_price_at_work' => $this->input->post('servicePriceAtWork'),
            'service_price_at_home' => $this->input->post('servicePriceAtHome')
        );
        $query = $this->db->insert('services', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

//============================================================================// 
    /**
     * This function select all product with help of category name.
     * <p>Description:</p>
     * This function make a get query into database and select all information
     * of products.
     * The params $category_name is the where into db query.
     * @param string $category_name  
     * @name select all product by category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for 
     * better view.
     * 
     */
    function select_all_product_by_category($category_name) {
        $this->load->database();
        $this->db->where('product_categories', $category_name);
        $query = $this->db->get('products');
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'product_id' => '',
                    'product_name' => '',
                    'product_enabled' => NULL,
                    'product_description' => '',
                    'product_available_quantity' => '',
                    'product_weight' => '',
                    'product_price' => '',
                    'product_sale_price' => '',
                    'product_categories' => '',
                    'product_image' => ''
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                        'product_id' => $row['product_id'],
                        'product_name' => $row['product_name'],
                        'product_enabled' => $row['product_enabled'],
                        'product_description' => $row['product_description'],
                        'product_available_quantity' => 
                        $row['product_available_quantity'],
                        'product_weight' => $row['product_weight'],
                        'product_price' => $row['product_price'],
                        'product_sale_price' => $row['product_sale_price'],
                        'product_categories' => $row['product_categories'],
                        'product_image' => $row['product_image']
                    );
                }
            }
        }
        return $data;
    }
//============================================================================//
    /**
     * This function select all data of a product with help of category name 
     * and product id.
     * <p>Description:</p>
     * This function make a get query into database and select all information
     * of products.
     * The params $category_name and $id is the where into db query.
     * @param string $id 
     * @param string $category_name  
     * @name select product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for 
     * better view.
     * 
     */
    function select_product($id,$category_name) {
        $this->load->database();
        $this->db->where('product_id', $id);
        $this->db->where('product_categories', $category_name);
        $query = $this->db->get('products');
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'product_id' => '',
                    'product_categories_id' => '',
                    'product_categories' => '',
                    'product_name' => '',
                    'product_enabled' => NULL,
                    'product_description' => '',
                    'product_available_quantity' => '',
                    'product_weight' => '',
                    'product_price' => '',
                    'product_sale_price' => '',
                    'product_categories' => '',
                    'product_image' => ''
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                    'product_id' => $row['product_id'],
                    'product_categories_id' => $row['product_categories_id'],
                    'product_categories' => $row['product_categories'],
                    'product_name' => $row['product_name'],
                    'product_enabled' => $row['product_enabled'],
                    'product_description' => $row['product_description'],
                    'product_available_quantity' =>
                        $row['product_available_quantity'],
                    'product_weight' => $row['product_weight'],
                    'product_price' => $row['product_price'],
                    'product_sale_price' => $row['product_sale_price'],
                    'product_categories' => $row['product_categories'],
                    'product_image' => $row['product_image']
                    );
                }
            }
        }
        return $data;
    }
//============================================================================// 
    /**
     * This function select all deal products.
     * <p>Description:</p>
     * This function make a get query into database and select all data
     * of deal products.
     * @name select product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for 
     * better view.
     * 
     */
    function select_all_deals_product() {
        $this->load->database();
        $query = $this->db->get('deals_products');
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'deals_products_id' => '',
                    'product_id' => '',
                    'product_categories_id' => '',
                    'product_categories' => '',
                    'product_name' => '',
                    'product_enabled' => NULL,
                    'product_description' => '',
                    'product_available_quantity' => '',
                    'product_weight' => '',
                    'product_price' => '',
                    'product_sale_price' => '',
                    'product_categories' => '',
                    'product_image' => ''
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                    'deals_products_id' => $row['deals_products_id'],
                    'product_id' => $row['product_id'],
                    'product_categories_id' => $row['product_categories_id'],
                    'product_categories' => $row['product_categories'],
                    'product_name' => $row['product_name'],
                    'product_enabled' => $row['product_enabled'],
                    'product_description' => $row['product_description'],
                    'product_available_quantity' => 
                        $row['product_available_quantity'],
                    'product_weight' => $row['product_weight'],
                    'product_price' => $row['product_price'],
                    'product_sale_price' => $row['product_sale_price'],
                    'product_categories' => $row['product_categories'],
                    'product_image' => $row['product_image']
                    );
                }
            }
        }
        return $data;
    }
//============================================================================// 
    /**
     * This function select all service  with help of category name.
     * <p>Description:</p>
     * This function make a get query into database and select all information
     * of services.
     * The params $category_name is the wheres into db query.
     * @param string $category_name  
     * @name select all services by category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for
     *  better view.
     * 
     */
    function select_all_services_by_category($category_name) {
        $this->load->database();
        $this->db->where('service_categories', $category_name);
        $query = $this->db->get('services');
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'service_id' => '',
                    'service_categories_id' => '',
                    'service_categories' => '',
                    'service_name' => '',
                    'service_details' => '',
                    'service_notes' => '',
                    'service_price_at_work' => NULL,
                    'service_price_at_home' => NULL
                );
            } else {
                foreach ($query->result_array() as $row) {
                 $data[] = array(
                    'service_id' => $row['service_id'],
                    'service_categories_id' => $row['service_categories_id'],
                    'service_categories' => $row['service_categories'],
                    'service_name' => $row['service_name'],
                    'service_details' => $row['service_details'],
                    'service_notes' => $row['service_notes'],
                    'service_price_at_work' => $row['service_price_at_work'],
                    'service_price_at_home' => $row['service_price_at_home']
                    );        
                }
            }
        }
        return $data;
    }
//============================================================================// 
    /**
     * This function select all orders.
     * <p>Description:</p>
     * This function make a get query into database and select all information
     * of orders.
     * @name select all orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for 
     * better view.
     * 
     */
    function select_all_orders() {
        $this->load->database();
        $query = $this->db->get("orders");
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'order_id' => '',
                    'order_number' => '',
                    'user_name' => '',
                    'user_email' => '',
                    'delivery_method' => '',
                    'city' => '',
                    'postcode' => '',
                    'ordered_on' => '',
                    'ship_to' => '',
                    'status' => '',
                    'shop_cart' => '',
                    'notes' => ''
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                        'order_id' => $row['order_id'],
                        'order_number' => $row['order_number'],
                        'user_name' => $row['user_name'],
                        'user_email' => $row['user_email'],
                        'delivery_method' => $row['delivery_method'],
                        'city' => $row['city'],
                        'postcode' => $row['postcode'],
                        'ship_to' => $row['ship_to'],
                        'ordered_on' => $row['ordered_on'],
                        'status' => $row['status'],
                        'shop_cart' => $row['shop_cart'],
                        'notes' => $row['notes']
                    );
                }
            }
        }
        return $data;
    }
//============================================================================// 
    /**
     * This function select all finished orders.
     * <p>Description:</p>
     * This function make a get query into database and select all information
     * of finished orders.
     * @name select all finished orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for 
     * better view.
     * 
     */
    function select_all_finished_orders() {
        $this->load->database();

        $query = $this->db->get('finished_orders');
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'finished_order_id' => '',
                    'order_id' => '',
                    'order_number' => '',
                    'user_name' => '',
                    'user_email' => '',
                    'delivery_method' => '',
                    'city' => '',
                    'postcode' => '',
                    'ordered_on' => '',
                    'ship_to' => '',
                    'status' => '',
                    'shop_cart' => '',
                    'notes' => ''
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                        'finished_order_id' => $row['finished_order_id'],
                        'order_id' => $row['order_id'],
                        'order_number' => $row['order_number'],
                        'user_name' => $row['user_name'],
                        'user_email' => $row['user_email'],
                        'delivery_method' => $row['delivery_method'],
                        'city' => $row['city'],
                        'postcode' => $row['postcode'],
                        'ship_to' => $row['ship_to'],
                        'ordered_on' => $row['ordered_on'],
                        'status' => $row['status'],
                        'shop_cart' => $row['shop_cart'],
                        'notes' => $row['notes']
                    );
                }
            }
        }
        return $data;
    }
//============================================================================// 
    /**
     * This function select all cancelled orders.
     * <p>Description:</p>
     * This function make a get query into database and select all information
     * of cancelled orders.
     * @name select all cancelled orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for 
     * better view.
     * 
     */
    function select_all_cancelled_orders() {
        $this->load->database();

        $query = $this->db->get('cancelled_orders');
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'cancelled_order_id' => '',
                    'order_id' => '',
                    'order_number' => '',
                    'user_name' => '',
                    'user_email' => '',
                    'delivery_method' => '',
                    'city' => '',
                    'postcode' => '',
                    'ordered_on' => '',
                    'ship_to' => '',
                    'status' => '',
                    'shop_cart' => '',
                    'notes' => ''
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                    'cancelled_order_id' => $row['cancelled_order_id'],
                    'order_id' => $row['order_id'],
                    'order_number' => $row['order_number'],
                    'user_name' => $row['user_name'],
                    'user_email' => $row['user_email'],
                    'delivery_method' => $row['delivery_method'],
                    'city' => $row['city'],
                    'postcode' => $row['postcode'],
                    'ship_to' => $row['ship_to'],
                    'ordered_on' => $row['ordered_on'],
                    'status' => $row['status'],
                    'shop_cart' => $row['shop_cart'],
                    'notes' => $row['notes']
                    );
                }
            }
        }
        return $data;
    }
//============================================================================// 
    /**
     * This function select all cancelled services request.
     * <p>Description:</p>
     * This function make a get query into database and select all information
     * of cancelled request services.
     * @name select all cancelled services request.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for 
     * better view.
     * 
     */
    function select_all_cancelled_services_request() {
        $this->load->database();
        $query = $this->db->get("cancelled_services_request");
       if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'cancelled_services_request_id'=>'',
                    'services_request_id' => '',
                    'service_id' => '',
                    'service_categories' => '',
                    'services_request_number' => '',
                    'services_request_status' => '',
                    'user_email' => '',
                    'service_name' => '',
                    'date' => '',
                    'notes'=> '',
                    'full_name' => '',
                    'city' => '',
                    'postcode' => '',
                    'adress' => ''
                    
                );
            } else {
                foreach ($query->result_array() as $row) {
                  $data[] = array(
                   'cancelled_services_request_id' => 
                   $row['cancelled_services_request_id'],
                   'services_request_id' => $row['services_request_id'],
                   'service_id' => $row['service_id'],
                   'service_categories' => $row['service_categories'],
                   'services_request_number' => $row['services_request_number'],
                   'services_request_status' => $row['services_request_status'],
                   'user_email' => $row['user_email'],
                   'service_name' => $row['service_name'],
                   'date' => $row['date'],
                   'notes' => $row['notes'],
                   'full_name' => $row['full_name'],
                   'city' => $row['city'],
                   'postcode' => $row['postcode'],
                   'adress' => $row['adress']
                    );
                }
            }
        }
        return $data;
    }
//============================================================================// 
    /**
     * This function select all finished services request.
     * <p>Description:</p>
     * This function make a get query into database and select all information
     * of request services.
     * @name select all finished services request.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for 
     * better view.
     * 
     */
    function select_all_finished_services_request() {
        $this->load->database();
        $query = $this->db->get("finished_services_request");
       if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                	'finished_services_request_id'=>'',
                	'services_request_id' => '',
                	'service_id' => '',
                	'service_categories' => '',
                        'services_request_number' => '',
                        'services_request_status' => '',
                        'user_email' => '',
                        'service_name' => '',
                        'date' => '',
                        'notes'=> '',
                        'full_name' => '',
                        'city' => '',
                        'postcode' => '',
                        'adress' => ''
                    
                );
            } else {
                foreach ($query->result_array() as $row) {
                  $data[] = array(
                   'finished_services_request_id' =>
                        $row['finished_services_request_id'],
                   'services_request_id' => $row['services_request_id'],
                   'service_id' => $row['service_id'],
                   'service_categories' => $row['service_categories'],
                   'services_request_number' => $row['services_request_number'],
                   'services_request_status' => $row['services_request_status'],
                   'user_email' => $row['user_email'],
                   'service_name' => $row['service_name'],
                   'date' => $row['date'],
                   'notes' => $row['notes'],
                   'full_name' => $row['full_name'],
                   'city' => $row['city'],
                   'postcode' => $row['postcode'],
                   'adress' => $row['adress']
                    );
                }
            }
        }
        return $data;
    }   
//============================================================================// 
    /**
     * This function select all request services.
     * <p>Description:</p>
     * This function make a get query into database and select all information
     * of request services.
     * @name select all request services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for 
     * better view.
     * 
     */
    function select_all_request_services() {
        $this->load->database();
        $query = $this->db->get("services_request");
       if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                	'services_request_id' => '',
                	'service_id' => '',
                	'service_categories' => '',
                        'services_request_number' => '',
                        'services_request_status' => '',
                        'user_email' => '',
                        'service_name' => '',
                        'date' => '',
                        'notes'=> '',
                        'full_name' => '',
                        'adress' => '',
                        'city' => '',
                        'postcode' => ''
                    
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                     	'services_request_id' => $row['services_request_id'],
                     	'service_id' => $row['service_id'],
                        'service_categories' => $row['service_categories'],
                        'services_request_number' => 
                            $row['services_request_number'],
                        'services_request_status' => 
                            $row['services_request_status'],
                        'user_email' => $row['user_email'],
                        'service_name' => $row['service_name'],
                        'date' => $row['date'],
                        'notes' => $row['notes'],
                        'full_name' => $row['full_name'],
                        'adress' => $row['adress'],
                        'city' => $row['city'],
                        'postcode' => $row['postcode']
                        
                    );
                }
            }
        }
        return $data;
    }
//============================================================================// 
    /**
     * This function select all categories.
     * <p>Description:</p>
     * This function make a get query into database and take information form
     * product categories.
     * @name select all categories.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data else return message.
     *
     * 
     */
    function select_all_categories() {
        $this->load->database();
        $query = $this->db->get("product_category");
        if ($query) {
            foreach ($query->result_array() as $row) {
                $data[] = array(
                    'product_categories_id' => $row['product_categories_id'],
                    'product_categories' => $row['product_categories']
                );
            }
            return $data;
        } else {
            echo "faild to select all categories";
        }
    }
//============================================================================// 
    /**
     * This function select all services categories.
     * <p>Description:</p>
     * This function make a get query into database and take information form
     * services categories.
     * @name select all services categories.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data else return message.
     *
     * 
     */
    function select_all_services_categories() {
        $this->load->database();
        $query = $this->db->get("service_category");
        if ($query) {
            foreach ($query->result_array() as $row) {
                $data[] = array(
                    'service_categories_id' => $row['service_categories_id'],
                    'service_categories' => $row['service_categories']
                );
            }
            return $data;
        } else {
            echo "faild to select all service categories";
        }
    }
//============================================================================// 
    /**
     * boolean function for insert a new category.
     * <p>Description:</p>
     * This function make a insert query into database.
     * @name insert category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to insert return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function insert_category() {
        $this->load->database();

        $data = array(
            'product_categories' => $this->input->post('categoryName')
        );

        $query = $this->db->insert('product_category', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function for insert a new service category.
     * <p>Description:</p>
     * This function make a insert query into database.
     * @name insert service category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to insert return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function insert_service_category() {
        $this->load->database();

        $data = array(
            'service_categories' => $this->input->post('categoryServiceName')
        );

        $query = $this->db->insert('service_category', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if delete category.
     * <p>Description:</p>
     * This function make two delete query first into products and then into 
     * category.
     * @name if delete category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete two of them return true else return
     * false.
     *
     * @internal first we delete from products and then we delete from category.
     * 
     */
    function if_delete_category($category_table_name) {
        $this->load->database();
        $query_delete_from_products = $this->db->query('DELETE FROM products'
                . ' where product_categories="' . $category_table_name . '"');

        if ($query_delete_from_products) {
            $query_delete_from_category = $this->db->query('DELETE FROM '
                    . 'product_category where product_categories="' 
                    . $category_table_name . '"');
            if ($query_delete_from_category) {
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
     * boolean function if update category.
     * @name if update category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return true if success update or false if faild to update. 
     * @internal .
     * 
     */
    function if_update_category($category_id,$category_name) {
    	
       $data_products = array(
       'product_categories' => $this->input->post('categoryName')
       );
       
       $this->db->where('product_categories_id', $category_id);
       $this->db->where('product_categories', $category_name);
       $update_products = $this->db->update('product_category', $data_products);
		
	if($update_products){
	    $data_product_category = array(
            'product_categories' => $this->input->post('categoryName')
            );
            $this->db->where('product_categories_id', $category_id);
	    $this->db->where('product_categories', $category_name);
	    $update_product_category = $this->db->update('products',
                    $data_product_category);
	        if ($update_product_category) {
	        	 $data_product_category = array(
	            'product_categories' => $this->input->post('categoryName')
	       		 );
		$this->db->where('product_categories_id', $category_id);
		$this->db->where('product_categories', $category_name);
		$update_deals_products_category = $this->db->update(
                                'deals_products', $data_product_category);
                    if($update_deals_products_category){
                        return true;
                    }else{
                        return false;
                    }
	            
	        } else {
	           return false;
	        }
			
	}else{
			
            return false;		
	}
    } 
//============================================================================// 
    /**
     * boolean function if update services category.
     * @name if update services category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return true if success update or false if faild to update. 
     * @internal .
     * 
     */
    function if_update_services_category($category_id,$category_name) {
    	
     $data_service_category = array(
        'service_categories' => $this->input->post('serviceName')
      );
     $this->db->where('service_categories_id', $category_id);
     $this->db->where('service_categories', $category_name);
     $update_service_category = $this->db->update('service_category',
             $data_service_category);
		
        if($update_service_category){

           $data_service = array(
               'service_categories' => $this->input->post('serviceName')
           );
           $this->db->where('service_categories_id', $category_id);
           $this->db->where('service_categories', $category_name);
           $update_service = $this->db->update('services', $data_service);

                   if($update_service){
                                   return true;
                           }else{
                                   return false;
                           }
        }else{
           return false;
        }   
    }     
//============================================================================// 
    /**
     * boolean function if delete service category.
     * <p>Description:</p>
     * This function make two delete query first into services and then into 
     * services category.
     * @name if delete services category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete two of them return true else return
     * false.
     *
     * @internal first we delete from products and then we delete from category.
     * 
     */
    function if_delete_service_category($category_table_name) {
        $this->load->database();
        $query_delete_from_products = $this->db->query('DELETE FROM services '
            . 'where service_categories="' . $category_table_name . '"');

        if ($query_delete_from_products) {
          $query_delete_from_category = $this->db->query('DELETE FROM '
          . 'service_category where service_categories="' 
          . $category_table_name . '"');
            if ($query_delete_from_category) {
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
     * boolean function if delete product.
     * <p>Description:</p>
     * This function make a delete query into database.
     * param $product_id and $product_categories used into where.
     * @param int $product_id
     * @param int $product_categories
     * @name if delete product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete return true else return false.
     * 
     */
    function if_delete_product($product_id, $product_categories) {
       

        $query_delete = $this->db->query('DELETE FROM deals_products WHERE '
        . 'product_id ="' . $product_id . '" AND product_categories ="' 
                . $product_categories . '" ');

        if ($query_delete) {
        	$query_del_products = $this->db->query('DELETE FROM '
                 . 'products WHERE product_id ="' . $product_id 
                 . '" AND product_categories ="' . $product_categories . '" ');
	  	 	if($query_del_products){
				return true;
			}else{
				return false;
			}
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if delete deals product.
     * <p>Description:</p>
     * This function make a delete query into database.
     * param $product_id and $product_categories used into where.
     * @param int $deals_products_id
     * @param int $product_categories
     * @name if delete deals product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete return true else return false.
     * 
     */
    function if_delete_deals_product($deals_products_id, $product_categories) {
        $this->load->database();

        $query_del_deals_product = $this->db->query('DELETE FROM deals_products'
                . ' WHERE deals_products_id ="' . $deals_products_id . '" AND '
                . 'product_categories ="' . $product_categories . '" ');

        if ($query_del_deals_product) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if delete service.
     * <p>Description:</p>
     * This function make a delete query into database.
     * param $service_id and $service_categories used into where.
     * @param int $service_id
     * @param int $service_categories
     * @name if delete service.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete return true else return false.
     * 
     */
    function if_delete_service($service_id, $service_categories) {
        $this->load->database();
        $query_del_service = $this->db->query('DELETE FROM services WHERE '
                . 'service_id ="' . $service_id . '" AND service_categories '
                . '="' . $service_categories . '" ');
        if ($query_del_service) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function for update orders status.
     * <p>Description:</p>
     * This function make a update query into database.
     * $order_number from input used in where.
     * @param string $table 
     * @name update orders status.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function update_orders_status($table) {

        $order_number = $this->input->get_post('order_number');

        $this->load->model('Cart_shop_model');
        $shop_cart = $this->Cart_shop_model->get_shop_cart($table, 
                'order_number', $order_number);

        $data = array(
            'order_number' => $this->input->get_post('order_number'),
            'user_name' => $this->input->get_post('userName'),
            'user_email' => $this->input->get_post('user_email'),
            'delivery_method' => $this->input->post('deliveryMethod'),
            'city' => $this->input->get_post('city'),
            'postcode' => $this->input->post('postcode'),
            'ship_to' => $this->input->get_post('ship_to'),
            'ordered_on' => $this->input->get_post('ordered_on'),
            'status' => $this->input->post('status'),
            'shop_cart' => $shop_cart,
            'notes' => $this->input->post('notes')
        );

        $this->db->where('order_number', $order_number);
        $query = $this->db->update($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function change order.
     * <p>Description:</p>
     * This function moves orders accordingly the status. Insert into 
     * $insert_tabel to order and after deleted from than that the use. 
     * @param string $table
     * @name change order.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if all success return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function change_order($table, $insert_tabel) {

        $order_number = $this->input->get_post('order_number');
        $this->load->model('Cart_shop_model');
        $shop_cart = $this->Cart_shop_model->get_shop_cart($table,'order_number'
                , $order_number);

        $data = array(
            'order_id' => $this->input->get_post('order_id'),
            'order_number' => $this->input->get_post('order_number'),
            'user_name' => $this->input->post('userName'),
            'user_email' => $this->input->get_post('user_email'),
            'delivery_method' => $this->input->post('deliveryMethod'),
            'city' => $this->input->get_post('city'),
            'postcode' => $this->input->post('postcode'),
            'ship_to' => $this->input->get_post('ship_to'),
            'ordered_on' => $this->input->get_post('ordered_on'),
            'status' => $this->input->post('status'),
            'shop_cart' => $shop_cart,
            'notes' => $this->input->post('notes')
        );


        $query = $this->db->insert($insert_tabel, $data);
        if ($query) {

            if ($this->delete_row_from_table($table, 'order_number',
                    $order_number)) {
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
     * boolean function for update request services status.
     * <p>Description:</p>
     * This function make a update query into database services_request_number 
     * from input used in where.
     * @param string $table 
     * @name update services status status.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function update_request_services_status($table) {

          $services_request_number = 
                             $this->input->get_post( 'services_request_number');
	$status=$this->input->post('status');
        $data = array(
         'services_request_id' => $this->input->get_post('services_request_id'),
         'service_id' => $this->input->get_post('service_id'),
         'service_categories' => $this->input->get_post('service_categories'),
         'services_request_number' => $services_request_number,
         'services_request_status' => $status,
         'user_email' => $this->input->get_post('user_email'),
         'service_name' => $this->input->get_post('service_name'),
         'date' => $this->input->get_post('date'),
         'notes' => $this->input->post('notes'),
         'full_name' => $this->input->get_post('full_name'),
         'adress' => $this->input->get_post('adress'),
         'city' => $this->input->get_post('city'),
         'postcode' => $this->input->get_post('postcode')
                
        );

        $this->db->where('services_request_number', $services_request_number);
        $query = $this->db->update($table, $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
        
    }
//============================================================================// 
    /**
     * boolean function change request services.
     * <p>Description:</p>
     * This function moves request services accordingly the status. Insert into 
     * $insert_tabel to request_services and after deleted from main table.
     * use. 
     * @param string $table
     * @name change request services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if all success return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter.
     * 
     */
    function change_request_services($table, $insert_tabel) {

        $services_request_number =
                            $this->input->get_post('services_request_number');
        $status=$this->input->post('status');
	
        $data = array(
         'services_request_id' => $this->input->get_post('services_request_id'),
         'service_id' => $this->input->get_post('service_id'),
         'service_categories' => $this->input->get_post('service_categories'),
         'services_request_number' =>
            $this->input->get_post('services_request_number'),
         'services_request_status' => $status,
         'user_email' => $this->input->get_post('user_email'),
         'service_name' => $this->input->get_post('service_name'),
         'date' => $this->input->get_post('date'),
         'notes' => $this->input->post('notes'),
         'full_name' => $this->input->get_post('full_name'),
         'adress' => $this->input->get_post('adress'),
         'city' => $this->input->get_post('city'),
         'postcode' => $this->input->get_post('postcode')
         
                
        );


        $query = $this->db->insert($insert_tabel, $data);
        if ($query) {

            if ($this->delete_row_from_table($table, 'services_request_number', 
                    $services_request_number)) {
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
     * boolean Generic function for delete a row with one where.
     * <p>Description:</p>
     * This function delete a row from $table where $var_where=$data_where.
     * @param undefined $table
     * @param undefined $var_where
     * @param undefined $data_where
     * @name delete row from table.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success delete return true else return false.
     *
     */
    function delete_row_from_table($table, $var_where, $data_where) {
        $this->db->where($var_where, $data_where);
        $result = $this->db->delete($table);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================//
    /**
     * This function get order by order number.
     * <p>Description:</p>
     * This function make a get query into database and select all information
     * of orders with spesifically order number .
     * @name get orders by order number.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal in this function. if the result is null we set empty array for 
     * better view.
     * 
     */
    function get_orders_by_order_number() {
        $this->load->database();
        $this->db->where('order_number', $this->input->post('orderNumber'));
        $query = $this->db->get('orders');
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'order_id' => '',
                    'order_number' => '',
                    'user_name' => '',
                    'user_email' => '',
                    'delivery_method' => '',
                    'city' => '',
                    'postcode' => '',
                    'ship_to' => '',
                    'status' => '',
                    'shop_cart' => '',
                    'notes' => ''
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                        'order_id' => $row['order_id'],
                        'order_number' => $row['order_number'],
                        'user_name' => $row['user_name'],
                        'user_email' => $row['user_email'],
                        'delivery_method' => $row['delivery_method'],
                        'city' => $row['city'],
                        'postcode' => $row['postcode'],
                        'ship_to' => $row['ship_to'],
                        'ordered_on' => $row['ordered_on'],
                        'status' => $row['status'],
                        'shop_cart' => $row['shop_cart'],
                        'notes' => $row['notes']
                    );
                }
            }
        }
        return $data;
    }

//============================================================================// 
    /**
     * boolean function insert cart shop
     * <p>Description:</p>
     * This function insert data into codeingiter shop cart.
     * @name insert_cart_shop.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success delete return true else return false.
     *
     * @internal in this function we take the shop cart as string and with 
     * unserialize we insert it into cart shop.
     */
    function insert_cart_shop() {

        $this->load->library('cart');
        $this->cart->destroy();

        $table_name = $this->input->get_post('table_name');
        $order_number = $this->input->get_post('order_number');
        $column_var_where = $this->input->get_post('column_var');


        $this->load->model('Cart_shop_model');
        $cartContentString = $this->Cart_shop_model->get_shop_cart($table_name, 
                $column_var_where, $order_number);

        if (!($cartContentString == NULL)) {

            $cartArray = unserialize($cartContentString);
            if ($this->cart->insert($cartArray)) {
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
     * boolean function for insert image into database.
     * <p>Description:</p>
     * This function insert image into specifically product where id and 
     * category is $product_id
     * and $product_categories .
     * @param undefined $product_id
     * @param undefined $product_categories
     * @name insert image.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success insert return true else return false.
     *
     */
    function insert_image($product_id, $product_categories) {


        $this->load->helper(array('form', 'url'));

        $config['upload_path'] = "images";
        $config['allowed_types'] = 'jpg|jpeg|gif|png';
        $config['logo_thumb'] = $_FILES['userfile']['name'];

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            echo $this->upload->display_errors('<center><p>', '</p></center>');
        } else {
            $image_data = array(
                'filename' => $config['logo_thumb'], 
                'full_path' => site_url($config['upload_path']),
                'product_id' => $product_id, 
                'product_categories' => $product_categories
            );
            $file_data = $this->upload->data();

            $if_add_image = $this->insert_product_image($image_data, 
                    $config, $file_data);
            if ($if_add_image) {
                return true;
            } else {
                return false;
            }
        }
    }
//============================================================================//
    /**
     * This function select_users_by_email.
     * <p>Description:</p>
     * This function make a get query into s user.
     * @name select users by email.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return error message.
     */
    function select_user_by_email($email) {
    	
        $this->load->database();
        $this->db->where('email',$email);
        $query = $this->db->get('users');
        if ($query) {
            foreach ($query->result_array() as $row) {
                $data[] = array(
                    'id' => $row['id'],
                    'full_name' => $row['full_name'],
                    'email' => $row['email'],
                    'delivery_method' => $row['delivery_method'],
                    'adress' => $row['adress'],
                    'city' => $row['city'],
                    'postcode' => $row['postcode'],
                    'phone_number' => $row['phone_number'],
                    'mobile_number' => $row['mobile_number']
                );
            }
            return $data;
        } else {
            echo "echo faild to get users";
        }
    }
//============================================================================// 
    /**
     * This function select all users contacts.
     * <p>Description:</p>
     * This function make a get query..
     * @name select all users contacts.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return empty data.
     */
    function select_all_users_contacts() {
    	
        $this->load->database();
        $query = $this->db->get('user_contacts');
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'contact_id' => '',
                    'email_from' => '',
                    'message' => '',
                    'answer' => '',
                    'message_status' => '',
                    
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                        'contact_id' => $row['contact_id'],
                        'email_from' => $row['email_from'],
                        'message' => $row['message'],
                        'answer' => $row['answer'],
                        'message_status' => $row['message_status']
                    );
                }
            }
        }
        return $data;
    }
//============================================================================// 
    /**
     * This function select all users email contacts.
     * <p>Description:</p>
     * This function make a get query.
     * @name select all users email contacts.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return empty data.
     */
    function select_all_users_email() {
        $this->load->database();
        $query = $this->db->get('users');
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'email' => ''
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                        'email' => $row['email']
                    );
                }
            }
        }
        return $data;
    }  
//============================================================================// 
    /**
     * boolean function if update contact.
     * <p>Description:</p>
     * This function make a update query into user_contacts.
     * @name update contact.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
     function update_contact() {
     	$email_from = $this->input->get_post('email_from');
     	$contact_id = $this->input->get_post('contact_id');
        
     	  $data= array(
             'answer' => $this->input->post('answer'),
             'message_status' => 'done'
                    );
		
        $this->db->where('email_from', $email_from);
        $this->db->where('contact_id', $contact_id);
        $query = $this->db->update('user_contacts', $data);
        if($query){
            return true;
	}else{
            return false;
		}
    }
//============================================================================// 
    /**
     * boolean function check if product is on deal.
     * <p>Description:</p>
     * This function make a get query and then checks if exist.
     * @name check_if_product_is_on_deal.
     * @param type $product_id
     * @param type $product_categories
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if product exist return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter. 
     * 
     */
    function check_if_product_is_on_deal($product_id,$product_categories) {
        $this->db->where('product_id', $product_id);
        $this->db->where('product_categories', $product_categories);

        $query = $this->db->get('deals_products');
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

//============================================================================// 
    /**
     * boolean function if find search.
     * <p>Description:</p>
     * This function make a search query.
     * @name search_result.
     * @param type $search_term
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return result data else return return 
     * empty data.
     *
     */
     function search_result($search_term=''){
		
	   $this->db->select('*');
	   $this->db->from('products');
	   $this->db->like('product_categories', $search_term);
	   $this->db->or_like('product_name', $search_term);
	   $this->db->or_like('product_description', $search_term);
	   $query = $this->db->get();
           return $query->result_array();
	}
 
//============================================================================// 	
   /**
     * This function is for send a general message.
     * <p>Description:</p>
     * makes a send mail with subject and message which will give.
     * @param undefined $subject
     * @param undefined $message
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return true if email send success or faild if dont
    */
    function  send_newsletters($subject, $message){
  	$data=$this->select_all_users_email();
        
  	foreach($data as $user){
	 $boolean=  $this->general_send_email($subject,$message,$user['email']);
            if($boolean=false){
                return false;
            }
	}
        return true;
        
  	
    }
    
//============================================================================//   
}

?>