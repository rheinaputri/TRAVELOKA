<?php

namespace App\Http\Controllers;

use App\Models\KotaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class KotaController extends Controller
{

    // tampilan utama
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kota',
            'list' => ['Home', 'Kota'],
        ];
        $page = (object) [
            'title' => 'Daftar kota yang terdaftar dalam sistem',
        ];
        $activeMenu = 'kota';
        $kota = KotaModel::all();
        return view('kota.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
            'kota' => $kota,
        ]);
    }

    // untuk menampilkan list data
    public function list(Request $request)
    {
        $kota1 = KotaModel::select('id_kota', 'nama_kota');

        return DataTables::of($kota1)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kota) {
                $btn =  '<button onclick="modalAction(\'' . url('/kota/' . $kota->id_kota . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kota/' . $kota->id_kota . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/kota/' . $kota->id_kota . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // menambah data
    public function create_ajax()
    {
        return view('kota.create_ajax');
    }

    // menyimpan data baru
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_kota' => 'required|string|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, //response status
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), //pesan error validasi
                ]);
            }

            KotaModel::create($request->all());

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
        $kota = KotaModel::find($id);
        return view('kota.show_ajax', [
            'kota' => $kota
        ]);
    }

    // edit
    public function edit_ajax(string $id)
    {
        $kota = KotaModel::find($id);
        return view('kota.edit_ajax', ['kota' => $kota]);
    }

    // simpan data edit
    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_kota'  => 'required|string|max:100'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = KotaModel::find($id);
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
        return redirect('/');
    }

    // hapuss
    public function confirm_ajax(string $id)
    {
        $kota = KotaModel::find($id);
        return view('kota.confirm_ajax', ['kota' => $kota]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $kota = KotaModel::find($id);
            if ($kota) {
                $kota->delete();
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
