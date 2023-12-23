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
                                    <div id="absenForm">
                                        <div class="form-group">
                                            <input id="siswa_id" type="hidden" name="siswa_id" class="form-control"
                                                value="{{ auth()->user()->id }}">
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
                                            <button id="inputButton" type="button" class="btn btn-primary"
                                                onclick="handleInput()">Simpan</button>
                                        </div>
                                    </div>
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
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- code buat tombol filter --}}
    <script>
        function handleSelection() {
            var selectElement = document.getElementById("selectButton");
            var selectedValue = selectElement.value;

            console.log("Selected Option:", selectedValue);

            // Mengirim formulir secara manual menggunakan JavaScript
            // var form = document.getElementById("filterForm");
            // form.submit();

            const selectButton = $('#selectButton')

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
                        // console.log(row)
                        let updateUrl = "{{ url('/absensi/update') }}/" + row.id
                        html += `<tr>
                                            <th scope="row"> ` + row.id + ` </th>
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
                                                            <div>
                                                                <div class="modal-body " style="border-radius: 10px;">
                                                                    <input id="siswa_idd" type="hidden" name="siswa_id"
                                                                        class="form-control siswa_idd"
                                                                        value="` + row.siswa_id + `">
                                                                    <input id="tanggall" type="hidden" name="tanggal"
                                                                        class="form-control tanggall"
                                                                        value="` + row.tanggal + `">
                                                                    <input id="jam_masukk" type="hidden" name="jam_masuk"
                                                                        class="form-control jam_masukk"
                                                                        value="` + row.jam_masuk + `">
                                                                    <input id="jam_pulangg" type="hidden"
                                                                        name="jam_pulang" class="form-control jam_pulangg"
                                                                        value="` + row.jam_pulang + `">
                                                                    <input id="namaa" type="hidden" name="nama"
                                                                        class="form-contro namaa" value="` +
                            selectButton
                            .val() + `">
                                                                    <label for="selectBarang"
                                                                        class="form-label">Status</label>
                                                                    <select id="statuss" name="status" class="form-select statuss" aria-label="Default select example">
                                                                        <option value="hadir" ${row.status === 'hadir' ? 'selected' : ''}>Hadir</option>
                                                                        <option value="izin" ${row.status === 'izin' ? 'selected' : ''}>Izin</option>
                                                                    </select>
                                                                    <label for="keterangan"
                                                                        class="form-label">Keterangan</label>
                                                                    <input type="text" class="form-control keterangann"
                                                                        id="keterangann" name="keterangan"
                                                                        placeholder="Keterangan"
                                                                        value="` + row.keterangan +
                            `" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                        <button id="updateButton" onclick="handleUpdate(` + row.id + `, ` + row.siswa_id + `, '` + row.tanggal + `', '` + row.jam_masuk + `', '` + row.jam_pulang + `', '` + row.status + `', '` + row.keterangan + `')" type="button" class="btn btn-primary">Simpan</button>
                                                            </div>
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
    {{-- code buat tombol input --}}
    <script>
        function handleInput() {
            const siswa_id = $('#siswa_id')
            const tanggal = $('#tanggal')
            const jam_masuk = $('#jam_masuk')
            const status = $('#status')
            const keterangan = $('#keterangan')
            const selectButton = $('#selectButton')
            $.ajax({
                type: 'POST',
                url: '/absensi/store',
                data: {
                    _token: "{{ csrf_token() }}",
                    siswa_id: siswa_id.val(),
                    tanggal: tanggal.val(),
                    jam_masuk: jam_masuk.val(),
                    status: status.val(),
                    keterangan: keterangan.val(),
                    nama: selectButton.val()
                },
                success: function(response) {
                    console.log(response)

                    let parent = $('#tableBody')

                    parent.empty()
                    let html = ``
                    response.filteredData.forEach(row => {
                        let updateUrl = `{{ url('absensi/update/' . ` + row.id + `) }}`
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
                                                                    <input id="siswa_idd" type="hidden" name="siswa_id"
                                                                        class="form-control"
                                                                        value="` + row.siswa_id + `">
                                                                    <input id="tanggall" type="hidden" name="tanggal"
                                                                        class="form-control"
                                                                        value="` + row.tanggal + `">
                                                                    <input id="jam_masukk" type="hidden" name="jam_masuk"
                                                                        class="form-control"
                                                                        value="` + row.jam_masuk + `">
                                                                    <input id="jam_pulangg" type="hidden"
                                                                        name="jam_pulang" class="form-control"
                                                                        value="` + row.jam_pulang + `">
                                                                    <input id="namaa" type="hidden" name="nama"
                                                                        class="form-control" value="` + selectButton
                            .val() + `">
                                                                    <label for="selectBarang" class="form-label">Status</label>
                                                                    <select id="statuss" name="status" class="form-select" aria-label="Default select example">
                                                                        <option value="hadir" ${row.status === 'hadir' ? 'selected' : ''}>Hadir</option>
                                                                        <option value="izin" ${row.status === 'izin' ? 'selected' : ''}>Izin</option>
                                                                    </select>
                                                                    <label for="keterangan"
                                                                        class="form-label">Keterangan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="keterangann" name="keterangan"
                                                                        placeholder="Keterangan"
                                                                        value="` + row.keterangan + `" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>`
                    });
                    $('#inputModal').modal('hide')
                    parent.append(html);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            })
        }
    </script>
    {{-- code buat tombol edit --}}
    <script>
        function handleUpdate(absen_id, siswa_id, tanggal, jam_masuk, jam_pulang, status, keterangan) {
            // var test = JSON.parse(row)
            // let absen_id = $(this).absen('id');
            // const absen_id = $('row.absen_id')
            // console.log(keterangan)
            // const siswa_idd = $('row.siswa_id')
            // const tanggall = $('row.tanggal')
            // const jam_masukk = $('row.jam_masuk')
            // const statuss = $('row.status')
            // const keterangann = $('row.keterangan')
            const selectButton = $('#selectButton')
            $.ajax({
                type: 'POST',
                url: `/absensi/update/${absen_id}`,
                data: {
                    _token: "{{ csrf_token() }}",
                    siswa_id: siswa_id,
                    tanggal: tanggal,
                    jam_masuk: jam_masuk,
                    jam_pulang: jam_pulang,
                    status: status,
                    keterangan: keterangan,
                    nama: selectButton.val()
                },
                success: function(response) {
                    console.log(response)

                    let parent = $('#tableBody')

                    parent.empty()
                    let html = ``
                    response.filteredData.forEach(row => {
                        let updateUrl = `{{ url('absensi/update/' . ` + row.id + `) }}`
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
                                                                    <input id="siswa_idd" type="hidden" name="siswa_id"
                                                                        class="form-control"
                                                                        value="` + row.siswa_id + `">
                                                                    <input id="tanggall" type="hidden" name="tanggal"
                                                                        class="form-control"
                                                                        value="` + row.tanggal + `">
                                                                    <input id="jam_masukk" type="hidden" name="jam_masuk"
                                                                        class="form-control"
                                                                        value="` + row.jam_masuk + `">
                                                                    <input id="jam_pulangg" type="hidden"
                                                                        name="jam_pulang" class="form-control"
                                                                        value="` + row.jam_pulang + `">
                                                                    <input id="namaa" type="hidden" name="nama"
                                                                        class="form-control" value="` + selectButton
                            .val() + `">
                                                                    <label for="selectBarang" class="form-label">Status</label>
                                                                    <select id="statuss" name="status" class="form-select" aria-label="Default select example">
                                                                        <option value="hadir" ${row.status === 'hadir' ? 'selected' : ''}>Hadir</option>
                                                                        <option value="izin" ${row.status === 'izin' ? 'selected' : ''}>Izin</option>
                                                                    </select>
                                                                    <label for="keterangan"
                                                                        class="form-label">Keterangan</label>
                                                                    <input type="text" class="form-control"
                                                                        id="keterangann" name="keterangan"
                                                                        placeholder="Keterangan"
                                                                        value="` + row.keterangan + `" required>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Tutup</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Simpan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>`
                    });
                    $('#inputModal').modal('hide')
                    parent.append(html);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            })
        }
    </script>
@endsection
