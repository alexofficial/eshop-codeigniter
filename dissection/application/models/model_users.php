<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

//============================================================================// 
/**
 * This class  : have all methods for user business administrator
 * @name Model_users.
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 * @filesource 
 * @api
 * @package application\models
 * @copyright Copyright (c) 2014-2015, Alexander Patsanis
 * 
 */
class Model_users extends CI_Model {
//============================================================================// 	
     /**
     * This function is for send a general message.
     * <p>Description:</p>
     * makes a send mail with subject and message which will give.
     * @param undefined $subject
     * @param undefined $message
     * @name general_send_email
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
     * boolean function check if user exist.
     * <p>Description:</p>
     * This function make a get query and then checks if exist.
     * @name check user exist.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if user exist return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter. 
     * 
     */
    function check_user_exist() {
        $this->db->where('email', $this->input->post('email'));
        /**
         * @internal {use md5 because saved password into database is with code 
         * of md5}}
         */
        $this->db->where('password', md5($this->input->post('password')));

        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function check if this email exist as user.
     * <p>Description:</p>
     * This function make a get query and then checks if exist.
     * @name if email exist.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if user exist return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter. 
     * 
     */
    function if_email_exist($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if add temp user.
     * <p>Description:</p>
     * This function make a insert query into temp user.
     * @param string $key
     * @name add temp user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter. 
     * 
     */
    function add_temp_user($key) {

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
            'key' => $key
        );
        
        $query = $this->db->insert('temp_users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================//
    /**
     * boolean function if add password recovery to user.
     * <p>Description:</p>
     * This function make a insert query into temp user.
     * @param string $key
     * @param string $email
     * @name add_password_recovery_user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter. 
     * 
     */
    function add_password_recovery_user($key, $email) {

        $data = array(
            'email' => $email,
            'key' => $key
        );
        $query = $this->db->insert('temp_recovery_password', $data);
        if ($query) {

            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if update user account.
     * <p>Description:</p>
     * This function make a update query into user.
     * @name if_update_user_account.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter. 
     * 
     */
    function if_update_user_account() {
        $data = array(
            'email' => $this->input->get_post('email'),
            'delivery_method' => $this->input->post('userCourier'),
            'full_name' => $this->input->post('userFullName'),
            'adress' => $this->input->post('userAdress'),
            'city' => $this->input->post('userCity'),
            'postcode' => $this->input->post('userPostcode'),
            'phone_number' => $this->input->post('userPhone'),
            'mobile_number' => $this->input->post('userMobilePhone'),
        );
        $this->db->where('email', $this->input->get_post('email'));
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================//
    /**
     * boolean function if update user password.
     * <p>Description:</p>
     * This function make a update query into user.
     * @name update user password.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     * @internal this posts comes from view is a helper of codeingiter. 
     * 
     */
    function update_user_password($email, $password) {
        
        $data = array(
            'password' => md5($password)
        );
        $this->db->where('email', $email);
        $query = $this->db->update('users', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if is key valid.
     * <p>Description:</p>
     * This function make a get query .
     * @param string $key
     * @name is key valid.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
    function is_key_valid($key) {
        $this->db->where('key', $key);
        $query = $this->db->get('temp_users');

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function is key password recovery valid.
     * <p>Description:</p>
     * This function make a get query .
     * @param string $key
     * @name is key password recovery valid.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
    function is_key_password_recovery_valid($key) {
        $this->db->where('key', $key);
        $query = $this->db->get('temp_recovery_password');

        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================//
    /**
     * boolean function is if update password.
     * <p>Description:</p>
     * This function make a get query .
     * @param string $key
     * @name if_update_password.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
    function if_update_password($key) {
        $user_data = $this->select_user_email_password_recovery($key);

        foreach ($user_data as $data) {
            $email = $data['email'];
            $password = $this->input->post('password');
            if ($this->update_user_password($email, $password)) {
                $delete_temp_recovery_password = 
                        $this->delete_temp_recovery_password($email, $key);
                if($delete_temp_recovery_password) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }
//============================================================================// 
    /**
     * This function select user email password recovery.
     * <p>Description:</p>
     * This function make a get query from temp_recovery_password.
     * @name select all users.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return error message.
     */
    function select_user_email_password_recovery($key) {
        $this->load->database();
        $this->db->where('key', $key);
        $query = $this->db->get('temp_recovery_password');
        if ($query) {
            foreach ($query->result_array() as $row) {
                $data[] = array(
                    'email' => $row['email']
                );
            }
            return $data;
        } else {
            return $data = null;
        }
    }

//============================================================================// 
    /**
     * boolean function if add user.
     * <p>Description:</p>
     * This function make a insert query into temp user.
     * @param string $key
     * @name add user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
    function add_user($key) {

        $this->db->where('key', $key);
        $temp_user = $this->db->get('temp_users');

        if ($temp_user) {
            $row = $temp_user->row();

            $data = array(
                'email' => $row->email,
                'password' => $row->password,
                'delivery_method' => $row->delivery_method,
                'full_name' => $row->full_name,
                'adress' => $row->adress,
                'city' => $row->city,
                'postcode' => $row->postcode,
                'phone_number' => $row->phone_number,
                'mobile_number' => $row->mobile_number
            );

            $did_add_user = $this->db->insert('users', $data);
        }

        if ($did_add_user) {

            $this->db->where('key', $key);
            $this->db->delete('temp_users');
            return $data;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if delete user order.
     * <p>Description:</p>
     * This function make a delete query into orders.
     * @param string $order_number
     * @param string $user_email
     * @name delete user order.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
    function delete_user_order($order_number, $user_email) {
        $this->db->where('order_number', $order_number);
        $this->db->where('user_email', $user_email);
        $query = $this->db->delete('orders');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if delete temp recovery password.
     * <p>Description:</p>
     * This function make a delete query into temp_recovery_password.
     * @param string $email
     * @param string $key
     * @name delete temp recovery password.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
    function delete_temp_recovery_password($email, $key) {
        $this->db->where('email', $email);
        $this->db->where('key', $key);
        $query = $this->db->delete('temp_recovery_password');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if delete user request service.
     * <p>Description:</p>
     * This function make a delete query into services_requests.
     * @param string $services_request_number
     * @param string $user_email
     * @name if delete user request service.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
    function if_delete_user_request_service($services_request_number, 
            $user_email) {
        $this->db->where('services_request_number', $services_request_number);
        $this->db->where('user_email', $user_email);
        $query = $this->db->delete('services_request');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * This function select all users.
     * <p>Description:</p>
     * This function make a get query from users.
     * @name select all users.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return error message.
     */
    function select_all_users() {
        $this->load->database();
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
     * This function select_user_password.
     * <p>Description:</p>
     * This function make a get query into user.
     * @param type $email 
     * @name select user password.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return null data.
     */
    function select_user_password($email) {
        $this->load->database();
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        if ($query) {
            foreach ($query->result_array() as $row) {
                $data[] = array(
                    'password' => $row['password']
                );
            }
            return $data;
        } else {
            return $data = null;
        }
    }

//============================================================================// 
    /**
     * This function select_users_by_email.
     * <p>Description:</p>
     * This function make a get query into s user.
     * @name select users by email.
     * @param type $email
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return error message.
     */
    function select_user_by_email($email) {
        
        $this->load->database();
        $this->db->where('email', $email);
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
     * boolean function if delete user.
     * <p>Description:</p>
     * This function make a insert query into temp user.
     * @param string $user_id
     * @name if_delete_user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
    function if_delete_user($user_id) {
        $query = $this->db->query('DELETE FROM users where id="' 
                . $user_id . '" ');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================//
    /**
     * boolean function if delete user contact.
     * <p>Description:</p>
     * This function make a delete query to user_contacts .
     * @param string $countact_id
     * @name if delete user contact.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
    function if_delete_user_contact($countact_id) {
        $query = $this->db->query('DELETE FROM user_contacts where contact_id="'
                . $countact_id . '" ');
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if add a new contact.
     * <p>Description:</p>
     * This function make a insert query into user_contacts.
     * @name add contact.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     */
    function add_contact() {
        $message = $this->input->post('message');
        $email = $this->session->userdata('user_email');
        $data = array(
            'email_from' => $email,
            'message' => $message
        );
        $query = $this->db->insert('user_contacts', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function if add a new contact.
     * <p>Description:</p>
     * This function make a select query into user_contacts.
     * @name add contact.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  array of contacts data.
     *
     */
    function select_user_contacts() {
        $this->load->database();
        $this->db->where('email_from', $this->session->userdata('user_email'));
        $query = $this->db->get('user_contacts');
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'contact_id' => '',
                    'email_from' => '',
                    'message' => '',
                    'answer' => ''
                );
            } else {
                foreach ($query->result_array() as $row) {
                    $data[] = array(
                        'contact_id' => $row['contact_id'],
                        'email_from' => $row['email_from'],
                        'message' => $row['message'],
                        'answer' => $row['answer']
                    );
                }
            }
        }
        return $data;
    }
//============================================================================// 
    /**
     * This function select user orders.
     * <p>Description:</p>
     * This function make a get query into user.
     * @param string $table 
     * @name select user orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return empty data.
     */
    function select_user_orders($table) {
        $this->load->database();
        $this->db->where('user_email', $this->session->userdata('user_email'));
        $query = $this->db->get($table);
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
                    'ordered_on' => '',
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
     * This function select user request services.
     * <p>Description:</p>
     * This function make a get query into temp user.
     * @param string $table 
     * @name select user orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return empty data.
     */
    function select_user_request_services($table) {
        $this->load->database();
        $this->db->where('user_email', $this->session->userdata('user_email'));
        $query = $this->db->get($table);
        if ($query) {
            if ($query->result_array() == null) {
                $data[] = array(
                    'service_categories' => '',
                    'services_request_number' => '',
                    'services_request_status' => '',
                    'user_email' => '',
                    'service_name' => '',
                    'date' => '',
                    'full_name' => '',
                    'adress' => '',
                    'city' => '',
                    'postcode' => ''
                );
            } else {
                foreach ($query->result_array() as $row) {
                $data[] = array(
                   'service_categories' => $row['service_categories'],
                   'services_request_number' => $row['services_request_number'],
                   'services_request_status' => $row['services_request_status'],
                   'user_email' => $row['user_email'],
                   'service_name' => $row['service_name'],
                   'date' => $row['date'],
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
     * This function get orders by order number.
     * <p>Description:</p>
     * This function make a get query into temp user.
     * @name get orders by order number.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return empty data.
     */
    public function get_orders_by_order_number() {
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
                    'ordered_on' => '',
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
     * Boolean function if user add a service request.
     * <p>Description:</p>
     * This function if all is success insert a new service request. 
     * @name if user add service request.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success insert return true else return false.
     */
    function if_user_add_service_request() {

        $this->load->library('session');
        /**
         * {@internal data.}}
         */
        $user_email = $this->session->userdata('user_email');
        $service_id = $this->input->get_post('service_id');
        $service_name = $this->input->get_post('service_name');
        $category = $this->input->get_post('category');
        $data = $this->date();
        $table = "services_request";
        $where_var = "services_request_number";
        $number = $this->generate_md5_number($table, $where_var);
        
        $user_item = $this->select_user_by_email($user_email);
        
        foreach($user_item as $user){
            $full_name = $user['full_name'];
            $adress = $user['adress'];
            $city = $user['city'];
            $postcode = $user['postcode']; 
        }
        
        $data = array(
            'service_id' => $service_id,
            'service_categories' => $category,
            'services_request_number' => $number,
            'services_request_status' => "Listing",
            'user_email' => $user_email,
            'service_name' => $service_name,
            'date' => $data,
            'full_name' => $full_name,
            'adress' => $adress,
            'city' => $city,
            'postcode' => $postcode
            
        );
        
        $insert_orders = $this->db->insert($table, $data);
        if ($insert_orders) {
            $subject = "Easy Shop : id of service request.";
            $message = "<p>Thanks you for service request!</p>";
            $message .= "<p>your id is " . $number . "</p>";
            $send_to = $user_email;
            if($this->general_send_email($subject, $message, $send_to))
            {
                return true;
            }else{
                return false;
            }
            
        } else {
            
        }
         
         
    }
//============================================================================// 
    /**
     * Boolean function generate md5 number .
     * <p>Description:</p>
     * This function make a loop when while generate a uniqid number for 
     * spesifically
     * table and row.
     * @name generate md5 number.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return uniqid number.
     * @internal with help of check_if_number_exist check if generate number 
     * exist 
     */
    function generate_md5_number($table, $where_var) {
        $number = md5(uniqid());
        $if_exist_order_number = $this->check_if_number_exist($table,
                $where_var, $number);

        while ($if_exist_order_number) {
            $number = md5(uniqid());
            $if_exist_order_number = $this->check_if_number_exist($table, 
                    $where_var, $number);
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
     * Boolean function check if number number exist.
     * <p>Description:</p>
     * This function select all $table and check if $where_data exist.
     * @param string $table
     * @param string $where_var
     * @param string $where_data
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if find this $where_data return true else return false.
     */
    function check_if_number_exist($table, $where_var, $where_data) {
        $query = $this->db->query("SELECT * FROM $table WHERE $where_var='" 
                . $where_data . "'");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * Boolean function  if insert cart shop.
     * <p>Description:</p>
     * This function insert cart shop.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success insert return true else return false.
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
     * This function is for search result .
     * <p>Description:</p>
     * This function make a query into table products and collect data.
     * @param type $search_term
     * @name search_result.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return array data.
     * @internal  $query->result_array()  is a codeingiter function.
     */
    function search_result($search_term = 'default') {

        $this->db->select('*');
        $this->db->from('products');
        $this->db->like('product_categories', $search_term);
        $this->db->or_like('product_name', $search_term);
        $this->db->or_like('product_description', $search_term);
        $query = $this->db->get();
        return $query->result_array();
    }
//============================================================================//

}

?>