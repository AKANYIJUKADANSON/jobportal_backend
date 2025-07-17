<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class JobsController extends MY_Controller {
        
        public function index(){
            // echo "Hello Jobs";
            $jobs = $this->jobs->get_jobs();
            echo json_encode($jobs);
        }

        public function singleJob($job_id){
            // die("Job Id: ". $job_id);
            $job = $this->jobs->get_jobs($job_id);
            echo json_encode($job);
        }

        public function addJob(){
            // Get POST data from React form
            $data = json_decode(file_get_contents('php://input'), true);

            // Prepare data
            $newJob = [
                'title' => $data['title'],
                'type' => $data['type'],
                'description' => $data['description'],
                'salary' => $data['salary'],
                'location' => $data['location'],
            ];

            // var_dump($newJob);

            if($this->jobs->add_job($newJob) ){
                echo 'Job added successfully';
            }else{
                echo 'Error while adding the job';
            }
        }

        public function deleteJob($job_id){
            // die('Ready to delete the job: '. $job_id);
            if($this->jobs->deleteJob($job_id)){
                echo 'Job deleted successfully';
            }else{
                echo "error while deleting the job";
            }
        }

        /**
         * --------------------------------------------------------
         * -------------------- FILES -----------------------------
         * --------------------------------------------------------
        */

        public function uploadFile(){

            // Set the timezone to East African Time
            date_default_timezone_set('Africa/Nairobi');

            $file_name = date('Ymdhis').'_'.str_replace(" ", "_", $_FILES['file']['name']);

            // set file upload directory
            $upload_directory = FCPATH. 'uploads/attachments';

            // check if upload directory is created, and if not we create it
            if (! is_dir($upload_directory)){
                // make directory
                mkdir($upload_directory, 0777, true);
            }

            // get image data into the config array
            $config = [
                'upload_path' => $upload_directory,
                'allowed_types' => 'jpg|png|jpeg',
                'file_name' => $file_name,
            ];


            // Call the upload library and pass the config array
            $this->load->library('upload', $config);

            /**
             * Check if the file is uploaded successfully by checking if there is
             * any error and redirect to the form with an error message
             */
             
            if ( ! $this->upload->do_upload('file'))
            {
                $error_response = [
                    'status' => "400",
                    'img' => '',
                    'message' => "File upload failure"
                ];

                echo json_encode($error_response);
            }
            else{
                // if the image is stored then add data to the db
                // get the file name that is used in the $config upload array
                $uploaded_file_name = $this->upload->data('file_name');

                $file_data = [
                    'file_name' => $uploaded_file_name,
                    'description' => $this->input->post('caption'),
                ];

                if($this->jobs->save_file_data($file_data)){
                    $success_data = [
                        'status' => '200',
                        'message' => "File saved successfully"
                    ];

                    echo json_encode($success_data);    
                }else{
                    $error_data = [
                        'status' => '400',
                        'message' => "Error while saving the file"
                    ];

                    echo json_encode($error_data);  
                }


            }     

        }
    }