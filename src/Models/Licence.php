<?php
namespace Marvelous\Licence\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Licence extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'loga_licences';

    protected $fillable = [
        'model_id', 'model', 'licence_key', 'licence', 'client_email', 'expires_at'
    ];
}
