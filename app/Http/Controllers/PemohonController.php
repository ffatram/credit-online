<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ApilosController;
use App\Http\Controllers\PermohonanFileController;



use App\Models\Permohonan;
use App\Models\PermohonanFile;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\ValidationException;

class PemohonController extends Controller
{

    protected $api;

    public function __construct(ApilosController $apilosController)
    {
        $this->api = $apilosController;
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->isMethod('post')) {
            // // Logika untuk metode POST di sini
            // // $data = $request->all();


            // $data =  $request->only(['nama_pemohon', 'tempat_lahir_pemohon']);


            try {


                // $validatedData = $request->validate(
                //     [
                //         'npwp_pemohon' => 'max:15',
                //         'file_no_ktp_pemohon' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                //         'file_no_ktp_pasangan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                //         'file_no_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                //     ],
                //     [
                //         'npwp_pemohon.max' => "NPWP : Max 15 karakter!"
                //     ]

                // );


                $validatedData = $request->validate([
                    'npwp_pemohon' => 'max:15',
                    'file_no_ktp_pemohon' => 'required|image|mimes:jpeg,png,jpg|max:5120',
                    'file_no_ktp_pasangan' => [
                        // 'sometimes',
                        'required_if:status_perkawinan,MENIKAH',
                        'image',
                        'mimes:jpeg,png,jpg',
                        'max:5120',
                    ],
                    'file_no_kk' => 'required|image|mimes:jpeg,png,jpg|max:5120',
                    'status_perkawinan' => 'required|in:MENIKAH,BELUM MENIKAH,DUDA,JANDA',
                ], [
                    'npwp_pemohon.max' => 'NPWP: Maksimal 15 karakter!',
                ]);





                $data =  $request->except(['_token', 'submit', 'file_no_ktp_pemohon', 'file_no_ktp_pasangan', 'file_no_kk']);

                // Periksa apakah tgl_create diisi atau tidak
                if (!isset($data['tgl_create']) || empty($data['tgl_create'])) {
                    // Jika tidak diisi, isi dengan tanggal saat ini
                    $data['tgl_create'] = now();
                }

                Permohonan::create($data);

                $PermohonanFileController = new PermohonanFileController();
                $data = $PermohonanFileController->upload($request);


                $data = $data->getData()->message;
                return response()->json(['message' => $data]);
            } catch (ValidationException $e) {
                // Tangkap kesalahan validasi
                $errors = $e->validator->errors()->toArray();
                return response()->json(['success' => false, 'errors' => $errors]);
            } catch (\Exception $e) {
                // Tangkap kesalahan umum lainnya
                return response()->json(['success' => false, 'error' => $e->getMessage()]);
            }
        }


        return view('home', [
            'title' => 'Home',
            'kantorcabang' => $this->api->kantor_cabang(),
            'jenispekerjaan' => $this->api->jenis_pekerjaan()
        ]);
    }








    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }



    public function alert()
    {
        Alert::success('Hore!', 'Post Created Successfully');
    }
}
