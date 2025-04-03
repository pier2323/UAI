<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivoMovil extends Model
{
    use HasFactory;

    protected $table = 'archivo_moviles'; // Explicitly specify the table name

    protected $fillable = ['id', 'year', 'description', 'numero_archivo', 'año', 'codigo_auditoria'];
}
