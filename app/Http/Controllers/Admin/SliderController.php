<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SliderModel;
use Validator;
use Image;
use DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Slider Website - Admin';
        $data = SliderModel::get();
        return view('admin.slider')->with([
            'data' => $data,
            'title' => $title,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required',
                'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',

            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }
        $a = $request['judul'];
        $b = $request['file'];

        $file = $request->file('file');
        $inputdua['imagename'] = time() . '.' . $file->extension();
        $destinationPath = public_path('berkas/slider/thumbnail');
        $img = Image::make($file->path());
        $img->resize(800, 8000, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $inputdua['imagename']);
        $destinationPath = public_path('berkas/slider');
        $file->move($destinationPath, $inputdua['imagename']);

        $simpan = SliderModel::create([

            "judul" => $a,
            "slider" => $inputdua['imagename'],

        ]);
        return redirect()->route('slider.index')->with('message', 'Data Berhasil Disimpan');
    }

    public function updatedata(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required',
            ],

        );

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first(),);
        }

        $id = $request['id'];
        $a = $request['judul'];
        $g = $request['file'];



        if ($g != null) {
            $validator = Validator::make(
                $request->all(),
                [
                    'file' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                ],

            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first(),);
            }
            $file = $request->file('file');
            $inputdua['imagename'] = time() . '.' . $file->extension();
            $destinationPath = public_path('berkas/slider/thumbnail');
            $img = Image::make($file->path());
            $img->resize(800, 8000, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $inputdua['imagename']);
            $destinationPath = public_path('berkas/slider');
            $file->move($destinationPath, $inputdua['imagename']);

            $user = SliderModel::findOrFail($id);
            $user->update([

                "judul" => $a,
                "slider" => $inputdua['imagename'],

            ]);
            return redirect()->route('slider.index')->with('message', 'Data Berhasil Disimpan');
        } else {

            $user = SliderModel::findOrFail($id);
            $user->update([

                "judul" => $a,



            ]);
            return redirect()->route('slider.index')->with('message', 'Data Berhasil Disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Data Slider - Admin';


        $data = SliderModel::where('id', $id)->first();

        return view('admin.slideredit')->with([
            'data' => $data,
            'title' => $title,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fungsi eloquent untuk menghapus data
        SliderModel::find($id)->delete();
        return redirect()->route('slider.index')
            ->with('message', 'Data Berhasil Dihapus');
    }
}
