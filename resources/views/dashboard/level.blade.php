@extends('layouts.admin')

@section('content')
    <div class="col-6 ms-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 d-flex align-items-center">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="link"><i
                            class="mdi mdi-home-outline fs-4"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Level</li>
            </ol>
        </nav>
        <h1 class="mb-0 fw-bold">Input Level</h1>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgb(238, 234, 234);">
                        <button type="button" class="btn btn-success">Rekap Data</button>
                        <!-- rekapnya ke excel -->

                        <!-- Button trigger modal -->
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#inputModal">
                            Input Data
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true" style="color: black;">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: rgb(124, 206, 142); ">
                                        <h5 class="modal-title" id="staticBackdropLabel">Isi Level</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('level/store') }}" method="post">
                                        @csrf
                                        <div class="modal-body " style="border-radius: 10px;">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                placeholder="Nama" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>





                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dataLevel)
                                        <tr>
                                            <th scope="row">{{ $dataLevel->id }}</th>
                                            <td>{{ $dataLevel->nama }}</td>
                                            <td>{{ $dataLevel->alamat }}</td>
                                            <td>{{ $dataLevel->no_hp }}</td>
                                            <td>{{ $dataLevel->username }}</td>
                                            <td>{{ $dataLevel->password }}</td>
                                            <td>
                                                <a class="btn btn-danger"
                                                    href="{{ url('level/destroy/' . $dataLevel->id) }}">Hapus</a>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $dataLevel->id }}">Edit</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal{{ $dataLevel->id }}" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                                    style="color: black;">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header"
                                                                style="background-color: rgb(124, 206, 142); ">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit
                                                                    Level
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ url('level/update/' . $dataLevel->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-body " style="border-radius: 10px;">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama" name="nama" placeholder="Nama"
                                                                        value="{{ $dataLevel->nama }}" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
