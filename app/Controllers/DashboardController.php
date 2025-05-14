<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProfileModel;
use Config\Session;

class DashboardController extends BaseController
{
    public function dashboard_profiles()
    {
        $model = new ProfileModel();
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('errors', 'Silakan login terlebih dahulu.');
        }

        $profiles = $model->find($user_id);
        if ($profiles) {
            // Kirim data profile ke view
            return view('dashboard/profiles', ['profiles' => $profiles]);
        } else {
            return redirect()->back()->with('errors', 'Profil tidak ditemukan.');
        }

    }

    public function update_photo($id)
    {
        $model = new ProfileModel();

        $validation = \Config\Services::validation();
        $validation->setRules([
            'photo' => [
                'rules' => 'uploaded[photo]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Foto harus diunggah.',
                    'is_image' => 'File harus berupa foto.',
                    'mime_in' => 'File harus berupa JPG, JPEG, atau PNG.',
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->listErrors());
        }

        $profile = $model->find($id);
        if (!$profile) {
            return redirect()->back()->with('errors', 'Profil tidak ditemukan.');
        }

        $photo = $this->request->getFile('photo');
        if ($photo->isValid() && !$photo->hasMoved()) {
            $newFileName = $photo->getRandomName();
            $photo->move('uploads/photos/', $newFileName);

            if (!empty($profile['photo']) && file_exists('uploads/photos/' . $profile['photo'])) {
                unlink('uploads/photos/' . $profile['photo']);
            }

            $model->update($id, ['photo' => $newFileName]);

            return redirect()->to('dashboard-profiles')->with('success', 'Foto profil berhasil diperbarui.');
        } else {
            return redirect()->back()->with('errors', 'Gagal mengunggah foto.');
        }
    }


    public function update_profile($id)
    {
        $model = new ProfileModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama_lengkap'=>'required',
            'bio'=>'required',
            'telp'=>'required|numeric',
            'jns_kelamin'=>'required',
            'tmp_lahir'=>'required',
            'tgl_lahir'=>'required|valid_date[Y-m-d]',
            'alamat'=>'required',
            'provinsi'=>'required',
            'kota'=>'required',
            'kode_pos'=>'required|numeric',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->listErrors());
        }

        $profile = $model->find($id);

        if (!$profile) {
            return redirect()->back()->with('errors', 'Profil tidak ditemukan.');
        }

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'bio' => $this->request->getPost('bio'),
            'telp' => $this->request->getPost('telp'),    
            'jns_kelamin' => $this->request->getPost('jns_kelamin'),
            'tmp_lahir' => $this->request->getPost('tmp_lahir'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'alamat' => $this->request->getPost('alamat'),
            'provinsi' => $this->request->getPost('provinsi'),
            'kota' => $this->request->getPost('kota'),
            'kode_pos' => $this->request->getPost('kode_pos'),
        ];

        if($model->update($id, $data)){
            return redirect()->to('dashboard-profiles')->with('success', 'Profil Berhasil Diubah');
        } else {
            return redirect()->to('dashboard-profiles')->with('errors', 'Profil Gagal Diubah');
        }
    }

    public function dashboard_password()
    {
        $model = new ProfileModel();
        $user_id = session()->get('user_id');
        if (!$user_id) {
            return redirect()->to('/login')->with('errors', 'Silakan login terlebih dahulu.');
        }

        $profiles = $model->find($user_id);
        if ($profiles) {
            // Kirim data profile ke view
            return view('dashboard/password', ['profiles' => $profiles]);
        } else {
            return redirect()->back()->with('errors', 'Profil tidak ditemukan.');
        }
    }

    public function update_password($id)
    {
        $model = new ProfileModel();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'password' => 'required',
            'confirm_password'=>'matches[password]',
        ]);

        if(!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->listErrors());
        }

        $password = $this->request->getPost('password');
        $data = [
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];

        if($model->update($id, $data)){
            return redirect()->to('dashboard-password')->with('success', 'Password Berhasil Diubah');
        } else {
            return redirect()->to('dashboard-password')->with('errors', 'Password Gagal Diubah');
        }
    }
    

}

