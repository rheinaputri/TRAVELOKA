<?php

namespace App\Http\Controllers;

use App\Models\WisatawanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class WisatawanController extends Controller
{

    // tampilan utama
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar wisatawan',
            'list' => ['Home', 'wisatawan'],
        ];
        $page = (object) [
            'title' => 'Daftar wisatawan yang terdaftar dalam sistem',
        ];
        $activeMenu = 'wisatawan';
        $wisatawan = WisatawanModel::all();
        return view('wisatawan.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
            'wisatawan' => $wisatawan,
        ]);
    }

    // untuk menampilkan list data
    public function list(Request $request)
    {
        $wisatawan1 = WisatawanModel::select('id_wisatawan', 'nama_wisatawan', 'jenis_kelamin', 'usia', 'alamat', 'email', 'no_telp');

        return DataTables::of($wisatawan1)
            ->addIndexColumn()
            ->addColumn('aksi', function ($wisatawan) {
                $btn =  '<button onclick="modalAction(\'' . url('/wisatawan/' . $wisatawan->id_wisatawan . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/wisatawan/' . $wisatawan->id_wisatawan . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/wisatawan/' . $wisatawan->id_wisatawan . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // menambah data
    public function create_ajax()
    {
        return view('wisatawan.create_ajax');
    }

    // menyimpan data baru
    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_wisatawan' => 'required|string|max:100',
                'jenis_kelamin' => 'required|in:L,P', // Perbaiki enum dengan 'in:L,P
                'usia' => 'required|integer|min:1',
                'alamat' => 'required|string|max:250',
                'email' => 'required|string|max:250',
                'no_telp' => 'required|numeric|min:1'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false, //response status
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(), //pesan error validasi
                ]);
            }

            WisatawanModel::create($request->all());

            return response()->json([
                'status' => true,
                'message' => 'Data wisatawan berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    // detail
    public function show_ajax(string $id)
    {
        $wisatawan = WisatawanModel::find($id);
        return view('wisatawan.show_ajax', [
            'wisatawan' => $wisatawan
        ]);
    }

    // edit
    public function edit_ajax(string $id)
    {
        $wisatawan = WisatawanModel::find($id);
        return view('wisatawan.edit_ajax', ['wisatawan' => $wisatawan]);
    }

    // simpan data edit
    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'nama_wisatawan'  => 'required|string|max:100',
                'jenis_kelamin' => 'required|in:L,P', // Perbaiki enum dengan 'in:L,P
                'usia' => 'required|integer|min:1',
                'alamat' => 'required|string|max:250',
                'email' => 'required|string|max:250',
                'no_telp' => 'required|numeric|min:1'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = WisatawanModel::find($id);
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
    // Menampilkan modal konfirmasi penghapusan data wisatawan (via AJAX)
    public function confirm_ajax(string $id)
    {
        $wisatawan = WisatawanModel::find($id);

        return view('wisatawan.confirm_ajax', [
            'wisatawan' => $wisatawan
        ]);
    }

    // Menghapus data wisatawan (via AJAX)
    public function delete_ajax(Request $request, $id)
    {
        // Cek apakah request berasal dari AJAX
        if ($request->ajax() || $request->wantsJson()) {
            $wisatawan = WisatawanModel::find($id);

            if ($wisatawan) {
                $wisatawan->delete();

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

        // Redirect jika bukan request AJAX
        return redirect('/');
    }
}
