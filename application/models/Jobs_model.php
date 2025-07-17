<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs_model extends CI_Model {

    public function __construct(){
        $this->load->database();
    }

    /**
     * ------------------------------------------------------------------------------
     * ------------------------|  Getting all the jobs  |----------------------------
     * ------------------------------------------------------------------------------
    */
    public function get_jobs($job_id = null){
        /**
         * If the id is not given, then get all the tickets
         */
        if ($job_id == null){

            // $this->db->limit(100);
            $this->db->order_by('id', 'DESC');

            $query = $this->db->get('jobs');
            return $query->result_array();
        }

        // If the id is provide then, retrieve the corresponding ticket
        $query = $this->db->get_where('jobs', array('id' => $job_id));
        return $query->row_array();

    }

    /**
     * ------------------------------------------------------------------------------
     * --------------------------------|  Adding a job  |----------------------------
     * ------------------------------------------------------------------------------
    */

    public function add_job($newJob){
        return $this->db->insert('jobs', $newJob);
    }

    /**
     * ------------------------------------------------------------------------------
     * --------------------------------|  Adding a job  |----------------------------
     * ------------------------------------------------------------------------------
    */

    public function deleteJob($job_id){
        $this->db->where('id', $job_id);
        return $this->db->delete('jobs');
    }


    public function save_file_data($file_data){
        return $this->db->insert('files', $file_data);
    }


}