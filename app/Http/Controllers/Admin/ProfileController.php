<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; // ←追加(松田メンター)

// 以下を追記することで、Profile Modelが扱えるようになる
use App\Profile;

class ProfileController extends Controller
{
    // 以下追記(add,create,edit,updateというアクションを追加)
    
    public function add()
    {
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        
        
        // 以下を追記(Lesson16 課題1)
        // validationを行う
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        
        unset($form['_token']);
        
        //　データベースに保存する
        $profile->fill($form);
        $profile->user_id = Auth::id(); // ←追加(松田メンター)
        $profile->save();
        // ここまで追記(Lesson16 課題1)
        
        return redirect('admin/profile/create');
    }
    
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        if ($cond_name != '') {
            // 検索されたら検索結果を出力する。
            $posts = Profile::where('name', $cond_name)->get();
        } else {
            // それ以外は全てのニュースを出力する。
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    
    public function edit(Request $request)
    {
        // 以下を追記(Lesson16 課題3)
        
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }
    
    public function update(Request $request)
    {
        // validationをかける
        $this->validate($request, Profile::$rules);
        // News Modelからデータを取得する
        $profile = Profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        
        $profile->fill($profile_form)->save();
        unset($profile_form['_token']);
        
        return redirect('admin/profile/');
    }
}
