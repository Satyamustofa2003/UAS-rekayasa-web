<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    public $timestamps = true; // Gunakan timestamp (created_at dan updated_at)

    // Atribut yang bisa diisi secara mass-assignment
    protected $fillable = [
        'nama', 'nip', 'email', 'jurusan', 'alamat', 'telepon',
    ];

    // Atribut yang tidak bisa diisi secara mass-assignment
    protected $guarded = [];
}
