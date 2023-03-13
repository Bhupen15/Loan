<?php

namespace App\Controllers;

use App\Models\ReactModel;
use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

require_once("/opt/lampp/htdocs/bhupendra/php-jwt/src/JWT.php");
require_once("/opt/lampp/htdocs/bhupendra/php-jwt/src/Key.php");

class ApiController3 extends ResourceController
{
    use ResponseTrait;
    //THis is done by ritik
    //show all users

    public function __construct()
    {
        // header('Access-Control-Allow-Origin: *');
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: Authorization, X-API-KEY, Origin,X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method");
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PATCH, PUT, DELETE, get, post");

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Authentication, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        //Do your magic here

    }

    public function index()
    {

        // $headers = $this->request->getHeaders();

        // if (isset($headers['Authentication'])) {
        //     $header = $headers['Authentication'];
        //     $secretKey = getenv('JWT_SECRET');
        //     $token = explode(' ', $header)[1]; 

        // $token = substr($token, 1,-1);




        // $jwtdata = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($secretKey, 'HS256'));



        // if ($jwtdata->sub->role) {
        $usermodel = model(ReactModel::class);

        // $page = $this->request->getGet('page');
        // $limit=5;
        // $limit = $this->request->getVar('pagelimit');

        // $offset=($page-1)*$limit;


        $data = $usermodel->get()->getResult();
        $totaluser = $usermodel->countAll();
        // $totalpage = ceil($totaluser / $limit);
        $response = [
            "status" => 200,
            "error" => null,
            "messages" => [
                "data" => $data,

            ]

        ];
        return $this->respondCreated($response);

        // $response = [
        //     'status' => 403,
        //     'error' => null,
        //     'messages' => [
        //         'success' => false,
        //         'message' => 'invalid token'
        //     ]
        // ];
        // return $this->respondCreated($response);


        // // }
        // $response = [
        //     'status' => 403,
        //     'error' => null,
        //     'messages' => [
        //         'success' => false,
        //         'message' => 'invalid token'
        //     ]
        // ];
        // return $this->respondCreated($response);

    }


    public function userdetail($sno)
    {

        $usermodel = model(ReactModel::class);
        print_r("hello");
        $data = $usermodel->dataById($sno);
        print_r($data);
        die;
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('No Data Found with id ' . $sno);
        }
    }



    public function create()
    {
        $usermodel = model(ReactModel::class);

        $data = [
            'category' => $this->request->getVar('category'),
            // 'lname' => $this->request->getVar('lname'),
            // 'email' => $this->request->getVar('email'),
            // 'mobile' => $this->request->getVar('mobile'),
            // 'password' => $this->request->getVar('password'),


        ];
        $result = $usermodel->insert($data);

        if (!$result) {
            $message = $usermodel->errors();
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' => $result,
                    'message' => $message

                ]
            ];
            return $this->respondCreated($response);
        }

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => "true"
            ]
        ];
        return $this->respondCreated($response);

    }
    public function create2()
    {
        $usermodel = model(ProductModel::class);

        $data = [
            'pname' => $this->request->getVar('pname'),
            'category' => $this->request->getVar('category'),
            'image' => $this->request->getVar('image'),
            'description' => $this->request->getVar('description'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock'),



        ];
        $result = $usermodel->insert($data);

        if (!$result) {
            $message = $usermodel->errors();
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' => $result,
                    'message' => $message

                ]
            ];
            return $this->respondCreated($response);
        }

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => "true"
            ]
        ];
        return $this->respondCreated($response);

    }



    public function login()
    {

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        // print_r($email."\n".$password);

        $usermodel = model(LoginModelReact::class);

        $result = $usermodel->where(['email' => $email])->get()->getResultArray();




        if (isset($result[0]['password'])) {

            $password1 = isset($result[0]['password']) ? $result[0]['password'] : '';
        } else {
            die("user not exist");
        }

        if (isset($password1) && !empty($password1)) {


            if ($password1 == $password) {

                $session = \Config\Services::session();
                $session->set('sno', $result[0]['sno']);


                $payload = [

                    'sub' => $result[0],
                    // Subject of the token
                    'iat' => time(),
                    // Time when JWT was issued. 
                    'exp' => time() + 10000000000 // Expiration time
                ];


                $secretKey = getenv('JWT_SECRET');
                $token = \Firebase\JWT\JWT::encode($payload, $secretKey, 'HS256');

                $jwtdata = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($secretKey, 'HS256'));


                $response = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'true',
                        'message' => "Login Successful",
                        'sno' => $result[0]['sno'],
                        'token' => $token
                    ]
                ];

            } else {
                $response = [
                    'status' => 403,
                    'error' => "Invalid user or password",
                    'messages' => [
                        'success' => 'false',
                        'message' => "Login failed"
                    ]
                ];
                return $this->respondCreated($response);

            }

        } else {


            $response = [
                'status' => 403,
                'error' => "Invalid user or password",
                'messages' => [
                    'success' => 'false',
                    'message' => "Login failed"
                ]
            ];

        }


        return $this->respondCreated($response);
        # code...
    }


    public function imageUpload($sno = null)
    {
        $file = $_FILES['image']['name'];
        $path = './public/upload/' . $file;
        try {
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }

        $usermodel = new ReactModel();
        $image = [
            'image' => "http://localhost/bhupendra/public/upload/" . $file,
        ];
        $r = false;
        $data = $usermodel->getWhere(['sno' => $sno])->getResult();
        if ($data) {
            $r = $usermodel->updatedata($sno, $image);
        }
        return $r;
    }



    public function update($sno = null)
    {
        $usermodel = model(ReactModel::class);
        $input = $this->request->getRawInput();
        $data = [
            'category' => $this->request->getVar('category'),



        ];

        $usermodel->updatedata($sno, $data);
        $loanmodel = new ReactModel();
        $loanmodel->UpdateLoanDetails($sno, $data);


        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => true
            ]
        ];
        return $this->respond($response);
    }
    public function delete($sno = null)
    {
        $usermodel = model(ReactModel::class);

        $data = $usermodel->where('sno', $sno)->find();
        if ($data) {
            $usermodel->deletedata($sno);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with sno ' . $sno);
        }

    }
    public function deletep($sno = null)
    {
        $usermodel = model(ProductModel::class);

        $data = $usermodel->where('sno', $sno)->find();
        if ($data) {
            $usermodel->deletedata($sno);
            $response = [
                'status' => 200,
                'error' => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No Data Found with sno ' . $sno);
        }

    }
    public function applyloan()
    {

        $loanmodel = model(ProductModel::class);
        $data = [
            'pname' => $this->request->getVar('pname'),
            'category' => $this->request->getVar('category'),
            'description' => $this->request->getVar('description'),
            'image' => $this->request->getVar('image'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock'),
            'cid' => $this->request->getVar('cid'),


        ];
        // print_r($data);
        // die;
        $result = $loanmodel->registerLoan($data);

        if (!$result) {
            $message = $loanmodel->errors();
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' => $result,
                    'message' => $message

                ]
            ];
            return $this->respondCreated($response);
        }

        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => "true",
                'message' => "Loan Applied"
            ]
        ];
        return $this->respondCreated($response);
    }

    public function appliedLoanList()
    {
        $loanmodel = new ProductModel;
        $result = $loanmodel->listLoan();
        return $this->respond($result);
    }


    public function loanDataById($sno = null)
    {

        $loanmodel = new ProductModel;
        $r = $loanmodel->loanBysno($sno);

        if ($r) {
            return $this->respond($r);
        } else {
            return $this->respond(false);
        }

    }

// public function editLoanData()
// {

//     $loanmodel = new LoanModel();
//     $sno = $this->request->getVar('sno');

//     $data = [
//         'fname' => $this->request->getVar('fname'),
//         'lname' => $this->request->getVar('lname'),
//         'email' => $this->request->getVar('email'),
//         'gender' => $this->request->getVar('gender'),
//         'aadhar' => $this->request->getVar('aadhar'),
//         'pan' => $this->request->getVar('pan'),
//         'profession' => $this->request->getVar('profession'),
//         'income' => $this->request->getVar('income'),
//         'loanamount' => $this->request->getVar('loanamount'),
//         'duration' => $this->request->getVar('duration'),
//         'address1' => $this->request->getVar('address1'),
//         'address2' => $this->request->getVar('address2'),
//         'place' => $this->request->getVar('place'),
//         'pincode' => $this->request->getVar('pincode'),
//         'country' => $this->request->getVar('country'),
//         'mobile' => $this->request->getVar('mobile'),
//         'status' => $this->request->getVar('status'),
//         'remark' => $this->request->getVar('remark'),
//     ];



//     $isData = $loanmodel->loanBysno($sno);

//     if (isset($isData)) {
//         $result = $loanmodel->UpdateLoanDetails($sno, $data);


//         if ($result) {
//             $response = [
//                 "status" => 200,
//                 "success" => true,
//                 "error" => null
//             ];
//         } else {
//             $error = $loanmodel->errors();
//             $response = [
//                 "status" => 200,
//                 "success" => false,
//                 "error" => $error
//             ];

//         }
//         return $this->respondCreated($response);
//     } else {
//         print_r("hello");
//         die();
//     }


// }

// public function editRemark()
// {

//     $loanmodel = new LoanModel();
//     $sno = $this->request->getVar('sno');
//     $data = [
//         'remark' => $this->request->getVar('remark'),
//     ];
//     $isData = $loanmodel->loanBysno($sno);

//     if (isset($isData)) {
//         $result = $loanmodel->UpdateLoanDetails($sno, $data);
//         //$result = $loanmodel->update($sno, $data);

//         if ($result) {
//             $response = [
//                 "status" => 200,
//                 "success" => true,
//                 "error" => null
//             ];
//         } else {
//             $error = $loanmodel->errors();
//             $response = [
//                 "status" => 200,
//                 "success" => false,
//                 "error" => $error
//             ];

//         }
//         return $this->respondCreated($response);
//     } else {
//         print_r("hello");
//         die();
//     }


// }

// public function editStatus()
// {

//     $loanmodel = new LoanModel();
//     $sno = $this->request->getVar('sno');
//     $data = [
//         'status' => $this->request->getVar('status'),
//     ];
//     $isData = $loanmodel->loanBysno($sno);

//     if (isset($isData)) {
//         $result = $loanmodel->UpdateLoanDetails($sno, $data);

//         // $result = $loanmodel->update($sno, $data);

//         if ($result) {
//             $response = [
//                 "status" => 200,
//                 "success" => true,
//                 "error" => null
//             ];
//         } else {
//             $error = $loanmodel->errors();
//             $response = [
//                 "status" => 200,
//                 "success" => false,
//                 "error" => $error
//             ];

//         }
//         return $this->respondCreated($response);
//     } else {
//         print_r("hello");
//         die();
//     }


// }

}