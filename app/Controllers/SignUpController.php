<?php

namespace App\Controllers;

use App\Models\UserModel;
use PhpParser\Node\Expr\AssignOp\Div;

class SignUpController extends BaseController
{
    public function index()
    {
  
        return view('signup');
    

    }

    public function do_signup()
    {

        helper(['form']);
        $rules = [
            'fname' => 'required|min_length[2]|max_length[50]',
            'lname' => 'required|min_length[2]|max_length[50]',
            'mobile' => 'required|min_length[10]|max_length[10]|is_unique[users.mobile]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[4]|max_length[50]',
            'confirmpassword' => 'matches[password]'
        ];
        if ($this->validate($rules)) {
            $usermodel = new UserModel();
            $fname = $this->request->getPost('fname');
            $lname = $this->request->getPost('lname');
            $mobile = $this->request->getPost('mobile');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            // $password = md5($password);

            $data = ['fname' => $fname, 'lname' => $lname, 'mobile' => $mobile, 'email' => $email, 'password' => $password];
            //  print_r($data);
            // die();
            $result = $usermodel->insert($data);
            print_r($usermodel->errors());

            if ($result) {
                echo "User registered successfully";
                //  $session->set("users", $result);

                return redirect()->to('/signin');
            } else {
                echo "Error during registration";
            }
        }
        else{
            $data['validation'] = $this->validator;
            echo view('signup', $data);
                }
    }
}