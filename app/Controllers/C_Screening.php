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

            // Indeks Massa Tubuh
            $tinggi_badan_m2 = round(($tinggi_badan*0.01) * ($tinggi_badan*0.01), 2);
            $indeks_massa_tubuh = round($berat_badan / $tinggi_badan_m2, 2);
            if (in_array($indeks_massa_tubuh, range(13.79, 25.99))) {
                $skor_indeks_massa_tubuh = 0;
            } elseif (in_array($indeks_massa_tubuh, range(26, 29.99))) {
                $skor_indeks_massa_tubuh = 1;
            } elseif (in_array($indeks_massa_tubuh, range(30, 35.589))) {
                $skor_indeks_massa_tubuh = 2;
            } else {
                $skor_indeks_massa_tubuh = null;
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
                        + $skor_indeks_massa_tubuh
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
                'indeks_massa_tubuh'                    => $indeks_massa_tubuh,
                'skor_indeks_massa_tubuh'               => $skor_indeks_massa_tubuh,
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
}
