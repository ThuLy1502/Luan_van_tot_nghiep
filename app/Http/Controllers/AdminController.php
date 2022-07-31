<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Admin\CreateFormRequest;
use App\Http\Services\Admin\AdminService;
use App\Models\Admin;

use Session;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    public function index()
    {
        return view('admin.login', [
            'title' => 'Đăng Nhập Hệ Thống'
        ]);
    }

    // Hàm xác thực đã đăng nhập
    public function auth()
    {
        // Nếu đã đăng nhập thì sẽ sinh ra một admin_id
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return redirect('admin/main');
        } else {
            return redirect('admin/login')->send();
        }
    }

    public function main()
    {
        $this->auth();
        return view('admin.home', [
            'title' => "Trang Admin"
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result = $this->adminService->login($request);

        return redirect()->route('admin');
    }

    public function logout(Request $request)
    {
        $this->auth();
        $result = $this->adminService->logout($request);
        
        return redirect('admin/login');
    }
}
