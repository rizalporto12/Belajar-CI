<?php

namespace App\Controllers;
use  App\Models\LoginModel;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use PhpParser\Node\Stmt\Break_;
use PHPUnit\TextUI\Output\DefaultPrinter;
use PHPUnit\TextUI\XmlConfiguration\DefaultConfiguration;

class Login extends BaseController
{
    public function index()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];
            
        
        return view('login', $data);
    }

    public function login_action()
    {
     $rules = [
        'username' => 'required',
        'password' => 'required'
     ];

     if(!$this->validate($rules)){
        $data['validation'] = $this->validator;
         return view('login', $data);
     }else{
        $session = session();
        $LoginModel = new LoginModel;

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $checkusername = $LoginModel->where('username', $username)->first();
         if($checkusername) {
         $password_db = $checkusername['password'];
         $cek_password = password_verify($password, $password_db);
         if($cek_password){

            $session_data = [
                'username' => $checkusername['username'],
                'logged_in' => TRUE,
                'role_id' => $checkusername['role']
            ];
            $session ->set($session_data);
        switch($checkusername['role']){
            case "Admin":
                return redirect()->to('admin/home');
                case "Pegawai":
                return redirect()->to('pegawai/home');
                default:
                $session->setFlashdata('pesan','Akun anda belum terdaftar');
                return redirect()->to('/');
                }
         }else{
            $session->setFlashdata('pesan','Password salah, silahkan coba lagi');
            return redirect()->to('/');
         }
         }else{
            $session->setFlashdata('pesan','Username salah, silahkan coba lagi');
            return redirect()->to('/');
         }
     }

    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}