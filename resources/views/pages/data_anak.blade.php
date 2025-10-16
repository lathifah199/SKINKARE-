@extends('layouts.app_nakes')

@section('title', 'Data Anak')

@section('content')

@include('pages.nakes.table_data_anak')
@include('pages.nakes.modal_data_anak')

<script>
    const modal = document.getElementById('modalTambah');
    const btnTambah = document.getElementById('btnTambah');
    const btnTutup = document.getElementById('btnTutup');

    btnTambah.addEventListener('click', () => modal.classList.remove('hidden'));
    btnTutup.addEventListener('click', () => modal.classList.add('hidden'));
</script>
@endsection
