<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_MyDiary extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\M_Screening');
        $this->name = 'my_diary'; // title, nama folder view. | spasi menggunakan garis bawah(_)
    }

    public function myDiary()
    {
        $data['data'] = $this->model->orderBy('id','DESC')->findAll();
        $data['name'] = $this->name;
        $data['route'] = $this->route;
        $data['title'] = 'My Diary';

        $data['content'] = view($this->name.'/my_diary',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    public function edit($id = null)
    {
        $id = model('M_Env')->decode($id);
        $data['data'] = $this->model->find($id);
        $data['name'] = $this->name;
        $data['route'] = $this->route;
        $data['title'] = 'Edit ' . ucwords(str_replace('_', ' ', $this->name));
        
        $data['content']   = view($this->name.'/edit',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);

    }

    public function update($id = null)
    {
        $id = model('M_Env')->decode($id);
        $field = [
            'deskripsi'     => $this->request->getVar('deskripsi', $this->filter),
        ];
        
        // dd($field);
        $this->model->update($id, $field);
        return redirect()->to($this->route.'/edit/'.model('M_Env')->encode($id))
            ->with('message',
            "<script>
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Catatan disimpan',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                })
            </script>");
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
                title: 'Gambar dihapus',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                })
            </script>");
    }
}
