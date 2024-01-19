<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Home;


class ApilosController extends Controller
{

    public function kantor_cabang()
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


    public function jenis_pekerjaan()
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


    // public function jenis_jaminan()
    // {
    //     // URL API yang ingin diakses
    //     $apiUrl = config('api.url') . '/restapi_credit_online/jenis_jaminan';

    //     // Inisialisasi Guzzle Client
    //     $client = new Client();

    //     try {
    //         // Mengirim request GET ke API
    //         $response = $client->get($apiUrl);

    //         // Mengambil body response dalam bentuk string
    //         $data = $response->getBody()->getContents();

    //         // Mengubah string JSON menjadi array
    //         $result = json_decode($data, true);

    //         // Sekarang, $result berisi data dari API yang dapat Anda olah sesuai kebutuhan Anda

    //         // Contoh: Menampilkan data
    //         dd($result);
    //     } catch (\Exception $e) {
    //         // Jika terjadi kesalahan, tangani sesuai kebutuhan Anda
    //         dd($e->getMessage());
    //     }
    // }
}
