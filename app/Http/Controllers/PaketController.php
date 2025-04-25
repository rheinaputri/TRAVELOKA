<?php

namespace App\Http\Controllers;

use App\Models\PaketModel;
use App\Models\KotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PaketController extends Controller
{

    // tampilan utama
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar paket',
            'list' => ['Home', 'paket'],
        ];
        $page = (object) [
            'title' => 'Daftar paket yang terdaftar dalam sistem',
        ];
        $activeMenu = 'paket';
        $paket = PaketModel::all();
        return view('paket.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
            'paket' => $paket,
        ]);
    }
    public function indexpaket()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar paket',
            'list' => ['Home', 'paket'],
        ];
        $page = (object) [
            'title' => 'Daftar paket yang terdaftar dalam sistem',
        ];
        $activeMenu = 'paket';
        $paket = PaketModel::all();
        return view('paket.indexpaket', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
            'paket' => $paket,
        ]);
    }

    // untuk menampilkan list data
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = PaketModel::with('kota')->select('paket.*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nama_kota', function ($row) {
                    return $row->kota->nama_kota ?? '-';
                })
                ->addColumn('aksi', function ($paket) {
                    $btn = '<button onclick="modalAction(\'' . url('/paket/' . $paket->id_paket . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                    $btn .= '<button onclick="modalAction(\'' . url('/paket/' . $paket->id_paket . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                    $btn .= '<button onclick="modalAction(\'' . url('/paket/' . $paket->id_paket . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }

    // menambah data
    public function create_ajax()
    {
        $pakets = PaketModel::all();
        $kotas = KotaModel::all();
        return view('paket.create_ajax', compact('pakets', 'kotas'));
    }


    // menyimpan data baru
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_kota' => 'required',
                'nama_paket' => 'required|string|max:250',
                'durasi_hari' => 'required|integer|min:1',
                'harga_perorang' => 'required|integer|min:1',
                'fasilitas' => 'required|string|max:250',

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, //response status
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), //pesan error validasi
                ]);
            }

            PaketModel::create($request->all());

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
        $paket = PaketModel::find($id);
        return view('paket.show_ajax', [
            'paket' => $paket
        ]);
    }

    // edit
    public function edit_ajax(string $id)
    {
        $paket = PaketModel::find($id);
        $kota = KotaModel::select('id_kota', 'nama_kota')->get();
        return view('paket.edit_ajax', ['paket' => $paket, 'kota' => $kota]);
    }

    // simpan data edit
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'id_kota' => 'required',
                'nama_paket' => 'required|string|max:250',
                'durasi_hari' => 'required|integer|min:1',
                'harga_perorang' => 'required|integer|min:1',
                'fasilitas' => 'required|string|max:250',

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, //response status
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), //pesan error validasi
                ]);
            }

            $check = PaketModel::find($id);
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
        $paket = PaketModel::find($id);
        return view('paket.confirm_ajax', ['paket' => $paket]);
    }



    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $paket = PaketModel::find($id);
            if ($paket) {
                $paket->delete();
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
