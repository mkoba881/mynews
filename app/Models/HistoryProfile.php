<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryProfile extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');
    
    // ★テーブル名を指定、ここはなぜ必要なのか後で質問するようにする。★
    protected $table = 'mynews.historiesprofile';

    public static $rules = array(
        'profile_id' => 'required',
        'edited_at' => 'required',
    );
}
