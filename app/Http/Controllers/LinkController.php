<?php

namespace App\Http\Controllers;
use App\Models\Link;
use Validator;
use App\Models\Subsosmed;
use Auth;
use Image;
use App\Models\Aplikasi;
use App\Models\Sosmed;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Bg;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function be_link_page()
    {
        $datas_sosmed   = Sosmed::all();
        $sub_sosmed     = Subsosmed::all();
        $datas          = Link::orderBy('id','asc')->get();
        $bg             = Bg::all();
        
        return view('be.be_tautan',compact('datas','sub_sosmed','datas_sosmed','bg'));
    }

    public function be_link_dell(Request $request)
    {
        $datas = Link::where('id', $request->id)->delete();
        return response()->json(
            [
                'datas'   => $datas,
                'status'  => 200,
                'message' => 'Link Tautan Has Been Deleted'
            ]
        );
    }

    public function be_link_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'max:30',
            'link'      => 'max:100',
            'urutan'    => 'max:5',
            'status'    => 'max:5',
            'icon'      => 'max:20',            
        ]);
    
        if ($validator->fails()) {

            return response()->json([
                'status'    => 400,
                'message'   => 'Ada Kesalahan',
                'errors'    => $validator->messages(),
            ]);

        }else {
            # code...
            $data       = Link::latest()->first();
            if ($data   == null) {
                # code...
                $urutan = 1;
            }else {
                $urutan = $data->id+1;
            }
            $datas      = Link::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'user_id'       => Auth::id(),
                    'name'          => $request->name,
                    'link'          => $request->link,
                    'urutan'        => $urutan,
                    'status'        => 'tampil',
                    'icon'          => $request->icon,
                ]
            );

            return response()->json(
                [
                    'datas'   => $datas,
                    'status'  => 200,
                    'message' => 'Link Tautan Has Been Updated'
                ]
            );
        }
    }

    public function be_link_data(Request $request)
    {
        if(request()->ajax())
        {
            $datas = Link::orderBy('id','asc')->get();
            return response()->json($datas,200);
        }
    }

    public function be_subsosmed_data(Request $request)
    {
        if(request()->ajax())
        {
            $datas = Subsosmed::orderBy('id','asc')->with('sosmed')->get();
            return response()->json($datas,200);
        }
    }

    public function be_subsosmed_store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'sosmed_id' => 'required',
            'link'      => 'required|max:100',            
        ]);
    
        if ($validator->fails()) {

            return response()->json([
                'status'    => 400,
                'message'   => 'Ada Kesalahan',
                'errors'    => $validator->messages(),
            ]);

        }else {
            # code...
            $datas      = Subsosmed::updateOrCreate(
                [
                    'id' => $request->id
                ],
                [
                    'user_id'   => $request->user_id,
                    'sosmed_id' => $request->sosmed_id,
                    'link'      => $request->link,
                ]
            );

            return response()->json(
                [
                    'datas'   => $datas,
                    'status'  => 200,
                    'message' => 'Sosmed Has Been Added'
                ]
            );
        }
    }

    public function be_subsosmed_dell(Request $request)
    {
        $datas = Subsosmed::where('id', $request->id)->delete();
        return response()->json(
            [
                'datas'   => $datas,
                'status'  => 200,
                'message' => 'Social Media Icon Has Been Deleted'
            ]
        );
    }

    public function be_aplikasi_store(Request $request)
    {
        $validator = Validator::make($request->all(), [            
            'user_id'   => 'required',
            'name'      => 'required|max:100',
            'slug'      => 'required',
            'deskripsi' => 'max:50',
            'img'       => 'mimes:jpeg,jpg,png,gif,svg',
        ]);
    
        if ($validator->fails()) {

            return response()->json([
                'status'    => 400,
                'message'   => 'Ada Kesalahan',
                'errors'    => $validator->messages(),
            ]);

        }else {
            # code...
            $slug       = Str::slug($request->slug);
            $data       = Aplikasi::where('slug',$slug);

            if ($request->img !== null) {
                # code...
                $filename = time().'.'.$request->img->getClientOriginalExtension();
                // lokasi folder
                $destinationPath  = public_path('/be_img_aplikasi_thumb');
                // resize & compress thumnail
                $imgFile = Image::make($request->img->getRealPath());
                $imgFile->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
                })->save($destinationPath.'/'.$filename);
                // original image folder
                $request->img->move(public_path('be_img_aplikasi'), $filename);
                
                // store data
                $datas      = Aplikasi::updateOrCreate(
                    [
                        'user_id'   => $request->user_id,
                    ],
                    [
                        'user_id'   => Auth::id(),
                        'name'      => $request->name,
                        'slug'      => $slug,
                        'deskripsi' => $request->deskripsi,
                        'img'       => $filename
                    ]
                );

            }else {
                # code...
                $datas      = Aplikasi::updateOrCreate(
                    [
                        'user_id' => $request->user_id
                    ],
                    [
                        'user_id'   => Auth::id(),
                        'name'      => $request->name,
                        'slug'      => $slug,
                    ]
                );
            }
            

            return response()->json(
                [
                    'datas'   => $datas,
                    'status'  => 200,
                    'message' => 'Aplikasi Name & Image Has Been Added'
                ]
            );
        }
    }

    public function be_aplikasi_data(Request $request)
    {
        $data = Aplikasi::where('user_id', Auth::id())->first();
        $url=asset("be_img_aplikasi/".$data->img); 
        return response()->json('
        <div>
            <img id="preview" src="'.$url.'" 
            style="margin-left: 103px; margin-top:60px" alt="Admin" class="rounded-circle p-1" width="80">
            <h5 style="text-align: center; font-size: 14px; margin-top: 10px" id="nama_aplikasi">
                '.$data->name.'
            </h5>
            <p style="text-align: center; font-size: 11px; margin-top: 10px" id="nama_aplikasi">
                '.$data->deskripsi.'
            </p>
        </div>
            ', 200);
    }

    public function be_get_link(Request $request)
    {
        $user_id = Auth::id();
        $data= Aplikasi::where('user_id',$user_id)->first();
        if ($data !== null) {
            # code...
            return response()->json(
                $data->slug
            );
        }else {
            # code...
            return response()->json('kosong');
        }
    }

    //validasi link social media & tautan
    
}
