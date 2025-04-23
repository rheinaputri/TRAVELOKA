@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>

            <div class="card-tools">
                {{-- <a class="btn btn-sm btn-primary mt-1" href="{{ url('kota/create') }}">Tambah</a> --}}
                <button onclick="modalAction('{{ url('kota/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah
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
            <table class="table table-bordered" id="table_kota">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama kota</th>
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

        var dataKota;
        $(document).ready(function() {
            dataKota = $('#table_kota').DataTable({

                processing: true,
                serverSide: true,
                ajax: "{{ route('kota.list') }}",
                columns: [{
                        data: "id_kota",
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "nama_kota",
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
