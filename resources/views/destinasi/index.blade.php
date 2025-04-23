@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>

            <div class="card-tools">
                {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('destinasi/create') }}">Tambah</a> --}}
                <button onclick="modalAction('{{ url('destinasi/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah
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
            <table class="table table-bordered" id="table_destinasi">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Destinasi</th>
                        <th>Nama Kota</th>
                        <th>Nama Paket</th>
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

        var dataDestinasi;
        $(document).ready(function() {
            dataDestinasi = $('#table_destinasi').DataTable({

                processing: true,
                serverSide: true,
                ajax: {
                url: "{{ url('destinasi/list') }}",
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
                        data: "nama_destinasi",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "kota.nama_kota",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "paket.nama_paket",
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
