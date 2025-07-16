<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class MY_Controller extends CI_Controller {

         public function __construct(){
            parent::__construct();

            // Set CORS headers
            header('Access-Control-Allow-Origin: *'); // Allow all origins (replace * with specific domain for security)
            header("Content-type:application/json");
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
            
            $this->load->helper('form');
            $this->load->library('form_validation');
            $this->load->model('Jobs_model', 'jobs');

            
        }

    }