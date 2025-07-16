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
    }