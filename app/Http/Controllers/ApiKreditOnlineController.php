<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permohonan;
use App\Models\PermohonanFile;

class ApiKreditOnlineController extends Controller
{

    public function getPermohonanWhereCabang($kode_cabang)
    {

        $permohonan = Permohonan::where('kode_cabang', $kode_cabang)->get();

        if ($permohonan->isEmpty()) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($permohonan);
    }

    public function getPermohonanWhereId($id)
    {
        $permohonan = Permohonan::find($id);

        if (!$permohonan) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($permohonan);
    }

    public function getFile($id)
    {

        $images = PermohonanFile::where('no_ktp_pemohon', $id)->get();

        // $namaFiles = $images->pluck('nama_file');


        if ($images->isEmpty()) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $imagePaths = $images->pluck('nama_file')->toArray();
        $publicImagePaths = array_map(function ($path) {
            return asset('uploads/' . $path);
        }, $imagePaths);

        return response()->json(['image_paths' => $publicImagePaths]);
        // return response()->json($namaFiles);
    }

    public function fileBerkas($id)
    {
        $data = PermohonanFile::where('no_ktp_pemohon', $id)->get();

        return response()->json(['data' => $data, 'message' => 'success']);
    }


    public function destroydata($id)
    {

        $data = Permohonan::where('no_ktp_pemohon', $id)->first();


        if ($data) {
            $data->delete();
            return response()->json(['message' => 'success', 'data' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['message' => 'success', 'data' => 'Data tidak ditemukan'], 404);
        }
    }


    public function destroydatafile($id)
    {

        $data = Permohonan::where('no_ktp_pemohon', $id)->first();

        if ($data) {
            // Hapus data dari tabel Permohonan
            $data->delete();

            // Ambil semua file dari tabel Permohonanfile berdasarkan no_ktp_pemohon
            $files = Permohonanfile::where('no_ktp_pemohon', $data->no_ktp_pemohon)->get();

            // Hapus setiap file dari folder uploads
            foreach ($files as $file) {
                $filePath = public_path("uploads/{$file->nama_file}");

                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            // Hapus record dari tabel Permohonanfile
            Permohonanfile::where('no_ktp_pemohon', $data->no_ktp_pemohon)->delete();

            return response()->json(['message' => 'success', 'data' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['message' => 'success', 'data' => 'Data tidak ditemukan'], 404);
        }
    }



    public function getCsrfToken()
    {
        $csrfToken = csrf_token();

        return response()->json(['csrf_token' => $csrfToken]);
    }
}
