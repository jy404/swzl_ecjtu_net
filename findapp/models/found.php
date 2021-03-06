<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Found extends CI_Model {

    private $per_page_count;
    private $total_count;
    
    public function __construct()
    {
        parent::__construct();
        $this->per_page_count = 9;
        $this->total_count = $this->get_total_rows();
    }
    
    public function get_info($page = '1',$perpage = 9)
    {
        $this->per_page_count = $perpage;
        $page = intval($page);
        if ($page <= 0)
        {
            $page = 1;
        }
        $this->db->select('fd.fid AS id, fd.name, fd.place, fd.time, fd.description, cy.cname');
        $this->db->from('found AS fd');
        $this->db->join('category AS cy', 'fd.category = cy.cid');
        $this->db->order_by("fd.fid", "desc");
        $this->db->limit($this->per_page_count, ($page - 1) * $this->per_page_count);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_detail_info($fid)
    {
        $lid = intval($fid);
        $this->db->select('fid');
        $query = $this->db->get_where('found', array('fid' => $fid) );
        if ($query->num_rows() > 0)
        {
            $this->db->select('fd.fid AS id, fd.name, fd.place, fd.time, fd.description, fd.owner, fd.phone, cy.cname');
            $this->db->from('found AS fd');
            $this->db->join('category AS cy', 'fd.category = cy.cid');
            $this->db->where('fid', $fid);
            return $this->db->get()->row_array();
        }
        else
        {
            show_404();
        }
    }
    
    public function get_phone($fid)
    {
        $lid = intval($fid);
        $this->db->select('fid');
        $query = $this->db->get_where('found', array('fid' => $fid) );
        if ($query->num_rows() > 0)
        {
            $this->db->select('phone');
            $this->db->where('fid', $fid);
            return $this->db->get('found')->row()->phone;
        }
        else
        {
            return array();
        }
    }
    
    public function insert($data)
    {
        $this->db->insert('found', $data);
    }
    
    public function search($page,$key)
    {
        $this->db->select('fd.fid AS id, fd.name, fd.place, fd.time, fd.description, fd.owner, fd.phone, cy.cname');
        $this->db->from('found AS fd');
        $this->db->join('category AS cy', 'fd.category = cy.cid');
        $this->db->like('fd.name', $key, 'both');
        $this->db->or_like('fd.place', $key, 'both');
        $this->db->or_like('fd.description', $key, 'both');
        $this->db->limit($this->per_page_count, ($page - 1) * $this->per_page_count);
        $query = $this->db->get();
        if ($query->num_rows > 0)
        {
            return $query->result();
        }
        else
        {
            return array();
        }
    }
    
    public function get_total_rows($key = '')
    {
        if ( ! empty($key) )
        {
            $this->db->select('fid');
            $this->db->like('name', $key, 'both');
            $this->db->or_like('place', $key, 'both');
            $this->db->or_like('description', $key, 'both');
        }
        return $this->db->count_all_results('found');
    }
    
    public function get_per_page_count()
    {
        return $this->per_page_count;
    }
}
