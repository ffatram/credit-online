@extends('layouts/main')

@section('container')
    <form class="form needs-validation" id="form-wrapper" method="" name="form-wrapper" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file_no_ktp_pemohon" id="no_ktp_pemohon">
        <input type="file" name="file_no_ktp_pasangan" id="no_ktp_pasangan">
        <input type="file" name="file_no_kk" id="no_kk">
        <input type="submit">

    </form>
@endsection
