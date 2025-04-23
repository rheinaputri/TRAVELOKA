<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Paket Wisata</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $paket->id_paket }}</td>
                </tr>
                <tr>
                    <th>Nama Kota</th>
                    <td>{{ $paket->kota->nama_kota ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Paket</th>
                    <td>{{ $paket->nama_paket }}</td>
                </tr>
                <tr>
                    <th>Durasi Hari</th>
                    <td>{{ $paket->durasi_hari }}</td>
                </tr>
                <tr>
                    <th>Harga_perorang</th>
                    <td>{{ $paket->harga_perorang }}</td>
                </tr>
                <tr>
                    <th>Fasilitas</th>
                    <td>{{ $paket->fasilitas }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>