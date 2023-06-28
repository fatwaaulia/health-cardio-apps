<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Auth extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\M_Users');
    }

    public function login()
    {
        if (session()->isLogin) return redirect()->to(base_url('dashboard'));
        $data['title'] = 'Login';

        $data['content'] = view('auth/login', $data);
        return view('dashboard/header', $data);
        
    }

    public function loginProcess()
    {
        $rules = [
            'username'  => 'required|alpha_numeric|max_length[20]',
            'password'  => 'required',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        } else {
            $where = [
                'username'  => $this->request->getVar('username', $this->filter),
                'password'  => $this->model->password_hash($this->request->getVar('password')),
            ];
            
            $user = $this->model->where($where)->first();
            $cek = $this->model->getWhere($where)->getNumRows();
            if ($cek > 0) {
                $session = [
                    'isLogin' => true,
                    'user'    => $user,
                ];
                session()->set($session);
                return redirect()->to(base_url('dashboard'));
            } else {
                return redirect()->to(base_url('login'))
                    ->with('message',
                    "<script>
                        Swal.fire({
                        position: 'top-end',
                        icon: 'error',
                        title: 'Username atau password salah!',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        })
                    </script>");
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function register()
    {
        if (session()->isLogin) return redirect()->to(base_url('dashboard'));
        $data['title'] = 'Register';

        $data['content'] = view('auth/register', $data);
        return view('dashboard/header', $data);
    }
    public function registerProcess()
    {
        $rules = [
            'nama'      => 'required',
            'username'  => 'required|alpha_numeric|max_length[20]|is_unique[users.username]',
            'password'  => 'required|min_length[8]',
            'passconf'  => 'required|min_length[8]|matches[password]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $field = [
                'id_role'   => '3',
                'nama'      => $this->request->getVar('nama', $this->filter),
                'username'  => $this->request->getVar('username', $this->filter),
                'password'  => $this->model->password_hash($this->request->getVar('password')),
            ];

            $this->model->insert($field);
            return redirect()->to(base_url('login'))
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Berhasil membuat akun, silakan login',
                    })
                </script>");
        }
    }
}
