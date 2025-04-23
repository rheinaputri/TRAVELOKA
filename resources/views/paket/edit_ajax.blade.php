@empty($paket)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria- label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/paket') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/paket/' . $paket->id_paket . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria- label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                            <label>Nama Kota</label>
                            <select name="id_kota" id="id_kota" class="form-control" required>
                                <option value="">- Pilih Kota -</option>
                                @foreach ($kota as $k)
                                    <option {{ $k->id_kota == $paket->id_kota ? 'selected' : '' }}
                                        value="{{ $k->id_kota }}">{{ $k->nama_kota }}</option>
                                @endforeach
                            </select>
                            <small id="error-id_kota" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <input value="{{ $paket->nama_paket }}" type="text" name="nama_paket" id="nama_paket"
                            class="form-control" required>
                        <small id="error-nama_paket" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Durasi</label>
                        <input value="{{ $paket->durasi_hari }}" type="text" name="durasi_hari" id="durasi_hari"
                            class="form-control" required>
                        <small id="error-durasi_hari" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Harga Perorang</label>
                        <input value="{{ $paket->harga_perorang }}" type="text" name="harga_perorang" id="harga_perorang"
                            class="form-control" required>
                        <small id="error-harga_perorang" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Fasilitas</label>
                        <input value="{{ $paket->fasilitas }}" type="text" name="fasilitas" id="fasilitas"
                            class="form-control" required>
                        <small id="error-fasilitas" class="error-text form-text text-danger"></small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function() {
            $("#form-edit").validate({
                rules: {
                    id_kota: {
                        required: true
                    },
                    nama_paket: {
                        required: true,
                        maxlength: 250
                    },
                    durasi_hari: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    harga_perorang: {
                        required: true,
                        number: true
                    },
                    fasilitas: {
                        required: true,
                        maxlength: 250
                    }
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
                                dataPaket.ajax.reload();
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
@endempty
