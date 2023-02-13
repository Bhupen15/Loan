<?php

namespace App\Models;

use CodeIgniter\Model;

class LoanModel extends Model
{
    protected $table = 'application';
    protected $allowedFields = ['fname', 'lname', 'email', 'gender', 'aadhar', 'pan', 'profession', 'income', 'loanamount', 'duration', 'address1', 'address2', 'pincode', 'place', 'country', 'mobile', 'sno', 'remark', 'status'];

    public function listLoan()
    {
        $result = $this->findAll();
        return $result;
    }

    public function loanBysno($sno)
    {
        $result = $this->select()->where('sno', $sno)->get()->getRowArray();
        return $result;
    }

    public function registerLoan($data)
    {
        $db = db_connect();
        $r = $db->table('application')->insert($data);
        return $r;
    }

    public function UpdateLoanDetails($sno, $data)
    {
        $db = db_connect();
        $data1 = $db->table('application')->where('sno', $sno)->ignore()->update($data);
        if ($db->affectedRows() == 1) {
            return True;
        }
        return $data1;

        // $r = $this->where('sno', $sno)->ignore()->update($data);
        // return $r;
    }

}