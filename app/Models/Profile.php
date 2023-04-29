<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    // 以下を追記
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
}

class Profile extends Model
{
    use HasFactory;
    // 以下を追記
    protected $guarded = array('id');

    // ★テーブル名を指定、ここはなぜ必要なのか後で質問するようにする。★
    protected $table = 'mynews.profile';

    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
    );
    
    // Profile Modelに関連付けを行う
    public function historiesprofile()
    {
        return $this->hasMany('App\Models\HistoryProfile');
    }
}
