<?php

namespace App\Http\Controllers;
use App\Models\Bg;
use App\Models\aplikasi_bg;
use App\Models\Aplikasi;
use Validator;
use Image;
use Illuminate\Http\Request;

class BGController extends Controller
{
    public function be_bg_page(Request $request)
    {
        $background = Bg::all();
        return view('be.be_background',compact('background'));
    }

    public function be_bg_delete(Request $request)
    {
        Bg::where('id', $request->id)->delete();
        return response()->json(
            [
              'status'  => 200,
              'message' => 'Background has ben deleted'
            ]
        );
    }

    public function be_bg_get(Request $request)
    {
        if(request()->ajax())
        {
            $datas = Bg::orderBy('id','asc')->get();
            return response()->json($datas,200);
        }
    }

    public function be_bg_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'img'       => 'nullable|mimes:jpeg,jpg,png,gif',
            'img_thumb' => 'nullable|mimes:jpeg,jpg,png,gif',         
        ]);

        if ($validator->fails()) {
            # code...
            return response()->json([
                'status' => 400,
                'message'  => 'Response Gagal',
                'errors' => $validator->messages(),
            ]);
        }else {
            # code...
            if ($request->img !== null) {
                # code...
                $filename = time().'.'.$request->img->getClientOriginalExtension();
                // lokasi folder
                $destinationPath  = public_path('/bg_img_thumb');
                // resize & compress thumnail
                $imgFile = Image::make($request->img->getRealPath());
                $imgFile->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destinationPath.'/'.$filename);
                // original image folder
                $request->img->move(public_path('bg_img_ori'), $filename);
                
                # code...
                $data   = Bg::updateOrCreate(
                    [
                        'id'        => $request->id
                    ],
                    [
                        'bg'        => $filename,
                        'bg_thumb'  => $filename
                    ]
                );
            }

            return response()->json(
                [
                  'status'  => 200,
                  'message' => 'Background has ben stored'
                ]
            );
        }
    }

    public function be_add_bg(Request $request)
    {
        $app = Aplikasi::where('id', $request->aplikasi_id)->first();
        $bgs = Bg::where('id', $request->bg_id)->first();
        if ($app->bg == null) {
            # code...
            $app->bg()->attach($bgs);
        }else {
            # code...
            $bg_ada = aplikasi_bg::where('aplikasi_id', $request->aplikasi_id)->delete();
            $app->bg()->attach($bgs);
        }

        return redirect()->back();
    }

    public function be_bg_app_data(Request $request)
    {
        if(request()->ajax())
        {
            $datas = Aplikasi::where('user_id', auth()->user()->id)->first();
            if ($datas->bg == null) {
                # code...
                return response()->json(
                    [
                        'status'  => 400,
                        'message' => 'Belum ada Bacground'
                    ]
                );
            }else {
                # code...
                return response()->json(
                    [
                        $datas,
                        'status'  => 200,
                        'message' => 'Background set'
                    ]
                );
            }
        }
    }
}
