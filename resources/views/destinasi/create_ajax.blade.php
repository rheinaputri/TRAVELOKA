<form action="{{ url('/destinasi/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <!-- Penempatan form di dalam modal-content -->
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ url('/destinasi/ajax') }}" method="POST" id="form-tambah">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Destinasi</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama destinasi</label>
                        <input value="" type="text" name="nama_destinasi" id="nama_destinasi"
                            class="form-control" required>
                        <small id="error-nama_destinasi" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama Kota</label>
                        <select name="id_kota" id="id_kota" class="form-control" required>
                            <option value="">Pilih Kota</option>
                            @foreach ($kotas as $kota)
                                <option value="{{ $kota->id_kota }}">{{ $kota->nama_kota }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_kota" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <select name="id_paket" id="id_paket" class="form-control" required>
                            <option value="">Pilih Paket</option>
                            @foreach ($pakets as $paket)
                                <option value="{{ $paket->id_paket }}">{{ $paket->nama_paket }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_paket" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#form-tambah").validate({
                rules: {
                    nama_destinasi: {
                        required: true,
                        maxlength: 250
                    },
                    id_kota: {
                        required: true
                    },
                    id_paket: {
                        required: true
                    },

                },
                submitHandler: function(form) {
                    $.ajax({
                        url: form.action,
                        type: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status) {
                                $('#myModal').modal('hide');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.message
                                });
                                dataDestinasi.ajax.reload();
                            } else {
                                $('.error-text').text('');
                                $.each(response.msgField, function(prefix, val) {
                                    $('#error-' + prefix).text(val[0]);
                                });
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Terjadi Kesalahan',
                                    text: response.message
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: 'Gagal mengirim data. Silakan coba lagi.'
                            });
                        }
                    });
                    return false;
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
