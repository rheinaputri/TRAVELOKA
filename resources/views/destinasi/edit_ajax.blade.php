@empty($destinasi)
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
                <a href="{{ url('/destinasi') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/destinasi/' . $destinasi->id_destinasi . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Destinasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria- label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Destinasi</label>
                        <input value="{{ $destinasi->nama_destinasi }}" type="text" name="nama_destinasi"
                            id="nama_destinasi" class="form-control" required>
                        <small id="error-nama_destinasi" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama Kota</label>
                        <select name="id_kota" id="id_kota" class="form-control" required>
                            <option value="">- Pilih Kota -</option>
                            @foreach ($kota as $k)
                                <option {{ $k->id_kota == $destinasi->id_kota ? 'selected' : '' }}
                                    value="{{ $k->id_kota }}">{{ $k->nama_kota }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_kota" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Nama Paket</label>
                        <select name="id_paket" id="id_paket" class="form-control" required>
                            <option value="">- Pilih Paket -</option>
                            @foreach ($paket as $p)
                                <option {{ $p->id_paket == $destinasi->id_paket ? 'selected' : '' }}
                                    value="{{ $p->id_paket }}">{{ $k->nama_paket }}</option>
                            @endforeach
                        </select>
                        <small id="error-id_paket" class="error-text form-text text-danger"></small>
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
                                datadestinasi.ajax.reload();
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
