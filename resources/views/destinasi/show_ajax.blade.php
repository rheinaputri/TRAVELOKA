<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Destinasi Wisata</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $destinasi->id_destinasi }}</td>
                </tr>
                <tr>
                    <th>Nama Destinasi</th>
                    <td>{{ $destinasi->nama_destinasi }}</td>
                </tr>
                <tr>
                    <th>Nama Kota</th>
                    <td>{{ $destinasi->kota->nama_kota ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Paket</th>
                    <td>{{ $destinasi->paket->nama_paket ?? '-' }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>