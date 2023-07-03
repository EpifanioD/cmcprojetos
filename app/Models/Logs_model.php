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

}
