<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        $data["first_name"] = "Vijay";
        $data["Last_name"] = "Rathor";
        return view('admin_home',$data);
    }
    public function bhupendra(){
        echo "This is admin";
    }
}
