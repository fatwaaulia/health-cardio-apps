<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Pasien implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->isLogin) { // Belum login
            return redirect()->to(base_url('login'))
            ->with('message',
                "<script>
                    Swal.fire({
                    position: 'top-end',
                    icon: 'warning',
                    title: 'Silahkan login!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    })
                </script>");
        } else {
            $user_session = session()->get('user');
            $user = model('M_Users')->where('id', $user_session['id'])->first();
            if ($user['id_role'] != '3') { // Tidak sesuai role yang diizinkan
                return redirect()->to(base_url('dashboard'))
                ->with('message',
                    "<script>
                        Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        title: 'Anda tidak memiliki akses!',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        })
                    </script>");
            } else {
                $data_kosong = [
                    $user['usia'],
                    $user['riwayat_diabetes'],
                    $user['riwayat_alkohol'],
                    $user['riwayat_merokok']
                ];
                if (in_array('', $data_kosong)) {
                    return redirect()->to(base_url('profile'))
                    ->with('message',
                        "<script>
                            Swal.fire({
                            position: 'top-end',
                            icon: 'warning',
                            title: 'Lengkapi riwayat kesehatan!',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            })
                        </script>");
                }
            }
        }
    
    }

    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
