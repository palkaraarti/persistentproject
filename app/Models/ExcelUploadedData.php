<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelUploadedData extends Model
{
    use HasFactory;
    protected $table = "excel-uploaded-data";
    protected $fillable = [
        'sapid','hostname','loopback','macaddress'
    ];
}
