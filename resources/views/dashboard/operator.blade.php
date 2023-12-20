@extends('layouts.admin')

@section('content')
    <div class="col-6 ms-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 d-flex align-items-center">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="link"><i
                            class="mdi mdi-home-outline fs-4"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Input Operator</li>
            </ol>
        </nav>
        <h1 class="mb-0 fw-bold">Input Operator</h1>
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
                                        <h5 class="modal-title" id="staticBackdropLabel">Isi Operator</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ url('operator/store') }}" method="post">
                                        @csrf
                                        <div class="modal-body " style="border-radius: 10px;">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                placeholder="Nama" required>
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat"
                                                placeholder="Alamat" required>
                                            <label for="no_hp" class="form-label">Nomor HP</label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                placeholder="Nomor HP" required>
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Username" required>
                                            <label for="password" class="form-label">Password</label>
                                            <input type="text" class="form-control" id="password" name="password"
                                                placeholder="Password" readonly>
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
                                        <th scope="col">Alamat</th>
                                        <th scope="col">No HP</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dataOperator)
                                        <tr>
                                            <th scope="row">{{ $dataOperator->id }}</th>
                                            <td>{{ $dataOperator->nama }}</td>
                                            <td>{{ $dataOperator->alamat }}</td>
                                            <td>{{ $dataOperator->no_hp }}</td>
                                            <td>{{ $dataOperator->username }}</td>
                                            <td>{{ $dataOperator->password }}</td>
                                            <td>
                                                <a class="btn btn-danger"
                                                    href="{{ url('operator/destroy/' . $dataOperator->id) }}">Hapus</a>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $dataOperator->id }}">Edit</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal{{ $dataOperator->id }}"
                                                    tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                    aria-hidden="true" style="color: black;">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header"
                                                                style="background-color: rgb(124, 206, 142); ">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit
                                                                    Operator
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ url('operator/update/' . $dataOperator->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-body " style="border-radius: 10px;">
                                                                    <label for="nama" class="form-label">Nama</label>
                                                                    <input type="text" class="form-control"
                                                                        id="nama" name="nama" placeholder="Nama"
                                                                        value="{{ $dataOperator->nama }}" required>
                                                                    <label for="alamat"
                                                                        class="form-label">Alamat</label>
                                                                    <input type="text" class="form-control"
                                                                        id="alamat" name="alamat"
                                                                        placeholder="Alamat"
                                                                        value="{{ $dataOperator->alamat }}" required>
                                                                    <label for="no_hp" class="form-label">Nomor
                                                                        HP</label>
                                                                    <input type="text" class="form-control"
                                                                        id="no_hp" name="no_hp"
                                                                        placeholder="Nomor HP"
                                                                        value="{{ $dataOperator->no_hp }}" required>
                                                                    <label for="username"
                                                                        class="form-label">Username</label>
                                                                    <input type="text" class="form-control"
                                                                        id="usernamee" name="username"
                                                                        placeholder="Username"
                                                                        value="{{ $dataOperator->username }}" required>
                                                                    <label for="password"
                                                                        class="form-label">Password</label>
                                                                    <input type="text" class="form-control"
                                                                        id="passwordd" name="password"
                                                                        placeholder="{{ $dataOperator->password }}"
                                                                        readonly>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input1 = document.getElementById('username');
            const input2 = document.getElementById('password');

            input1.addEventListener('input', function() {
                input2.value = input1.value;
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input3 = document.getElementById('usernamee');
            const input4 = document.getElementById('passwordd');

            input3.addEventListener('input', function() {
                input4.value = input3.value;
            });
        });
    </script>
@endsection
