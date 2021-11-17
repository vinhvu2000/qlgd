<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Hash;


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
                                            // return '<a class="btn btn-success btn-sm" href=""><i class="fa fa-pencil"></i></a> 
                                            // <a class="btn btn-secondary btn-sm" href="{{route(\'admin.deleteUser\',$row->id)}}">
                                            // <i class="fa fa-trash-o"></i>
                                            // </a>
                                            // <form action="{{ route(\'admin.deleteUser\',' . $row->id . ') }}" method="POST">
                                            // '.csrf_field().'
                                            // '.method_field("DELETE").'
                                            // <button type="submit" class="btn btn-danger"
                                            //     onclick="return confirm(\'Are You Sure Want to Delete?\')"
                                            //     style="padding: .0em !important;font-size: xx-small;">X</a>
                                            // </form>';
                                            $actionBtn = '<a href="'.route('admin.editUser',$row->id).'" class="btn btn-success btn-sm"> <i class="fa fa-pencil"></i> </a> 
                                            <a href="'.route('admin.deleteUser',$row->id).'" class="btn btn-secondary btn-sm"><i class="fa fa-trash-o"></i></a>';
                                            return $actionBtn;
                                            })
                                        ->rawColumns(['action'])
                                        ->make(true);
        }
        if (view()->exists('admin.user')) {
            return view('admin.user');
        }
    
        return abort('404');
    }

    public function addUser(Request $request)
    {
        if($request->file('file')){
            Excel::import(new UsersImport, $request->file('file'));
        }
        else{
            $data = $request->input();
            $user = new User([
                'name'     => $data['name'],
                'email'    => $data['email'], 
                'role'     => $data['role'],
                'password' => Hash::make('12345678'),
             ]);
            $user->save();
            return back();
        }
    }

    public function editUser($id)
    {
        echo '<pre>';
        var_dump("Edit $id");
        echo '</pre>';
        die();
    }

    public function deleteUser($id)
    {
        echo '<pre>';
        var_dump("Delete $id");
        echo '</pre>';
        die();
    }
    public function support()
    {
        return view('admin.support');
    }

    public function settings()
    {
        return view('admin.settings');
    }

}
