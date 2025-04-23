<?php

namespace App\Http\Controllers;

use App\Models\PemesananModel;
use App\Models\WisatawanModel;
use App\Models\PaketModel;
use App\Models\KotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PemesananController extends Controller
{

    // tampilan utama
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar pemesanan',
            'list' => ['Home', 'pemesanan'],
        ];
        $page = (object) [
            'title' => 'Daftar pemesanan yang terdaftar dalam sistem',
        ];
        $activeMenu = 'pemesanan';
        $pemesanan = PemesananModel::all();
        return view('pemesanan.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
            'pemesanan' => $pemesanan,
        ]);
    }

    // untuk menampilkan list data
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = PemesananModel::with(['wisatawan','kota', 'paket'])->select('pemesanan.*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('wisatawan.nama_wisatawan', function ($row) {
                    return $row->wisatawan->nama_wisatawan ?? '-';
                })
                ->addColumn('kota.nama_kota', function ($row) {
                    return $row->kota->nama_kota ?? '-';
                })
                ->addColumn('paket.nama_paket', function ($row) {
                    return $row->paket->nama_paket ?? '-';
                })
                ->addColumn('aksi', function ($pemesanan) {
                    $btn = '<button onclick="modalAction(\'' . url('/pemesanan/' . $pemesanan->id_pemesanan . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                    $btn .= '<button onclick="modalAction(\'' . url('/pemesanan/' . $pemesanan->id_pemesanan . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                    $btn .= '<button onclick="modalAction(\'' . url('/pemesanan/' . $pemesanan->id_pemesanan . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }


    // menambah data
    public function create_ajax()
    {
        $pemesanans = PemesananModel::all();
        $wisatawans = WisatawanModel::all();
        $kotas = KotaModel::all();
        $pakets = PaketModel::all();
        return view('pemesanan.create_ajax', compact('pemesanans', 'wisatawans','kotas','pakets'));
    }


    // menyimpan data baru
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_wisatawan'=> 'required',
                'id_kota'=> 'required',
                'id_paket' => 'required',
                'jumlah_orang' => 'required|integer|min:1',
                'tanggal_berangkat' => 'required|date',
                'tanggal_kembali' => 'required|date',

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, //response status
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), //pesan error validasi
                ]);
            }

            PemesananModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data kota berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    // detail
    public function show_ajax(string $id)
    {
        $pemesanan = PemesananModel::find($id);
        return view('pemesanan.show_ajax', [
            'pemesanan' => $pemesanan
        ]);
    }

    // edit
    public function edit_ajax(string $id)
    {
        $pemesanan = PemesananModel::find($id);
        $wisatawan = WisatawanModel::select('id_wisatawan', 'nama_wisatawan')->get();
        $kota = KotaModel::select('id_kota', 'nama_kota')->get();
        $paket = PaketModel::select('id_paket', 'nama_paket')->get();
        return view('pemesanan.edit_ajax', ['pemesanan' => $pemesanan,'wisatawan' => $wisatawan, 'kota' => $kota, 'paket' => $paket]);
    }

    // simpan data edit
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_wisatawan'=> 'required',
                'id_kota'=> 'required',
                'id_paket' => 'required',
                'jumlah_orang' => 'required|integer|min:1',
                'tanggal_berangkat' => 'required|date',
                'tanggal_kembali' => 'required|date',

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, //response status
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), //pesan error validasi
                ]);
            }

            $check = PemesananModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        redirect('/');
    }

    // hapuss
    public function confirm_ajax(string $id)
    {
        $pemesanan = PemesananModel::find($id);
        return view('pemesanan.confirm_ajax', ['pemesanan' => $pemesanan]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $pemesanan = PemesananModel::find($id);
            if ($pemesanan) {
                $pemesanan->delete();
                return response()->json([
                    'status'  => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }
}
