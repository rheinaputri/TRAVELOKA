<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Wisatawan</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $wisatawan->id_wisatawan }}</td>
                </tr>
                <tr>
                    <th>Nama Wisatawan</th>
                    <td>{{ $wisatawan->nama_wisatawan }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $wisatawan->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Usia</th>
                    <td>{{ $wisatawan->usia }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $wisatawan->alamat }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $wisatawan->email }}</td>
                </tr>
                <tr>
                    <th>No Telepon</th>
                    <td>{{ $wisatawan->nama_wisatawan }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

