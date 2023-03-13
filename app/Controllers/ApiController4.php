<?php

namespace App\Controllers;

use App\Models\ComposeModel;
use App\Models\EmailModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

require_once("/opt/lampp/htdocs/bhupendra/php-jwt/src/JWT.php");
require_once("/opt/lampp/htdocs/bhupendra/php-jwt/src/Key.php");

class ApiController4 extends ResourceController
{
    use ResponseTrait;

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Authentication, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    }

    public function index()
    {
        $usermodel = model(EmailModel::class);

        $data = $usermodel->get()->getResult();

        $response = [
            "status" => 200,
            "error" => null,
            "messages" => [
                "data" => $data,

            ]

        ];
        return $this->respondCreated($response);
    }

    public function create()
    {
        $usermodel = model(EmailModel::class);

        $data = [
            'fname' => $this->request->getVar('fname'),
            'lname' => $this->request->getVar('lname'),
            'email' => $this->request->getVar('email'),
            // 'mobile' => $this->request->getVar('mobile'),
            'password' => $this->request->getVar('password'),
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
        $emailmodel = Model(EmailModel::class);
        $email = $this->request->getVar('email');

        $user = $emailmodel->where(['email' => $email])->get()->getResultArray();


        if (isset($_FILES['file'])) {
            $file = $_FILES['file']['name'];
            $path = './public/upload/' . $file;
            try {
                move_uploaded_file($_FILES['file']['tmp_name'], $path);
            } catch (\Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
        if (isset($user[0]['sno'])) {
            $receiverId = $user[0]['sno'];

            $usermodel = new ComposeModel();
            $data = [
                'senderId' => $this->request->getVar('senderId'),
                'receiverId' => $receiverId,
                'subject' => $this->request->getVar('subject'),
                'message' => $this->request->getVar('message'),

                // 'status' => $this->request->getVar('status'),
                // 'date' => date("l jS \of F Y h:i:s A"),

            ];
            if (isset($_FILES['file'])) {
                $data['file'] = "http://localhost/bhupendra/public/upload/" . $_FILES['file']['name'];
            }
            print_r($data);
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
    }
    public function getSentMails($id)
    {
        $emailcontent = new ComposeModel;
        $result = $emailcontent->sentMail($id);
        if ($result) {
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' => true,
                    'result' => $result,
                ]
            ];
        } else {
            $message = $emailcontent->errors();
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' => false,
                    'result' => $message,
                ]
            ];
        }
        return $this->respondCreated($response);

    }
    public function getReceivedMails($id)
    {
        $emailcontent = new ComposeModel;
        $result = $emailcontent->receivedMail($id);
        if ($result) {
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' => true,
                    'result' => $result,
                ]
            ];
        } else {
            $message = $emailcontent->errors();
            $response = [
                'status' => 403,
                'error' => null,
                'messages' => [
                    'success' => false,
                    'result' => $message,
                ]
            ];
        }
        return $this->respondCreated($response);

    }


    public function login()
    {

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $usermodel = model(EmailModel::class);

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
                    'iat' => time(),
                    'exp' => time() + 10000000000
                ];


                $secretKey = getenv('JWT_SECRET');
                $token = \Firebase\JWT\JWT::encode($payload, $secretKey, 'HS256');
                $jwtdata = \Firebase\JWT\JWT::decode($token, new \Firebase\JWT\Key($secretKey, 'HS256'));


                $response = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => true,
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
                        'success' => false,
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
                    'success' => false,
                    'message' => "Login failed"
                ]
            ];

        }


        return $this->respondCreated($response);
        # code...
    }
}