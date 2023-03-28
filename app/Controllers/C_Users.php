<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Users extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\M_Users');
        $this->name = 'users'; // title, nama folder view. | spasi menggunakan garis bawah(_)
    }

    public function index()
    {
        $data['data'] = $this->model->findAll();
        $data['name'] = $this->name;
        $data['route'] = $this->route;
        $data['title'] = 'Data Users';

        $data['content'] = view($this->name.'/index',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    public function edit($id = null)
    {
        $id = model('M_Env')->decode($id);
        $data['data'] = $this->model->find($id);
        $data['name'] = $this->name;
        $data['route'] = $this->route;
        $data['title'] = 'Edit Pengguna';
        
        $data['content']   = view($this->name.'/edit',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);

    }

    public function update($id = null)
    {
        $id = model('M_Env')->decode($id);
        $data = $this->model->find($id);

        $password = $this->request->getVar('password');
        $passconf = $this->request->getVar('passconf');
        if ($password == '' && $passconf == '') {
            $matches = 'string';
        } elseif ($password == '' || $passconf == '') {
            $matches = 'required|min_length[8]|matches[password]'; 
        } elseif ($password != '' && $passconf != '') {
            $matches = 'required|min_length[8]|matches[password]';
        }
        $rules = [
            'id_role'       => 'required',
            'nama'          => 'required',
            'passconf'      => $matches,
            'jenis_kelamin' => 'required',
            'img'           => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $img = $this->request->getFile('img');
            if ($img != '') {
                $img_name = $img->getRandomName();
                $this->image->withFile($img)
                    ->save('assets/img/'.$this->name.'/'.$img_name, 60);
                $file = 'assets/img/'.$this->name.'/'.$data['img'];
                if (is_file($file)) unlink($file);
            } else {
                $img_name = $data['img'];
            }

            $field = [
                'id_role'       => $this->request->getVar('id_role', $this->filter),
                'nama'          => $this->request->getVar('nama', $this->filter),
                'password'      => $password != '' ? $this->model->password_hash($password) : $data['password'],
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin', $this->filter),
                'img'           => $img_name,
            ];
            
            // dd($field);
            $this->model->update($id, $field);
            return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Perubahan tersimpan',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    })
                </script>");
        }
    }

    public function delete($id = null)
    {
        $id = model('M_Env')->decode($id);
        $data = $this->model->find($id);

        $file = 'assets/img/'.$this->name.'/'.$data['img'];
        if (is_file($file)) unlink($file);

        // die;
        $this->model->delete($id);
        return redirect()->to($this->route)
            ->with('message',
            "<script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Hapus data berhasil',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                })
            </script>");
    }

    public function deleteImg($id = null)
    {
        $id = model('M_Env')->decode($id);
        $data = $this->model->find($id);

        $file = 'assets/img/'.$this->name.'/'.$data['img'];
        if (is_file($file)) unlink($file);

        // die;
        $this->model->update($id, ['img'=>'']);
        return redirect()->to($this->route .'/edit/'.$id)
            ->with('message',
            "<script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Foto profil dihapus',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                })
            </script>");
    }

    // PROFILE
    public function profile()
    {
        $id = $this->user_session['id'];
        $data['data'] = $this->model->find($id);
        $data['name'] = $this->name;
        $data['route'] = $this->route;
        $data['title'] = 'Personal Information';

        $data['content']   = view($this->name.'/profile',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    public function updateProfile()
    {
        $id = $this->user_session['id'];
        $data = $this->model->find($id);

        if ($data['id_role'] == 3) {
            $rules = [
                'img'              => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
                'nama'             => 'required',
                'jenis_kelamin'    => 'required',
                'usia'             => 'required',
                'riwayat_diabetes' => 'required',
                'riwayat_alkohol'  => 'required',
                'riwayat_merokok'  => 'required',
            ];
        } else {
            $rules = [
                'img'              => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
                'nama'             => 'required',
                'jenis_kelamin'    => 'required',
                'usia'             => 'required',
            ];
        }
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $img = $this->request->getFile('img');
            if ($img != '') {
                $img_name = $img->getRandomName();
                $this->image->withFile($img)
                    ->save('assets/img/'.$this->name.'/'.$img_name, 60);
                $file = 'assets/img/'.$this->name.'/'.$data['img'];
                if (is_file($file)) unlink($file);
            } else {
                $img_name = $data['img'];
            }

            $field = [
                'img'               => $img_name,
                'nama'              => $this->request->getVar('nama', $this->filter),
                'jenis_kelamin'     => $this->request->getVar('jenis_kelamin', $this->filter),
                'usia'              => $this->request->getVar('usia', $this->filter),
                'riwayat_diabetes'  => $this->request->getVar('riwayat_diabetes', $this->filter),
                'riwayat_alkohol'   => $this->request->getVar('riwayat_alkohol', $this->filter),
                'riwayat_merokok'   => $this->request->getVar('riwayat_merokok', $this->filter),
            ];
            
            // dd($field);
            $this->model->update($id, $field);
            return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Perubahan tersimpan',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    })
                </script>");
        }
    }
    public function deleteProfileImg()
    {
        $id = $this->user_session['id'];
        $data = $this->model->find($id);

        $file = 'assets/img/'.$this->name.'/'.$data['img'];
        if (is_file($file)) unlink($file);

        // die;
        $this->model->update($id, ['img'=>'']);
        return redirect()->to($this->route)
            ->with('message',
            "<script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Foto profil dihapus',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                })
            </script>");
    }

    // SETTINGS
    public function settings()
    {
        $id = $this->user_session['id'];
        $data['data'] = $this->model->find($id);
        $data['name'] = $this->name;
        $data['route'] = $this->route;
        $data['title'] = 'Settings';

        $data['content']   = view($this->name.'/settings',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    public function updatePassword($id = null)
    {
        $id = $this->user_session['id'];
        $data = $this->model->find($id);

        $oldpass = $this->request->getVar('oldpass');
        $password = $this->request->getVar('password');
        $passconf = $this->request->getVar('passconf');
        if (!empty($oldpass && $password && $passconf) 
            && strlen($password) >= 8
            && strlen($passconf) >= 8 ) {
            // Tidak ada yang kosong dan >= 8
            if (($data['password'] == $this->model->password_hash($oldpass)) && ($password == $passconf)) {
                // True
                $field = [
                    'password'   => $this->model->password_hash($password),
                ];
                $this->model->update($id, $field);
                session()->remove(['isLogin', 'user']);
                return redirect()->to(base_url('login'))
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Ubah password berhasil, silahkan login kembali',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    })
                </script>");
            } else {
                // False
                return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Password saat ini salah!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    })
                </script>");
            }
        } else {
            // Tidak memenuhi ketentuan
            return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Password setidaknya harus berisi 8 karakter!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    })
                </script>");
        }
    }
}
