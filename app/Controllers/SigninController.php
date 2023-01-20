<?php

namespace App\Controllers;

use App\Models\UserModel;

class SigninController extends BaseController
{
    public function index()
    {

        echo view('signin');


    }

    public function do_signin()
    {

        $usermodel = new UserModel();
        $session = \Config\Services::session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');



        $where = ['email' => $email];
        // $where = array('id', id);
        // $result = $usermodel->where('email', $email)->first();
        $result = $usermodel->getUserDetail($where);


        if ($result['email'] != '') {
            // $password = md5($password);
            // if ($password == $result['password']) {
          //  echo $password."<br>".$result['password'];
            if ($password == $result['password']){

                $session->set("users", $result);


                $result = $session->get('users');
                if ($result['role'] == 0) {
                    // echo "You are User";
                    //  echo view('user');
                    return redirect()->to('/user');



                } else {
                    echo view('dashboard');
                    //  echo "You are Admin";
                }
                //  return redirect()->to('/dashboard');

            } else {
                // $data=array('msg'=>"Invalid username or password!!");
                echo "Invalid username or password ye wali!!";
                // return view('signin', $data);
                //  return redirect()->to('signin');
                // return redirect('signin');
            }
        } else {
            echo " Invalid username or password";
            //  return redirect()->to('signin');
            //return redirect('signin');
        }
    }

    public function logout()
    {
        echo "<script>alert('You are logged out')</script>";

        session_destroy();
        echo view('signin');

    }
}