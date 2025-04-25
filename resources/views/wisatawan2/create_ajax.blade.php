<form action="{{ url('/wisatawan/ajax') }}" method="POST" id="form-tambah-wisatawan">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Wisatawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <!-- Nama Wisatawan -->
                <div class="form-group">
                    <label>Nama Wisatawan</label>
                    <input type="text" name="nama_wisatawan" id="nama_wisatawan" class="form-control" required>
                    <small id="error-nama_wisatawan" class="error-text form-text text-danger"></small>
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                    <small id="error-jenis_kelamin" class="error-text form-text text-danger"></small>
                </div>

                <!-- Usia -->
                <div class="form-group">
                    <label>Usia</label>
                    <input type="number" name="usia" id="usia" class="form-control" required min="1">
                    <small id="error-usia" class="error-text form-text text-danger"></small>
                </div>

                <!-- Alamat -->
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control" required maxlength="250">
                    <small id="error-alamat" class="error-text form-text text-danger"></small>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control" required maxlength="250">
                    <small id="error-email" class="error-text form-text text-danger"></small>
                </div>

                <!-- No. Telepon -->
                <div class="form-group">
                    <label>No. Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control" required>
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

<!-- jQuery Validation & AJAX -->
<script>
    $(document).ready(function() {
        $("#form-tambah-wisatawan").validate({
            rules: {
                nama_wisatawan: {
                    required: true,
                    maxlength: 250
                },
                jenis_kelamin: {
                    required: true,
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
                            dataWisatawan.ajax.reload(); // reload data
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
