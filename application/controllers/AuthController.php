<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class AuthController extends MY_Controller {
        
        public function index(){
            $useremail = 'sysadmin@jobs.go.ug';
            $password = 'jobs@2025';

            $user_data = [
                'name' => 'Tinah Agaba',
                'phone' => '0775836572',
                'useremail' => 'tinah.agaba@jobs.go.ug'
            ];

            
            $login_response = [
                'status' => '200',
                'authenticated_user' => $user_data
            ]; 

            echo json_encode($login_response);
        }
    }