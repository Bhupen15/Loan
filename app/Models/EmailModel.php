<?php
namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{

    protected $table = "user";

    protected $PrimaryKey = 'sno';


    protected $allowedFields = ['fname', 'lname',  'email', 'password'];


    public function getUserDetail($where)
    {

        $value = $this->where($where)->get()->getRowArray();

        return $value;

    }

    public function getAllUser()
    {
        $value = $this->select()->get()->getResultArray();

        return $value;

    }

    public function fetchDataById($sno){
        $result = $this->select()->where('sno',$sno)->get()->getRowArray();
        return $result;
    }

    public function fetchDataByEmail($email){
        $result = $this->select()->where('email',$email)->get()->getRowArray();
       
        return $result;
    }
}

?>