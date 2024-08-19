<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $userService;
    public function __construct() {}

    public function index(Request $request)
    {

        $users = DB::table('users')->when($request->role !== null && $request->role !== '', function ($row) use ($request) {
            return $row->where('status_role', $request->role);
        })
            ->when($request->keyword !== null, function ($row) use ($request) {
                if ($request->search_type == 0) {
                    return $row->where('fullname', 'LIKE', '%' . $request->keyword . '%');
                } elseif ($request->search_type == 1) {
                    return $row->where('email', 'LIKE', '%' . $request->keyword . '%');
                } elseif ($request->search_type == 2) {
                    return $row->where('phone', 'LIKE', '%' . $request->keyword . '%');
                }
            })
            ->paginate(10);
        $template = 'user.index';
        $config = [
            'js' => [
                asset('/template/js/plugins/switchery/switchery.js')
            ],
            'css' => [
                asset('/template/css/plugins/switchery/switchery.css'),
            ],
            'seo' => config('apps.users')
        ];

        return view('dashboard/layout', compact(
            'template',
            'config',
            'users',
        ))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        $template = 'user.create';
        $config['seo'] = config('apps.users');
        return view('dashboard/layout', compact(
            'template',
            'config'
        ));
    }

    public function store(UserRequest $request)
    {
        $user = new User();
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = Hash::make($request->input('password'));
        $file = $request->file('avatar');
        $allowedImageExtensions = ['jpg', 'jpeg', 'png'];
        $extension = $file->getClientOriginalExtension();

        if (in_array($extension, $allowedImageExtensions)) {
            $filename = time() . '.' . $extension;
            $file->move(public_path('images/user'), $filename);
            $user->image = $filename;
        } else {
            return back()->with('message', 'File avatar không hợp lệ. Chỉ chấp nhận các định dạng: jpg, jpeg, png.')->with('type', 'error');
        }
        $user->status_role = $request->input('status_role');
        $user->save();
        return redirect()->back()->with('message', 'Thêm người dùng thành công')->with('type', 'success');
    }
    public function edit($id)
    {
        $template = 'user.edit';
        $config['seo'] = config('apps.users');
        $user =  User::find($id);
        return view('dashboard/layout', compact(
            'user',
            'template',
            'config'
        ));
    }

    public function update(Request $request, $id)
    {
        $user =  User::find($id);
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        if ($request->input('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        if ($request->hasFile('avatar')) {
            $oldfile = asset('images/user/' . $user->image);
            if (File::exists($oldfile)) {
                File::delete($oldfile);
            }

            $file = $request->file('avatar');
            $allowedImageExtensions = ['jpg', 'jpeg', 'png'];
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, $allowedImageExtensions)) {
                $filename = time() . '.' . $extension;
                $file->move(public_path('images/user'), $filename);
                $user->image = $filename;
            } else {
                return back()->with('message', 'File avatar không hợp lệ. Chỉ chấp nhận các định dạng: jpg, jpeg, png.')->with('type', 'error');
            }
        }
        if ($request->hasFile('status_role')) {
            $user->status_role = $request->input('status_role');
        }
        $user->update();
        return redirect()->back()->with('message', 'Cập nhật người dùng thành công')->with('type', 'success');
    }

    public function updatePass(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->input('password')) {
            if ($user->password == $request->input('oldpassword')) {
                $user->password = Hash::make($request->input('password'));
                $user->update();
                return redirect()->route('auth.admin')->with('message', 'Cập nhật mật khẩu mới thành công')->with('type', 'success');
            } else {
                return redirect()->back()->with('message', 'Mật khẩu cũ không chính xác')->with('type', 'error');
            }
        } else {
            return redirect()->back()->with('message', 'Nhập đầy đủ thông tin')->with('type', 'error');
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('user.index')->with('message', 'Người dùng không tồn tại')->with('type', 'error');
        }

        if ($user->id == 1) {
            return redirect()->route('user.index')->with('message', 'Không thể chuyển trạng thái cho tài khoản quản trị')->with('type', 'error');
        } else {
            if ($user->status_disable == 0) {
                $user->status_disable = 1;
                $user->save();
            } elseif ($user->status_disable == 1) {
                $user->status_disable = 0;
                $user->save();
            }
        }
        return redirect()->route('user.index')->with('message', 'Trạng thái được cập nhật')->with('type', 'success');
    }
}
