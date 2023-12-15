@extends('layouts.admin')

@section('content')
    <div class="col-6">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 d-flex align-items-center">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="link"><i
                            class="mdi mdi-home-outline fs-4"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Absen</li>
            </ol>
        </nav>
        <h1 class="mb-0 fw-bold mb-3">Data Absen</h1>
    </div>
    <div>
        <form method="POST" action="{{ url('/absensi/filter') }}">
            @csrf
            <label for="nama">Pilih Nama:</label>
            <select class="form-control mb-2" name="nama" id="nama">
                <option value="">--PILIH--</option>
                @foreach ($data as $dataNama)
                    <option value="{{ $dataNama->siswa_id }}">{{ $dataNama->siswa->nama }}</option>
                @endforeach
            </select>

            <button class="btn btn-warning mb-3" type="submit">Filter</button>
        </form>
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
                        <a href="inpudataabsen.html" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#inputModal">
                            Input Data
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true" style="color: black;">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: rgb(124, 206, 142); ">
                                        <h5 class="modal-title" id="staticBackdropLabel">Isi Absen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body " style="border-radius: 10px;">
                                        <label for="selectBarang" class="form-label">Status</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Pilih</option>
                                            <option value="hadir">Hadir</option>
                                            <option value="izin">Izin</option>
                                        </select>

                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                                            placeholder="Keterangan">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="button" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Siswa</th>
                                        <th scope="col">Tanggal absen</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Jam Pulang</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($filteredData as $tableData)
                                        <tr>
                                            <th scope="row">{{ $tableData->id }}</th>
                                            <td>{{ $tableData->siswa->nama }}</td>
                                            <td>{{ $tableData->tanggal }}</td>
                                            <td>{{ $tableData->jam_masuk }}</td>
                                            <td>{{ $tableData->jam_pulang }}</td>
                                            <td>{{ $tableData->status }}</td>
                                            <td>{{ $tableData->keterangan }}</td>
                                            <td>
                                                <button type="button" class="btn btn-danger">Hapus</button>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $tableData->id }}">Edit</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal{{ $tableData->id }}" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true"
                                                    style="color: black;">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header"
                                                                style="background-color: rgb(124, 206, 142); ">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Absen
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ url('absen/upate/' . $tableData->id) }}">
                                                                <div class="modal-body " style="border-radius: 10px;">
                                                                    <label for="selectBarang"
                                                                        class="form-label">Status</label>
                                                                    <select class="form-select"
                                                                        aria-label="Default select example">
                                                                        @if ('hadir' === $tableData->status)
                                                                            <option value="hadir" selected>Hadir</option>
                                                                            <option value="izin">Izin</option>
                                                                        @elseif ('izin' === $tableData->status)
                                                                            <option value="hadir">Hadir</option>
                                                                            <option value="izin" selected>Izin</option>
                                                                        @endif
                                                                    </select>

                                                                    <label for="keterangan"
                                                                        class="form-label">Keterangan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="keterangan" name="keterangan"
                                                                        placeholder="Keterangan"
                                                                        value="{{ $tableData->keterangan }}" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="button"
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
@endsection
