<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Search_model extends MY_Model {

    function __construct()
    {		
            parent::__construct();
            $this->table = 'search';

    }
        
    function search($terms, $start = 0, $results_per_page = 0)
    {
       if ($results_per_page > 0)
        {
                $limit = "LIMIT $start, $results_per_page";
        }
        else
        {
                $limit = '';
        }

        // Execute our SQL statement and return the result
        $sql = "SELECT url, name, main_content
                        FROM pages
                        WHERE MATCH (main_content) AGAINST (?) > 0
                        $limit";
        $query = $this->db->query($sql, array($terms, $terms));
        return $query->result();
    }
    
    function search_email($category)
    {
        $q = $this->input->post('search');
        
        if($category == 'sent'){
            
            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND member_id = '".$this->session->userdata('members_id')."') OR (body LIKE '%$q%' AND $category = 'yes' AND member_id = '".$this->session->userdata('members_id')."')";
            $query = $this->db->query($sql);
        
            if($query->num_rows() > 0){

              foreach ($query->result() as $row)
               {
                       $data[] = $row;
               }

            }
            else{
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
            
        }
        elseif($category == 'important'){
           
            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND sent_member_id = '".$this->session->userdata('members_id')."') OR (body LIKE '%$q%' AND $category = 'yes' AND sent_member_id = '".$this->session->userdata('members_id')."')";
            $query = $this->db->query($sql);
        
            if($query->num_rows() > 0){

              foreach ($query->result() as $row)
               {
                       $data[] = $row;
               }

            }
            else{
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        }
        elseif($category == 'archive'){
            
            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND sent_member_id = '".$this->session->userdata('members_id')."') OR (body LIKE '%$q%' AND $category = 'yes' AND sent_member_id = '".$this->session->userdata('members_id')."')";
            $query = $this->db->query($sql);
        
            if($query->num_rows() > 0){

              foreach ($query->result() as $row)
               {
                       $data[] = $row;
               }

            }
            else{
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        }
        elseif($category == 'draft'){
           
            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND member_id = '".$this->session->userdata('members_id')."') OR (body LIKE '%$q%' AND $category = 'yes' AND member_id = '".$this->session->userdata('members_id')."')";
            $query = $this->db->query($sql);
        
            if($query->num_rows() > 0){

              foreach ($query->result() as $row)
               {
                       $data[] = $row;
               }

            }
            else{
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        }
        elseif($category == 'trash'){
            
            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND sent_member_id = '".$this->session->userdata('members_id')."') OR (body LIKE '%$q%' AND $category = 'yes' AND sent_member_id = '".$this->session->userdata('members_id')."')";
            $query = $this->db->query($sql);
        
            if($query->num_rows() > 0){

              foreach ($query->result() as $row)
               {
                       $data[] = $row;
               }

            }
            else{
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        }
        elseif($category == 'member' || $category == 'market' || $category == 'support'){
            
            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND inbox = 'yes' AND sent_member_id = '".$this->session->userdata('members_id')."' AND sent_from = '".$category."') OR (body LIKE '%$q%' AND inbox = 'yes' AND sent_member_id = '".$this->session->userdata('members_id')."' AND sent_from = '".$category."') ORDER BY datetime DESC";
            $query = $this->db->query($sql);
        
            if($query->num_rows() > 0){

              foreach ($query->result() as $row)
               {
                       $data[] = $row;
               }

            }
            else{
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        }
        else{
            
            $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND inbox = 'yes' AND sent_member_id = '".$this->session->userdata('members_id')."') OR (body LIKE '%$q%' AND inbox = 'yes' AND sent_member_id = '".$this->session->userdata('members_id')."') ORDER BY datetime DESC";
            $query = $this->db->query($sql);
        
            if($query->num_rows() > 0){

              foreach ($query->result() as $row)
               {
                       $data[] = $row;
               }

            }
            else{
                $data = 'NO RESULTS WERE FOUND!';
            }
            //echo json_encode($data);
            return $data;
        }
        
//        $sql = "SELECT * FROM mailbox WHERE (subject LIKE '%$q%' AND $category = 'yes' AND member_id = '".$this->session->userdata('members_id')."') OR (body LIKE '%$q%' AND $category = 'yes' AND member_id = '".$this->session->userdata('members_id')."')";
//        $query = $this->db->query($sql);
//        
//            if($query->num_rows() > 0){
//
//              foreach ($query->result() as $row)
//               {
//                       $data[] = $row;
//               }
//
//            }
//            else{
//                $data = 'NO RESULTS WERE FOUND!';
//            }
//            //echo json_encode($data);
//            return $data;
    }
   
   function count_search_results($terms)
   {
           // Run SQL to count the total number of search results
           $sql = "SELECT COUNT(*) AS count
                           FROM pages
                           WHERE MATCH (main_content) AGAINST (?)";
           $query = $this->db->query($sql, array($terms));
           return $query->row()->count;
   }
}

