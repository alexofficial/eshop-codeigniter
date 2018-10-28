<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
//============================================================================// 
/**
 * This class  : hosts all controll admin methods.
 * 
 * @name Admin_page_controller.
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 * @filesource  
 * @package application\controllers
 * @copyright Copyright (c) 2014-2015, Alexander Patsanis
 * 
 */
class Admin_page_controller extends CI_Controller {

//============================================================================// 
    /**
     * This function gives to others functions of view some default data.
     * @name stantar_data_view :
     * <p>Description of data:</p>
     * <ul>
     *  <li>styles paths</li>
     *  <li>image paths</li>
     * </ul>
     * 
     * @return string array of all this data.
     */
    function stantar_data_view() {
        $data["css_path_home_page"] = "styles/home_page.css";
        $data["css_path_user_logged"] = "styles/logged_user.css";
        $data["css_path_admin_logged"] = "styles/admin_page.css";
        $data["css_path_search"] = "styles/search.css";
        $data["path_home_image"] = "images/homeImage.png";
        $data['selected_categories'] = $this->select_all_categories();
        $data['selected_services_categories'] = 
                $this->select_all_services_categories();
        return $data;
    }
//============================================================================// 
    /**
     * This function control index view of admin logged.
     * @name index admin page :
     * 
     * <p>Description:</p>
     * 
     * Admin can see:
     * <ul>
     * <li>orders</li>
     * <li>finished orders</li>
     * <li>cancelled orders</li>
     * </ul>
     * Admin can change values:
     * <ul>
     * <li>orders</li>
     * <li>finished orders</li>
     * <li>cancelled orders</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  view of logged admin
     * 
     */
    function index_admin_page() {

        $data = $this->stantar_data_view();
        $data["page_title"] = "admin home page";

        
        $data['selected_orders'] = $this->select_all_orders();
        $data['selected_finished_orders'] = 
                $this->select_all_finished_orders();
        $data['selected_cancelled_orders'] =
                $this->select_all_cancelled_orders();
        /**
         * {@internal here load the view. We can add data only at first
         *  load of view. }}
         */
        $this->load->view('html_header_1/logged_admin_html_header', $data);
        $this->load->view('body_navigator_2/logged_admin_body_navigator');
        $this->load->view('body_header_3/admin/logged_admin_header');
        $this->load->view('body_content_4/admin/logged_admin_content');
        $this->load->view('body_footer_5/admin_footer');
    }
//============================================================================// 
    /**
     * This function control search view of admin logged after a search.
     * @name search view 
     * <p>Description:</p>
     * 
     * Admin can see:
     * <ul>
     * <li>search results</li>
     * </ul>
     * Admin can:
     * <ul>
     * <li>add shop</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  view of search admin
     * 
     */    
     function search_view() {
       
        $data= $this->stantar_data_view();
        $data["page_title"] = "admin search page";
        $search_input=$this->input->post('search_input');
        
        $data['search_result']=$this->search_result($search_input);
        
         /**
         * {@internal here load the view. We can add data only at first
         *  load of view. }}
         */
        $this->load->view('html_header_1/logged_admin_html_header', $data);
        $this->load->view('body_navigator_2/logged_admin_body_navigator');
        $this->load->view('body_header_3/admin/search_logged_admin_header');
        $this->load->view('body_content_4/admin/search_logged_admin_content');
        $this->load->view('body_footer_5/admin_footer');
        
    }

//============================================================================// 
    /**
     * This function control index view of request services.
     * @name request services view :
     * 
     * <p>Description:</p>
     * 
     * Admin can see:
     * <ul>
     * <li>request services</li>
     * <li>finished request services</li>
     * <li>cancelled request services</li>
     * </ul>
     * Admin can change values:
     * <ul>
     * <li>request services</li>
     * <li>finished request services</li>
     * <li>cancelled request services</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return  view of of request services.
     * 
     */
    function request_services_view() {

        $data = $this->stantar_data_view();
        $data["page_title"] = "request services page";

        
        $data['selected_request_services'] = 
                $this->select_all_request_services();
        $data['selected_finished_request_services'] = 
                $this->select_all_finished_request_services();
        $data['selected_cancelled_request_services'] =
                $this->select_all_cancelled_services_request();
        /**
         * {@internal here load the view. We can add data only at first
         *  load of view. }}
         */
        $this->load->view('html_header_1/logged_admin_html_header', $data);
        $this->load->view('body_navigator_2/logged_admin_body_navigator');
        $this->load->view('body_header_3/admin/'
                . 'request_services_logged_admin_header');
        $this->load->view('body_content_4/admin/'
                . 'request_services_logged_admin_content');
        $this->load->view('body_footer_5/admin_footer');
    }

//============================================================================// 
    /**
     * This function controlls user logout.
     * @name user logout :
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view home index.
     * 
     */
    function user_logout() {
        /**
         * {@internal destroy all sessions. }}
         */
        $this->session->sess_destroy();
        /**
         * {@internal include home_page_controller from controller and call
         *  index }}
         */
        $this->load->library('../controllers/home_page_controller');
        $this->home_page_controller->index();
    }
//============================================================================// 
    /**
     * This function control the admin panel.
     * @name admin panel :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *  <li>category</li>
     *  <li>add product</li>
     *  </ul>
     * <li>pc</li>
     * <li>services</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     *  <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin panel.
     * 
     */
    function admin_panel() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin panel page";

        
        /**
         * {@internal here load the view. We can add data only at first 
         * load of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator');
        $this->load->view('body_header_3/admin/admin_panel_header');
        $this->load->view('body_content_4/admin/admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }

//============================================================================// 
    /**
     * This function control the users contacts.
     * @name users contacts :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *  <li>category</li>
     *  <li>add product</li>
     *  <li>add service</li>
     *  </ul>
     * <li>pc</li>
     * <li>services</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     *  <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>see and answer to contacts</li>
     *  </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of all users contacts.
     * 
     */
    function users_contacts() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin contacts users";

        $data['selected_users_contacts']=$this->select_all_users_contacts();
        /**
         * {@internal here load the view. We can add data only at 
         * first load of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator');
        $this->load->view('body_header_3/admin/'
                . 'contacts_users_admin__panel_header');
        $this->load->view('body_content_4/admin/'
                . 'contacts_users_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }  
//============================================================================// 
    /**
     * This function control the history of users contacts.
     * @name history_users_contacts :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *  <li>category</li>
     *  <li>add product</li>
     *  <li>add service</li>
     *  </ul>
     * <li>pc</li>
     * <li>services</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     *  <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>see history of contacts</li>
     *  </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of user history contacts.
     * 
     */
    function history_users_contacts() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin history contacts users";

        $data['selected_users_contacts']=$this->select_all_users_contacts();
        /**
         * {@internal here load the view. We can add data only at first
         *  load of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator');
        $this->load->view('body_header_3/admin/'
                . 'history_contacts_users_admin__panel_header');
        $this->load->view('body_content_4/admin/'
                . 'history_contacts_users_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }  
 
//============================================================================// 
    /**
     * This function is for newsletters validate before sends it.
     * @name newsletters_validator.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return message if success or nothing if faild.
     *
     * @internal this code call boolean function send_newsletters and
     * view function newsletter_view.
     * 
     */
    function newsletters_validator() {
        $this->load->library('form_validation');

       $subject = $this->input->get_post('subject');
       $message = $this->input->get_post('message');
	   
       
        $this->form_validation->set_rules('subject', 'subject',
                'required|trim|min_length[4]|max_length[100]');
        $this->form_validation->set_rules('message', 'message',
                'required|trim|min_length[4]');
       
        $result_form_validation = $this->form_validation->run();

        if ($result_form_validation) {
            $if_send_newsletters=$this->send_newsletters($subject,$message);
                if($if_send_newsletters){
                  echo "<center><span id='color_green'>success</span></center>";
                  $this->newsletter_view();
		}else{
                  $this->newsletter_view();
		}
            
        } else {
           $this->newsletter_view();
        }
        
    }

 
//============================================================================// 
    /**
     * This function control the admin user panel.
     * @name users :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>update user</li>
     *  <li>delete user</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin users panel.
     * 
     */
    function users() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin user page";

        
        $data['selected_users'] = $this->select_all_users();
        /**
         * {@internal here load the view. We can add data only at first
         *  load of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator');
        $this->load->view('body_header_3/admin/'
                . 'all_users_admin_panel_header');
        $this->load->view('body_content_4/admin/'
                . 'all_users_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }

//============================================================================// 
    /**
     * This function control the admin products panel.
     * @name show products :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>update product</li>
     *  <li>delete product</li>
     *  <li>add image product</li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin product page.
     * 
     * 
     * @internal Dev must add with some way the var $category! example 
     * <a href=" . base_url()."Admin_page_controller/show_products?category=
     * ".$category." >
     */
    function show_products() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin products page";
        $category = $this->input->get('category');
        $data['category'] = $category;

       
        
        $data['selected_products'] = $this->select_all_product($category);

        if (!$data['selected_categories'] == NULL) {
            /**
             * {@internal here load the view. We can add data only at first 
             * load of view. }}
             */
            $this->load->view('html_header_1/admin_panel_header', $data);
            $this->load->view('body_navigator_2/admin_panel_navigator');
            $this->load->view('body_header_3/admin/'
                    . 'all_products_admin_panel_header');
            $this->load->view('body_content_4/admin/'
                    . 'all_products_admin_panel_content');
            $this->load->view('body_footer_5/admin_footer');
        }
    }
//============================================================================// 
    /**
     * This function control the admin deals products panel.
     * @name deals_view :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>update product</li>
     *  <li>delete product</li>
     *  <li>see deals products</li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin deals product page.
     * 
     * 
    
     */
    function deals_view() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin deals products page";

       
        
        $data['selected_products_deals'] = $this->select_all_deals_product();

        if (!$data['selected_categories'] == NULL) {
            /**
             * {@internal here load the view. We can add data only at first
             *  load of view. }}
             */
            $this->load->view('html_header_1/admin_panel_header', $data);
            $this->load->view('body_navigator_2/admin_panel_navigator');
            $this->load->view('body_header_3/admin/'
                    . 'all_deals_products_admin_panel_header');
            $this->load->view('body_content_4/admin/'
                    . 'all_deals_products_admin_panel_content');
            $this->load->view('body_footer_5/admin_footer');
        }
    }  
    
//============================================================================// 
    /**
     * This function control the admin services panel.
     * @name show services :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>update product</li>
     *  <li>delete product</li>
     *  <li>add image product</li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin services page.
     * 
     * 
     * @internal Dev must add with some way the var $category! example 
     * <a href=" . base_url()."Admin_page_controller/show_service?category=
     * ".$category." >
     */
    function show_service() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin services page";
        $category = $this->input->get('category');
        $data['category'] = $category;

        $data['selected_services'] = $this->select_all_services($category);

        if (!$data['selected_services_categories'] == NULL) {
            /**
             * {@internal here load the view. We can add data only at first 
             * load of view. }}
             */
            $this->load->view('html_header_1/admin_panel_header', $data);
            $this->load->view('body_navigator_2/admin_panel_navigator');
            $this->load->view('body_header_3/admin/'
                    . 'all_services_admin_panel_header');
            $this->load->view('body_content_4/'
                    . 'admin/all_services_admin_panel_content');
            $this->load->view('body_footer_5/admin_footer');
        }
    }
//============================================================================// 
    /**
     * This function shows specifically category of products. 
     * @param string $category 
     * @name show  products specifically :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>update product</li>
     *  <li>delete product</li>
     *  <li>add image product</li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin product of a category page.
     * 
     * 
     * @internal if we have a function and we need do something like refresh 
     * the page we use this function.
     */
    function show_products_specifically($category) {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin products page";

        
        $data['selected_products'] = $this->select_all_product($category);
        $data['category'] = $category;
        if (!$data['selected_categories'] == NULL) {
            /**
             * {@internal here load the view. We can add data only at first 
             * load of view. }}
             */
            $this->load->view('html_header_1/admin_panel_header', $data);
            $this->load->view('body_navigator_2/admin_panel_navigator');
            $this->load->view('body_header_3/admin/'
                    . 'all_products_admin_panel_header');
            $this->load->view('body_content_4/admin/'
                    . 'all_products_admin_panel_content');
            $this->load->view('body_footer_5/admin_footer');
        }
    }
//============================================================================// 
    /**
     * This function  show services of specifically category. 
     * @param string $category 
     * @name show  services specifically :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>update product</li>
     *  <li>delete product</li>
     *  <li>add image product</li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin product page.
     * 
     * 
     * @internal if we have a function and we need do something like refresh 
     * the page we use this function.
     */
    function show_services_specifically($category) {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin products page";

        
        $data['selected_services'] = $this->select_all_services($category);
        $data['category'] = $category;
        if (!$data['selected_categories'] == NULL) {
            /**
             * {@internal here load the view. We can add data only at first
             *  load of view. }}
             */
            $this->load->view('html_header_1/admin_panel_header', $data);
            $this->load->view('body_navigator_2/admin_panel_navigator');
            $this->load->view('body_header_3/admin/'
                    . 'all_services_admin_panel_header');
            $this->load->view('body_content_4/admin/'
                    . 'all_services_admin_panel_content');
            $this->load->view('body_footer_5/admin_footer');
        }
    }

//============================================================================// 
    /**
     * This function control the admin categories view. 
     * @name show categories :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>add new category product or services</li>
     *  <li>delete category</li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin categories page.
     * 
     *
     */
    function show_categories() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin categories page";

        /**
         * {@internal here load the view. We can add data only at first load 
         * of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator');
        $this->load->view('body_header_3/admin/'
                . 'all_categories_admin_panel_header');
        $this->load->view('body_content_4/admin/'
                . 'all_categories_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }

//============================================================================// 
    /**
     * This function control the admin add new user view. 
     * @name  add new user view :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>add new user </li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin add user form page.
     * 
     */
    function add_new_user_view() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin add new user page";
        
        /**
         * {@internal here load the view. We can add data only at first load 
         * of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator');
        $this->load->view('body_header_3/admin/add_user_admin_panel_header');
        $this->load->view('body_content_4/admin/add_user_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }

//============================================================================// 
    /**
     * This function control the admin item add view. 
     * @name  item add view :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>add new product</li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin item add form page.
     * 
     */
    function item_add_view() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin product add page";
        

        /**
         * {@internal here load the view. We can add data only at first load 
         * of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator');
        $this->load->view('body_header_3/admin/item_add_admin_panel_header');
        $this->load->view('body_content_4/admin/item_add_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }
//============================================================================// 
    /**
     * This function control the admin service add view. 
     * @name  service add view :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>add new service</li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of admin item add form page.
     * 
     */
    function service_add_view() {
        $data = $this->stantar_data_view();
        $data["page_title"] = "admin service add page";
        /**
         * {@internal here load the view. We can add data only at first load
         *  of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator');
        $this->load->view('body_header_3/admin/'
                . 'service_add_admin_panel_header');
        $this->load->view('body_content_4/admin/'
                . 'service_add_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }

//============================================================================// 
    /**
     * This function control the admin a specifically shop cart of order view. 
     * @name  view order shop cart :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>see shop cart of specifically order </li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of specifically shop cart of order.
     * 
     * 
     * @internal this code use insert_cart_shop function.
     */
    function view_order_shop_cart() {

        /**
         * {@internal this code call insert_cart_shop function of 
         * admin model. }}
         */
        $this->insert_cart_shop();

        $data = $this->stantar_data_view();

        $data["page_title"] = "order shop cart page ";
       

        /**
         * {@internal here load the view. We can add data only at first
         *  load of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator');
        $this->load->view('body_header_3/admin/'
                . 'order_shop_cart_admin_panel_header');
        $this->load->view('body_content_4/admin/'
                . 'order_shop_cart_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }
//============================================================================// 
    /**
     * This function control the admin a specifically view of request
     * services user. 
     * @name  view_request_services_user :
     * <p>Description:</p>
     * 
     * <p>Admin can navigate to:</p>
     * <ul>
     * <li>index</li>
     * <li>users</li>
     * <li>products</li>
     *  <ul>
     *       <li>category</li>
     *       <li>add product</li>
     * 		 <li>add service</li>
     *       </ul>
     *  <li>pc</li>
     *  <li>services</li>
     *  <li>add new user</li>
     * </ul>
     * 
     * <p>Admin can :</p>
     * <ul>
     *  <li>logout</li>
     *  <li>search</li>
     *  <li>see request services user data</li>
     * </ul>
     * 
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of specifically of request services user..
     * 
     */
    function view_request_services_user() {
		
        $data = $this->stantar_data_view();

        $data["page_title"] = "view user request service ";
       	$email = $this->input->get_post("user_email");
		$data["selected_user"]	= $this->select_user($email);
                
        /**
         * {@internal here load the view. We can add data only at first 
         * load of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator');
        $this->load->view('body_header_3/admin/'
                . 'show_user_request_services_admin_panel_header');
        $this->load->view('body_content_4/admin/'
                . 'show_user_request_services_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }

//============================================================================// 
    /**
     * This function insert cart shop. 
     * @name  insert cart shop :

     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean if success inserted return true else return false.
     *
     * @internal this code call Model_Admin and then the function
     *  insert_cart_shop.
     */
    function insert_cart_shop() {

        $this->load->model('Model_admin');
        return $this->Model_admin->insert_cart_shop();
    }
//============================================================================//
    /**
     * This function view pf php doc. 
     * @name  php doc.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of php doc.
     *
     * @internal 
     */
    function php_doc() {

        $data = $this->stantar_data_view();
        $data["page_title"] = "admin php info page";
       
        /**
         * {@internal here load the view. We can add data only at first load
         *  of view. }}
         */
        $this->load->view('php_doc_view', $data);
    }
//============================================================================// 

    /**
     * This function control the admin view of register per day statistics. 
     * @name  statistics register per day view 
     * <p>Description:</p>
     * 
     * Admin can see:
     * <ul>
     * <li>statistics registers per day</li>
     * </ul>
     * Admin can :
     * <ul>
     * <li>print this statistics</li>
     * </ul>
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of register per day statistics.
     *
     */
    function statistics_registers_per_day_view() {

        $data = $this->stantar_data_view();
        $data["page_title"] = "statistics registes per day  page";
       

        /**
         * {@internal here load the view. We can add data only at first
         *  load of view. }}
         */
        $this->load->view('html_header_1/logged_admin_html_header', $data);
        $this->load->view('body_navigator_2/logged_admin_body_navigator.php');
        $this->load->view('body_header_3/admin/'
                . 'statistics_register_per_day_admin_panel_header');
        $this->load->view('body_content_4/admin/'
                . 'statistics_register_per_day_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }
//============================================================================// 
    /**
     * This function control the admin view of logins per day statistics. 
     * @name  statistics logins per day view .
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of logins per day statistics.    * 
     *
     */
    function statistics_logins_per_day_view() {

        $data = $this->stantar_data_view();
        $data["page_title"] = "statistics logins per day page";
       

        /**
         * {@internal here load the view. We can add data only at first load
         *  of view. }}
         */
        $this->load->view('html_header_1/logged_admin_html_header', $data);
        $this->load->view('body_navigator_2/logged_admin_body_navigator.php');
        $this->load->view('body_header_3/admin/'
                . 'statistics_logins_per_day_admin_panel_header');
        $this->load->view('body_content_4/admin/'
                . 'statistics_logins_per_day_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }
//============================================================================// 
    /**
     * This function control the admin view of finished orders per day 
     * statistics. 
     * @name  statistics finished orders  per day view .
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of finished orders  per day statistics. 
     *
     */
    function statistics_finished_orders_per_day_view() {

        $data = $this->stantar_data_view();
        $data["page_title"] = "statistics finished oerds per day page";
       

        /**
         * {@internal here load the view. We can add data only at first 
         * load of view. }}
         */
        $this->load->view('html_header_1/logged_admin_html_header', $data);
        $this->load->view('body_navigator_2/logged_admin_body_navigator.php');
        $this->load->view('body_header_3/admin/'
                . 'statistics_finished_orders_per_day_admin_panel_header');
        $this->load->view('body_content_4/admin/'
                . 'statistics_finished_orders_per_day_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }
//============================================================================// 
    /**
     * This function control the admin view of cancelled orders per day
     * statistics. 
     * @name  statistics cancelled orders  per day view .
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of cancelled orders  per day statistics.
     *
     */
    function statistics_cancelled_orders_per_day_view() {

        $data = $this->stantar_data_view();
        $data["page_title"] = "statistics cancelled orders per day page";
       

        /**
         * {@internal here load the view. We can add data only at first load 
         * of view. }}
         */
        $this->load->view('html_header_1/logged_admin_html_header', $data);
        $this->load->view('body_navigator_2/logged_admin_body_navigator.php');
        $this->load->view('body_header_3/admin/'
                . 'statistics_cancelled_orders_per_day_admin_panel_header');
        $this->load->view('body_content_4/admin/'
                . 'statistics_cancelled_orders_per_day_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }
//============================================================================// 
    /**
     * This function control the admin view of statistics orders money we 
     * will get view. 
     * @name  statistics orders money we will get view .
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of statistics orders money we will get.  
     *
     */
    function statistics_orders_money_we_will_get_view() {

        $data = $this->stantar_data_view();
        $data["page_title"] = "statistics orders money per day page";
       

        /**
         * {@internal here load the view. We can add data only at first load
         *  of view. }}
         */
        $this->load->view('html_header_1/logged_admin_html_header', $data);
        $this->load->view('body_navigator_2/logged_admin_body_navigator.php');
        $this->load->view('body_header_3/admin/'
            . 'statistics_orders_money_we_will_get_per_day_admin_panel_header');
        $this->load->view('body_content_4/admin/'
           . 'statistics_orders_money_we_will_get_per_day_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }
//============================================================================// 
    /**
     * This function admin control the newsletters view of all users  
     * @name  newsletter_view .
     * 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of newsletter.  
     *
     */
    function newsletter_view() {

        $data = $this->stantar_data_view();
        $data["page_title"] = "news letter view";
       
		$data['users'] = $this->select_all_users_email();
        /**
         * {@internal here load the view. We can add data only at first load
         *  of view. }}
         */
        $this->load->view('html_header_1/admin_panel_header', $data);
        $this->load->view('body_navigator_2/admin_panel_navigator.php');
        $this->load->view('body_header_3/admin/'
                . 'newsletter_admin_panel_header');
        $this->load->view('body_content_4/admin/'
                . 'newsletter_admin_panel_content');
        $this->load->view('body_footer_5/admin_footer');
    }
 
//============================================================================//    
    /**
     * This boolean function is for if send newsletters. 
     * @name  send newsletters
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if true return true else return false.
     *
     * @internal this code call model_user from models and then the function
     * general_send_email.
     */
    function send_newsletters($subject,$message) {
        $this->load->model('Model_admin');
        return $this->Model_admin->send_newsletters($subject,$message);
    } 
//============================================================================// 
    /**
     * This function select all users email. 
     * @name  select all users email
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return if true return true else return false.
     *
     * @internal this code call model_user from models and then the
     *  function select_all_users_email.
     */    
 	function select_all_users_email(){
		$this->load->model('Model_admin');
        return $this->Model_admin->select_all_users_email();
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
     * select_all_deals_product.
     */    
 	function select_all_deals_product(){
		$this->load->model('Model_admin');
                return $this->Model_admin->select_all_deals_product();
	}      
  
//============================================================================// 

    /**
     * This function select all users information. 
     * @name  select all users 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return users data.
     *
     * @internal this code call model_user from models and then the function 
     * select_all_users.
     */
    function select_all_users() {
        $this->load->model('model_users');
        return $this->model_users->select_all_users();
    }
//============================================================================// 

    /**
     * This function select all users contacts. 
     * @name  select all users contacts
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return users contacts data.
     *
     * @internal this code call model_user from models and then the function
     * select_all_users.
     */
    function select_all_users_contacts() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_users_contacts();
    }

//============================================================================// 
    /**
     * This function select user by email. 
     * @param type $email
     * @name  select user 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return user data.
     *
     * @internal this code call Model_admin from models and then the function
     *  select_user_by_email.
     */
    function select_user($email) {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_user_by_email($email);
    }
//============================================================================// 
    /**
     * This function select all product. 
     * @name select all product 
     * @param string $categorie 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return product data.
     *
     * @internal this code call Model_admin from models and then the function
     * select_all_product_by_category.The param give as the profucts of 
     * specifically category.
     * 
     */
    function select_all_product($categorie) {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_product_by_category($categorie);
    }
//============================================================================// 
 /**
     * This function select product by id and category. 
     * @name select product 
     * @param string $id
     * @param string $categorie 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return product data.
     *
     * @internal this code call Model_admin from models and then the function 
     * select_product.The param give as the profuct of specifically category
     * and id.
     * 
     */
    function select_product($id,$categorie) {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_product($id,$categorie);
    }   
    
//============================================================================// 
    /**
     * This function select all service. 
     * @name select all services 
     * @param string $categorie 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return all services data.
     *
     * @internal this code call Model_admin from models and then the function
     * select_all_services_by_category.The param give as the profucts of 
     * specifically category.
     * 
     */
    function select_all_services($categorie) {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_services_by_category($categorie);
    }

//============================================================================// 
    /**
     * This function select all product categories. 
     * @name select all categories 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return product categories data.
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
     * This function search result. 
     * @param type $search_input
     * @name search result 
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return search result data.
     *
     * @internal this code call Model_admin from models and then the function 
     * search_result.
     * 
     */
    function search_result($search_input) {
        $this->load->model('Model_admin');
        return $this->Model_admin->search_result($search_input);
    }
//============================================================================// 
    /**
     * This function select all services categories. 
     * @name select all services categories
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return all services categories data.
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
     * This function select all orders. 
     * @name select all orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return orders data.
     *
     * @internal this code call Model_admin from models and then the function
     *  select_all_orders.
     * 
     */
    function select_all_orders() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_orders();
    }

//============================================================================// 
    /**
     * This function select all finished orders. 
     * @name select all finished orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return finished orders data.
     *
     * @internal this code call Model_admin from models and then the function 
     * select_all_finished_orders.
     * 
     */
    function select_all_finished_orders() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_finished_orders();
    }
//============================================================================// 
    /**
     * This function select all cancelled orders. 
     * @name select all cancelled orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return cancelled orders data.
     *
     * @internal this code call Model_admin from models and then the function 
     * select_all_cancelled_orders.
     * 
     */
    function select_all_cancelled_orders() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_cancelled_orders();
    }
//============================================================================// 
    /**
     * This function select all request services. 
     * @name select all request services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return request services data.
     *
     * @internal this code call Model_admin from models and then the function 
     * select_all_request_services.
     * 
     */
    function select_all_request_services() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_request_services();
    }
//============================================================================// 
    /**
     * This function select all finished request services. 
     * @name select all finished request services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return finished request services data.
     *
     * @internal this code call Model_admin from models and then the function
     *  select_all_finished_services_request.
     * 
     */
    function select_all_finished_request_services() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_finished_services_request();
    }
//============================================================================// 
    /**
     * This function select all cancelled request services. 
     * @name select all cancelled request services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return cancelled request services data.
     *
     * @internal this code call Model_admin from models and then the function 
     * select_all_cancelled_services_request.
     * 
     */
    function select_all_cancelled_services_request() {
        $this->load->model('Model_admin');
        return $this->Model_admin->select_all_cancelled_services_request();
    }

//============================================================================// 
    /**
     * This boolean function is for delete a user. 
     * @param int $user_id 
     * @name if delete user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete return true else return false.
     *
     * @internal this code call model_users from models and then the function 
     * if_delete_user.
     * 
     */
    function if_delete_user($user_id) {
        $this->load->model('model_users');
        return $this->model_users->if_delete_user($user_id);
    }

//============================================================================// 
    /**
     * This function is for view after delete user. 
     * @name delete user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of users. if success to delete return a view with changes 
     * else with faild message.
     *
     * @internal this code call function if_delete_user.
     * 
     */
    function delete_user() {
        $user_id = $this->input->get_post('user_id');
        $result = $this->if_delete_user($user_id);
        if ($result) {
            $this->users();
        } else {
            echo "faild to delete the user";
            $this->users();
        }
    }
    
//============================================================================// 
    /**
     * This boolean function insert image. 
     * @param int $product_id 
     * @param string $product_categories 
     * @name insert image.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to insert return true else return false.
     *
     * @internal this code call Model_admin from models and then the 
     * function insert_image.
     * 
     */
    function insert_image($product_id, $product_categories) {
       $this->load->model('Model_admin');
       return $this->Model_admin->insert_image($product_id,$product_categories);
    }

//============================================================================// 
    /**
     * This function add product image into a product. 
     * @name add product image.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of specifically products category.
     *
     * @internal this code call boolean function insert_image.
     * 
     */
    function add_product_image() {
        $product_id = $this->input->get_post('product_id');
        $product_categories = $this->input->get_post('product_categories');

        $if_add_image = $this->insert_image($product_id, $product_categories);

        if ($if_add_image) {
            $this->show_products_specifically($product_categories);
        } else {
            $this->show_products_specifically($product_categories);
        }
    }

//============================================================================// 
    /**
     * boolean function insert product category. 
     * @name insert category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to insert return true else return false.
     *
     * @internal this code call Model_admin from models and then the function
     *  insert_category.
     * 
     */
    function insert_category() {
        $this->load->model('Model_admin');
        return $this->Model_admin->insert_category();
    }
//============================================================================// 
    /**
     * boolean function insert services category. 
     * @name insert service category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to insert return true else return false.
     *
     * @internal this code call Model_admin from models and then the function
     * insert_service_category.
     * 
     */
    function insert_service_category() {
        $this->load->model('Model_admin');
        return $this->Model_admin->insert_service_category();
    }
//============================================================================// 
    /**
     * This function is for view after add a new product category and for the 
     * form validation. 
     * @name add category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of categories.
     *
     * @internal this code call boolean function insert_category.
     * 
     */
    function add_category() {
        $category_name = $this->input->get_post('categoryName');
        $this->load->library('form_validation');
        $this->form_validation->set_message('trim', '');
        $this->form_validation->set_message('required', '');
        $this->form_validation->set_message('min_length', '');
        $this->form_validation->set_message('max_length', '');
        $this->form_validation->set_message('is_unique', '');
        $this->form_validation->set_rules('categoryName', 'Category Name',
        'required|trim|min_length[3]|max_length[45]'
                . '|is_unique[product_category.product_categories]|');

        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {

            $insert_category = $this->insert_category();

            if ($insert_category) {
                $this->show_categories();
            } else {
                $this->show_categories();
            }
        } else {
            $this->show_categories();
        }
    }

//============================================================================// 
    /**
     * This function is for view after add a new service category and for the 
     * form validation. 
     * @name add service category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of categories.
     *
     * @internal this code call boolean function insert_service_category.
     * 
     */
    function add_service_category() {
        $category_name = $this->input->get_post('categoryServiceName');
        $this->load->library('form_validation');
        $this->form_validation->set_message('trim', '');
        $this->form_validation->set_message('required', '');
        $this->form_validation->set_message('min_length', '');
        $this->form_validation->set_message('max_length', '');
        $this->form_validation->set_message('is_unique', '');
        $this->form_validation->set_rules('categoryServiceName', 
        'Category Service Name', 'required|trim|min_length[3]|max_length[45]'
                . '|is_unique[service_category.service_categories]|');
        
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {
            $insert_service_category = $this->insert_service_category();
            if ($insert_service_category) {

                $this->show_categories();
            } else {

                $this->show_categories();
            }
        } else {
            $this->show_categories();
        }
    } 
//============================================================================// 
    /**
     * boolean function if delete category.
     * @param string $category  
     * @name if delete category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete return true else return false.
     *
     * @internal this code call Model_admin from models and then the function
     * if_delete_category.
     * 
     */
    function if_delete_category($category) {
        $this->load->model('model_admin');
        return $this->model_admin->if_delete_category($category);
    }
//============================================================================// 
    /**
     * boolean function if update category.
     * @param string $category_id 
     * @param string $category_name   
     * @name if update category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update return true else return false.
     *
     * @internal this code call Model_admin from models and then the function 
     * if_update_category.
     * 
     */
    function if_update_category($category_id,$category_name) {
     $this->load->model('model_admin');
     return $this->model_admin->if_update_category($category_id,$category_name);
    }   
//============================================================================// 
    /**
     * boolean function if update services category.
     * @param string $category_id 
     * @param string $category_name   
     * @name if update services category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update services return true else return 
     * false.
     *
     * @internal this code call Model_admin from models and then the function 
     * if_update_services_category.
     */
    function if_update_services_category($category_id,$category_name) {
        $this->load->model('model_admin');
        return $this->model_admin->if_update_services_category($category_id,
                $category_name);
    }    
//============================================================================// 
    /**
     * boolean function if delete service category.
     * @param string $category  
     * @name if delete service category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete return true else return false.
     *
     * @internal this code call Model_admin from models and then the function 
     * if_delete_service_category.
     */
    function if_delete_service_category($category) {
        $this->load->model('model_admin');
        return $this->model_admin->if_delete_service_category($category);
    }
//============================================================================// 
    /**
     * This function is for view after delete a category. 
     * @name delete category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of categories.
     *
     * @internal this code call boolean function if_delete_category.
     * 
     */
    function delete_category() {
        $category = $this->input->get_post('product_categories');
        if ($this->if_delete_category($category)) {
            $this->show_categories();
        } else {
            $this->show_categories();
        }
    }
//============================================================================// 
    /**
     * This function is for view after update a product category. 
     * @name update category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of categories.
     *
     * @internal this code call boolean function if_update_category.
     * 
     */
    function update_category() {
        $category_name = $this->input->get_post('product_categories');
        $category_id   = $this->input->get_post('product_categories_id');
        
        if ($this->if_update_category($category_id,$category_name)) {
            $this->show_categories();
        } else {
            $this->show_categories();
        } 
    }
//============================================================================// 
    /**
     * This function is for view after update a service category. 
     * @name update service category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of service categories.
     *
     * @internal this code call boolean function if_update_services_category.
     * 
     */
    function update_services_category() {
        $category_name = $this->input->get_post('service_categories');
        $category_id   = $this->input->get_post('service_categories_id');
         
        if ($this->if_update_services_category($category_id,$category_name)) {
            $this->show_categories();
        } else {
            $this->show_categories();
        }
    }    
//============================================================================// 
    /**
     * This function is for view after delete a service category. 
     * @name delete service category.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of categories.
     *
     * @internal this code call boolean function if_delete_service_category.
     * 
     */
    function delete_service_category() {
        $category = $this->input->get_post('service_categories');
        if ($this->if_delete_service_category($category)) {
            $this->show_categories();
        } else {
            $this->show_categories();
        }
    }

//============================================================================// 
    /**
     * boolean function if admin add a user.
     * @name if admin add user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to add a new user return true else return
     * false.
     * @internal this code call Model_admin from models and then the function 
     * if_admin_add_user.
     * 
     */
    function if_admin_add_user() {
        $this->load->model('Model_admin');
        return $this->Model_admin->if_admin_add_user();
    }

//============================================================================// 
    /**
     * This function is for view after admin add a new user and for the 
     * form validation. 
     * @name add_new_user_validator.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of user if success return users view else return add new 
     * user view.
     *
     * @internal this code call boolean function if_admin_add_user.
     * 
     */
    function add_new_user_validator() {
        $this->load->library('form_validation');

        $this->form_validation->set_message('matches', 'pass wrong');
        $this->form_validation->set_message('is_unique', 
        'The email address you entered is already in use on another account ');

        $this->form_validation->set_rules('registerEmail', 'Email', 
                'required|trim|min_length[4]|max_length[45]|xss_clean|'
                . 'valid_email|is_unique[users.email]|is_unique[admins.email]');

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
                ' required|trim|min_length[4]|max_length[30]|numeric|');
        $this->form_validation->set_rules('registerMobilePhone', 'MobilePhone', 
                'trim|min_length[4]|max_length[30]|numeric|');

        $result_form_validation = $this->form_validation->run();

        if ($result_form_validation) {

            $add_user_success = $this->if_admin_add_user();
            if ($add_user_success) {
                $this->users();
            } else {
                $this->add_new_user_view();
            }
        } else {
            $this->add_new_user_view();
        }
    }
//============================================================================// 
    /**
     * boolean function if insert product.
     * @name if insert product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to insert sucess a new product return true 
     * else return false.
     *
     * @internal this code call Model_admin from models and then the function 
     * insert_product.
     * 
     */
    function if_insert_product() {
        $this->load->model('Model_admin');
        return $this->Model_admin->insert_product();
    }

//============================================================================// 
    /**
     * This function is for view after add a product and for the form
     * validation. 
     * @name add product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of products if success return products specifically 
     * category view  else return item add view .
     *
     * @internal this code call boolean function if_insert_product.
     * 
     */
    function add_product() {

        $this->load->library('form_validation');
	/**
	* 
	* {@internal max_lenght 22 for limits of css. }}
	* 
	*/
        $this->form_validation->set_rules('productName', '', 
                'required|trim|min_length[2]|max_length[22]|');
        $this->form_validation->set_rules('productEnabled', 'Enabled',
                'required|trim|');
        $this->form_validation->set_rules('productDescription', 'Description', 
                'required|trim|min_length[1]|max_length[1550]');
        $this->form_validation->set_rules('productAvailableQuantity', 
                'Available Quantity', 
                'required|trim|min_length[1]|max_length[45]|integer|numeric|');
        $this->form_validation->set_rules('productWeight', 'Weight',
                'required|trim|min_length[1]|max_length[45]|numeric|');
        $this->form_validation->set_rules('productPrice', 'Price', 
                'required|trim|min_length[1]|max_length[45]|numeric|');
        $this->form_validation->set_rules('productSalePrice', 'Sale Price',
                'required|trim|min_length[1]|max_length[45]|numeric|');
        $this->form_validation->set_rules('productCategories', 'Categories',
                'required|trim|');

        $product_category = $this->input->post('productCategories');
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {

            $insert_product = $this->if_insert_product();
            if ($insert_product) {
                $this->show_products_specifically($product_category);
            } else {
                $this->item_add_view();
            }
        } else {

            $this->item_add_view();
        }
    }
//============================================================================// 
    /**
     * This boolean function is for if insert service.
     * @name if insert service.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to insert sucess a new service return true
     * else return false.
     *
     * @internal this code call Model_admin from models and then the function
     * insert_service.
     * 
     */
    function if_insert_service() {
        $this->load->model('Model_admin');
        return $this->Model_admin->insert_service();
    }

//============================================================================// 
    /**
     * This function is for view after add a service and for the form
     * validation. 
     * @name add service.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of service if success return service specifically service
     * category view else return service add view .
     *
     * @internal this code call boolean function if_insert_service.
     * 
     */
    function add_service() {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('serviceName', 'Service Name', 
                'required|trim|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('servicedetails', 'Service Details', 
                'required|trim|min_length[1]|max_length[2000]');
       $this->form_validation->set_rules('serviceNotes', 'Service Notes', 
               'required|trim|min_length[1]|max_length[2000]');
        $this->form_validation->set_rules('servicePriceAtWork', 
                'Service Price At Work', 
                'required|trim|min_length[1]|max_length[45]|numeric|');
         $this->form_validation->set_rules('servicePriceAtHome', 
                 'Service Price At Home', 
                 'required|trim|min_length[1]|max_length[45]|numeric|');
        $this->form_validation->set_rules('serviceCategories', 
                'Service Categories', 'required|trim|');
        
        $service_category = $this->input->post('serviceCategories');
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {

            $if_insert_service = $this->if_insert_service();
            if ($if_insert_service) {
                $this->show_services_specifically($service_category);
            } else {
                $this->service_add_view();
            }
        } else {
            $this->service_add_view();
        }
    }
//============================================================================// 
    /**
     * boolean function if admin update user.
     * @name if admin update user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update sucess a user return true else
     *  return false.
     *
     * @internal this code call Model_admin from models and then the function 
     * if_admin_update_user.
     * 
     */
    function if_admin_update_user($user_id) {
        $this->load->model('Model_admin');
        return $this->Model_admin->if_admin_update_user($user_id);
    }
//============================================================================// 
    /**
     * This function is for view after update a user and for the form
     * validation. 
     * @name  update user.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of user if success return users with changes view else 
     * users without change.
     * @internal this code call boolean function if_admin_update_user.
     * 
     */
    function update_user() {
        $user_id = $this->input->get_post('id');

        $this->load->library('form_validation');

        $this->form_validation->set_message('is_unique', 'The email address you'
                . ' entered is already in use on another account ');
        $this->form_validation->set_rules('email', 'Email', 
                'required|trim|min_length[4]|max_length[45]|xss_clean|'
                . 'valid_email|is_unique[admins.email]');
        $this->form_validation->set_rules('deliveryMethod', 'Courier', 
                'required|trim|');
        $this->form_validation->set_rules('fullName', 'FullName',
                'required|trim|min_length[4]|max_length[45]|');
        $this->form_validation->set_rules('adress', 'Adress', 
                'required|trim|min_length[4]|max_length[45]|');
        $this->form_validation->set_rules('city', 'City', 
                'required|trim|min_length[4]|max_length[45]|');
        $this->form_validation->set_rules('postcode', 'Postcode', 
                'required|trim|min_length[4]|max_length[30]|');
        $this->form_validation->set_rules('phoneNumber', 'Phone', 
                ' required|trim|min_length[4]|max_length[30]|');
        $this->form_validation->set_rules('mobileNumber', 'MobilePhone', 
                'trim|min_length[4]|max_length[30]|');

        $result_form_validation = $this->form_validation->run();

        if ($result_form_validation) {
            $update_user_success = $this->if_admin_update_user($user_id);
            if ($update_user_success) {
                $this->users();
            } else {
                $this->users();
            }
        } else {
            $this->users();
        }
    }
//============================================================================// 
    /**
     * boolean function if update product.
     * @param int $product_id
     * @param string $product_categories
     * @name if update product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update sucess a product return true 
     * else return false.
     * @internal this code call Model_admin from models and then the function 
     * if_admin_update_product.
     * 
     */
    function if_update_product($product_id, $product_categories) {
        $this->load->model('Model_admin');
        return $this->Model_admin->if_admin_update_product($product_id, 
                $product_categories);
    }

//============================================================================// 
    /**
     * This function is for view after update a product and for the form
     * validation. 
     * @name  update product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of products if success return  products specifically with 
     * changes  view  else return products specifically without changes.
     *
     * @internal this code call boolean function if_update_product.
     * 
     */
    function update_product() {
        $product_id = $this->input->get_post('product_id');
        $product_categories = $this->input->get_post('product_categories');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('productName', 'Name', 
                'required|trim|min_length[4]|max_length[45]');
        $this->form_validation->set_rules('productEnabled', 'Enabled', 
                'required|trim|');
        $this->form_validation->set_rules('productDescription', 'Description', 
                'required|trim|min_length[1]|max_length[1550]');
        $this->form_validation->set_rules('productAvailableQuantity', 
                'Available Quantity', 
                'required|trim|min_length[1]|max_length[45]|integer|');
        $this->form_validation->set_rules('productWeight', 'Weight', 
                'required|trim|min_length[1]|max_length[45]|numeric|');
        $this->form_validation->set_rules('productPrice', 'Price', 
                'required|trim|min_length[1]|max_length[45]|numeric|');
        $this->form_validation->set_rules('productSalePrice', 'Sale Price',
                'required|trim|min_length[1]|max_length[45]|numeric|');

        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {

            $update_product_success = $this->if_update_product($product_id,
                    $product_categories);
            if ($update_product_success) {
                $this->show_products_specifically($product_categories);
            } else {
                $this->show_products_specifically($product_categories);
            }
        } else {

            $this->show_products_specifically($product_categories);
        }
    }
//============================================================================// 
    /**
     * This function is for view after add product to deals. 
     * @name  add product to deals.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of deals products if success return  products specifically 
     * with changes  view  else return products specifically without changes .
     *
     * @internal this code call boolean function insert_product_to_deals.
     * 
     */
    function add_product_to_deals() {
        $product_id = $this->input->get_post('product_id');
        $product_categories = $this->input->get_post('product_categories');

        
        $data = $this->select_product($product_id, $product_categories);
        if ($data) {
            $check_if_product_is_on_deal = $this->check_if_product_is_on_deal(
                    $product_id,$product_categories);
            
            if(!$check_if_product_is_on_deal){
              $if_insert_product_to_deals=$this->insert_product_to_deals($data);
              
                    if($if_insert_product_to_deals){
                      
                      $this->deals_view();
                    }else{
                      echo "<center>faild to insert product to deals</center>";
                      $this->deals_view();
                    }  
            }else{
               echo "<center>product exist to deals</center>";
                      $this->deals_view();
            }
            
        } else {
            echo "<center>faild</center>";
        }
    }
//============================================================================// 
    /**
     * boolean function if insert product to deals.
     * @param string $product_data
     * @name insert product to deals.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to insert a product to deals return true 
     * else return false.
     *
     * @internal this code call Model_admin from models and then the function 
     * insert_product_to_deals.
     * 
     */
    function insert_product_to_deals($product_data) {
        $this->load->model('Model_admin');
        return $this->Model_admin->insert_product_to_deals($product_data);
    }
//============================================================================// 
    /**
     * boolean function check if product is on deal.
     * @param string $product_id
     * @param string $product_categories
     * @name check_if_product_is_on_deal.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to insert a product to deals return true 
     * else return false.
     *
     * @internal this code call Model_admin from models and then the function 
     * check_if_product_is_on_deal.
     * 
     */
    function check_if_product_is_on_deal($product_id,$product_categories) {
        $this->load->model('Model_admin');
        return $this->Model_admin->check_if_product_is_on_deal($product_id,
                $product_categories);
    }
//============================================================================// 
    /**
     * boolean function if update service.
     * @param int $service_id
     * @param string $service_categories
     * @name if update service.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update return true else
     * return false.
     *
     * @internal this code call Model_admin from models and then the function 
     * if_admin_update_service.
     * 
     */
    function if_update_service($service_id, $service_categories) {
        $this->load->model('Model_admin');
        return $this->Model_admin->if_admin_update_service($service_id,
                $service_categories);
    }

//============================================================================// 
    /**
     * This function is for view after update a service and for the form 
     * validation. 
     * @name  update service.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of services if success return  service specifically with 
     * changes  view  else return service specifically without changes.
     *
     * @internal this code call boolean function if_update_service.
     * 
     */
    function update_service() {

        $service_id = $this->input->get_post('service_id');
        $service_categories = $this->input->get_post('service_categories');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('serviceName', 'Service Name', 
                'required|trim|min_length[4]|max_length[45]');
        $this->form_validation->set_rules('serviceDetails', 'Service Details', 
                'required|trim|max_length[2000]');
        $this->form_validation->set_rules('serviceNotes', 'Service Notes', 
                'required|trim|max_length[2000]');
        $this->form_validation->set_rules('servicePriceAtWork', 
                'Service Price At Work', 
                'required|trim|min_length[1]|max_length[45]|numeric|');
        $this->form_validation->set_rules('servicePriceAtHome', 
                'Service Price At Home', 
                'required|trim|min_length[1]|max_length[45]|numeric|');

        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {

            $update_service_success = $this->if_update_service($service_id,
                    $service_categories);
            if ($update_service_success) {
                $this->show_services_specifically($service_categories);
            } else {
                $this->show_services_specifically($service_categories);
            }
        } else {
            $this->show_services_specifically($service_categories);
        }
    }
//============================================================================// 
    /**
     * boolean function if delete product.
     * @param int $product_id
     * @param string $product_categories
     * @name if delete product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete a product return true else return
     * false.
     *
     * @internal this code call Model_admin from models and then the function
     * if_delete_product.
     * 
     */
    function if_delete_product($product_id, $product_categories) {
        $this->load->model('Model_admin');
        return $this->Model_admin->if_delete_product($product_id,
                $product_categories);
    }
//============================================================================// 
    /**
     * boolean function if delete deals product.
     * @param int $deals_products_id
     * @param string $product_categories
     * @name if delete deals product.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete a product return true else return
     * false.
     *
     * @internal this code call Model_admin from models and then the function 
     * if_delete_deals_product.
     * 
     */
    function if_delete_deals_product($deals_products_id, $product_categories) {
        $this->load->model('Model_admin');
        return $this->Model_admin->if_delete_deals_product($deals_products_id, 
                $product_categories);
    }

//============================================================================// 
    /**
     * This function is for view after delete a product . 
     * @name  delete product by id.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of products if success return products specifically with 
     * changes view else return products specifically without changes .
     *
     * @internal this code call boolean function if_delete_product.
     * 
     */
    function delete_product_by_id() {
        $product_id = $this->input->get_post('product_id');
        $product_categories = $this->input->get_post('product_categories');

        $if_delete_product = $this->if_delete_product($product_id,
                $product_categories);
        if ($if_delete_product) {
            $this->show_products_specifically($product_categories);
        } else {
            echo "faild to delete the product";
            $this->show_products_specifically($product_categories);
        }
    }
//============================================================================// 
    /**
     * This function is for view after delete a deals product . 
     * @name  delete deals product by id.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of products if success return deals products  with changes 
     * view else return deals products  without changes .
     *
     * @internal this code call boolean function if_delete_deals_product.
     * 
     */
    function delete_deals_product_by_id() {
        $deals_products_id = $this->input->get_post('deals_products_id');
        $product_categories = $this->input->get_post('product_categories');

        $if_delete_deals_product = $this->if_delete_deals_product(
                $deals_products_id, $product_categories);
        if ($if_delete_deals_product) {
           $this->deals_view();
        } else {
            echo "<center>faild to delete the product</center>";
            $this->deals_view();
        }
    }
    
//============================================================================// 
    /**
     * boolean function if delete service.
     * @param int $service_id
     * @param string $service_categories
     * @name if delete service.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to delete a service return true else
     *  return false.
     *
     * @internal this code call Model_admin from models and then the function
     *  if_delete_service.
     * 
     */
    function if_delete_service($service_id, $service_categories) {
        $this->load->model('Model_admin');
        return $this->Model_admin->if_delete_service($service_id,
                $service_categories);
    }

//============================================================================// 
    /**
     * This function is for view after delete a service . 
     * @name  delete service by id.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of service if success return  service specifically with 
     * changes view else return service specifically without changes .
     *
     * @internal this code call boolean function if_delete_product.
     * 
     */
    function delete_service_by_id() {
        $service_id= $this->input->get_post('service_id');
        $service_categories = $this->input->get_post('service_categories');

        $if_delete_service = $this->if_delete_service($service_id, 
                $service_categories);
        if ($if_delete_service) {
            $this->show_services_specifically($service_categories);
        } else {
            echo "faild to delete the service";
            $this->show_services_specifically($service_categories);
        }
    }
 
//============================================================================// 
    /**
     * This function is for validate and for update contact answer . 
     * <p>Description:</p>
     * This function give as a validate for inputs and if change the status 
     * call the update_contact.
     * @name  contact answer validator.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of users contacts if success return users contacts page 
     * with changes view  else return  users contacts page without changes .
     *
     * @internal this code call update_contact.
     * 
     */
    function contact_answer_validator() {
         $this->load->library('form_validation');

        $this->form_validation->set_rules('answer', 'answer', 
                'required|trim|min_length[3]');
    
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {
           $if_update_contact=$this->update_contact();
           if($if_update_contact){
		   		echo "<center>Success answer</center>";
		   		$this->users_contacts();
		   }else{
		   	echo "<center>Faild answer</center>";
		   		$this->users_contacts();
		   }
             
        }else{
        	echo "<center>Validator dont runs.</center>";
              $this->users_contacts();
        }
    }
//============================================================================// 
    /**
     * boolean function update order status.
     * @param string $table_name
     * @name  update_contact.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update order return true else 
     * return false.
     *
     * @internal this code call Model_admin from models and then the function
     *  update_contact.
     * 
     */
    function update_contact() {
        $this->load->model('Model_admin');
        return $this->Model_admin->update_contact(); 
    }
//============================================================================// 
    /**
     * This function is for validate and for update orders. 
     * <p>Description:</p>
     * This function give as a validate for inputs and if change the status
     * call update_orders_by_order_number.
     * Status is:
     * <ul>
     *      <li>(main)Listing,Processed,Completion</li>
     *      <li>Cancelled</li>
     *      <li>Finished</li>
     * </ul>
     * @name  validate update orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of orders if success return index admin page with changes 
     * view  else return index admin page without changes .
     *
     * @internal this code call update_orders_by_order_number and 
     * index_admin_page .
     * 
     */
    function validate_update_orders() {
         $this->load->library('form_validation');

        $this->form_validation->set_rules('userName', 'Name',
                'required|trim|min_length[3]|max_length[50]');
        
        $this->form_validation->set_rules('city', 'city', 
                'required|trim|min_length[3]|max_length[45]|');
        
        $this->form_validation->set_rules('postcode', 'postcode',
                'required|trim|min_length[3]|max_length[45]|integer|numeric|');
        $this->form_validation->set_rules('deliveryMethod', 'Delivery Method',
                'required|trim|min_length[2]|max_length[45]|');
        
   
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {
           $this->update_orders_by_order_number();
             
        }else{
            $this->index_admin_page();
        }
    }
//============================================================================// 
    /**
     * This function is for validate and for update request services . 
     * <p>Description:</p>
     * This function give as a validate for inputs and  if change the status 
     * call update_request_services_by_order_number.
     * Status is:
     * <ul>
     *      <li>(main)Listing,Processed,Completion</li>
     *      <li>Cancelled</li>
     *      <li>Finished</li>
     * </ul>
     * @name  validate_request_services .
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of request services .if success return 
     * request_services_view admin page with changes view  else return 
     * request_services_view admin page without changes .
     *
     * @internal this code call update_request_services_by_order_number and
     * request_services_view.
     * 
     */
    function validate_request_services() {
        
         $this->load->library('form_validation');
        

        $this->form_validation->set_rules('notes', 'notes', 
                'trim|max_length[250]');
        
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {
        	 
           $this->update_request_services_by_order_number();
             
        }else{
        	
            $this->request_services_view();
        }
    }
//============================================================================// 
    /**
     * This function is for validate and update finished request services . 
     * <p>Description:</p>
     * This function give as a validate for inputs and  if change the status 
     * call update_finished_request_services_by_order_number.
     * Status is:
     * <ul>
     *      <li>Listing,Processed,Completion</li>
     *      <li>Cancelled</li>
     *      <li>(main)Finished</li>
     * </ul>
     * @name  validate update finished request services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of services if success return request services page 
     * with changes view else return request services page without changes.
     *
     * @internal this code call
     *  update_finished_request_services_by_order_number and 
     * request_services_view.
     * 
     */
    function validate_update_finished_request_services() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('notes', 'notes',
                'trim|max_length[250]');
 
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {
            $this->update_finished_request_services_by_order_number();
        }else{
           $this->request_services_view(); 
        }
    }
//============================================================================// 
    /**
     * This function is for validate and update finished request services . 
     * <p>Description:</p>
     * This function give as a validate for inputs and  if change the status 
     * call update_finished_request_services_by_order_number.
     * Status is:
     * <ul>
     *      <li>Listing,Processed,Completion</li>
     *      <li>(main)Cancelled</li>
     *      <li>Finished</li>
     * </ul>
     * @name  validate update cancelled  request services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of services if success return  request services page with 
     * changes view  else return request services page without changes .
     *
     *@internal this code call 
     * update_cancelled_request_services_by_order_number and
     * request_services_view.
     * 
     */
    function validate_update_cancelled_request_services() {
        
         $this->load->library('form_validation');

        $this->form_validation->set_rules('notes', 'notes', 
                'trim|max_length[250]');
 
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {
            $this->update_cancelled_request_services_by_order_number();
        }else{
           $this->request_services_view(); 
        }
    }
//============================================================================// 
    /**
     * This function is for view update request services . 
     * <p>Description:</p>
     * This function give as a check if change the status of order.
     * if changes moves the request_ services to the new status.
     * Status is:
     * <ul>
     *      <li>(main)Listing,Processed,Completion</li>
     *      <li>Cancelled</li>
     *      <li>Finished</li>
     * </ul>
     * @name  update request_services by order number.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of request services if success return request services page
     *  with changes view  else return request services page without changes.
     *
     * @internal this code call  function update_request_services_status and
     *  change_request_services depends of status.
     * 
     */
    function update_request_services_by_order_number() {
        
            $status = $this->input->post('status');
            $table_name = $this->input->get_post('table_name');
          

            if ($status == 'Listing' || $status == 'Processed' ||
                    $status == 'Completion') {
            	
                $result = $this->update_request_services_status($table_name);
                if ($result) {
                	
                    $this->request_services_view();
                } else {
                    $this->request_services_view();
                }
                
            } elseif ($status == 'Cancelled') {
            	
                $insert_cancelled_table = 'cancelled_services_request';
                $result = $this->change_request_services($table_name,
                        $insert_cancelled_table);
                if ($result) {
                    $this->request_services_view();
                } else {
                    $this->request_services_view();
                }
                
            } else {
                $insert_finished_table = 'finished_services_request';
                $result = $this->change_request_services($table_name, 
                        $insert_finished_table);
                if ($result) {
                    $this->request_services_view();
                } else {
                    $this->request_services_view();
                } 
            }
    }
//============================================================================// 
    /**
     * This function is for view update finished request services. 
     * <p>Description:</p>
     * This function give as a check if change the status of order.
     * if changes moves the request services to the new status.
     * Status is:
     * <ul>
     *      <li>Listing,Processed,Completion</li>
     *      <li>Cancelled</li>
     *      <li>(main)Finished</li>
     * </ul>
     * @name  update finished request services by request services number.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of finished request services if success return request
     * services page with changes view else return irequest_services page
     * without changes .
     *
     * @internal this code call  function change_request_services and 
     * update_request_services_status depends of status.
     * 
     */
    function update_finished_request_services_by_order_number() {
        
        $status = $this->input->post('status');
           	$table_name = $this->input->get_post('table_name');

        if ($status == 'Cancelled') {

            $insert_cancelled_table = 'cancelled_services_request';
            $result = $this->change_request_services($table_name,
                    $insert_cancelled_table);
                    if ($result) {
                        $this->request_services_view();
                    } else {
                        $this->request_services_view();
                    }
        } elseif ($status == 'Listing' || $status == 'Processed' || 
                $status == 'Completion') {

                   $insert_cancelled_table = 'services_request';
                    $result = $this->change_request_services($table_name, 
                            $insert_cancelled_table);
                    if ($result) {
                        $this->request_services_view();
                    } else {
                        $this->request_services_view();
                    }
         } else {
                   $result = $this->update_request_services_status($table_name);
                    if ($result) {
                        $this->request_services_view();
                    } else {
                        $this->request_services_view();
                    }
                }
    }
//============================================================================// 
    /**
     * This function is for view update cancelled request services. 
     * <p>Description:</p>
     * This function give as a check if change the status of order.
     * if changes moves the orders to the new status.
     * Status is:
     * <ul>
     *      <li>Listing,Processed,Completion</li>
     *      <li>(main) Cancelled</li>
     *      <li>Finished</li>
     * </ul>
     * @name  update cancelled request services orders by order number.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of cancelled  request services if success return  request
     * services page with changes view  else return request services page 
     * without changes .
     *
     * @internal this code call  function update_request_services_status and 
     * change_request_services depends of status.
     * 
     */
    public function update_cancelled_request_services_by_order_number() {
        
           $status = $this->input->post('status');
           $table_name = $this->input->get_post('table_name');

            if ($status == 'Cancelled') {

                $result = $this->update_request_services_status($table_name);
                if ($result) {
                    $this->request_services_view();
                } else {
                    $this->request_services_view();
                }
            } elseif ($status == 'Listing' || $status == 'Processed' || 
                    $status == 'Completion') {

                $insert_cancelled_table = 'services_request';
                $result = $this->change_request_services($table_name, 
                        $insert_cancelled_table);
                if ($result) {
                    $this->request_services_view();
                } else {
                    $this->request_services_view();
                }
            } else {

                $insert_cancelled_table = 'finished_services_request';
                $result = $this->change_request_services($table_name, 
                        $insert_cancelled_table);
                if ($result) {
                    $this->request_services_view();
                } else {
                    $this->request_services_view();
                }
            }
        
    }
//============================================================================// 
    /**
     * This function is for view update orders . 
     * <p>Description:</p>
     * This function give as a check if change the status of order.
     * if changes moves the orders to the new status.
     * Status is:
     * <ul>
     *      <li>(main)Listing,Processed,Completion</li>
     *      <li>Cancelled</li>
     *      <li>Finished</li>
     * </ul>
     * @name  update orders by order number.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of orders if success return index admin page with changes
     *  view else return index admin page without changes .
     *
     * @internal this code call  function update_order_status and change_order 
     * depends of status.
     * 
     */
    function update_orders_by_order_number() {
        
            $status = $this->input->post('status');
            $table_name = $this->input->post('table_name');

            if ($status == 'Listing' || $status == 'Processed' || 
                    $status == 'Completion') {
                $result = $this->update_order_status($table_name);
                if ($result) {
                    $this->index_admin_page();
                } else {
                    $this->index_admin_page();
                }
            } elseif ($status == 'Cancelled') {
                $insert_cancelled_table = 'cancelled_orders';
                $result = $this->change_order($table_name,
                        $insert_cancelled_table);
                if ($result) {
                $table ='statistics_cancelled_orders_per_day';
                $if_stats_add=$this->add_statistics_admin_orders_pluss($table);
			if($if_stats_add){
							
			}else{
                            echo "problem to add stats";
			}
                    $this->index_admin_page();
                } else {
                    $this->index_admin_page();
                }
            } else {
                $insert_finished_table = 'finished_orders';
                $result = $this->change_order($table_name,
                        $insert_finished_table);
                if ($result) {
                $table ='statistics_finished_orders_per_day';
                $if_stats_add=$this->add_statistics_admin_orders_pluss($table);
			if($if_stats_add){
							
			}else{
			echo "problem to add stats";
			}
                    $this->index_admin_page();
                } else {
                    $this->index_admin_page();
                }
            }
             
        }

//============================================================================// 
    /**
     * boolean function add statistics admin orders pluss.
     * @name  add statistics admin orders pluss.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update order return true else return 
     * false.
     *
     * @internal this code call Statistics_model from models and then the 
     * function add_statistics_admin_orders_pluss.
     * 
     */
    function add_statistics_admin_orders_pluss($table) {
    $this->load->model('Statistics_model');
    return $this->Statistics_model->add_statistics_admin_orders_pluss($table);
        
    }
//============================================================================// 
    /**
     * boolean function add statistics admin orders abstractio.
     * @name  add statistics admin orders abstractio.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update order return true else return
     * false.
     *
     * @internal this code call Statistics_model from models and then the 
     * function add_statistics_admin_orders_abstraction.
     * 
     */
    function add_statistics_admin_orders_abstraction($table) {
    $this->load->model('Statistics_model');
    return $this->Statistics_model->add_statistics_admin_orders_abstraction(
            $table);
        
    }
       
//============================================================================// 
    /**
     * boolean function update order status.
     * @param string $table_name
     * @name  update order status.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean.If success to update order return true else return false.
     *
     * @internal this code call Model_admin from models and then the function 
     * update_orders_status.
     * 
     */
    function update_order_status($table_name) {
        $this->load->model('Model_admin');
        if ($this->Model_admin->update_orders_status($table_name)) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function change order.
     * @param string $table
     * @param string $insert_tabel
     * @name  change order.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to change order status return true else 
     * return false.
     *
     * @internal this code call Model_admin from models and then the function
     * change_order.
     * 
     */
    function change_order($table, $insert_tabel) {
        $this->load->model('Model_admin');
        if ($this->Model_admin->change_order($table, $insert_tabel)) {
            return true;
        } else {
            return false;
        }
    }

//============================================================================// 
    /**
     * boolean function update request services status.
     * @param string $table_name
     * @name  update request services status.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to update request services return true else 
     * return false.
     *
     * @internal this code call Model_admin from models and then the function
     *  update_request_services_status.
     * 
     */
    function update_request_services_status($table_name) {
        $this->load->model('Model_admin');
        if ($this->Model_admin->update_request_services_status($table_name)) {
            return true;
        } else {
            return false;
        }
    }
//============================================================================// 
    /**
     * boolean function change request services.
     * @param string $table
     * @param string $insert_tabel
     * @name  change request services.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return boolean. if success to change request services status return 
     * true else return false.
     *
     * @internal this code call Model_admin from models and then the function 
     * change_request_services.
     * 
     */
    function change_request_services($table, $insert_tabel) {
        $this->load->model('Model_admin');
       if ($this->Model_admin->change_request_services($table, $insert_tabel)) {
            return true;
        } else {
            return false;
        }
    }

//============================================================================// 
    /**
     * This function is for validate and update finished orders . 
     * <p>Description:</p>
     * This function give as a validate for inputs and  if change the status 
     * call update_finished_orders_by_order_number.
     * Status is:
     * <ul>
     *      <li>Listing,Processed,Completion</li>
     *      <li>Cancelled</li>
     *      <li>(main)Finished</li>
     * </ul>
     * @name  validate update finished orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of orders if success return index admin page with changes
     * view  else return index admin page without changes .
     *
     * @internal this code call update_finished_orders_by_order_number.
     * 
     */
    function validate_update_finished_orders() {
        
         $this->load->library('form_validation');

        $this->form_validation->set_rules('userName', 'Name', 
                'required|trim|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('city', 'city', 
                'required|trim|min_length[3]|max_length[45]|');
        $this->form_validation->set_rules('postcode', 'postcode', 
                'required|trim|min_length[3]|max_length[45]|integer|numeric|');
        $this->form_validation->set_rules('deliveryMethod', 'Delivery Method',
                'required|trim|min_length[2]|max_length[45]|');
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {
            $this->update_finished_orders_by_order_number();
        }else{
           $this->index_admin_page(); 
        }
    }
//============================================================================// 
    /**
     * This function is for view update finished orders. 
     * <p>Description:</p>
     * This function give as a check if change the status of order.
     * if changes moves the orders to the new status.
     * Status is:
     * <ul>
     *      <li>Listing,Processed,Completion</li>
     *      <li>Cancelled</li>
     *      <li>(main)Finished</li>
     * </ul>
     * @name  update finished orders by order number.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of finished orders if success return index admin page with
     * changes view  else return index admin page without changes .
     *
     * @internal this code call  function update_order_status and change_order 
     * depends of status.
     * 
     */
    function update_finished_orders_by_order_number() {
        
        $status = $this->input->post('status');
        $table_name = $this->input->post('table_name');

        if ($status == 'Cancelled') {
					
            $insert_cancelled_table = 'cancelled_orders';
            $result = $this->change_order($table_name, $insert_cancelled_table);
            if ($result) {
            $table_finished ='statistics_finished_orders_per_day';
            $table_cancelled ='statistics_cancelled_orders_per_day';
            $if_stats_add_finished=
                $this->add_statistics_admin_orders_abstraction($table_finished);
            $if_stats_add_cancelled=
            $this->add_statistics_admin_orders_pluss($table_cancelled);
                        if($if_stats_add_finished && $if_stats_add_cancelled ){

                        }else{
                            echo "problem to add stats";
                        }
                    $this->index_admin_page();
            } else {
            $this->index_admin_page();
            }
        } elseif ($status == 'Listing' || $status == 'Processed' ||
                $status == 'Completion') {

            $insert_cancelled_table = 'orders';
            $result = $this->change_order($table_name, $insert_cancelled_table);
            if ($result) {
                $table ='statistics_finished_orders_per_day';
                $if_stats_add=
                        $this->add_statistics_admin_orders_abstraction($table);
			if($if_stats_add){
							
			}else{
                            echo "problem to add stats";
			}
                        $this->index_admin_page();
                    } else {
                        $this->index_admin_page();
                    }
        } else {
                    $result = $this->update_order_status($table_name);
                    if ($result) {
                        $this->index_admin_page();
                    } else {
                        $this->index_admin_page();
                    }
                }
 
    }
//============================================================================// 
    /**
     * This function is for validate and update cancelled orders . 
     * <p>Description:</p>
     * This function give as a validate for inputs and  if change the status 
     * call update_cancelled_orders_by_order_number.
     * Status is:
     * <ul>
     *      <li>Listing,Processed,Completion</li>
     *      <li>(main) Cancelled</li>
     *      <li>Finished</li>
     * </ul>
     * @name  validate update cancelled orders.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of orders if success return index admin page with changes 
     * view  else return index admin page without changes .
     *
     * @internal this code call update_cancelled_orders_by_order_number.
     * 
     */
    public function validate_update_cancelled_orders() {
        
         $this->load->library('form_validation');

        $this->form_validation->set_rules('userName', 'Name', 
                'required|trim|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('city', 'city', 
                'required|trim|min_length[3]|max_length[45]|');
        $this->form_validation->set_rules('postcode', 'postcode',
                'required|trim|min_length[3]|max_length[45]|integer|numeric|');
        $this->form_validation->set_rules('deliveryMethod', 'Delivery Method', 
                'required|trim|min_length[2]|max_length[45]|');
        
        
        $result_form_validation = $this->form_validation->run();
        if ($result_form_validation) {
           $this->update_cancelled_orders_by_order_number();
        }else{
            $this->index_admin_page();
        }
    }
//============================================================================// 
    /**
     * This function is for view update cancelled orders. 
     * <p>Description:</p>
     * This function give as a ckeck if change the status of order.
     * if changes moves the orders to the new status.
     * Status is:
     * <ul>
     *      <li>Listing,Processed,Completion</li>
     *      <li>(main) Cancelled</li>
     *      <li>Finished</li>
     * </ul>
     * @name  update cancelled orders by order number.
     * @author Alex Patsanis <alexpatsanis@gmail.gr>
     * @api
     * @return view of cancelled orders if success return index admin page with 
     * changes view  else return index admin page without changes .
     *
     * @internal this code call  function update_order_status and change_order 
     * depends of status.
     * 
     */
    public function update_cancelled_orders_by_order_number() {
        
            $status = $this->input->post('status');
            $table_name = $this->input->post('table_name');

        if ($status == 'Cancelled') {

                $result = $this->update_order_status($table_name);
                if ($result) {
                    $this->index_admin_page();
                } else {
                    $this->index_admin_page();
                }
        } elseif ($status == 'Listing' || $status == 'Processed' || 
                    $status == 'Completion') {

                $insert_cancelled_table = 'orders';
                $result = $this->change_order($table_name, 
                        $insert_cancelled_table);
                if ($result) {
                 $table ='statistics_cancelled_orders_per_day';
                 $if_stats_add=
                        $this->add_statistics_admin_orders_abstraction($table);
			if($if_stats_add){
							
			}else{
                            echo "problem to add stats";
			}
                    $this->index_admin_page();
                } else {
                    $this->index_admin_page();
                }
        } else {

                $insert_cancelled_table = 'finished_orders';
                $result = $this->change_order($table_name, 
                        $insert_cancelled_table);
              if ($result) {
              $table_finished ='statistics_finished_orders_per_day';
              $table_cancelled ='statistics_cancelled_orders_per_day';
              $if_stats_add_cancelled=
              $this->add_statistics_admin_orders_abstraction($table_cancelled);
              $if_stats_add_finished=
                      $this->add_statistics_admin_orders_pluss($table_finished);
		if($if_stats_add_finished && $if_stats_add_cancelled ){
							
		}else{
			echo "problem to add stats";
		}
                    $this->index_admin_page();
                } else {
                    $this->index_admin_page();
                }
            }
        
    }

//============================================================================// 

}

?>