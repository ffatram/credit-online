@extends('layouts/main')



@section('container')
    <!-- CONTAINER -->



    <div class="container d-flex align-items-center min-vh-100">
        <div class="row g-0 justify-content-center">
            <!-- TITLE -->
            <div class="col-lg-4 offset-lg-1 mx-0 px-0">

                <div id="title-container">
                    <img class="covid-image" src="{{ asset('images/img.png') }} " alt="img">
                    {{-- <h2>KREDIT ONLINE</h2>
                    <h3>BPR HASAMITRA</h3> --}}
                    <p>Dana tambahan selalu berguna. Ajukan kredit online hari ini dan nikmati kemudahan tanpa harus datang
                        ke bank.
                    </p>
                </div>

            </div>
            <!-- FORMS -->
            <div class="col-lg-7 mx-0 px-0">

                <div class="progress">
                    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50"
                        class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                        style="width: 0%"></div>
                </div>
                <div id="qbox-container">
                    <form class="form needs-validation" id="form-wrapper" method="" name="form-wrapper"
                        enctype="multipart/form-data">
                        @csrf
                        <div id="steps-container">

                            <div class="step">

                                <div class="row">

                                    <div class="mt-1">
                                        <label class="form-label">No. KTP</label><span class="required">*</span>
                                        <input class="form-control input-number ktp nik_ktp" type="text" required>
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-1">
                                        <label class="form-label">Kantor Cabang Terdekat</label><span
                                            class="required">*</span>
                                        <select class="form-select kantor_cabang" name="kode_cabang" aria-label=""
                                            required>
                                            <option selected disabled>- Silahkan Pilih -</option>
                                            @foreach ($kantorcabang['kantor_cabang'] as $row)
                                                @if ($row['nama_cabang'] !== 'ALL CABANG')
                                                    <option value="{{ $row['kode_cabang'] }}">{{ $row['nama_cabang'] }}
                                                    </option>
                                                @endif
                                            @endforeach


                                        </select>
                                        <div class="error-message"></div>
                                    </div>





                                </div>
                            </div>

                            <div class="step">

                                <div class="p-3 mb-2 bg-success text-white">Data Pribadi</div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Nama Pemohon</label><span
                                            class="required">*</span></label>
                                        <input class="form-control" id="nama_pemohon" name="nama_pemohon" type="text"
                                            required>
                                        <div class="error-message"></div>
                                    </div>


                                    <div class="col-lg-7">
                                        <div class="mt-2">
                                            <label class="form-label">Tempat Lahir</label><span class="required">*</span>
                                            <input class="form-control" id="tempat_lahir_pemohon"
                                                name="tempat_lahir_pemohon" type="text" required>
                                            <div class="error-message"></div>
                                        </div>

                                    </div>

                                    <div class="col-lg-5">
                                        <div class="mt-2">
                                            <label class="form-label">Tanggal Lahir</label><span class="required">*</span>
                                            <input class="form-control" id="tgl_lahir_pemohon" name="tgl_lahir_pemohon"
                                                type="date" required>
                                            <div class="error-message"></div>
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Jenis Kelamin</label><span class="required">*</span>
                                        <div class="col-lg-8">
                                            <div id="input-container">
                                                <input class="form-check-input" id="jenis_kelamin_pria"
                                                    name="jenis_kelamin_pemohon" type="radio" value="PRIA" required>
                                                <label class="form-check-label radio-lb">PRIA</label>

                                                <input class="form-check-input" id="jenis_kelamin_wanita"
                                                    name="jenis_kelamin_pemohon" type="radio" value="WANITA" required>
                                                <label class="form-check-label radio-lb">WANITA</label>
                                                <div class="error-message"></div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="mt-2"><span class="required">*</span>
                                        <label class="form-label">Nama Ibu Kandung</label>
                                        <input class="form-control" id="nama_ibu_kandung_pemohon"
                                            name="nama_ibu_kandung_pemohon" type="text" required>
                                        <div class="error-message"></div>
                                    </div>



                                    <div class="mt-2">
                                        <label class="form-label">No. KTP</label><span class="required">*</span>
                                        <input class="form-control input-number ktp" id="no_ktp_pemohon"
                                            name="no_ktp_pemohon" type="text" required>
                                        <div class="error-message"></div>

                                    </div>


                                </div>
                            </div>



                            <div class="step">
                                <div class="p-3 mb-2 bg-success text-white">Data Pribadi</div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">NPWP</label>
                                        <input class="form-control" @error('npwp_pemohon') is_invalid @enderror
                                            id="npwp_pemohon" name="npwp_pemohon" type="text">

                                        @error('npwp_pemohon')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror

                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Alamat Sesuai KTP</label><span class="required">*</span>
                                        <input class="form-control" id="alamat_ktp_pemohon" name="alamat_ktp_pemohon"
                                            type="text" required>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Alamat Sekarang</label><span class="required">*</span>
                                        <input class="form-control" id="alamat_sekarang_pemohon"
                                            name="alamat_sekarang_pemohon" type="text" required>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Telepon/Hp</label><span class="required">*</span>
                                        <input class="form-control" id="telepon_pemohon" name="telepon_pemohon"
                                            type="text" required>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" id="media_sosial" name="media_sosial"
                                            type="text">
                                    </div>
                                </div>
                            </div>


                            <div class="step">
                                <div class="p-3 mb-2 bg-success text-white">Data Pribadi</div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Status Kepemilikan Rumah</label><span
                                            class="required">*</span>
                                        <select class="form-select" aria-label="" id="status_kepemilikan_rumah_pemohon"
                                            name="status_kepemilikan_rumah_pemohon" required>
                                            <option selected disabled>- Silahkan Pilih -</option>
                                            <option value="PRIBADI">PRIBADI</option>
                                            <option value="KELUARGA">KELUARGA</option>
                                            <option value="DINAS">DINAS</option>
                                            <option value="SEWA">SEWA</option>
                                            <option value="KOST">KOST</option>
                                            <option value="LAINNYA">LAINNYA</option>
                                        </select>

                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Pendidikan Terakhir</label><span
                                            class="required">*</span>
                                        <select class="form-select" aria-label="" id="pendidikan_terakhir_pemohon"
                                            name="pendidikan_terakhir_pemohon" required>
                                            <option selected disabled>- Silahkan Pilih -</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA">SMA</option>
                                            <option value="D3">D3</option>
                                            <option value="S1">S1</option>
                                            <option value="S2">S2</option>
                                            <option value="S3">S3</option>
                                            <option value="LAINNYA">LAINNYA</option>
                                        </select>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Gelar Pendidikan</label>
                                        <input class="form-control" id="gelar_pemohon" name="gelar_pemohon"
                                            type="text">
                                    </div>
                                    <div class="mt-2">

                                        <label class="form-label">Status Perkawinan</label><span class="required">*</span>
                                        <select class="form-select" aria-label="" id="status_perkawinan"
                                            name="status_perkawinan" required>
                                            <option selected disabled>- Silahkan Pilih -</option>
                                            <option value="BELUM MENIKAH">BELUM MENIKAH</option>
                                            <option value="MENIKAH">MENIKAH</option>
                                            <option value="DUDA">DUDA</option>
                                            <option value="JANDA">JANDA</option>
                                        </select>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Jumlah Tanggungan (Orang)</label>
                                        <input class="form-control input-number" id="jumlah_tanggungan"
                                            name="jumlah_tanggungan" type="text">
                                    </div>
                                </div>
                            </div>




                            <div class="step">
                                <div class="p-3 mb-2 bg-success text-white">Keluarga tidak serumah yang dapat dihubungi
                                    atau teman </div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Nama</label><span class="required">*</span>
                                        <input class="form-control" id="nama_keluarga_dapat_dihubungi"
                                            name="nama_keluarga_dapat_dihubungi" type="text" required>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Alamat</label><span class="required">*</span>
                                        <input class="form-control" id="alamat_keluarga_dapat_dihubungi"
                                            name="alamat_keluarga_dapat_dihubungi" type="text" required>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Hubungan</label><span class="required">*</span>
                                        <input class="form-control" id="hubungan_keluarga_dapat_dihubungi"
                                            name="hubungan_keluarga_dapat_dihubungi" type="text" required>
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Telepon/Hp Yang Dapat Dihubungi</label><span
                                            class="required">*</span>
                                        <input class="form-control" id="telepon_keluarga_dapat_dihubungi"
                                            name="telepon_keluarga_dapat_dihubungi" type="text" required>
                                        <div class="error-message"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="step">
                                <!-- <div class="p-3 mb-2 bg-success text-white">Data Pekerjaan </div> -->
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Jenis Pekerjaan</label><span class="required">*</span>
                                        <select class="form-select" aria-label="" id="jenis_pekerjaan"
                                            name="jenis_pekerjaan" required>
                                            <option selected disabled>- Silahkan Pilih -</option>
                                            @foreach ($jenispekerjaan as $row)
                                                <option value="{{ $row['jenis_pekerjaan'] }}">{{ $row['jenis_pekerjaan'] }}
                                                </option>
                                            @endforeach

                                        </select>
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Nama Instansi</label><span class="required">*</span>
                                        <select class="instansi js-example-basic-single custom-select" id="nama_instansi"
                                            name="nama_instansi" required>
                                            <option value="" selected disabled>- Silahkan Pilih -</option>
                                        </select>
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-2">
                                        <input class="form-control" id="kode_instansi" name="kode_instansi"
                                            type="hidden">
                                    </div>


                                    <div class="mt-2">
                                        <label class="form-label">Alamat Instansi</label><span class="required">*</span>
                                        <input class="form-control" id="alamat_instansi" name="alamat_instansi"
                                            type="text" required>
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Telepon Kantor</label>
                                        <input class="form-control" id="telepon_instansi" name="telepon_instansi"
                                            type="text">
                                    </div>
                                </div>
                            </div>


                            <div class="step">
                                <div class="p-3 mb-2 bg-success text-white">Data Pekerjaan </div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Tahun Mulai Bekerja</label>
                                        <input class="form-control" id="tahun_mulai_bekerja" name="tahun_mulai_bekerja"
                                            type="text">
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Jabatan Saat Ini</label>
                                        <input class="form-control" id="jabatan_saat_ini" name="jabatan_saat_ini"
                                            type="text">
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Atasan Langsung</label>
                                        <input class="form-control" id="atasan_langsung" name="atasan_langsung"
                                            type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Telepon/Hp Bendahara</label>
                                        <input class="form-control" id="telepon_bendahara" name="telepon_bendahara"
                                            type="text">
                                    </div>
                                </div>
                            </div>


                            <div class="step">
                                <div class="p-3 mb-2 bg-success text-white">Data Pasangan</div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Nama Pasangan</label><span class="required">*</span>
                                        <input class="form-control required_pasangan" id="nama_pasangan"
                                            name="nama_pasangan" type="text">
                                        <div class="error-message"></div>
                                    </div>



                                    <div class="col-lg-7">
                                        <div class="mt-2">
                                            <label class="form-label">Tempat Lahir Pasangan</label><span
                                                class="required">*</span>
                                            <input class="form-control required_pasangan" id="tempat_lahir_pasangan"
                                                name="tempat_lahir_pasangan" type="text">
                                            <div class="error-message"></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="mt-2">
                                            <label class="form-label">Tanggal Lahir Pasangan</label><span
                                                class="required">*</span>
                                            <input class="form-control required_pasangan" id="tgl_lahir_pasangan"
                                                name="tgl_lahir_pasangan" type="date">
                                            <div class="error-message"></div>
                                        </div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">No. KTP Pasangan</label><span class="required">*</span>
                                        <input class="form-control input-number ktp required_pasangan"
                                            id="no_ktp_pasangan" name="no_ktp_pasangan" type="text">
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Alamat KTP Pasangan</label><span
                                            class="required">*</span>
                                        <input class="form-control required_pasangan" id="alamat_ktp_pasangan"
                                            name="alamat_ktp_pasangan" type="text">
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Alamat Sekarang Pasangan</label><span
                                            class="required">*</span>
                                        <input class="form-control required_pasangan" id="alamat_sekarang_pasangan"
                                            name="alamat_sekarang_pasangan" type="text">
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Telepon/Hp Pasangan</label>
                                        <input class="form-control" id="telepon_pasangan" name="telepon_pasangan"
                                            type="text">
                                    </div>
                                </div>


                                <div class="mt-3"></div>
                                <div class="p-3 mb-2 bg-success text-white">Data Pekerjaan Pasangan</div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Jenis Pekerjaan Pasangan</label><span
                                            class="required">*</span>
                                        <select class="form-select" aria-label="" id="jenis_pekerjaan_pasangan"
                                            name="jenis_pekerjaan_pasangan" required>
                                            <option selected disabled>- Silahkan Pilih -</option>
                                            @foreach ($jenispekerjaan as $row)
                                                <option value="{{ $row['jenis_pekerjaan'] }}">{{ $row['jenis_pekerjaan'] }}
                                                </option>
                                            @endforeach

                                        </select>
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Nama Instansi Pasangan</label>
                                        <input class="form-control" id="nama_instansi_pasangan"
                                            name="nama_instansi_pasangan" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Tahun Mulai Bekerja Pasangan</label>
                                        <input class="form-control" id="tahun_mulai_bekerja_pasangan"
                                            name="tahun_mulai_bekerja_pasangan" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Jabatan Saat Ini Pasangan</label>
                                        <input class="form-control" id="jabatan_saat_ini_pasangan"
                                            name="jabatan_saat_ini_pasangan" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Alamat Kantor Pasangan</label>
                                        <input class="form-control" id="alamat_kantor_pasangan"
                                            name="alamat_kantor_pasangan" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Telepon Kantor Pasangan</label>
                                        <input class="form-control" id="telepon_kantor_pasangan"
                                            name="telepon_kantor_pasangan" type="text">
                                    </div>
                                </div>
                            </div>



                            <div class="step">
                                <div class="p-3 mb-2 bg-success text-white">Data Kredit</div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Jumlah Kredit Yang Dimohon</label><span
                                            class="required">*</span>
                                        <input class="form-control input-number rupiah" id="plafond_dimohon"
                                            name="plafond_dimohon" type="text" required>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Jangka Waktu (Bulan)</label><span
                                            class="required">*</span>
                                        <input class="form-control input-number bulan" id="jangka_waktu"
                                            name="jangka_waktu" type="text" required>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Tujuan Penggunaan Kredit</label><span
                                            class="required">*</span>
                                        <input class="form-control" id="tujuan_penggunaan_kredit"
                                            name="tujuan_penggunaan_kredit" type="text" required>
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Jenis Jaminan</label>
                                        <!-- <input class="form-control" id="jenis_jaminan" name="jenis_jaminan" type="text"> -->
                                        <select class="form-select jenis_jaminan" aria-label="" id="jenis_jaminan"
                                            name="jenis_jaminan">
                                        </select>
                                    </div>


                                    <div class="mt-2">
                                        <label class="form-label">Nilai Perkiraaan Jaminan</label>
                                        <input class="form-control input-number rupiah" id="nilai_jaminan"
                                            name="nilai_jaminan" type="text">
                                    </div>

                                </div>
                            </div>



                            <div class="step">
                                <div class="p-3 mb-2 bg-success text-white">Penghasilan Perbulan</div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Penghasilan Pemohon (Rp)</label><span
                                            class="required">*</span>
                                        <input class="form-control input-number rupiah" id="penghasilan_pemohon"
                                            name="penghasilan_pemohon" type="text" required>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Penghasilan Pasangan (Rp)</label>
                                        <input class="form-control input-number rupiah" id="penghasilan_pasangan"
                                            name="penghasilan_pasangan" type="text">
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Penghasilan Tambahan (Rp)</label>
                                        <input class="form-control input-number rupiah" id="penghasilan_tambahan"
                                            name="penghasilan_tambahan" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Penghasilan Tambahan Lainnya (Rp)</label>
                                        <input class="form-control input-number rupiah" id="penghasilan_tambahan_lainnya"
                                            name="penghasilan_tambahan_lainnya" type="text">
                                    </div>
                                </div>

                                <div class="mt-3"></div>
                                <div class="p-3 mb-2 bg-success text-white">Pengeluaran Perbulan</div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Biaya Hidup Perbulan (Rp)</label><span
                                            class="required">*</span>
                                        <input class="form-control input-number rupiah" id="biaya_hidup_perbulan"
                                            name="biaya_hidup_perbulan" type="text" required>
                                        <div class="error-message"></div>
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Biaya Pendidikan (Rp)</label>
                                        <input class="form-control input-number rupiah" id="biaya_pendidikan"
                                            name="biaya_pendidikan" type="text">
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Biaya PAM/Listrik/Telp/Hp (Rp)</label>
                                        <input class="form-control input-number rupiah" id="biaya_pam_listrik_telepon"
                                            name="biaya_pam_listrik_telepon" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Biaya Transport (Rp)</label>
                                        <input class="form-control input-number rupiah" id="biaya_transport"
                                            name="biaya_transport" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Angsuran Bank Lain (Rp)</label>
                                        <input class="form-control input-number rupiah" id="angsuran_bank_lain"
                                            name="angsuran_bank_lain" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Angsuran Perumahan (Rp)</label>
                                        <input class="form-control input-number rupiah" id="angsuran_perumahan"
                                            name="angsuran_perumahan" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Angsuran Kendaraan (Rp)</label>
                                        <input class="form-control input-number rupiah" id="angsuran_kendaraan"
                                            name="angsuran_kendaraan" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Angsuran Barang Elektronik (Rp)</label>
                                        <input class="form-control input-number rupiah" id="angsuran_barang_elektronik"
                                            name="angsuran_barang_elektronik" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Angsuran Koperasi (Rp)</label>
                                        <input class="form-control input-number rupiah" id="angsuran_koperasi"
                                            name="angsuran_koperasi" type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Biaya Lainnya (Rp)</label>
                                        <input class="form-control input-number rupiah" id="biaya_lainnya"
                                            name="biaya_lainnya" type="text">
                                    </div>
                                </div>

                            </div>


                            <div class="step">
                                <div class="p-3 mb-2 bg-success text-white">Data Aset Yang Dimiliki</div>
                                <div class="row">
                                    <div class="mt-1">
                                        <label class="form-label">Aset Yang Dimiliki</label>
                                        <input class="form-control" id="aset_yang_dimiliki" name="aset_yang_dimiliki"
                                            type="text">
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Alamat Aset</label>
                                        <input class="form-control" id="alamat_aset" name="alamat_aset" type="text">
                                    </div>
                                    <div class="mt-2">
                                        <label class="form-label">Jenis Sertifikat</label>
                                        <input class="form-control" id="jenis_sertifikat" name="jenis_sertifikat"
                                            type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Jumlah Kendaraan</label>
                                        <input class="form-control" id="jumlah_kendaraan" name="jumlah_kendaraan"
                                            type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Merek Kendaran</label>
                                        <input class="form-control" id="merek_kendaraan" name="merek_kendaraan"
                                            type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Tahun Kendaran</label>
                                        <input class="form-control" id="tahun_kendaraan" name="tahun_kendaraan"
                                            type="text">
                                    </div>

                                    <div class="mt-2">
                                        <label class="form-label">Atas Nama Kendaraan</label>
                                        <input class="form-control" id="atas_nama_kendaraan" name="atas_nama_kendaraan"
                                            type="text">
                                    </div>

                                </div>
                            </div>



                            <div class="step">
                                <div class="p-3 mb-2 bg-success text-white">Upload File</div>
                                <div class="row">
                                    <div class="mt-1 file1">
                                        <label class="form-label">KTP Pemohon</label><span class="required">*</span>
                                        <small class="form-text text-muted">Ukuran file tidak boleh melebihi 5MB.</small>
                                        <input class="form-control" id="file_no_ktp_pemohon" name="file_no_ktp_pemohon"
                                            type="file" accept=".jpg, .jpeg, .png" required>

                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-1 file2">
                                        <label class="form-label">KTP Pasangan</label><span class="required">*</span>
                                        <small class="form-text text-muted">Ukuran file tidak boleh melebihi 5MB.</small>
                                        <input class="form-control" id="file_no_ktp_pasangan" name="file_no_ktp_pasangan"
                                            type="file" accept=".jpg, .jpeg, .png" required>
                                        <div class="error-message"></div>
                                    </div>

                                    <div class="mt-1 file3">
                                        <label class="form-label">File KK</label><span class="required">*</span>
                                        <small class="form-text text-muted">Ukuran file tidak boleh melebihi 5MB.</small>
                                        <input class="form-control" id="file_no_kk" name="file_no_kk" type="file"
                                            accept=".jpg, .jpeg, .png" required>
                                        <div class="error-message"></div>
                                    </div>
                                </div>
                            </div>



                            <div id="success">
                                <div class="mt-5">
                                    <h4>Selamat! Permohonan Anda telah dikirim!</h4>
                                    {{-- <p>Silahkan bla blaa ....</p> --}}
                                    <!-- <a class="back-link" href="/tes">Lanjutkan untuk upload Berkas ➜</a> -->
                                </div>
                            </div>
                        </div>


                        <div id="q-box__buttons">
                            <button id="prev-btn" type="button">Kembali</button>
                            <button id="next-btn" type="button">Lanjut</button>
                            <button type="submit" id="submit-btn" type="submit">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div id="preloader-wrapper">
        <div id="preloader"></div>
        <div class="preloader-section section-left"></div>
        <div class="preloader-section section-right"></div>
    </div>
@endsection
