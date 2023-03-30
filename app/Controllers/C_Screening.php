<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class C_Screening extends BaseController
{
    public function __construct()
    {
        $this->model = model('App\Models\M_Screening');
        $this->name = 'screening'; // title, nama folder view. | spasi menggunakan garis bawah(_)
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

    public function screening() 
    {
        $id = $this->user_session['id'];
        $data['route'] = $this->route;
        $data['title'] = 'Real Time ' . ucwords(str_replace('_', ' ', $this->name));
        
        $data['content']   = view($this->name.'/screening',$data);
        $data['sidebar'] = view('dashboard/sidebar',$data);
        return view('dashboard/header',$data);
    }

    public function create()
    {
        $rules = [
            'tinggi_badan'          => 'required',
            'berat_badan'           => 'required',
            'tekanan_darah_mm'      => 'required',
            'tekanan_darah_hg'      => 'required',
            'denyut_jantung'        => 'required',
            'aktivitas_fisik'       => 'required',
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput();
        }else {
            $tinggi_badan       = $this->request->getVar('tinggi_badan', $this->filter);
            $berat_badan        = $this->request->getVar('berat_badan', $this->filter);
            $tekanan_darah_mm   = $this->request->getVar('tekanan_darah_mm', $this->filter);
            $tekanan_darah_hg   = $this->request->getVar('tekanan_darah_hg', $this->filter);
            $denyut_jantung     = $this->request->getVar('denyut_jantung', $this->filter);
            $aktivitas_fisik    = $this->request->getVar('aktivitas_fisik', $this->filter);

            // Jenis kelamin
            $jenis_kelamin = $this->user_session['jenis_kelamin'];
            if ($jenis_kelamin == 'Perempuan') {
                $skor_jenis_kelamin = 0;
            } elseif ($jenis_kelamin == 'Laki-laki') {
                $skor_jenis_kelamin = 1;
            } else {
                $skor_jenis_kelamin = null;
            }

            // Usia
            $usia = $this->user_session['usia'];
            if (in_array($usia, range(25, 34))) {
                $skor_usia = 4;
            } elseif (in_array($usia, range(35, 39))) {
                $skor_usia = -3;
            } elseif (in_array($usia, range(40, 44))) {
                $skor_usia = -2;
            } elseif (in_array($usia, range(45, 49))) {
                $skor_usia = 0;
            } elseif (in_array($usia, range(50, 54))) {
                $skor_usia = 1;
            } elseif (in_array($usia, range(55, 59))) {
                $skor_usia = 2;
            } elseif (in_array($usia, range(60, 64))) {
                $skor_usia = 3;
            } else {
                $skor_usia = null;
            }

            //Tekanan darah
            if ($tekanan_darah_mm < 130 && $tekanan_darah_hg < 84) {
                $skor_tekanan_darah = 0;
            } elseif (in_array($tekanan_darah_mm, range(130, 139)) &&
                        in_array($tekanan_darah_hg, range(85, 89))) {
                $skor_tekanan_darah = 1;
            } elseif (in_array($tekanan_darah_mm, range(140, 159)) &&
                        in_array($tekanan_darah_hg, range(90, 99))) {
                $skor_tekanan_darah = 2;
            } elseif (in_array($tekanan_darah_mm, range(160, 179)) &&
                        in_array($tekanan_darah_hg, range(100, 109))) {
                $skor_tekanan_darah = 3;
            } elseif ($tekanan_darah_mm > 180 && $tekanan_darah_hg < 110) {
                $skor_tekanan_darah = 3;
            } else {
                $skor_tekanan_darah = null;
            }

            // BMI
            $tinggi_badan_m2 = round(($tinggi_badan*0.01) * ($tinggi_badan*0.01), 2);
            $bmi = round($berat_badan / $tinggi_badan_m2, 2);
            if (in_array($bmi, range(13.79, 25.99))) {
                $skor_bmi = 0;
            } elseif (in_array($bmi, range(26, 29.99))) {
                $skor_bmi = 1;
            } elseif (in_array($bmi, range(30, 35.589))) {
                $skor_bmi = 2;
            } else {
                $skor_bmi = null;
            }

            // Riwayat merokok
            $riwayat_merokok = $this->user_session['riwayat_merokok'];
            if ($riwayat_merokok == 'Tidak pernah') {
                $skor_riwayat_merokok = 0;
            } elseif ($riwayat_merokok == 'Mantan perokok') {
                $skor_riwayat_merokok = 3;
            } elseif ($riwayat_merokok == 'Perokok') {
                $skor_riwayat_merokok = 4;
            } else {
                $skor_riwayat_merokok = null;
            }

            // Riwayat diabetes
            $riwayat_diabetes = $this->user_session['riwayat_diabetes'];
            if ($riwayat_diabetes == 'Tidak') {
                $skor_riwayat_diabetes = 0;
            } elseif ($riwayat_diabetes == 'Ya') {
                $skor_riwayat_diabetes = 2;
            } else {
                $skor_riwayat_diabetes = null;
            }

            // Aktivitas fisik
            if ($aktivitas_fisik == 'Tidak ada') {
                $skor_aktivitas_fisik = 2;
            } elseif ($aktivitas_fisik == 'Ringan') {
                $skor_aktivitas_fisik = 1;
            } elseif ($aktivitas_fisik == 'Sedang') {
                $skor_aktivitas_fisik = 0;
            } elseif ($aktivitas_fisik == 'Berat') {
                $skor_aktivitas_fisik = -3;
            } else {
                $skor_aktivitas_fisik = null;
            }

            // Total skor
            $total_skor = $skor_jenis_kelamin
                        + $skor_usia
                        + $skor_tekanan_darah
                        + $skor_bmi
                        + $skor_riwayat_merokok
                        + $skor_riwayat_diabetes
                        + $skor_aktivitas_fisik;

            // Risiko
            if (in_array($total_skor, range(-7, 1))) {
                $risiko = 'Risiko rendah';
            } elseif (in_array($total_skor, range(2, 4))) {
                $risiko = 'Risiko sedang';
            } elseif ($total_skor > 5) {
                $risiko = 'Risiko tinggi';
            }

            $field = [
                'id_user'                => $this->user_session['id'],
                'jenis_kelamin'          => $jenis_kelamin,
                'skor_jenis_kelamin'     => $skor_jenis_kelamin,
                'usia'                   => $usia,
                'skor_usia'              => $skor_usia,
                'tinggi_badan'           => $tinggi_badan,
                'berat_badan'            => $berat_badan,
                'bmi'                    => $bmi,
                'skor_bmi'               => $skor_bmi,
                'tekanan_darah'          => $tekanan_darah_mm . '/' . $tekanan_darah_hg,
                'skor_tekanan_darah'     => $skor_tekanan_darah,
                'denyut_jantung'         => $denyut_jantung,
                'riwayat_merokok'        => $riwayat_merokok,
                'skor_riwayat_merokok'   => $skor_riwayat_merokok,
                'riwayat_alkohol'        => $this->user_session['riwayat_alkohol'],
                'riwayat_diabetes'       => $riwayat_diabetes,
                'skor_riwayat_diabetes'  => $skor_riwayat_diabetes,
                'aktivitas_fisik'        => $aktivitas_fisik,
                'skor_aktivitas_fisik'   => $skor_aktivitas_fisik,
                'total_skor'             => $total_skor,
                'risiko'                 => $risiko,
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
