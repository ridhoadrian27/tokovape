@extends('layouts.admin.layout')
@section('header', 'Dashboard')

@section('content')
Selamat datang kembali {{ Auth::guard('user')->user()->name }} di halaman Dashboard.
@endsection
