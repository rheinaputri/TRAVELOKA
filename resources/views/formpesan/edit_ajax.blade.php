@empty($pemesanan)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/formpesan') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
    <form action="{{ url('/pemesanan/' . $pemesanan->id_pemesanan . '/update_ajax') }}" method="POST" id="form-edit">
        @csrf
        @method('PUT')
        <div id="modal-master" class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Pemesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Wisatawan</label>
                        <select name="id_wisatawan" id="id_wisatawan" class="form-control" required>
                            <option value="">- Pilih Wisatawan -</option>
                            @foreach ($wisatawan as $w)
                                <option {{ $w->id_wisatawan == $pemesanan->id_wisatawan ? 'selected' : '' }}
                                    value="{{ $w->id_wisatawan }}">
                                    {{ $w->nama_wisatawan }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-id_wisatawan" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Nama Kota</label>
                        <select name="id_kota" id="id_kota" class="form-control" required>
                            <option value="">- Pilih Kota -</option>
                            @foreach ($kota as $k)
                                <option {{ $k->id_kota == $pemesanan->id_kota ? 'selected' : '' }}
                                    value="{{ $k->id_kota }}">
                                    {{ $k->nama_kota }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-id_kota" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Nama Paket</label>
                        <select name="id_paket" id="id_paket" class="form-control" required>
                            <option value="">- Pilih Paket -</option>
                            @foreach ($paket as $p)
                                <option {{ $p->id_paket == $pemesanan->id_paket ? 'selected' : '' }}
                                    value="{{ $p->id_paket }}">
                                    {{ $p->nama_paket }}
                                </option>
                            @endforeach
                        </select>
                        <small id="error-id_paket" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Jumlah Orang</label>
                        <input value="{{ $pemesanan->jumlah_orang }}" type="number" name="jumlah_orang" id="jumlah_orang"
                            class="form-control" required>
                        <small id="error-jumlah_orang" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Berangkat</label>
                        <input value="{{ $pemesanan->tanggal_berangkat }}" type="date" name="tanggal_berangkat"
                            id="tanggal_berangkat" class="form-control" required>
                        <small id="error-tanggal_berangkat" class="error-text form-text text-danger"></small>
                    </div>

                    <div class="form-group">
                        <label>Tanggal Kembali</label>
                        <input value="{{ $pemesanan->tanggal_kembali }}" type="date" name="tanggal_kembali"
                            id="tanggal_kembali" class="form-control" required>
                        <small id="error-tanggal_kembali" class="error-text form-text text-danger"></small>
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
                    id_wisatawan: {
                        required: true
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
                        date: true,
                    },
                    tanggal_kembali: {
                        required: true,
                        date: true,
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
@endempty
