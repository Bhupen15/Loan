<?php
namespace App\Controllers;

use App\Models\UserModel;

// $pager = \Config\Services::pager();
// $user = model(UserModel::class); 
// $data = [
//     'users' => $user->where('ban', 1)->paginate(10),
//     'pager' => $user->pager,
// ];
class Dashboard extends BaseController
{
    public function index()
    {
        $session = \Config\Services::session();

        if (session('users')->id < 1) {
            // return view('dashboard');
            // return redirect()->to('signin');
        }

        return view('dashboard');

    }


    public function userlist()
    {
    
        $user = model(UserModel::class);

        if (empty($data)) {
            $data = [
                'user' => $user->paginate(5),
                'pager' => $user->pager,
            ];
        }
        if ($this->request->getGet('s')) {
            $s = $this->request->getGet('s');
            $data = ['user' => $user->like('fname', $s)->getAllUser()];
        }
        if ($this->request->getGet('opt')) {
            $opt = $this->request->getGet('opt');
            $data = ['user' => $user->like('fname', $opt)->getAllUser()];
            echo ($opt);
        } 

        if ($this->request->getGet('asc')) {
            $asc = $this->request->getGet('asc');
            $data = $this->paging($asc);
        }

        if ($this->request->getGet('dsc')) {
            $dsc = $this->request->getGet('dsc');
            $data = $this->paging($dsc);
        } 
      

        echo view('userlist', $data);
    }

    public function show()
    {
        $sno = $_POST['id'];
        $where = ['sno' => $sno];
        $user = model(UserModel::class);
        $result = $user->getUserDetail($where);

        $data = [
            'result' => $result
        ];
        echo view('edit', $data);
    }
    public function update()
    {

        $sno = $this->request->getPost('sno');
        $fname = $this->request->getPost('fname');
        $lname = $this->request->getPost('lname');
        $mobile = $this->request->getPost('mobile');
        $email = $this->request->getPost('email');

        $data = ['fname' => $fname, 'lname' => $lname, 'mobile' => $mobile, 'email' => $email];
        $user = model(UserModel::class);
        $user->updatedata($sno, $data);

    }
    public function delete()
    {

        $sno = $this->request->getPost('id');

        $user = model(UserModel::class);
        // print_r($sno);
        // die();
        $user->deletedata($sno);



    }



    public function paging($filter = '')
    {
        $user = model(UserModel::class);


        $data = [
            'user' => $user->orderBy('fname', $filter)->paginate(5),
            'pager' => $user->pager,
        ];




        return $data;
    }

}

?>