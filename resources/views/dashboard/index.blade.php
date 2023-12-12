@extends('layouts.admin')

@section('content')
    <div class="col-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 d-flex align-items-center">
                <li class="breadcrumb-item"><a href="{{url('/')}}" class="link"><i
                            class="mdi mdi-home-outline fs-4"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </nav>
        <h1 class="mb-0 fw-bold">Dashboard</h1>
    </div>
    <div class="card text-white mb-4 stretch-card" style="width: 100%; background-color: #4cb162;">
        <div class="card-body" style="text-align: center; font-size: 25px;">Selamat Datang Di Absensi</div>
    </div>
@endsection