<?php

namespace App\Http\Controllers;

use App\Models\PermohonanFile;
use App\Http\Requests\UpdatePermohonanFileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PermohonanFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function upload(Request $request)
    {


        try {
            if ($request->hasFile('file_no_ktp_pemohon')) {
                $file = $request->file('file_no_ktp_pemohon');

                $datareques = [
                    'file' => $file,
                    'no_ktp' => $request->no_ktp_pemohon,
                    'ketfile' => 'file_ktp'
                ];
                $filename = $this->newFileName($datareques);

                $file->move(public_path('uploads'), $filename);


                $file = new PermohonanFile([
                    'no_ktp_pemohon' => $request->no_ktp_pemohon,
                    'file_no_ktp_pemohon' => $filename,
                    'file_no_ktp_pasangan' => '-',
                    'file_no_kk' => '-',
                    'jenis_file' => "KTP"
                ]);

                $file->save();
            }

            if ($request->hasFile('file_no_ktp_pasangan')) {

                $file = $request->file('file_no_ktp_pasangan');


                $datareques = [
                    'file' => $file,
                    'no_ktp' => $request->no_ktp_pemohon,
                    'ketfile' => 'file_ktp'
                ];
                $filename = $this->newFileName($datareques);


                $file->move(public_path('uploads'), $filename);


                $file = new PermohonanFile([
                    'no_ktp_pemohon' => $request->no_ktp_pemohon,
                    'file_no_ktp_pemohon' => '-',
                    'file_no_ktp_pasangan' => $filename,
                    'file_no_kk' => '-',
                    'jenis_file' => "KTP"
                ]);
                $file->save();
            }

            if ($request->hasFile('file_no_kk')) {

                $file = $request->file('file_no_kk');
                $datareques = [
                    'file' => $file,
                    'no_ktp' => $request->no_ktp_pemohon,
                    'ketfile' => 'file_kk'
                ];
                $filename = $this->newFileName($datareques);
                $file->move(public_path('uploads'), $filename);


                $file = new PermohonanFile([
                    'no_ktp_pemohon' => $request->no_ktp_pemohon,
                    'file_no_ktp_pemohon' => '-',
                    'file_no_ktp_pasangan' => '-',
                    'file_no_kk' => $filename,
                    'jenis_file' => "KK"
                ]);
                $file->save();
            }

            return response()->json(['message' => 'berhasil']);
        } catch (\Exception $e) {

            // return response()->json(['message' => $e]);
            echo $e;
        }
    }



    public function newFileName($datareques)
    {

        $file = $datareques["file"];
        $ketfile = $datareques["ketfile"];
        $no_ktp = $datareques["no_ktp"];


        $now = Carbon::now();
        $formattedDate = $now->format('dmY_His');
        $extension = $file->getClientOriginalExtension();
        $newFileName = $ketfile . '_' . $no_ktp . $formattedDate . '.' . $extension;
        return $newFileName;
    }





    public function index()
    {
        //
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
    }

    /**
     * Display the specified resource.
     */
    public function show(PermohonanFile $permohonanFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PermohonanFile $permohonanFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermohonanFileRequest $request, PermohonanFile $permohonanFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PermohonanFile $permohonanFile)
    {
        //
    }
}
