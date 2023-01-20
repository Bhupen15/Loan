<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {

        echo view('signin');


    }
    public function user()
    {
        echo view('user');
        # code...
    }

    // public function do_signin()
    // {

    //     $usermodel = new UserModel();
    //     $session = \Config\Services::session();
    //     $email = $this->request->getPost('email');
    //     $password = $this->request->getPost('password');
    //     $result = $usermodel->where('email', $email)->first();

    //     if ($result['email'] != '') {

    //         // if ($password == $result['password']) {
    //         if (password_verify($password, $result['password'])) {
    //             $session->set("users", $result);


    //             $result = $session->get('users');
    //             if ($result['role'] == 0) {
    //                 // echo "You are User";
    //                 echo view('user');
    //             } else {
    //                 echo view('dashboard');
    //                 //  echo "You are Admin";
    //             }
    //             //  return redirect()->to('/dashboard');

    //         } else {
    //             // $data=array('msg'=>"Invalid username or password!!");
    //             echo "Invalid username or password!!";
    //             // return view('signin', $data);
    //             //  return redirect()->to('signin');
    //             // return redirect('signin');
    //         }
    //     } else {
    //         echo " Invalid username or password";
    //         //  return redirect()->to('signin');
    //         //return redirect('signin');
    //     }
    // }


}