<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $PrimaryKey = 'sno';

    protected $allowedFields = ['fname', 'lname', 'mobile', 'email', 'password','image'];


    public function getUserDetail($where)
    {

        $value = $this->where($where)->get()->getRowArray();


        //       $result = $usermodel->where('email', $email)->first();

        // select * from user where email=email ;
        return $value;
        # code...
    }

    public function getAllUser()
    {
        $value = $this->select()->get()->getResultArray();
        // select* from users;

        return $value;

        # code...
    }
    public function updatedata($sno, $data)
    {
        // print_r($sno);

        // print_r($data);
        $db = db_connect();
        $result = $db->table('users')->where('sno', $sno)->update($data);
        
        // $result= $this->update($sno,$data);
     
       

        # code...
    }

    public function deletedata($sno)
    {

        $db = db_connect();
        $result = $db->table('users')->where('sno', $sno)->delete();
     
    }


    
}


?>