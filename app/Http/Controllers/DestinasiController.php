<?php

namespace App\Http\Controllers;

use App\Models\DestinasiModel;
use App\Models\PaketModel;
use App\Models\KotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DestinasiController extends Controller
{

    // tampilan utama
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar destinasi',
            'list' => ['Home', 'destinasi'],
        ];
        $page = (object) [
            'title' => 'Daftar destinasi yang terdaftar dalam sistem',
        ];
        $activeMenu = 'destinasi';
        $destinasi = DestinasiModel::all();
        return view('destinasi.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
            'destinasi' => $destinasi,
        ]);
    }

    public function indexweb()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar destinasi',
            'list' => ['Home', 'destinasi'],
        ];
        $page = (object) [
            'title' => 'Daftar destinasi yang terdaftar dalam sistem',
        ];
        $activeMenu = 'destinasi';
        $destinasi = DestinasiModel::all();
        return view('destinasi.indexweb', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
            'destinasi' => $destinasi,
        ]);
    }
    
    

    // untuk menampilkan list data
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $data = DestinasiModel::with(['kota', 'paket'])->select('destinasi.*');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kota.nama_kota', function ($row) {
                    return $row->kota->nama_kota ?? '-';
                })
                ->addColumn('paket.nama_paket', function ($row) {
                    return $row->paket->nama_paket ?? '-';
                })
                ->addColumn('aksi', function ($destinasi) {
                    $btn = '<button onclick="modalAction(\'' . url('/destinasi/' . $destinasi->id_destinasi . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                    $btn .= '<button onclick="modalAction(\'' . url('/destinasi/' . $destinasi->id_destinasi . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                    $btn .= '<button onclick="modalAction(\'' . url('/destinasi/' . $destinasi->id_destinasi . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
    }


    // menambah data
    public function create_ajax()
    {
        $destinasis = DestinasiModel::all();
        $kotas = KotaModel::all();
        $pakets = PaketModel::all();
        return view('destinasi.create_ajax', compact('destinasis', 'kotas','pakets'));
    }


    // menyimpan data baru
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_destinasi' => 'required|string|max:250',
                'id_kota'=> 'required',
                'id_paket' => 'required',

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, //response status
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), //pesan error validasi
                ]);
            }

            DestinasiModel::create($request->all());

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
        $destinasi = DestinasiModel::find($id);
        return view('destinasi.show_ajax', [
            'destinasi' => $destinasi
        ]);
    }

    // edit
    public function edit_ajax(string $id)
    {
        $destinasi = DestinasiModel::find($id);
        $kota = KotaModel::select('id_kota', 'nama_kota')->get();
        $paket = PaketModel::select('id_paket', 'nama_paket')->get();
        return view('destinasi.edit_ajax', ['destinasi' => $destinasi, 'kota' => $kota, 'paket' => $paket]);
    }

    // simpan data edit
    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_destinasi' => 'required|string|max:250',
                'id_kota' => 'required',
                'id_paket' => 'required',

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, //response status
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), //pesan error validasi
                ]);
            }

            $check = DestinasiModel::find($id);
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
        $destinasi = DestinasiModel::find($id);
        return view('destinasi.confirm_ajax', ['destinasi' => $destinasi]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $destinasi = DestinasiModel::find($id);
            if ($destinasi) {
                $destinasi->delete();
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
