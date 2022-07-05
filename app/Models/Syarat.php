<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syarat extends Model
{
    use HasFactory;

    public $table = 'syarats';

    protected $fillable = [
        'skripsi',    
        'skripsistatus' ,   
        'photo' ,   
        'photostatus' ,   
        'serticalonsarjana' ,   
        'serticalonsarjanastatus' ,   
        'sertibebasperpus' ,   
        'sertibebasperpusstatus' ,   
        'sertimaba' ,   
        'sertimabastatus' ,   
        'bebaslab' ,   
        'bebaslabstatus' ,   
        'transkrip' ,   
        'transkripstatus' ,   
        'pembayaran' ,   
        'pembayaranstatus' ,  
        'status' ,   
        'feedback' ,   
        'mahasiswa_id' ,   
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }
}
