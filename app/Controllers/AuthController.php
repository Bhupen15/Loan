<?php
namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class AuthController extends  ResourceController
{

public  function create_token($user_id) {
        $this->db->select('token');
        $this->db->where('user_id', $user_id);
        $qres = $this->db->get('user_token');
        if ($qres->num_rows() > 0) {
            $user = $qres->row();
            $data = array(
                'user_id' => $user_id,
                'logout_time' => null
            );
            $this->db->update('user');
        }
    
    }

    function check_token($token = FALSE) {
        if ($token) {
            $query = $this->db->where(array('token' => $token, 'logout_time' => NULL))->limit(1)->get('user_token');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        return FALSE;
    }

    function update_token($token = FALSE) {
        $flag = FALSE;
        if ($token) {
            $id = $this->get_user($token);
            $log = "User [$id] could not be logout.";
            $this->db->update('user_token', array('logout_time' => date('Y-m-d H:i:s')), array('token' => $token));
            $return = $this->db->affected_rows() == 1;
            if ($return) {

            }
        }
    
    }
}
