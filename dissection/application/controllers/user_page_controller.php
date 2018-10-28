<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
//============================================================================// 
/**
 * This class  : hosts all controll of user methods.
 * 
 * @name User_page_controller.
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 * @filesource  
 * @package application\controllers
 * @copyright Copyright (c) 2014-2015, Alexander Patsanis
 * 
 */
class User_page_controller extends CI_Controller {

//============================================================================// 
    /**
     * This function gives to others functions of view some default data.
     * <p>Description of data:</p>
     * <ul>
     *  <li>styles paths</li>
     *  <li>image paths</li>
     * </ul>
     * 
     * @return string array of all this data.
     */
    function stantar_user_data_view() {
        $data["css_path_home_page"] = "styles/home_page.css";
        $data["css_path_user_logged"] = "styles/logged_user.css";
        $data["css_path_admin_logged"] = "styles/admin_page.css";
        $data["css_path_product"] = "styles/product.css";
        $data["css_path_product_normalize"] = "styles/normalize.css";
        $data["css_path_search"] = "styles/search.css";
        $data["path_home_image"] = "images/homeImage.png";
        $data['selected_categories'] = $this->select_all_categories();
        $data['selected_services_categories'] = 
                $this->select_all_services_categories();
        return $data;
    }
//============================================================================// 	
     /**
     * This function is for send a general message.
     * <p>Description:</p>
     * makes a send mail with subject and  message which will give.
     * @param undefined $subject
     * @param undefined $message
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return true if email send success or faild if dont
     */
    function general_send_email($subject, $message,$send_to){
        $this->load->model('email_model');
        return $this->email_model->general_send_email($subject,
                $message,$send_to);
    }
//============================================================================// 
    /**
     * This function control index view of user logged.
     * @name index_user_page :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>deals prodcuts</li>
     * <li>shop cart</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>add shop</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  view of user logged.
     * 
     */
    
     function index_user_page() {
        $user_email = $this->session->userdata('user_email');
        $this->load->model('Cart_shop_model');
        $this->Cart_shop_model->select_shop_cart($user_email);
        
        $data= $this->stantar_user_data_view();
        $data["page_title"] = "user home page";
        $data['selected_products_deals'] = $this->select_all_deals_product();
         /**
         * {@internal here load the view. We can add data only at first
          *  load of view. }}
         */
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/user/logged_user_header');
        $this->load->view('body_content_4/user/logged_user_content');
        $this->load->view('body_footer_5/user_footer');
    }
//============================================================================// 
    /**
     * This function control search view.
     * @name search_view :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>searched prodcuts</li>
     * <li>shop cart</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>add shop</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  search view.
     * 
     */
     function search_view() {
       
        $data= $this->stantar_user_data_view();
        $data["page_title"] = "user search page";
        $search_input=$this->input->post('search_input');
        
        $data['search_result']=$this->search_result($search_input);
        $data['category']='computers';
         /**
         * {@internal here load the view. We can add data only at first
         *  load of view. }}
         */
         
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/user/search_logged_user_header');
        $this->load->view('body_content_4/user/search_logged_user_content');
        $this->load->view('body_footer_5/user_footer');
        
    }
//============================================================================// 
    /**
     * This function control fix view. 
     * @name fix_view :
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  fix page.
     * 
     */
     function fix_view() {
        
        $data= $this->stantar_user_data_view();
        $data["page_title"] = "user home page";
         /**
         * {@internal here load the view. We can add data only at first
          *  load of view. }}
         */
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('fix_body');
        $this->load->view('body_footer_5/user_footer');
    }
//============================================================================// 
    /**
     * This function control how to order view of user.
     * @name how_to_order_view :
     * 
     * <p>Description:</p>
     * 
     * user user can see view of:
     * <ul>
     * <li>how to order</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  how to order view.
     * 
     */
    public function how_to_order_view() {

        $data = $this->stantar_user_data_view();
        $data["page_title"] = "how to order";
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/home/how_to_order_site_body_header');
        $this->load->view('body_content_4/home/how_to_order_site_content');
        $this->load->view('body_footer_5/user_footer');
    }
//============================================================================// 
    /**
     * This function control payment methods view of user.
     * @name payment_methods_view :
     * 
     * <p>Description:</p>
     * 
     * user can see view of:
     * <ul>
     * <li>payment methods</li>
     * </ul>
     * user user can:
     * <ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  payment methods view.
     * 
     */
    public function payment_methods_view() {

        $data = $this->stantar_user_data_view();
        $data["page_title"] = "how to order";
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/home/'
                . 'payment_methods_site_body_header');
        $this->load->view('body_content_4/home/'
                . 'payment_methods_site_content');
        $this->load->view('body_footer_5/user_footer');
    }
//============================================================================// 
    /**
     * This function control shipping methods view of user.
     * @name shipping_methods_view :
     * 
     * <p>Description:</p>
     * 
     * user user can see view of:
     * <ul>
     * <li>shipping methods</li>
     * </ul>
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  shipping methods view.
     * 
     */
    public function shipping_methods_view() {

        $data = $this->stantar_user_data_view();
        $data["page_title"] = "how to order";
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/home/'
                . 'shipping_methods_site_body_header');
        $this->load->view('body_content_4/home/'
                . 'shipping_methods_site_content');
        $this->load->view('body_footer_5/user_footer');
    }
//============================================================================// 
    /**
     * This function control contact view.
     * @name contact :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>contact form</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>send contact request</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  contact view.
     * 
     */
     function contact() {
       
        $data= $this->stantar_user_data_view();
        $data["page_title"] = "user contact page";
   	$data["user_email"]= $this->session->userdata('user_email');
         
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/user/contact_logged_user_header');
        $this->load->view('body_content_4/user/contact_logged_user_content');
        $this->load->view('body_footer_5/user_footer');
        
    }    
//============================================================================// 
    /**
     * This function control contact history view.
     * @name contact_history :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>contact history view</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>delete a contact</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  contact history view.
     * 
     */     
    function contact_history() { 
        $data= $this->stantar_user_data_view();
        $data["page_title"] = "user contact history page";
   	$data["user_email"]= $this->session->userdata('user_email');
   		
   	$data['user_contacts']= $this->select_user_contacts();
         
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/user/'
                . 'contact_history_logged_user_header');
        $this->load->view('body_content_4/user/'
                . 'contact_history_logged_user_content');
        $this->load->view('body_footer_5/user_footer');
    }
//============================================================================// 
    /**
     * This function control user account view.
     * @name user_account_view :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>user account form view</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>update account</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  user account view.
     * 
     */
   function user_account_view() {
       
        $data= $this->stantar_user_data_view();
        $data["page_title"] = "user account page";
   	$data["user_email"]= $this->session->userdata('user_email');
   	$email = $this->session->userdata('user_email');
   	$data['user_account']= $this->select_user_by_email($email);
         
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/user/'
                . 'user_account_logged_user_header');
        $this->load->view('body_content_4/user/'
                . 'user_account_logged_user_content');
        $this->load->view('body_footer_5/user_footer');
    } 
//============================================================================// 
    /**
     * This function control contact delete view.
     * @name contact_delete_view :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>contact history view with delete changes</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>delete a contact</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return contact history view.
     * 
     */         
    function contact_delete_view() {
           $countact_id =$this->input->get_post('contact_id');
           
           $if_delete_contact = $this->delete_user_contact($countact_id);
           if($if_delete_contact){
               $this->contact_history();
           }else{
               $this->contact_history();
           }
    }
//============================================================================// 
    /**
     * This function is for contact validator. 
     * @name contact_validator.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of contact with success message if add a contact else a 
     * faild message .
     *
     * @internal this code call boolean function add_contact.
     * 
     */
    function contact_validator(){
	$this->load->library('form_validation');

        $this->form_validation->set_rules('message', 'message', 
                'required|trim|min_length[3]|max_length[1500]');
        
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {
              $if_add_contact=$this->add_contact();
              if($if_add_contact){
			  	echo "<center>Success</center>";
			  	$this->contact();
			  }else{
                                echo "<center>Faild</center>";
			  	$this->contact();
			  }
        }else{
               $this->contact();
        }
    }
//============================================================================// 
    /**
     * This function is for update user account validator. 
     * @name update_user_account_validator.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of user account with success message if add a contact else
     * a faild message .
     *
     * @internal this code call boolean function if_update_user_account.
     * 
     */     
     function update_user_account_validator(){
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('userCourier', 'Courier', 
                  'required|trim|');
            $this->form_validation->set_rules('userFullName', 'FullName', 
                  'required|trim|min_length[4]|max_length[45]|');
            $this->form_validation->set_rules('userAdress', 'Adress', 
                  'required|trim|min_length[4]|max_length[45]|');
            $this->form_validation->set_rules('userCity', 'City', 
                  'required|trim|min_length[4]|max_length[45]|');
            $this->form_validation->set_rules('userPostcode', 'Postcode', 
                  'required|trim|min_length[4]|max_length[30]|numeric|');
            $this->form_validation->set_rules('userPhone', 'Phone', 
                  'required|trim|min_length[4]|max_length[30]|numeric|');
            $this->form_validation->set_rules('userMobilePhone', 
                  'MobilePhone', 'trim|min_length[4]|max_length[30]|numeric|');


            $result_form_validation = $this->form_validation->run();

            if ($result_form_validation) {
               $if_update_user_account = $this->if_update_user_account();
               if($if_update_user_account){
                   echo "<center id='#success_message'>Success<center>";
                    $this->user_account_view();
               }else{
                   echo "<center>Faild<center>";
                    $this->user_account_view();
               }
            } else {
                 $this->user_account_view();
            }
	}     
//============================================================================// 
    /**
     * This function select all deals product. 
     * @name  select_all_deals_product
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if true return true else return false.
     *
     * @internal this code call Model_admin from models and then the function 
     * select_all_deals_product.
     */    
 	function select_all_deals_product(){
		$this->load->model('Model_admin');
        return $this->Model_admin->select_all_deals_product();
	}          
    
//============================================================================// 
    /**
     * This function is for user logout. 
     * @name  user_logout
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return index view of no login users.
     *
     * @internal this function call session helper of codeingiter.
     */   
     function user_logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'Home_page_controller/index');
    }
//============================================================================// 
    /**
     * This function is for add a contact. 
     * @name add_contact.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean.True if success to add or false if faild.
     *
     * @internal this code call Model_users from models and then the function 
     * add_contact.
     * 
     */  
     function add_contact() {
        $this->load->model('Model_users');
        return $this->Model_users->add_contact();
    }

//============================================================================// 
    /**
     * This function select all services categories. 
     * @name select_all_services_categories.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data else return message.
     *
     * @internal this code call Model_admin from models and then the function 
     * select_all_services_categories.
     * 
     */ 
     function select_all_services_categories() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_services_categories();
    }
//============================================================================// 
    /**
     * This function controlls search result. 
     * @param type $search_input
     * @name search_result.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return array of results.
     *
     * @internal this code call Model_users from models and then the function 
     * search_result.
     * 
     */  
     function search_result($search_input) {
        $this->load->model('Model_users');
        return $this->Model_users->search_result($search_input);
    } 
//============================================================================// 
    /**
     * This function controll select user contacts .
     * @name select_user_contacts.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return array of contacts data.
     *
     * @internal this code call Model_users from models and then the function 
     * select_user_contacts.
     * 
     */ 
     function select_user_contacts() {
        $this->load->model('Model_users');
        return $this->Model_users->select_user_contacts();
    }      
    
//============================================================================// 
    /**
     * This function select all categories.
     * @name select_all_categories.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success to select return array of data else return message.
     *
     * @internal this code call Model_admin from models and then the function 
     * select_all_categories.
     * 
     */  
     function select_all_categories() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_categories();
    }
//============================================================================// 
    /**
     * This function select user orders.
     * @param type $table 
     * @name select_user_orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return empty data.
     *
     * @internal this code call Model_users from models and then the function 
     * select_user_orders.
     * 
     */ 
     function select_user_orders($table) {
        $this->load->model('Model_users');
        return $this->Model_users->select_user_orders($table);
    }
//============================================================================// 
    /**
     * This function select user request services.
     * @param type $table 
     * @name select_user_request_services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return data. if query success return data else return empty data..
     *
     * @internal this code call Model_users from models and then the function 
     * select_user_request_services.
     * 
     */  
     function select_user_request_services($table) {
        $this->load->model('Model_users');
        return $this->Model_users->select_user_request_services($table);
    }    

//============================================================================// 
    /**
     * This function select all product.
     * @param type $categorie 
     * @name select_user_request_services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal this code call Model_admin from models and then the function 
     * select_all_product_by_category.
     * 
     */  
     function select_all_product($categorie) {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_product_by_category($categorie);
    }  
//============================================================================// 
    /**
     * This function select all services.
     * @param type $categorie 
     * @name select_all_services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if success return array of data  else return return empty array 
     * of data.
     *
     * @internal this code call Model_admin from models and then the function 
     * select_all_services_by_category.
     * 
     */  
     function select_all_services($categorie) {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_services_by_category($categorie);
    }
//============================================================================// 
    /**
     * This function select user by email.
     * @name select_user_by_email.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if query success return data else return error message.
     *
     * @internal this code call Model_users from models and then the function 
     * select_user_by_email.
     * 
     */   
     function select_user_by_email($email) {
        $this->load->model('Model_users');
        return $this->Model_users->select_user_by_email($email);
    }
//============================================================================// 
    /**
     * This function delete user order.
     * @param type $order_number
     * @param type $user_email
     * 
     * @name delete_user_order.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if query success return true else return false.
     *
     * @internal this code call Model_users from models and then the function 
     * delete_user_order.
     * 
     */
     function delete_user_order($order_number,$user_email) {
        $this->load->model('Model_users');
        return $this->Model_users->delete_user_order($order_number,$user_email);
    }
//============================================================================// 
    /**
     * This function control if delete user request services.
     * @param type $services_request_number
     * @param type $user_email
     * 
     * @name if_delete_user_request_service.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  boolean. if query success return true else return false.
     *
     * @internal this code call Model_users from models and then the function 
     * if_delete_user_request_service.
     * 
     */ 
     function if_delete_user_request_service($services_request_number,
             $user_email) {
        $this->load->model('Model_users');
        return $this->Model_users->if_delete_user_request_service(
                $services_request_number,$user_email);
    }
    
//============================================================================// 
    /**
     * This function control if delete user contact.
     * @param type $countact_id
     * 
     * @name delete_user_contact.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  boolean. if query success return true else return false.
     *
     * @internal this code call Model_users from models and then the function 
     * if_delete_user_contact.
     * 
     */ 
     function  delete_user_contact($countact_id) {
        $this->load->model('Model_users');
        return $this->Model_users->if_delete_user_contact($countact_id);
    }  
//============================================================================// 
    /**
     * This function control products view.
     * @name show_products :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>deals products view</li>
     * <li>shop cart</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>add shop</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return products view.
     * 
     */  
     function show_products() {
        $category = $this->input->get('category'); 
        $data= $this->stantar_user_data_view();
        $data["page_title"] = "products " . $category . " page";
        $data['category'] = $category;
        
        $data['selected_products'] = $this->select_all_product($category);

        if (!$data['selected_categories'] == NULL) {
            $this->load->view('html_header_1/logged_user_html_header', $data);
            $this->load->view('body_navigator_2/logged_user_body_navigator');
            $this->load->view('body_header_3/user/'
                    . 'all_products_user_panel_header');
            $this->load->view('body_content_4/user/'
                    . 'all_products_user_panel_content');
            $this->load->view('body_footer_5/user_footer');
        }
    }
//============================================================================// 
    /**
     * This function control service view.
     * @name show_service :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>service view</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>add service</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return service view.
     * 
     */   
     function show_service() {
        $category = $this->input->get('category'); 
        $data= $this->stantar_user_data_view();
        $data["page_title"] = "products " . $category . " page";
        $data['category'] = $category;
        
        $data['selected_services'] = $this->select_all_services($category);

        if (!$data['selected_services_categories'] == NULL) {
            $this->load->view('html_header_1/logged_user_html_header', $data);
            $this->load->view('body_navigator_2/logged_user_body_navigator');
            $this->load->view('body_header_3/user/'
                    . 'all_services_user_panel_header');
            $this->load->view('body_content_4/user/'
                    . 'all_services_user_panel_content');
            $this->load->view('body_footer_5/user_footer');
        }
    }
//============================================================================// 
    /**
     * This function control service by category view.
     * @name show_service_by_category :
     * @param type $category
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>category service view</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>add service</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return category service view.
     * 
     */
     function show_service_by_category($category) {
         /*
          * TODO: check this code
          */
        $category = $this->input->get('category');
        $data= $this->stantar_user_data_view();
        $data["page_title"] = "products " . $category . " page";
        $data['category'] = $category;
        
        $data['selected_services'] = $this->select_all_services($category);

        if (!$data['selected_services_categories'] == NULL) {
            $this->load->view('html_header_1/logged_user_html_header', $data);
            $this->load->view('body_navigator_2/logged_user_body_navigator');
            $this->load->view('body_header_3/user/all_services_user_panel_header');
            $this->load->view('body_content_4/user/all_services_user_panel_content');
            $this->load->view('body_footer_5/user_footer');
        }
    }
//============================================================================//
    /**
     * This function show service for service request.
     * @name show_service_for_service_request.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void.
     *
     * @internal this code call show_service_by_category.
     * 
     */  
     function show_service_for_service_request() {
       
       $category= $this->input->get_post('service_categories');
       $this->show_service_by_category($category);
    }
//============================================================================// 
    /**
     * This function control reload products category view.
     * @name show_products_refresh :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>category products view</li>
     * <li>shop cart</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>add shop</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return category products view.
     * 
     */   
     function show_products_refresh($category) {

        $data= $this->stantar_user_data_view();
        $data["page_title"] = "products " . $category . " page";
        $data["category"] = $category;
        
        $data['selected_products'] = $this->select_all_product($category);

        if (!$data['selected_categories'] == NULL) {
            $this->load->view('html_header_1/logged_user_html_header', $data);
            $this->load->view('body_navigator_2/logged_user_body_navigator');
            $this->load->view('body_header_3/user/'
                    . 'all_products_user_panel_header');
            $this->load->view('body_content_4/user/'
                    . 'all_products_user_panel_content');
            $this->load->view('body_footer_5/user_footer');
        }
    }
//============================================================================// 
    /**
     * This function control orders status view.
     * @name orders_status :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>orders status</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>delete order</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return orders status view.
     * 
     */  
     function orders_status() {

      $table_orders = 'orders';

      $data= $this->stantar_user_data_view();
      $data["page_title"] = "orders status";

      $data['selected_orders'] = $this->select_user_orders($table_orders);


      $this->load->view('html_header_1/logged_user_html_header', $data);
      $this->load->view('body_navigator_2/logged_user_body_navigator');
      $this->load->view('body_header_3/user/orders_status_user_panel_header');
      $this->load->view('body_content_4/user/orders_status_user_panel_content');
      $this->load->view('body_footer_5/user_footer');
    }
//============================================================================// 
    /**
     * This function control if delete user order.
     * @name delete_user_order_view.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void.
     *
     * @internal this code call function orders_status.
     * 
     */  
     function delete_user_order_view() {
     $order_number = $this->input->get_post("order_number");
     $user_email = $this->input->get_post("user_email");
         
     $if_delete_user_order =$this->delete_user_order($order_number,$user_email);
         if($if_delete_user_order){
             $this->orders_status();
         }else{
             $this->orders_status();
         } 
    } 
//============================================================================// 
    /**
     * This function control if delete user request service.
     * @name delete_user_request_service.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void.
     *
     * @internal this code call if_delete_user_request_service.
     * 
     */  
     function delete_user_request_service() {
      $services_request_number = 
              $this->input->get_post("services_request_number");
      $user_email = $this->input->get_post("user_email");
         
      $if_delete_user_request_service =$this->if_delete_user_request_service(
              $services_request_number,$user_email);
         if($if_delete_user_request_service){
             
             $this->services_status();
         }else{
              
             $this->services_status();
         }
         
    }    
//============================================================================// 
    /**
     * This function control services status view.
     * @name services_status :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>orders status</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>delete services</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return services status view.
     * 
     */   
     function services_status() {

        $table_services= 'services_request';

        $data= $this->stantar_user_data_view();
        $data["page_title"] = "services request status";
		
        
        $data['selected_request_services'] = 
                $this->select_user_request_services($table_services);

        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/user/'
                . 'services_request_status_user_panel_header');
        $this->load->view('body_content_4/user/'
                . 'services_request_status_user_panel_content');
        $this->load->view('body_footer_5/user_footer');
    }
//============================================================================// 
    /**
     * This function control order shop cart view.
     * @name view_order_shop_cart :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>see a order shop cart</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return services status view.
     * 
     */  
    function view_order_shop_cart() {

        /**
         * {@internal this code call insert_cart_shop function 
         * of admin model. }}
         */
        $this->insert_cart_shop();

        $data = $this->stantar_user_data_view();

        $data["page_title"] = "user order shop cart page ";
       

        /**
         * {@internal here load the view. We can add data only at first 
         * load of view. }}
         */
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/user/'
                    . 'order_shop_cart_user_panel_header');
        $this->load->view('body_content_4/user/'
                . 'order_shop_cart_user_panel_content');
        $this->load->view('body_footer_5/user_footer');
        /**
         * {@internal we load again shop cart because we have lost it from 
         * view_order_shop_cart if we dont do this we have problem with 
         * shop cart.
         *if we dont save cart shop we lose it.
         * }}
         */
        $this->cart->destroy();
        $user_email = $this->session->userdata('user_email');
        $this->load->model('Cart_shop_model');
        $this->Cart_shop_model->select_shop_cart($user_email);
    }
//============================================================================// 
    /**
     * This function insert cart shop.
     * @name insert_cart_shop.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success insert return true else return false.
     *
     * @internal this code call Model_users from models and then the 
     * function insert_cart_shop.
     * 
     */   
    function insert_cart_shop(){
	$this->load->model('model_users');
	$this->model_users->insert_cart_shop();
	
    }
 //============================================================================// 
    /**
     * This function controll if update user account.
     * @name if_update_user_account.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success update return true else return false.
     *
     * @internal this code call Model_users from models and then the function 
     * if_update_user_account.
     * 
     */ 
    function if_update_user_account(){
	$this->load->model('model_users');
	return $this->model_users->if_update_user_account();
	
    }       
        
//============================================================================// 
    /**
     * This function control history orders status view.
     * @name history_orders_status :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>history of orders status</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>see shop cart of all orders</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return history orders status view.
     * 
     */  
     function history_orders_status() {

        $table_finished_orders = 'finished_orders';
        $table_cancelled_orders = 'cancelled_orders';

        $data= $this->stantar_user_data_view();
        $data["page_title"] = "history orders ";
        
        $data['selected_finished_orders'] = 
                $this->select_user_orders($table_finished_orders);
        $data['selected_cancelled_orders'] = 
                $this->select_user_orders($table_cancelled_orders);
        
        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/user/'
                . 'history_orders_status_user_panel_header');
        $this->load->view('body_content_4/user/'
                . 'history_orders_status_user_panel_content');
        $this->load->view('body_footer_5/user_footer');
    }
//============================================================================// 
    /**
     * This function control history services status view.
     * @name history_services_request_status :
     * 
     * <p>Description:</p>
     * 
     * user can see:
     * <ul>
     * <li>history of services status</li>
     * </ul>
     * user can :
     * <ul>
     * <li>use menu navigation</li>
     * <li>search</li>
     * <li>logout</li>
     * <li>see services</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return history services status view.
     * 
     */ 
     function history_services_request_status() {

        $table_finished_services_request = 'finished_services_request';
        $table_cancelled_services_request = 'cancelled_services_request';

         $data= $this->stantar_user_data_view();
        $data["page_title"] = "history services request ";

        
        $data['selected_finished_services_request'] = 
          $this->select_user_request_services($table_finished_services_request);
        $data['selected_cancelled_services_request'] = 
         $this->select_user_request_services($table_cancelled_services_request);
       
       

        $this->load->view('html_header_1/logged_user_html_header', $data);
        $this->load->view('body_navigator_2/logged_user_body_navigator');
        $this->load->view('body_header_3/user/'
                . 'history_services_request_status_user_panel_header');
        $this->load->view('body_content_4/user/'
                . 'history_services_request_status_user_panel_content');
        $this->load->view('body_footer_5/user_footer');
    }
//============================================================================// 
    /**
     * This function add to shop cart.
     * @name add_to_shop_cart.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void.
     *
     * @internal this code call show_products_refresh.
     * 
     */  
     function add_to_shop_cart() {
        //TODO:refactor
        $product_table_name = $this->input->get_post('category');
        $product_enabled = $this->input->get_post('product_enabled');

        $this->load->model('Cart_shop_model');
        $product = $this->Cart_shop_model->get_product();


        $insert = array(
            'id' => $this->input->get_post('product_id'),
            'qty' => 1,
            'price' => $product['product_sale_price'],
            'name' => $product['product_name'],
            'options' => array('Enabled' => $product_enabled,
            'category' => $product_table_name)
        );

        $this->cart->insert($insert);
        
        $this->show_products_refresh($this->input->get_post('category'));
    }
//============================================================================// 
    /**
     * This function is for destroy cart shop.
     * @name destroy.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void.
     *
     * @internal this code call a codeingiter function destroy from helper cart.
     * 
     */ 
     function destroy() {
         //TODO:refactor 
        $this->cart->destroy();
    }

//============================================================================// 
    /**
     * This function is for remove item from cart.
     * @name remove_item_from_cart.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void.
     *
     * @internal this code call show_products_refresh function.
     * 
     */  
     function remove_item_from_cart() {
        //TODO:refactor 
        $rowid = $this->input->get('rowid');
        $product_category = $this->input->get('category_name');

        $insert = array(
            'rowid' => $rowid,
            'qty' => 0
        );

        $this->cart->update($insert);
        $this->show_products_refresh($product_category);
    }

//============================================================================// 
    /**
     * This function is for update shop cart.
     * @name update_shop_cart.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void.
     *
     * @internal this code call show_products_refresh function.
     * 
     */ 
      function update_shop_cart() {
        $product_category = $this->input->get('category_name');
        $i = $this->input->get_post('i');
        
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        for ($count = 1; $count < $i; $count++) {   
            $this->form_validation->set_rules($count . '[qty]', 'qty much',
                    'required');
        }
 
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {

            if ($_POST) {
                $data = $_POST; 
                $this->cart->update($data);
                $this->load->library('session');

                $this->load->model('Cart_shop_model');
                $if_set_cart_shop = 
                        $this->Cart_shop_model->set_cart_shop_to_user();

                if ($if_set_cart_shop) {
                    $this->show_products_refresh($product_category);
                } else {
                    echo error_reporting();
                }
            }
        } else {
            $this->show_products_refresh($product_category);
        }
    }
//============================================================================// 
    /**
     * This function is for final shop add.
     * @name final_shop_add.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void. view of products with message if success or faild.
     *
     * @internal this code call show_products_refresh,destroy functions,
     * from Cart_shop_model function if_user_add_cart_shop 
     * and total function from codeingiter helper.
     * 
     */  
     function final_shop_add() {

        $product_category = $this->input->get_post('category');

        $this->load->model('Cart_shop_model');
        $if_add_cart_to_user = $this->Cart_shop_model->if_user_add_cart_shop();
	$total= $this->cart->total();
		
        if ($if_add_cart_to_user) {
            echo "<center>Success</center>";
             
            $if_stats_add=$this->add_statistics_orders($total);
            if($if_stats_add){
				
            }else{
		echo "problem to add stats";
            }
            $this->destroy();
            $this->show_products_refresh($product_category);
        } else {
            
            echo validation_errors();
            $this->show_products_refresh($product_category);
        }
        
    }
//============================================================================// 
    /**
     * This function add total statistics to orders.
     * @param type $total
     * @name add_statistics_orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success return true return false.
     *
     * @internal this function call add_statistics_orders function from model 
     * Statistics_model. 
     * 
     */  
    function add_statistics_orders($total){
		$this->load->model('Statistics_model');
		return $this->Statistics_model->add_statistics_orders($total);
	}
//============================================================================// 
    /**
     * This function add service to user.
     * @name add_service_to_user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void. if success return success message else faild message 
     *
     * @internal this function call if_user_add_service_request function from
     * model_users and show_service function. 
     */  
	function add_service_to_user(){
		$category= $this->input->get_post('category');
		
		$this->load->model('Model_users');
		$if_success=$this->Model_users->if_user_add_service_request();
		if($if_success){
			$message ="<center><b>Success</b></center>";
			echo $message;
			$this->show_service();
		}else{ 
			echo "<center><b>Faild try again..</b></center>";
			$this->show_service();
		}	 
	}
//============================================================================// 
    /**
     * This function clear cart shop.
     * @name clear_cart_shop.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return success message or faild message
     *
     * @internal this function call show_products_refresh. 
     * 
     */  
     function clear_cart_shop() {

        $product_category = $this->input->get_post('category');

        $this->load->model('Cart_shop_model');
        $if_clear_cart_shop = $this->Cart_shop_model->if_clear_cart_shop();


        if ($if_clear_cart_shop) {
            echo "<center>Success Clear shop</center>";
            $this->destroy();
            $this->show_products_refresh($product_category);
        } else {
            echo validation_errors();
            $this->show_products_refresh($product_category);
        }
    }
}

?>