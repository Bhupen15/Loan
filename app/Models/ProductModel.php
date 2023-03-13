<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $allowedFields = ['pname', 'category', 'description', 'image', 'price', 'stock', 'cid'];

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
        $r = $db->table('product')->insert($data);
        return $r;
    }


    public function deletedata($sno)
    {

        $db = db_connect();
        $result = $db->table('product')->where('sno', $sno)->delete();
     
    }

    public function UpdateLoanDetails($sno, $data)
    {
        $db = db_connect();
        $data1 = $db->table('product')->where('sno', $sno)->ignore()->update($data);
        if ($db->affectedRows() == 1) {
            return True;
        }
        return $data1;

        // $r = $this->where('sno', $sno)->ignore()->update($data);
        // return $r;
    }

}