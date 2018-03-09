<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',[
            'except' => ['show', 'create', 'store', 'index', 'confirmEmail']
        ]);
    }

    //显示用户列表
    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    //显示用户注册页
    public function create()
    {
        return view('users.create');
    }

    //显示用户信息查看页
    public function show(User $user)
    {
        $statuses = $user->statuses()->orderBy('created_at', 'desc')->paginate(10);

        return view('users.show', compact('user', 'statuses'));
    }

    //显示用户信息编辑页

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    //用户注册操作
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');
    }

    //用户信息更新操作
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);

        $this->validate($request,[
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        $data = [];
        $data['name'] = $request->name;
        if($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        session()->flash('success', '个人资料更新成功');

        return redirect()->route('users.show', $user->id);
    }

    //用户删除操作
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户!');
        return back();
    }

    //用户激活账户操作
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    //发送激活邮件方法
    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        //$from = 'limin@gmail.com';
        //$name = 'Lee';
        $to = $user->email;
        $subject = '感谢注册 Sample 应用，请确认你的邮箱';

        Mail::send($view, $data, function ($message) use ($to, $subject){
            $message->to($to)->subject($subject);
        });
    }

    //显示粉丝列表
    public function followers(User $user)
    {
        $users = $user->followers()->paginate(10);
        $title = '粉丝';

        return view('users.show_follow', compact('users', 'title'));
    }

    //显示关注人列表
    public function followings(User $user)
    {
        $users = $user->followings()->paginate(10);
        $title = '关注的人';

        return view('users.show_follow', compact('users', 'title'));
    }
}
