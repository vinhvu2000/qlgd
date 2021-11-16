<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function room()
    {
        return view('admin.room');
    }

    public function device()
    {
        return view('admin.device');
    }

    public function chat()
    {
        return view('admin.chat');
    }

    public function user(Request $request)
    {
        if($request->ajax()){
            $data = User::select('id', 'name', 'email', 'role')->get();
            return Datatables::of($data)->addColumn('action', function ($row) {
                                            $deletebtn = '<a class="btn btn-primary btn-sm" href=""><i class="fa fa-pencil"></i></a> <a class="btn btn-secondary btn-sm" href=""><i class="fa fa-trash-o"></i></a>';
                                            return $deletebtn;
                                            })
                                        ->rawColumns(['action'])
                                        ->make(true);
        }
        if (view()->exists('admin.user')) {
            return view('admin.user');
         }
    
        return abort('404');
    }

    public function support()
    {
        return view('admin.support');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function tableUser()
    {
        
    }
}
