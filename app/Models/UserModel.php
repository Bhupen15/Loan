<?php
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $PrimaryKey = 'sno';

    protected $allowedFields = ['fname', 'lname', 'mobile', 'email', 'password'];


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
        if ($db->affectedRows() == 1) {
            die("data update");
        }
        // $result= $this->update($sno,$data);
        echo $result;
        print_r($this->errors());

        # code...
    }

    public function deletedata($sno)
    {

        $db = db_connect();
        $result = $db->table('users')->where('sno', $sno)->delete();
       // $result = $this->where('sno', $sno)->delete();
        // echo view('userlist');
    
        // Display warning message
        // $this->session->set_flashdata('flashWarning', 'This is a warning message.');
        // redirect('dashboard/userlist');

    }

    // public function banned()
    // {
    //     $this->builder()->where('ban', 1);

    //     return $this; // This will allow the call chain to be used.
    // }

    // public function search($search)
    // {
    //     if ($search) {
    //         $this->builder()->like('name', $search);
    //     }

    //     return $this; // This will allow the call chain to be used.
    // }
    
}


?>