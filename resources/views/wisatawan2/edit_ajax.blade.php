@empty($wisatawan)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan.
                </div>
                <a href="{{ url('/wisatawan') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <!-- Form Edit Wisatawan -->
    <form action="{{ url('/wisatawan/' . $wisatawan->id_wisatawan . '/update_ajax') }}" method="POST" id="form-edit-wisatawan">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Wisatawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Wisatawan</label>
                        <input type="text" name="nama_wisatawan" id="nama_wisatawan" class="form-control"
                            value="{{ $wisatawan->nama_wisatawan }}" required>
                        <small id="error-nama_wisatawan" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="L" {{ $wisatawan->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="P" {{ $wisatawan->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                        <small id="error-jenis_kelamin" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Usia</label>
                        <input type="number" name="usia" id="usia" class="form-control"
                            value="{{ $wisatawan->usia }}" required min="1">
                        <small id="error-usia" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control"
                            value="{{ $wisatawan->alamat }}" required>
                        <small id="error-alamat" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" id="email" class="form-control"
                            value="{{ $wisatawan->email }}" required>
                        <small id="error-email" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="number" name="no_telp" id="no_telp" class="form-control"
                            value="{{ $wisatawan->no_telp }}" required>
                        <small id="error-no_telp" class="error-text form-text text-danger"></small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    <!-- Script Validasi & Ajax -->
    <script>
        $(document).ready(function() {
            $("#form-edit-wisatawan").validate({
                rules: {
                    nama_wisatawan: {
                        required: true,
                        maxlength: 250
                    },
                    jenis_kelamin: {
                        required: true
                    },
                    usia: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    alamat: {
                        required: true,
                        maxlength: 250
                    },
                    email: {
                        required: true,
                        maxlength: 250
                    },
                    no_telp: {
                        required: true,
                        number: true,
                        min: 1
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
                                dataWisatawan.ajax.reload();
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
