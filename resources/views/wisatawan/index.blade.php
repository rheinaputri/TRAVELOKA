@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>

            <div class="card-tools">
                {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('wisatawan/create') }}">Tambah</a> --}}
                <button onclick="modalAction('{{ url('wisatawan/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah
                    Ajax</button>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="table_wisatawan">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Wisatawan</th>
                        <th>Jenis Kelamin</th>
                        <th>Usia</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data- backdrop="static"
        data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
    <script>
        function modalAction(url = '') {
            $('#myModal').load(url, function() {
                $('#myModal').modal('show');
            });
        }

        var dataWisatawan;
        $(document).ready(function() {
            dataWisatawan = $('#table_wisatawan').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('wisatawan.list') }}",
                columns: [{
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "nama_wisatawan",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "jenis_kelamin",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "usia",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "alamat",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "email",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "no_telp",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "aksi",
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush
