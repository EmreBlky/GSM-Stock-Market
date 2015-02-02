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

