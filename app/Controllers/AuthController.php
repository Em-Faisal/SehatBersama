<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProfileModel;
use Config\Session;

class AuthController extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }
    public function proses_register()
    {
        
        $validation = \config\Services::validation();
        $validation->setRules([
            'nama_lengkap'=>'required',
            'username'=>'required|is_unique[profiles.username]',
            'email'=>'required|valid_email|is_unique[profiles.email]',
            'password'=>'required|min_length[8]',
            'confirm_password'=>'required|matches[password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->listErrors());
        }
        
        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'lvl_profile' => 'user',
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];
        $model = new ProfileModel();
        $existingEmail = $model->where('email', $this->request->getPost('email'))->first();
        
        if ($existingEmail) {
            return redirect()->back()->withInput()->with('email_exists', true);
        }
        if (!$model->insert($data)) {
        return redirect()->back()->withInput()->with('errors', 'Gagal menyimpan data ke database');
    }
        return redirect()->to('/login')->with('success', 'Registrasi Berhasil');
        

    }

    public function login()
    {
        return view('auth/login');
    }

    public function proses_login()
    {
        $session = session();
        $loginInput = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $lvl_profile = $this->request->getPost('lvl_profile');

        $model = new ProfileModel();
        $user = $model->where('email', $loginInput)->first();

        if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
            $user = $model->where('email', $loginInput)->first();
            } else {
                $user = $model->where('username', $loginInput)->first();
        }

        if ($user) {
            if(password_verify($password, $user['password'])){
                $session->set ([
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email'  => $user['email'],
                    'logged_in' => TRUE,
                    'lvl_profile' => $user['lvl_profile'],
                ]);
                session()->set(['user_id' => $user['id']]);

                    return redirect()->to('/home');
                } else {
                    return redirect()->back()->with('errors', 'Email/Username atau Password Salah');
                }
        
            
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
