<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class telegramMensagem extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_telegram_id',
        'mensagem'
    ];
}
