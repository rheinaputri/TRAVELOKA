@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>

            <div class="card-tools">
                {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('paket/create') }}">Tambah</a> --}}
                <button onclick="modalAction('{{ url('paket/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah
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
            <table class="table table-bordered" id="table_paket">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kota</th>
                        <th>Nama Paket</th>
                        <th>Durasi Hari</th>
                        <th>Harga Per Orang</th>
                        <th>Fasilitas</th>
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

        var dataPaket;
        $(document).ready(function() {
            dataPaket = $('#table_paket').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                url: "{{ url('paket/list') }}",
                dataType: "json",
                type: "GET"
                // "data" : function(d) {
                //     d.kategori_id = $('#kategori_id').val();
                // }
            },
                columns: [
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "kota.nama_kota",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "nama_paket",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "durasi_hari",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "harga_perorang",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "fasilitas",
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
