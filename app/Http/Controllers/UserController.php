<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\User;
use Auth;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function be_user_page()
    {
        return view('be.be_user');
    }

    public function be_user_store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'name'          => 'required',
            'password'      => 'required|max:100',            
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status'    => 400,
                'message'   => 'Ada Kesalahan',
                'errors'    => $validator->messages(),
            ]);

        }else {
            # code...
            $datas          = User::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'name'      => $request->name,
                    'password' => Hash::make($request->password),
                    'role'      => 'admin'
                ]
            );
            return response()->json(
                [
                    'datas'   => $datas,
                    'status'  => 200,
                    'message' => 'New User Has Been Added'
                ]
            );
        }
    }

    public function be_user_data(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('id','desc')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($data){
                    if ($data->id == auth()->user()->id) {
                        # code...
                        return "-";
                    }else {
                        # code...
                        $actionBtn= ' <a data-target="#modaldel" data-id="'.$data->id.'" data-toggle="modal" href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                        return $actionBtn;
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function be_user_dell(Request $request)
    {
        $data_id            =   $request->id;
        $data_user_id       =   $request->uid;
        if ($data_id        ==  $data_user_id) {
            # code...
            
            return response()->json(
                [
                    'status'  => 400,
                    'message' => 'Gagal'
                ]
            );
           
        }else {
            # code...
            $data = User::where('id', $request->id)->delete();
            return response()->json(
                [
                    'datas'   => $data,
                    'status'  => 200,
                    'message' => 'User has been deleted'
                ]
            );
            
        }
        
    }
}
