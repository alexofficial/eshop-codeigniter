<?php

//============================================================================// 
/**
 * This class  : have all methods for email.
 * @name email_model.
 * @author Alex Patsanis <alexpatsanis@gmail.gr>
 * @filesource 
 * @api
 * @package application\models
 * @copyright Copyright (c) 2014-2015, Alexander Patsanis
 * 
 */
class Email_model extends CI_Model {
    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
//============================================================================// 
    /**
     * This function gives to others functions of view some default data.
     * <p>Description of data:</p>
     * <ul>
     *  <li>email config</li>
     * </ul>
     * 
     * @return string array of all this data.
     */    
     function email_data(){
        $config = array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'ssl://smtp.gmail.com',
                    'smtp_port' => '465',
                    //for example: 'smtp_user' => 'example@gmail.com ', 
                    'smtp_user' => 'dissectionmailer@gmail.com ', 
                    //for example: 'smtp_pass' => 'your password ',
                    'smtp_pass' => '6945635415*',
                    'charset' => 'utf-8',
                    'newline' => "\r\n",
                    'mailtype' => 'html',
                    'validation' => TRUE // bool whether to validate email or not 
                );
        return $config;
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
     * @return true if email send success or false if dont.
     */
     function general_send_email($subject, $message,$send_to) {
      
        $config=$this->email_data();

        $this->load->library('email', $config);
        $this->email->from($config['smtp_user'], 'Admin Team');
        $this->email->to($send_to);
        $this->email->subject($subject);
        $this->email->message($message);

        return $this->email->send();
    }
    
}
