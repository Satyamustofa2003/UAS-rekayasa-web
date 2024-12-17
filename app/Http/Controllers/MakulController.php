<?php

namespace App\Http\Controllers;

use App\Models\Makul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MakulController extends Controller
{
    // Menampilkan semua mata kuliah (Read)
    public function read()
    {
        // Mengambil semua data mata kuliah
        $makul = Makul::all();

        // Jika data kosong
        if ($makul->isEmpty()) {
            return response()->json([
                'message' => 'No mata kuliah found'
            ], 404);
        }

        // Mengembalikan data dengan status 200
        return response()->json($makul, 200);
    }

    // Mengupdate mata kuliah (Update)
    public function update(Request $request, $id)
    {
        // Cari mata kuliah berdasarkan ID
        $makul = Makul::find($id);

        // Jika data tidak ditemukan
        if (!$makul) {
            return response()->json([
                'message' => 'Mata kuliah not found'
            ], 404);
        }

        // Validasi input data
        $validator = Validator::make($request->all(), [
            'kode_makul' => 'sometimes|required|string|max:10|unique:makul,kode_makul,' . $id,
            'nama_makul' => 'sometimes|required|string|max:255',
            'sks' => 'sometimes|required|integer|min:1',
            'jurusan' => 'sometimes|required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Update hanya kolom yang ada di request
        $makul->update($request->only(['kode_makul', 'nama_makul', 'sks', 'jurusan']));

        // Mengembalikan respons berhasil
        return response()->json([
            'message' => 'Mata kuliah updated successfully',
            'makul' => $makul
        ], 200);
    }

    // Fungsi lain (Create, Delete, dll.) bisa ditambahkan di sini...
}
