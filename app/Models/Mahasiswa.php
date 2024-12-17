<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'mahasiswa';

    // Primary key tabel
    protected $primaryKey = 'id';

    // Gunakan timestamp (created_at dan updated_at)
    public $timestamps = true;

    // Atribut yang bisa diisi secara mass-assignment
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'jurusan',
        'tahun_masuk',
    ];

    // Atribut yang tidak bisa diisi secara mass-assignment
    protected $guarded = [];
}
