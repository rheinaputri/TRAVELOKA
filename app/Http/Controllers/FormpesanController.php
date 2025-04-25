<?php

namespace App\Http\Controllers;

use App\Models\PemesananModel;
use App\Models\WisatawanModel;
use App\Models\PaketModel;
use App\Models\KotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FormpesanController extends Controller
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
        $pemesanan = PemesananModel::with('wisatawan')->get();
        return view('formpesan.index', [
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
            $data = PemesananModel::with(['wisatawan', 'kota', 'paket'])->select('pemesanan.*');
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
        $wisatawans = WisatawanModel::all();
        $kotas = KotaModel::all();
        $pakets = PaketModel::all();
        return view('formpesan.create_ajax', compact('wisatawans', 'kotas', 'pakets'));
    }

    public function store_ajax(Request $request)
    {
        try {
            if ($request->ajax() || $request->wantsJson()) {
                $rules = [
                    'nama_wisatawan' => 'required|string|max:100',
                    'jenis_kelamin' => 'required|in:L,P',
                    'usia' => 'required|integer|min:1',
                    'alamat' => 'required|string|max:250',
                    'email' => 'required|string|max:250',
                    'no_telp' => 'required|numeric|min:1',
                    'id_kota' => 'required',
                    'id_paket' => 'required',
                    'jumlah_orang' => 'required|integer|min:1',
                    'tanggal_berangkat' => 'required|date',
                    'tanggal_kembali' => 'required|date',
                ];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Validasi Gagal',
                        'msgField' => $validator->errors(),
                    ]);
                }

                $wisatawan = WisatawanModel::create([
                    'nama_wisatawan' => $request->nama_wisatawan,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'usia' => $request->usia,
                    'alamat' => $request->alamat,
                    'email' => $request->email,
                    'no_telp' => $request->no_telp,
                ]);

                PemesananModel::create([
                    'id_wisatawan' => $wisatawan->id_wisatawan,
                    'id_kota' => $request->id_kota,
                    'id_paket' => $request->id_paket,
                    'jumlah_orang' => $request->jumlah_orang,
                    'tanggal_berangkat' => $request->tanggal_berangkat,
                    'tanggal_kembali' => $request->tanggal_kembali,
                ]);

                return response()->json([
                    'status' => true,
                    'message' => 'Data pemesanan berhasil disimpan'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ]);
        }
        redirect('/');
    }

    // edit
    public function edit_ajax(string $id)
    {
        $pemesanan = PemesananModel::find($id);
        $wisatawan = WisatawanModel::all();
        $kota = KotaModel::select('id_kota', 'nama_kota')->get();
        $paket = PaketModel::select('id_paket', 'nama_paket')->get();
        return view('formpesan.edit_ajax', [
            'pemesanan' => $pemesanan,
            'wisatawan' => $wisatawan,
            'kota' => $kota,
            'paket' => $paket
        ]);
    }

    // simpan data edit
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_wisatawan' => 'required',
                'id_kota' => 'required',
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

    // hapus
    public function delete_ajax(Request $request, $id)
    {
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
