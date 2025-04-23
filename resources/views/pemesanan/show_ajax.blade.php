<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detail Pemesanan Wisata</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $pemesanan->id_pemesanan }}</td>
                </tr>
                <tr>
                    <th>Nama Wisatawan</th>
                    <td>{{ $pemesanan->wisatawan->nama_wisatawan  ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Kota</th>
                    <td>{{ $pemesanan->kota->nama_kota ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Nama Paket</th>
                    <td>{{ $pemesanan->paket->nama_paket ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Orang</th>
                    <td>{{ $pemesanan->jumlah_orang }}</td>
                </tr>
                <tr>
                    <th>Tanggal Berangkat</th>
                    <td>{{ $pemesanan->tanggal_berangkat}}</td>
                </tr>
                <tr>
                    <th>Tanggal Kembali</th>
                    <td>{{ $pemesanan->tanggal_kembali }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>