@extends('layouts.admin')

@section('content')
    <div class="col-6 ms-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 d-flex align-items-center">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" class="link"><i
                            class="mdi mdi-home-outline fs-4"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Data Absen</li>
            </ol>
        </nav>
        <h1 class="mb-0 fw-bold mb-3">Data Absen</h1>
        <div>
            <div id="filterForm">
                @csrf
                <label for="nama">Pilih Nama:</label>
                <select id="selectButton" onchange="handleSelection()" class="form-control mb-2" name="nama"
                    {{-- id="nama" --}}>
                    <option value="">--PILIH--</option>
                    @foreach ($data as $dataNama)
                        @if ($dataNama->id == $nama)
                            {{-- @dd($dataNama) --}}
                            {{ $selected = 'selected' }}
                        @endif
                        <option value="{{ $dataNama->id }}" {{ $selected }}> {{ $dataNama->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" style="background-color: rgb(238, 234, 234);">
                        <button type="button" class="btn btn-success mb-3">Rekap Data</button>
                        <!-- rekapnya ke excel -->

                        <!-- Button trigger modal -->
                        <a class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#inputModal">
                            Input Data
                        </a>

                        <!-- Modal -->
                        <div class="modal fade" id="inputModal" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true" style="color: black;">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: rgb(59,113,202); ">
                                        <h5 class="modal-title" id="staticBackdropLabel">Isi Absen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="absenForm" action="{{ url('/absensi/store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input id="siswa_id" type="hidden" name="siswa_id" class="form-control"
                                                value="
                                                {{-- {{ auth()->user()->id }} --}}
                                                1">
                                        </div>
                                        <div class="form-group">
                                            <input id="tanggal" type="hidden" name="tanggal" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <input id="jam_masuk" type="hidden" name="jam_masuk" class="form-control">
                                        </div>
                                        <div class="modal-body " style="border-radius: 10px;">
                                            <label for="status" class="form-label">Status</label>
                                            <select id="status" name="status" class="form-select"
                                                aria-label="Default select example">
                                                <option>Pilih</option>
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
                                            <button type="sumbit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>





                        <div class="table-responsive">
                            <table class="table table-striped table-bordered mt-3 mb-5" id="table">
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
                                <tbody id="tableBody">
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
                                                <a href="{{ url('/absensi/destroy/' . $tableData->id) }}"
                                                    class="btn btn-danger">Delete</a>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $tableData->id }}">Edit</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal{{ $tableData->id }}"
                                                    tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                    aria-hidden="true" style="color: black;">
                                                    <div
                                                        class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                        <div class="modal-content">
                                                            <div class="modal-header"
                                                                style="background-color: rgb(124, 206, 142); ">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit
                                                                    Absen
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form id="formEdit"
                                                                action="{{ url('absensi/update/' . $tableData->id) }}"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-body " style="border-radius: 10px;">
                                                                    <input id="siswa_id" type="hidden" name="siswa_id"
                                                                        class="form-control"
                                                                        value="{{ $tableData->siswa_id }}">
                                                                    <input id="tanggal" type="hidden" name="tanggal"
                                                                        class="form-control"
                                                                        value="{{ $tableData->tanggal }}">
                                                                    <input id="jam_masuk" type="hidden" name="jam_masuk"
                                                                        class="form-control"
                                                                        value="{{ $tableData->jam_masuk }}">
                                                                    <input id="jam_pulang" type="hidden"
                                                                        name="jam_pulang" class="form-control"
                                                                        value="{{ $tableData->jam_pulang }}">
                                                                    <input id="nama" type="hidden" name="nama"
                                                                        class="form-control" value="{{ $nama }}">
                                                                    <label for="selectBarang"
                                                                        class="form-label">Status</label>
                                                                    <select id="status" name="status"
                                                                        class="form-select"
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
                                                                    <div class="btn btn-primary" onclick="submitForm()">
                                                                        Simpan</div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <script>
                                            function submitForm() {
                                                // Mengambil formulir menggunakan ID
                                                var form = document.getElementById('formEdit');
                                                console.log(form);
                                                // Membuat objek FormData untuk mengambil data formulir
                                                var formData = new FormData(form);

                                                // Mengirim data formulir menggunakan AJAX
                                                $.ajax({
                                                    type: form.method,
                                                    url: form.action,
                                                    data: formData,
                                                    processData: false,
                                                    contentType: false,
                                                    success: function(response) {
                                                        // Menutup modal setelah formulir terkirim
                                                        $('#editModal{{ $tableData->id }}').modal('hide');

                                                        // Mengganti konten tabel dengan yang baru (misalnya, setelah formulir terkirim)
                                                        // Gantilah baris ini dengan logika yang sesuai untuk me-reload tabel tanpa me-reload halaman

                                                        $('#table tbody').html(response);
                                                    },
                                                    error: function(error) {
                                                        console.error('Error:', error);
                                                    }
                                                });
                                            }
                                        </script>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('absenForm').addEventListener('submit', function() {
            // Mendapatkan tanggal dan jam saat ini
            var currentDateTime = new Date();

            // Format tanggal menjadi 'YYYY-MM-DD'
            var formattedDate = currentDateTime.toISOString().split('T')[0];

            // Format jam menjadi 'HH:mm:ss'
            var formattedTime = currentDateTime.toTimeString().split(' ')[0];

            // Set nilai input hidden
            document.getElementById('tanggal').value = formattedDate;
            document.getElementById('jam_masuk').value = formattedTime;
        });
    </script>
    <script>
        function handleSelection() {
            var selectElement = document.getElementById("selectButton");
            var selectedValue = selectElement.value;

            console.log("Selected Option:", selectedValue);

            // Mengirim formulir secara manual menggunakan JavaScript
            // var form = document.getElementById("filterForm");
            // form.submit();

            const selectButton = $('#selectButton')

            let updateUrl = `{{ url('absensi/update/' . `+ row.id +`) }}`
            $.ajax({
                type: 'POST',
                url: '/absensi/filter',
                data: {
                    _token: "{{ csrf_token() }}",
                    nama: selectButton.val()
                },
                success: function(response) {
                    console.log(response)

                    let parent = $('#tableBody')

                    parent.empty()
                    let html = ``
                    response.filteredData.forEach(row => {
                        html += `<tr>
                                            <th scope="row">` + row.id + `</th>
                                            <td>` + row.siswa.nama + `</td>
                                            <td>` + row.tanggal + `</td>
                                            <td>` + row.jam_masuk + `</td>
                                            <td>` + row.jam_pulang + `</td>
                                            <td>` + row.status + `</td>
                                            <td>` + row.keterangan + `</td>
                                            <td>
                                                <a href="{{ url('/absensi/destroy/' . `+ row.id +`) }}"
                                                    class="btn btn-danger">Delete</a>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal` + row.id + `">Edit</button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal` + row.id + `">
                                                        <div class="modal-content modal-dialog">
                                                            <div class="modal-header"
                                                                style="background-color: rgb(124, 206, 142); ">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Edit
                                                                    Absen
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form id="formEdit"
                                                                action="` + updateUrl + `"
                                                                method="post">
                                                                @csrf
                                                                <div class="modal-body " style="border-radius: 10px;">
                                                                    <input id="siswa_id" type="hidden" name="siswa_id"
                                                                        class="form-control"
                                                                        value="` + row.siswa_id + `">
                                                                    <input id="tanggal" type="hidden" name="tanggal"
                                                                        class="form-control"
                                                                        value="` + row.tanggal + `">
                                                                    <input id="jam_masuk" type="hidden" name="jam_masuk"
                                                                        class="form-control"
                                                                        value="` + row.jam_masuk + `">
                                                                    <input id="jam_pulang" type="hidden"
                                                                        name="jam_pulang" class="form-control"
                                                                        value="` + row.jam_pulang + `">
                                                                    <input id="nama" type="hidden" name="nama"
                                                                        class="form-control" value="` + selectButton
                            .val() + `">
                                                                    <label for="selectBarang"
                                                                        class="form-label">Status</label>
                                                                    <select id="status" name="status"
                                                                        class="form-select"
                                                                        aria-label="Default select example">
                                                                        @if ('hadir' === `+ row.status +`)
                                                                            <option value="hadir" selected>Hadir</option>
                                                                            <option value="izin">Izin</option>
                                                                        @elseif ('izin' === `+ row.status +`)
                                                                            <option value="hadir">Hadir</option>
                                                                            <option value="izin" selected>Izin</option>
                                                                        @endif
                                                                    </select>
                                                                    <label for="keterangan"
                                                                        class="form-label">Keterangan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="keterangan" name="keterangan"
                                                                        placeholder="Keterangan"
                                                                        value="` + row.keterangan + `" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                    <div class="btn btn-primary" onclick="submitForm()">
                                                                        Simpan</div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>`
                    });



                    parent.append(html);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    </script>
@endsection
