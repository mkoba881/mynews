<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下の1行を追記することで、Profile Modelが扱えるようになる
use App\Models\Profile;
// 以下を追記
use App\Models\HistoryProfile;
use Carbon\Carbon;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        // 以下を追記
        // Validationを行う
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        
        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        
        // データベースに保存する
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }

    public function edit(Request $request)
    {
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
        
    public function update(Request $request)
    {
        //dd('アップデートが呼ばれた');
                // Validationをかける
        $this->validate($request, Profile::$rules);
        // News Modelからデータを取得する
        $profile = Profile::find($request->id);
        //dd($profile);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        //dd($profile_form);
        // データベースにない属性をはずす
        unset($profile_form['_token']);
        //dd($profile_form);
        // 該当するデータを上書きして保存する
        //dd($profile->fill($profile_form));
        $profile->fill($profile_form)->save();
        //dd('プロフィールを更新した。');

        // 以下を追記
        $historyprofile = new HistoryProfile();
        $historyprofile->profile_id = $profile->id;
        $historyprofile->edited_at = Carbon::now();
        //dd($historyprofile);
        $historyprofile->save();
        //dd('プロフィール編集履歴成功');

        return redirect('admin/profile');
    }

    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Profile::where('name', $cond_title)->get();
        } else {
            // それ以外はすべてのプロフィールを取得する
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }



    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $profile = Profile::find($request->id);

        // 削除する
        $profile->delete();

        return redirect('admin/profile/');
    }
}