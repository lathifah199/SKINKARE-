@extends('layouts.app')

@section('content')
  @include('pages.sections.hero')
  @include('pages.sections.tambah_anak', compact('anak'))
  @include('pages.sections.tombol_menu')
  @include('pages.sections.cek_stunting')
  @include('pages.sections.informasi')
@endsection
