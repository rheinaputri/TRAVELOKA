<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Kota Wisata</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $kota->id_kota }}</td>
                </tr>
                <tr>
                    <th>Nama kota</th>
                    <td>{{ $kota->nama_kota }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>