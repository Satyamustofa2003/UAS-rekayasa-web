<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    // Menampilkan semua mahasiswa (read)
    public function read()
    {
        $mahasiswa = Mahasiswa::all();
        return response()->json($mahasiswa, 200); // Menambahkan status 200
    }

    // Menampilkan mahasiswa berdasarkan ID (read)
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404); // Status 404 jika tidak ditemukan
        }

        return response()->json($mahasiswa, 200); // Menambahkan status 200
    }

    // Menambahkan mahasiswa baru (create)
    public function create(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswa,nim|max:15',
            'email' => 'required|email|unique:mahasiswa,email|max:255',
            'jurusan' => 'required|string|max:255',
            'tahun_masuk' => 'required|integer|min:2000|max:2100',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400); // Menambahkan status 400
        }

        // Membuat mahasiswa baru
        $mahasiswa = Mahasiswa::create($request->only([
            'nama', 'nim', 'email', 'jurusan', 'tahun_masuk'
        ]));

        return response()->json([
            'message' => 'Mahasiswa created successfully',
            'mahasiswa' => $mahasiswa
        ], 201); // Status 201 untuk success create
    }

    // Mengupdate data mahasiswa berdasarkan ID (update)
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404); // Status 404 jika tidak ditemukan
        }

        // Validasi input untuk update
        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
            'nim' => 'sometimes|required|string|max:15|unique:mahasiswa,nim,' . $id,
            'email' => 'sometimes|required|email|max:255|unique:mahasiswa,email,' . $id,
            'jurusan' => 'sometimes|required|string|max:255',
            'tahun_masuk' => 'sometimes|required|integer|min:2000|max:2100',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400); // Status 400 jika ada error
        }

        // Update mahasiswa
        $mahasiswa->update($request->only([
            'nama', 'nim', 'email', 'jurusan', 'tahun_masuk'
        ]));

        return response()->json([
            'message' => 'Mahasiswa updated successfully',
            'mahasiswa' => $mahasiswa
        ], 200); // Status 200 untuk success update
    }

    // Menghapus mahasiswa berdasarkan ID (delete)
    public function delete($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404); // Status 404 jika tidak ditemukan
        }

        // Menghapus mahasiswa
        $mahasiswa->delete();

        return response()->json(['message' => 'Mahasiswa deleted successfully'], 204); // Status 204 untuk successful delete
    }
}
