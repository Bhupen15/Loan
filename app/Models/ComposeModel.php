<?php
namespace App\Models;

use CodeIgniter\Model;

class ComposeModel extends Model
{

    protected $table = "email";

    protected $PrimaryKey = 'sno';


    protected $allowedFields = [ 'senderId', 'receiverId', 'subject', 'message', 'status', 'date', 'file'];


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

    
    public function receivedMail($id){
        $result = $this->select()->where('receiverId',$id)->get()->getResultArray();
        return $result;
    }

    public function sentMail($id){
        $result = $this->select()->where('senderId',$id)->get()->getResultArray();
        return $result;
    }
}

?>