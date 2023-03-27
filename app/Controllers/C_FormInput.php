<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_FormInput extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\M_FormInput');
        $this->name = 'form_input'; // title, nama folder view. | spasi menggunakan garis bawah(_)
    }

    public function index()
    {
        $data['data'] = $this->model->findAll();
        $data['name'] = $this->name;
        $data['route'] = $this->route;
        $data['title'] = 'Data ' . ucwords(str_replace('_', ' ', $this->name));

        $data['content'] = view($this->name.'/index',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    public function new()
    {
        $data['route'] = $this->route;
        $data['title'] = 'Tambah ' . ucwords(str_replace('_', ' ', $this->name));

        $data['content']   = view($this->name.'/new',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    public function create()
    {
        $rules = [
            'nama'              => "required|is_unique[$this->name.nama]",
            'deskripsi'         => 'required',
            'konten'            => 'required',
            'img'               => 'uploaded[img]|max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
            'select'            => 'required',
            'select_search'     => 'required',
            'select_multiple'   => 'required',
            'checkbox'          => 'required',
            'radio'             => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $img = $this->request->getFile('img');
            if ($img != '') {
                $img_name = $img->getRandomName();
                $this->image->withFile($img)
                    ->save('assets/img/'.$this->name.'/'.$img_name, 60);
            } else {
                $img_name = '';
            }

            $field = [
                'nama'              => $this->request->getVar('nama', $this->filter),
                'deskripsi'         => $this->request->getVar('deskripsi', $this->filter),
                'konten'            => $this->request->getVar('konten'),
                'img'               => $img_name,
                'select'            => $this->request->getVar('select', $this->filter),
                'select_search'     => $this->request->getVar('select_search', $this->filter),
                'select_multiple'   => json_encode($this->request->getVar('select_multiple', $this->filter),true),
                'checkbox'          => json_encode($this->request->getVar('checkbox', $this->filter),true),
                'radio'             => $this->request->getVar('radio', $this->filter),
            ];
            
            // dd($field);
            $this->model->insert($field);
            return redirect()->to($this->route)
                ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tambah data berhasil',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    })
                </script>");
        }
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
        $data = $this->model->find($id);

        $rules = [
            'nama'              => "required|is_unique[$this->name.nama,id,$id]",
            'deskripsi'         => 'required',
            'konten'            => 'required',
            'img'               => 'max_size[img,1024]|ext_in[img,png,jpg,jpeg]',
            'select'            => 'required',
            'select_search'     => 'required',
            'select_multiple'   => 'required',
            'checkbox'          => 'required',
            'radio'             => 'required',
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
                'nama'              => $this->request->getVar('nama', $this->filter),
                'deskripsi'         => $this->request->getVar('deskripsi', $this->filter),
                'konten'            => $this->request->getVar('konten'),
                'img'               => $img_name,
                'select'            => $this->request->getVar('select', $this->filter),
                'select_search'     => $this->request->getVar('select_search', $this->filter),
                'select_multiple'   => json_encode($this->request->getVar('select_multiple', $this->filter),true),
                'checkbox'          => json_encode($this->request->getVar('checkbox', $this->filter),true),
                'radio'             => $this->request->getVar('radio', $this->filter),
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
                title: 'Gambar dihapus',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                })
            </script>");
    }
}
