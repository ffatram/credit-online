<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Home;


class HomeController extends Controller
{


    

    public function show($id)
    {
       return view('home',[
        'home'=> Home::find($id)
       ]);
    }





    public function index(Request $request)
    {

        if ($request->isMethod('post')) {
            // Logika untuk metode POST di sini
            $data = $request->all();
            // Simpan data ke database atau lakukan tindakan lainnya
            return response()->json(['data' => $data, 'message' => 'Data disimpan']);
        }

        return view('home', [
            'title' => 'Home',
            'kantorcabang' => $this->kantor_cabang_API(),
            'jenispekerjaan' => $this->jenis_pekerjaan_API()
        ]);
    }

    public function urllos()
    {
        return config('api.url');
    }

    public function kantor_cabang_API()
    {

        // URL API yang ingin diakses
        $apiUrl = config('api.url') . '/restapi_credit_online/kantor_cabang';

        // Inisialisasi Guzzle Client
        $client = new Client();

        try {
            // Mengirim request GET ke API
            $response = $client->get($apiUrl);

            // Mengambil body response dalam bentuk string
            $data = $response->getBody()->getContents();

            // Mengubah string JSON menjadi array
            $result = json_decode($data, true);

            // Sekarang, $result berisi data dari API yang dapat Anda olah sesuai kebutuhan Anda

            // Contoh: Menampilkan data
            // dd($result);
            return $result;
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tangani sesuai kebutuhan Anda
            dd($e->getMessage());
        }
    }

    // bagian ini tidak di pake di view bisa di hapus saja nanti 
    public function jenis_jaminan_API()
    {
        // URL API yang ingin diakses
        $apiUrl = config('api.url') . '/restapi_credit_online/jenis_jaminan';

        // Inisialisasi Guzzle Client
        $client = new Client();

        try {
            // Mengirim request GET ke API
            $response = $client->get($apiUrl);

            // Mengambil body response dalam bentuk string
            $data = $response->getBody()->getContents();

            // Mengubah string JSON menjadi array
            $result = json_decode($data, true);

            // Sekarang, $result berisi data dari API yang dapat Anda olah sesuai kebutuhan Anda

            // Contoh: Menampilkan data
            dd($result);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tangani sesuai kebutuhan Anda
            dd($e->getMessage());
        }
    }

    public function jenis_pekerjaan_API()
    {
        // URL API yang ingin diakses
        $apiUrl = config('api.url') . '/restapi_credit_online/pekerjaan';

        // Token yang ingin Anda kirim
        $token = 'faturungimuharram';

        // Inisialisasi Guzzle Client
        $client = new Client();

        try {
            // Mengirim request POST ke API dengan parameter 'token'
            $response = $client->post($apiUrl, [
                'form_params' => [
                    'token' => $token,
                    // Tambahkan parameter lain sesuai kebutuhan
                    // 'key2' => 'value2',
                    // 'key3' => 'value3',
                ],
            ]);

            // Mengambil body response dalam bentuk string
            $data = $response->getBody()->getContents();

            // Mengubah string JSON menjadi array
            $result = json_decode($data, true);

            // Sekarang, $result berisi data dari API yang dapat Anda olah sesuai kebutuhan Anda

            // Contoh: Menampilkan data
            // dd($result);
            return $result;
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, tangani sesuai kebutuhan Anda
            dd($e->getMessage());
        }
    }
}
