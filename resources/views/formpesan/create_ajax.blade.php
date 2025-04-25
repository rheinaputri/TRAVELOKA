<form action="{{ url('/formpesan/ajax') }}" method="POST" id="form-tambah">
    @csrf
    <!-- Penempatan form di dalam modal-content -->
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ url('/formpesan/ajax') }}" method="POST" id="form-tambah">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
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
                        <input type="number" name="usia" id="usia" class="form-control" required
                            min="1">
                        <small id="error-usia" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- Alamat -->
                    <div class="form-group">
                        <label>Alamat</label>
                        <input type="text" name="alamat" id="alamat" class="form-control" required
                            maxlength="250">
                        <small id="error-alamat" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" required
                            maxlength="250">
                        <small id="error-email" class="error-text form-text text-danger"></small>
                    </div>

                    <!-- No. Telepon -->
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="text" name="no_telp" id="no_telp" class="form-control" required>
                        <small id="error-no_telp" class="error-text form-text text-danger"></small>
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
                    <div class="form-group">
                        <label>Jumlah Orang</label>
                        <input value="" type="number" name="jumlah_orang" id="jumlah_orang" class="form-control"
                            required>
                        <small id="error-jumlah_orang" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Berangkat</label>
                        <input value="" type="date" name="tanggal_berangkat" id="tanggal_berangkat"
                            class="form-control" required>
                        <small id="error-tanggal_berangkat" class="error-text form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <input value="" type="date" name="tanggal_kembali" id="tanggal_kembali"
                            class="form-control" required>
                        <small id="error-tanggal_kembali" class="error-text form-text text-danger"></small>
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
                    },
                    id_kota: {
                        required: true
                    },
                    id_paket: {
                        required: true
                    },
                    jumlah_orang: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    tanggal_berangkat: {
                        required: true,
                        date: true
                    },
                    tanggal_kembali: {
                        required: true,
                        date: true
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
                                dataPemesanan.ajax.reload();
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
