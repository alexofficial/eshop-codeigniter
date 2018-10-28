<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//============================================================================// 
/**
 * This class  : hosts all controll of home methods.
 * 
 * @name Home_page_controller.
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 * @filesource  
 * @package application\controllers
 * @copyright Copyright (c) 2014-2015, Alexander Patsanis
 * 
 */
class Home_page_controller extends CI_Controller {

//============================================================================// 
    /**
     * This function control index view of all users whos try to login.
     * @name index :
     * 
     * <p>Description:</p>
     * 
     * user can login as:
     * <ul>
     * <li>user</li>
     * <li>or admin</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return index page of admin or user logged or not logged.
     * 
     */
    public function index() {

       
          
        if ($this->session->userdata('user_is_logged_in')) {

            $this->add_statistics_logins_per_day();
            $this->logged_user_page();
        } elseif ($this->session->userdata('admin_is_logged_in')) {

            $this->logged_admin_page();
        } else {
            $this->homePage();
        }
    }

//============================================================================//     
    /**
     * This function gives to others functions of view some default data.
     * <p>Description of data:</p>
     * <ul>
     *  <li>styles paths</li>
     *  <li>image paths</li>
     *  <li>categories data</li>
     * </ul>
     * 
     * @return string array of all this data.
     */
    function stantar_home_data_view() {
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
     * makes a send mail with subject and message which will give.
     * @param undefined $subject
     * @param undefined $message
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return true if email send success or false if faild.
     */
    function general_send_email($subject, $message,$send_to){
      $this->load->model('email_model');
      return $this->email_model->general_send_email($subject,$message,$send_to);
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
        
        $data= $this->stantar_home_data_view();
        $data["page_title"] = "fix";
         /**
         * {@internal here load the view. We can add data only at first
          *  load of view. }}
         */
        $this->load->view('html_header_1/site_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('fix_body');
        $this->load->view('body_footer_5/site_footer');
    }
//============================================================================// 
    /**
     * This function control index view of nologged.
     * @name homePage :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>index</li>
     * </ul>
     * nologged user can:
     * <ul>
     * <li>login</li>
     * <li>register</li>
     * <li>search products</li>
     * <li>recovery password</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  homePage view.
     * 
     */
    public function homePage() {

        $data = $this->stantar_home_data_view();
        $data["page_title"] = "home page";
        
        $data['selected_products_deals'] = $this->select_all_deals_product();
        $this->load->view('html_header_1/site_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('body_header_3/home/site_body_header');
        $this->load->view('body_content_4/home/site_content');
        $this->load->view('body_footer_5/site_footer');
    }

//============================================================================// 
    /**
     * This function control how to order view of nologged.
     * @name how_to_order_view :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>how to order</li>
     * </ul>
     * nologged user can:
     * <ul>
     * <li>login</li>
     * <li>register</li>
     * <li>search products</li>
     * <li>recovery password</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  how to order view.
     * 
     */
    public function how_to_order_view() {

        $data = $this->stantar_home_data_view();
        $data["page_title"] = "how to order";
        $this->load->view('html_header_1/site_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('body_header_3/home/how_to_order_site_body_header');
        $this->load->view('body_content_4/home/how_to_order_site_content');
        $this->load->view('body_footer_5/site_footer');
    }

//============================================================================// 
    /**
     * This function control payment methods view of nologged.
     * @name payment_methods_view :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>payment methods</li>
     * </ul>
     * nologged user can:
     * <ul>
     * <li>login</li>
     * <li>register</li>
     * <li>search products</li>
     * <li>recovery password</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  payment methods view.
     * 
     */
    public function payment_methods_view() {

        $data = $this->stantar_home_data_view();
        $data["page_title"] = "how to order";
        
        
        $this->load->view('html_header_1/site_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('body_header_3/home/'
                . 'payment_methods_site_body_header');
        $this->load->view('body_content_4/home/'
                . 'payment_methods_site_content');
        $this->load->view('body_footer_5/site_footer');
    }

//============================================================================// 
    /**
     * This function control shipping methods view of nologged.
     * @name shipping_methods_view :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>shipping methods</li>
     * </ul>
     * nologged user can:
     * <ul>
     * <li>login</li>
     * <li>register</li>
     * <li>search products</li>
     * <li>recovery password</li>
     * <li>see shipping methods</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  shipping methods view.
     * 
     */
    public function shipping_methods_view() {

        $data = $this->stantar_home_data_view();
        $data["page_title"] = "how to order";
        
        
        $this->load->view('html_header_1/site_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('body_header_3/home/'
                . 'shipping_methods_site_body_header');
        $this->load->view('body_content_4/home/'
                . 'shipping_methods_site_content');
        $this->load->view('body_footer_5/site_footer');
    }
//============================================================================// 
    /**
     * This function control search view of nologged.
     * @name search :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>search</li>
     * </ul>
     * nologged user can:
     * <ul>
     * <li>login</li>
     * <li>register</li>
     * <li>search products</li>
     * <li>recovery password</li>
     * <li>see search products</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  search view.
     * 
     */
    function search_view() {
        $data = $this->stantar_home_data_view();

        $search_input = $this->input->post('search_input');

        $data['search_result'] = $this->search_result($search_input);
        $data['category'] = 'computers';

        $data["page_title"] = "home page";
        
        $this->load->view('html_header_1/site_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('body_header_3/home/search_site_body_header');
        $this->load->view('body_content_4/home/search_site_content');
        $this->load->view('body_footer_5/site_footer');
    }
//============================================================================// 
    /**
     * This function control show service view of nologged.
     * @name show_service :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>services</li>
     * </ul>
     * Admin can:
     * <ul>
     * <li>login</li>
     * <li>register</li>
     * <li>search products</li>
     * <li>recovery password</li>
     * <li>see services</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return service view.
     * 
     */
    function show_service() {
        /*
         * or, $id=$_GET["id"];
         */
        $category = $this->input->get('category'); 
        $data = $this->stantar_home_data_view();
        $data["page_title"] = "products " . $category . " page";
        
        $data['category'] = $category;

        $data['selected_services'] = $this->select_all_services($category);

        if (!$data['selected_services_categories'] == NULL) {
            $this->load->view('html_header_1/site_html_header', $data);
            $this->load->view('body_navigator_2/site_body_navigator');
            $this->load->view('body_header_3/home/'
                    . 'all_services_home_panel_header');
            $this->load->view('body_content_4/home/'
                    . 'all_services_home_panel_content');
            $this->load->view('body_footer_5/site_footer');
        }
    }
//============================================================================// 
    /**
     * This function control forgot password view of nologged.
     * @name forgot_password_view :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>forgot password</li>
     * </ul>
     * nologged user can:
     * <ul>
     * <li>login</li>
     * <li>register</li>
     * <li>search products</li>
     * <li>(main)recovery password</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return forgot password view.
     * 
     */
    function forgot_password_view() {

        $data = $this->stantar_home_data_view();
        $data["page_title"] = "forgot password page";

        $this->load->view('html_header_1/site_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('body_header_3/home/'
                . 'forgot_password_home_panel_header');
        $this->load->view('body_content_4/home/'
                . 'forgot_password_home_panel_content');
        $this->load->view('body_footer_5/site_footer');
    }
//============================================================================// 
    /**
     * This function control register view of nologged.
     * @name register_page :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>register</li>
     * </ul>
     * nologged user can:
     * <ul>
     * <li>login</li>
     * <li>(main)register</li>
     * <li>search products</li>
     * <li>recovery password</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return register view.
     * 
     */
    public function register_page() {

        $data = $this->stantar_home_data_view();
        $data["page_title"] = "register page";
      
        $this->load->view('html_header_1/register_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('body_header_3/home/register_header');
        $this->load->view('body_content_4/home/register_content');
        $this->load->view('body_footer_5/site_footer');
    }
//============================================================================// 
    /**
     * This function check orders status view.
     * @name check_orders_status_view :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>check orders status</li>
     * </ul>
     * nologged user can:
     * <ul>
     * <li>login</li>
     * <li>register</li>
     * <li>search products</li>
     * <li>recovery password</li>
     * <li>(main)check orders status</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return check orders status view.
     * 
     */
    public function check_orders_status_view() {

        $data = $this->stantar_home_data_view();
        $data["page_title"] = "check orders status";
        

        $this->load->view('html_header_1/site_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('body_header_3/home/check_orders_status_header');
        $this->load->view('body_content_4/home/check_orders_status_content');
        $this->load->view('body_footer_5/site_footer');
    }
//============================================================================// 
    /**
     * This function control order status by order number view of nologged.
     * @name order_status_by_order_number_view :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>order status by order number</li>
     * </ul>
     * nologged user can:
     * <ul>
     * <li>login</li>
     * <li>register</li>
     * <li>search products</li>
     * <li>recovery password</li>
     * <li>(main)see order status by order number</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return order status by order number view.
     * 
     */
    public function order_status_by_order_number_view($get_orders_by_number) {

        $data = $this->stantar_home_data_view();
        $data["page_title"] = "user orders status";
        
        $data['selected_orders'] = $get_orders_by_number;

        $this->load->view('html_header_1/site_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('body_header_3/home/'
                . 'order_status_by_order_number_header');
        $this->load->view('body_content_4/home/'
                . 'order_status_by_order_number_content');
        $this->load->view('body_footer_5/site_footer');
    }
//============================================================================// 
    /**
     * This function control show products of nologged.
     * @name show_products :
     * 
     * <p>Description:</p>
     * 
     * nologged user can see view of:
     * <ul>
     * <li>show products</li>
     * </ul>
     * nologged user can:
     * <ul>
     * <li>login</li>
     * <li>register</li>
     * <li>search products</li>
     * <li>recovery password</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  show products.
     * 
     */
        public function show_products() {
            $category = $this->input->get('category'); 
            $data = $this->stantar_home_data_view();
            $data["page_title"] = "category " . $category . " page";
            
            $data['category'] = $category;
            
            $data['selected_products'] = $this->select_all_product($category);

            if (!$data['selected_categories'] == NULL) {
                $this->load->view('html_header_1/site_html_header', $data);
                $this->load->view('body_navigator_2/site_body_navigator');
                $this->load->view('body_header_3/home/'
                        . 'all_products_site_panel_header');
                $this->load->view('body_content_4/home/'
                        . 'all_products_site_panel_content');
                $this->load->view('body_footer_5/site_footer');
            }
        }
//============================================================================// 
    /**
     * This function select all deals product. 
     * @name  select all deals product
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if true return true else return false.
     *
     * @internal this code call model_user from models and then the function
     *  select_all_deals_product.
     */
    function select_all_deals_product() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_deals_product();
    }
//============================================================================// 
    /**
     * This function select all search result. 
     * @name  search result
     * @param type $search_input
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return search result
     *
     * @internal this code call model_user from models and then the 
     * function search_result.
     */
    function search_result($search_input) {
        $this->load->model('Model_users');
        return $this->Model_users->search_result($search_input);
    }
//============================================================================// 
    /**
     * This function select all services result. 
     * @name  select_all_services
     * @param type $categorie
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return all selected services data
     *
     * @internal this code call Model_admin from models and then the 
     * function select_all_services_by_category.
     */    
    function select_all_services($categorie) {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_services_by_category($categorie);
    }

//============================================================================// 
    /**
     * boolean function add statistics admin orders pluss.
     * @name  add_statistics_logins_per_day.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to add statistics return true else return 
     * false.
     * @internal this code call Statistics_model from models and then the 
     * function add_statistics_generics_pluss.
     * 
     */
    function add_statistics_logins_per_day() {
        $table = 'statistics_logins_per_day';
        $this->load->model('Statistics_model');
        return $this->Statistics_model->add_statistics_generics_pluss($table);
    }

//============================================================================// 
    /**
     * This function select all services categories. 
     * @name select all services categories
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return services categories data.
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
     * boolean function add statistics register per day pluss.
     * @name add statistics register per day.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to add statistics return true else return 
     * false.
     *
     * @internal this code call Statistics_model from models and then the 
     * function add_statistics_generics_pluss.
     * 
     */
    function add_statistics_register_per_day() {
        $table = 'statistics_register_per_day';
        $this->load->model('Statistics_model');
        return $this->Statistics_model->add_statistics_generics_pluss($table);
    }

//============================================================================//  
    /**
     * This function get orders by order number. 
     * @name get_orders_by_order_number
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return orders data.
     *
     * @internal this code call Model_admin from models and then the function 
     * get_orders_by_order_number.
     * 
     */

    public function get_orders_by_order_number() {
        $this->load->model('Model_users');
        return $get_orders_by_number = 
                $this->Model_users->get_orders_by_order_number();
    }
    
//============================================================================//  
    /**
     * This function is for check orders status by order name. 
     * @name check_orders_status.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of order if is success else a empty view.
     *
     * @internal this code call boolean function get_orders_by_order_number.
     * 
     */
    public function check_orders_status() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('orderNumber', 'Order Number', 
                'required');

        $result_form_validation = $this->form_validation->run();

        if ($result_form_validation) {
            $get_orders_by_number = $this->get_orders_by_order_number();
            if (!$get_orders_by_number == NULL) {
                $this->order_status_by_order_number_view($get_orders_by_number);
            } else {
                $this->check_orders_status_view();
            }
        } else {
            $this->check_orders_status_view();
        }
    }
    
//============================================================================// 
    /**
     * This function is for password recovery validator. 
     * @name password_recovery_validator.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of forgot password with message if success send mail for 
     * recovery password or faild.
     *
     * @internal
     * 
     */
    public function password_recovery_validator() {
        $this->load->model('Model_users');
        $this->load->library('form_validation');
        $email = $this->input->post('email');

        $this->form_validation->set_rules('email', 'Email', 
            'required|trim|min_length[4]|max_length[45]|xss_clean|valid_email|');

        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {
        
            $if_email_exist = $this->if_email_exist($email);    
        if($if_email_exist){
            $password = $this->select_user_password($email);
         if (!$password == null) {
                //Generator a ramdom key
                $key = md5(uniqid());
  
            if ($this->Model_users->add_password_recovery_user($key, $email)) {
                
             $subject='password revovery your account.';
             $message = "<p>Click Here for password recovery!</p>";
             $message .= "<p><a href='" . base_url() . 
              "home_page_controller/user_password_recovery/$key'>Click here</a>"
                     . "recovery your password your account</p>";
                   
            $if_succes_send_email=$this->general_send_email($subject,
                    $message,$email);
                    
                    if ($if_succes_send_email) {
                        ?>
                        <center> <?php
                        $this->index();
                        echo "The email has been sent successful!Go to your "
                        . "email for password revovery Confirm.";
                        $this->forgot_password_view();
                        ?>
                        </center>
                            <?php
                        } else {
                             echo "<center>Faild to send email</center>";
                            $this->forgot_password_view();
                        }
                    } else {
                         echo "<center>Faild password recovery</center>";
                        $this->forgot_password_view();
                    }
                } else {
                    
                }
            } else {
                echo "<center>Email dont exist</center>";
                $this->forgot_password_view();
            }
        }else{
              echo "<center>no validation</center>";
                $this->forgot_password_view();
        }
        }
//============================================================================//  
    /**
      * boolean function check if user email exist.
      * <p>Description:</p>
      * This function make a model call function and checks if this email
      * exist.
      * @name if email exist.
      * @author Alex Patsanis <alexpatsanis@gmail.gr>
      * @api
      * @return boolean. if user exist return true else return false.
      *
      * @internal we use a model_users function called if_email_exist. 
      * 
      */
        public function if_email_exist($email) {
          $this->load->model('model_users');
          return $this->model_users->if_email_exist($email);
        }
//============================================================================//  
    /**
     * This function is for user register. 
     * @param type $key
     * @name register_user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of index with message if success or faild.
     *
     * @internal we use set_session_user_data function for autologin after
     * register.
     * 
     */
        public function register_user($key) {
            $this->load->model('model_users');

            if ($this->model_users->is_key_valid($key)) {
                if ($data = $this->model_users->add_user($key)) {
                    $data_user_session = array(
                        'user_email' => $data['email'],
                        'user_password' => $data['password'],
                        'user_is_logged_in' => true
                    );
                    $this->set_session_user_data($data_user_session);
                    $this->index();
                } else {
                    echo "faild to add user.";
                    $this->index();
                }
            } else {
                echo "invalid key";
                $this->index();
            }
        }
//============================================================================// 
    /**
     * This function is for user register. 
     * @param string $key
     * @name user_password_recovery.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of index with message if success or faild.
     *
     * @internal this function calls a model_users function 
     * is_key_password_recovery_valid.
     * 
     */
    function user_password_recovery($key) {
            $this->load->model('model_users');

            if ($this->model_users->is_key_password_recovery_valid($key)) {
                $this->user_password_recovery_view($key);
            } else {
                echo "<center>Something wrong!!</center>";
                $this->index();
            }
    }
//============================================================================// 
    /**
     * This function is for view of user password recovery. 
     * @param string $key
     * @name user_password_recovery_view.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of user password recovery.
     *
     */
    function user_password_recovery_view($key) {

        $data = $this->stantar_home_data_view();
        $data["key"] = $key;
        $data["page_title"] = "password recovery page";
        $this->load->view('html_header_1/site_html_header', $data);
        $this->load->view('body_navigator_2/site_body_navigator');
        $this->load->view('body_header_3/home/'
                . 'user_password_recovery_site_body_header');
        $this->load->view('body_content_4/home/'
                . 'user_password_recovery_site_content');
        $this->load->view('body_footer_5/site_footer');
    }
//============================================================================// 
    /**
     * This function redirect to view of logged user page. 
     * @name logged_user_page.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of logged user page.
     *
     * @internal we use redirect because we can't call a controller function from 
     * a controller.
     * 
     */
    public function logged_user_page() {

        redirect(base_url() . 'User_page_controller/index_user_page');
    }

//============================================================================// 
    /**
     * This function redirect to view of logged admin page. 
     * @name logged_admin_page.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of logged admin page.
     *
     * @internal we use redirect because we can't call a controller function 
     * from a controller.
     * 
     */
    public function logged_admin_page() {

        redirect(base_url() . 'Admin_page_controller/index_admin_page');
    }
//============================================================================// 
    /**
     * This function redirect to view of logged admin panel page. 
     * @name admin_page.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of logged admin panel page.
     *
     * @internal we use redirect because we can't call a controller function 
     * from a controller.
     * 
     */
    public function admin_page(){
		
		redirect(base_url().'Admin_page_controller/admin_panel');
    }    
//============================================================================// 
    /**
     * This function is for send confirm email to success user register. 
     * @name register_user_send_email.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of index page with success message if success send email or
     *  view of register_page with faild message.
     *
     * @internal .
     * 
     */
        public function register_user_send_email() {
            $this->load->model('model_users');

            /* Generator a ramdom key */
            $key = md5(uniqid());
          
            if ($this->model_users->add_temp_user($key)) {
                $subject = 'Confirm your account.';
                $message = "<p>Thanks you for singup!</p>";
                $message .= "<p><a href='" . base_url() . 
                  "home_page_controller/register_user/$key'>Click here</a>"
                   . "confirm your account</p>";
                $send_to = $this->input->post('registerEmail');
                
                $if_send_email = $this->general_send_email($subject, $message,
                        $send_to);
               
                    if ($if_send_email) {
                            ?>
                        <center> <?php
                        $this->index();
                        echo "The email has been sent successful!Go to your "
                        . "email for Confirm.";
                        ?>
                        </center>
                         <?php
                    } else {
                        echo "<center>Faild to send email</center>";
                        $this->register_page();
                     }
            } else {
                        echo "<center>Faild to add temp user</center>";
                        $this->register_page();
            }
        }
//============================================================================// 
    /**
     * This function is for login validator. 
     * @name login_validator.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of whos login.
     *
     * @internal call controller function check_who_login .
     * 
     */
        public function login_validator() {

            $this->load->library('form_validation');
            $this->form_validation->set_message('trim', '');
            $this->form_validation->set_message('required', '');
            $this->form_validation->set_message('min_length', '');
            $this->form_validation->set_message('max_length', '');
            $this->form_validation->set_message('xss_clean', '');
            /*
             * TODO:check if can login more ifs? wehy callback dont work / 
             * ( delete  libraries MY_Form_Validation)?
             */
            $this->form_validation->set_rules('email', 'Email', 
                    'required|trim|min_length[4]|max_length[45]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 
                    'required|min_length[4]|max_length[45]|xss_clean|md5');

            /*check who try to login and redirect to index function*/
            $this->check_who_login();
        }
//============================================================================// 
    /**
     * This function is for register validator. 
     * @name register_validator.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void.
     *
     * @internal call controller function register_user_send_email for main 
     * operation and add_statistics_register_per_day  .
     * 
     */
        public function register_validator() {

            $this->load->library('form_validation');

            $this->form_validation->set_message('matches', 'pass wrong');
            $this->form_validation->set_message('is_unique', 'The email address'
                    . ' you entered is already in use on another account ');

            $this->form_validation->set_rules('registerEmail', 'Email',
             'required|trim|min_length[4]|max_length[45]|xss_clean|valid_email|'
                    . 'is_unique[users.email]|is_unique[admins.email]');

            $this->form_validation->set_rules('registerPassword', 'Passoword', 
                    'required|trim|min_length[4]|max_length[16]|');
            $this->form_validation->set_rules('registerCPassword', 
                'ConfirmPassoword', 'trim|matches[registerPassword]|');
            $this->form_validation->set_rules('registerCourier', 'Courier',
                'required|trim|');
            $this->form_validation->set_rules('registerFullName', 'FullName',
                'required|trim|min_length[4]|max_length[45]|');
            $this->form_validation->set_rules('registerAdress', 'Adress', 
                'required|trim|min_length[4]|max_length[45]|');
            $this->form_validation->set_rules('registerCity', 'City', 
                'required|trim|min_length[4]|max_length[45]|');
            $this->form_validation->set_rules('registerPostcode', 'Postcode', 
                'required|trim|min_length[4]|max_length[30]|numeric|');
            $this->form_validation->set_rules('registerPhone', 'Phone', 
                'required|trim|min_length[4]|max_length[30]|numeric|');
            $this->form_validation->set_rules('registerMobilePhone', 
                'MobilePhone', 'trim|min_length[4]|max_length[30]|numeric|');


            $result_form_validation = $this->form_validation->run();

            if ($result_form_validation) {
                $this->add_statistics_register_per_day();
                $this->register_user_send_email();
            } else {
                $this->register_page();
            }
        }
//============================================================================// 
    /**
     * This function is for add new password validator. 
     * @name register_validator.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return void.
     *
     * @internal call controller function if_update_password.
     * 
     */
        public function add_new_password_validator() {

            $this->load->library('form_validation');

            $this->form_validation->set_message('matches', 'pass wrong');


            $this->form_validation->set_rules('password', 'Passoword', 
                    'required|trim|min_length[4]|max_length[16]|');
            $this->form_validation->set_rules('cPassword', 'ConfirmPassoword',
                    'trim|matches[password]|required|trim|min_length[4]'
                    . '|max_length[16]|');
            $result_form_validation = $this->form_validation->run();

            if ($result_form_validation) {
                $key = $this->input->post('key');
                $if_update_password = $this->if_update_password($key);
                if ($if_update_password) {
                    echo "<center>Success</center>";
                    $this->index();
                } else {
                    echo "<center>Faild</center>";
                    $this->index();
                }
                 
            } else {
                echo "<center>".validation_errors()."</center>";
                $this->index();
            }
        }

//============================================================================// 
    /**
     * This function checks if user try to login. 
     * @name can_user_login.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return return boolean if exist return true else returns false.
     *
     * @internal this function call from model_users function check_user_exist.
     * 
     */
        public function can_user_login() {
            $this->load->model('model_users');
            return $this->model_users->check_user_exist();
        }
//============================================================================// 
    /**
     * This function checks if update password. 
     * @param string $key
     * @name if_update_password.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return return boolean if update return true else returns false.
     *
     * @internal this function call from model_users function 
     * if_update_password.
     * 
     */
        public function if_update_password($key) {
            $this->load->model('model_users');
            return $this->model_users->if_update_password($key);
        }
//============================================================================// 
    /**
     * This function is for select_user_password. 
     * @param string $email
     * @name select_user_password.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return return boolean if select user password return true else returns
     * false.
     *
     * @internal this function call from model_users function 
     * select_user_password.
     * 
     */
     
        public function select_user_password($email) {
            $this->load->model('model_users');
            return $this->model_users->select_user_password($email);
        }

//============================================================================// 
    /**
     * This function checks if admin try to login. 
     * @name can_admin_login.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return return boolean if exist return true else returns false.
     *
     * @internal this function call from model_users function check_admin_exist.
     * 
     */
    public function can_admin_login() {
    $this->load->model('Model_admin');
    if ($this->Model_admin->check_admin_exist()) {
                return true;
            } else {
                return false;
            }
        }

//============================================================================// 
    /**
     * This function is for set session user data. 
     * @param array $session_data
     * @name set_session_user_data.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return return boolean if set userdata return true else returns false.
     *
     * @internal this function call for session helper function set_userdata.
     * 
     */
    public function set_session_user_data($session_data) {
        if ($this->session->set_userdata($session_data)) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * This function is for checks whos try to login. 
     * @name check_who_login.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return return void.
     *
     * @internal this function call set_session_user_data and set whos try to 
     * login.
     * 
    */
    public function check_who_login() {
     $result_can_admin_login = $this->can_admin_login();
     $result_can_user_login = $this->can_user_login();
     $result_form_validation = $this->form_validation->run();

     if ($result_can_admin_login && $result_form_validation && 
             !$result_can_user_login) {

                $data_admin_session = array(
                    'admin_email' => $this->input->post('email'),
                    'admin_password' => $this->input->post('password'),
                    'admin_is_logged_in' => true
                );
                $this->set_session_user_data($data_admin_session);
                $this->index();
            } elseif ($result_can_user_login && $result_form_validation && 
                    !$result_can_admin_login) {

                $data_user_session = array(
                    'user_email' => $this->input->post('email'),
                    'user_password' => $this->input->post('password'),
                    'user_is_logged_in' => true
                );
                $this->set_session_user_data($data_user_session);
                $this->index();
            } else {
                $this->index();
            }
        }
//============================================================================// 
    /**
     * This function select all categories.
     * @name set_session_user_data.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return return selected categories data.
     *
     * @internal this function calls a Model_admin function 
     * select_all_categories .
     * 
     */
    public function select_all_categories() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_categories();
    }
//============================================================================// 
    /**
     * This function select all product by category.
     * @param type $categorie
     * @name select_all_product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return return selected products data.
     *
     * @internal this function calls a Model_admin function 
     * select_all_product_by_category .
     * 
     */
    public function select_all_product($categorie) {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_product_by_category($categorie);
    }
 }
    ?>	
