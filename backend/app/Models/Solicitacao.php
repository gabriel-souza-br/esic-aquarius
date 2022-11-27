<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{
    protected $table = 'solicitacao';
    public $timestamps = false;
    protected $fillable = [
        'user_id', 'assunto',
        'solicitacao', 'rascunho',
        'criacao', 'inativacao',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\Vo\User');
    }
}
