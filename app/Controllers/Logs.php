<?php

namespace App\Controllers;

class Logs extends Security_Controller {

    protected $Ticket_templates_model;
    protected $Logs_model = null;

    function __construct() {
        parent::__construct();
        $this->init_permission_checker("logs");

        $this->Logs_model = model('App\Models\Logs_model');
    }

    function view($user_id = 0) {
        validate_numeric_value($user_id);

        if (!$user_id) {
            $user_id = $this->request->getPost('id');
        }

        $view_type = $this->request->getPost('view_type');

        if ($user_id) {
            
            $options = array("id" => $user_id);
            $contact_info = $this->Users_model->get_one($user_id);
            
            $logs_info = $this->Logs_model->get_my_logs_list($user_id);
            
            $view_data['user'] = $contact_info;
            $view_data["view_type"] = $view_type;
            $view_data['logs'] = $logs_info;

            if ($view_type == "modal_view") {
                return $this->template->view("logs/view", $view_data);
            } else {
                return $this->template->rander("logs/view", $view_data);
            }
        } else {
            show_404();   
        }
    }
}


/* End of file logs.php */
/* Location: ./app/controllers/logs.php */