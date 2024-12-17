<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DosenController extends Controller
{
    // Menambahkan dosen baru (Create)
    public function create(Request $request)
    {
        // Validasi input data
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|unique:dosen,nip|max:18',
            'email' => 'required|email|unique:dosen,email|max:255',
            'jurusan' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:15',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Membuat dosen baru
        $dosen = Dosen::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'email' => $request->email,
            'jurusan' => $request->jurusan,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return response()->json(['message' => 'Dosen created successfully', 'dosen' => $dosen], 201);
    }

    // Menampilkan semua dosen (Read)
    public function read()
    {
        $dosen = Dosen::all(); // Mengambil semua data dosen
        return response()->json($dosen);
    }

    // Mengupdate data dosen (Update)
    public function update(Request $request, $id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen not found'], 404);
        }

        // Validasi input data
        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes|required|string|max:255',
            'nip' => 'sometimes|required|string|max:18|unique:dosen,nip,' . $id,
            'email' => 'sometimes|required|email|max:255|unique:dosen,email,' . $id,
            'jurusan' => 'sometimes|required|string|max:255',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:15',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Mengupdate data dosen
        $dosen->update($request->all());

        return response()->json(['message' => 'Dosen updated successfully', 'dosen' => $dosen]);
    }

    // Menghapus data dosen (Delete)
    public function delete($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen not found'], 404);
        }

        // Menghapus dosen
        $dosen->delete();

        return response()->json(['message' => 'Dosen deleted successfully']);
    }
}

