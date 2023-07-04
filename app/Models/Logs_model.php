<?php

namespace App\Models;

class Logs_model extends Crud_model {

    protected $table = null;

    function __construct() {
        $this->table = 'logs';
        parent::__construct($this->table);
    }

    function log_authenticate($user_id) {
        
        $data['user_id'] = $user_id;

        return $this->ci_save($data);
    }

    function get_my_logs_list($user_id = 0) {
        $logs_table = $this->db->prefixTable('logs');
    
        $query = $this->db->query("SELECT * FROM $logs_table WHERE user_id = $user_id");
    
        return $query->getResultArray();
    }
    
    
}
