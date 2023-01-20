<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class ApiController extends  ResourceController
{
    use ResponseTrait;  

    //show all users

    public function __construct()
    {
        // header('Access-Control-Allow-Origin: *');
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin,X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method");
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE, get, post");

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        //Do your magic here
        
    }
    
    public function index()
    {
        

        $usermodel = model(UserModel::class);
        $data = $usermodel->findAll();
        return $this->respondCreated($data);
 }


 public function userdetail($sno) 
    {
        
        $usermodel = model(UserModel::class);
        $data = $usermodel->getWhere(['sno' => $sno])->getResult();
        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No Data Found with id '.$sno);
        }
    }



    public function create()
    {
        $usermodel=model(UserModel::class);
        
            $data = [
                'fname' => $this->request->getVar('fname'),
                'lname' => $this->request->getVar('lname'),
                'email' => $this->request->getVar('email'),
                'mobile' => $this->request->getVar('mobile'),
                'password' => $this->request->getVar('password'),


            ];
         $result=   $usermodel->insert($data);
            
         if(!$result){
            $message = $usermodel->errors();
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' =>$result,
                    'message'=>$message

                ]
            ];
            return $this->respondCreated($response);
         }

            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' =>"true"
                ]
            ];
            return $this->respondCreated($response);
        
    }



    public function login()
    {
        
        $email = $this->request->getJsonVar('email');
        $password=$this->request->getJsonVar('password');
        
        $usermodel=model(UserModel::class);
        
        $result = $usermodel->getWhere(['email'=>$email])->getResultArray();
        
        
        if(isset($result[0]['password']))
        {
            
            $password1 = isset($result[0]['password']) ? $result[0]['password'] : '';
        }
        
   
        if(isset($password1) && !empty($password1)){
                if($password1==$password){
            $session = \Config\Services::session();
            $session->set('sno',$result[0]['sno']);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'true',
                    'message'=>"Login Successful",
                    'role'=>$result[0]['role'],
                    'sno'=>$result[0]['sno']
                ]
            ]; 
            
        }
    }else{
            $response = [
                'status'   => 403,
                'error'    => "Invalid user or password",
                'messages' => [
                    'success' => 'false',
                    'message'=>"Login failed"
                ]
            ]; 
            
        }
        
        
        return $this->respondCreated($response);
        # code...
    }





    public function update($sno = null)
    {
       $usermodel=model(UserModel::class);
        $input = $this->request->getRawInput();
        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'email' => $this->request->getVar('email'),
            'mobile' => $this->request->getVar('mobile'),
            'password' => $this->request->getVar('password'),


        ];

        $usermodel->updatedata($sno, $data);
        print_r($usermodel->errors());

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];
        return $this->respond($response);
    }
    public function delete($sno = null)
    {
        $usermodel=model(UserModel::class);
        
        $data = $usermodel->where('sno',$sno)->find();
        if($data){
            $usermodel->deletedata($sno);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('No Data Found with sno '.$sno);
        }
         
    }
    
}
