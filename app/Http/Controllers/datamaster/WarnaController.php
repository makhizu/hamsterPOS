<?php

namespace App\Http\Controllers\datamaster;

use App\Models\Warna;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WarnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('datamaster.warna', [
            'warna' => Warna::all()
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
        // return($request);
        $errorMessage = [
            'nama_warna.unique' => 'Warna <strong>'. e($request['nama_warna']). '</strong> sudah ada'
        ];
        $validateData = $request->validate([
            'nama_warna' => 'required|unique:warnas',
            'deskripsi' => 'nullable|max:225'
        ], $errorMessage);
        // return $validateData;
        

        Warna::create(
            [
                'nama_warna' => $validateData['nama_warna'],
                'deskripsi' => $validateData['deskripsi'],
            ]
        );
        session()->flash('success', 'Data "'.$validateData['nama_warna'].'" Berhasil Ditambahkan.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warna  $warna
     * @return \Illuminate\Http\Response
     */
    public function show(Warna $warna)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warna  $warna
     * @return \Illuminate\Http\Response
     */
    public function edit(Warna $warna)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warna  $warna
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warna $warna)
    {
        // var_dump($id);
        // dd($id);
        // var_dump($request);
        $data = Warna::find($warna['id']);
        // dd($data);
        // return $data;

        $rules = [
            // 'nama_model' => 'required',
            'deskripsi' => 'nullable|max:225'
        ];
        
        $validateData = $request->validate($rules);

        // return $validateData;
        // dd($validateData);
        Warna::where('id', $warna['id'])->update($validateData);


        return redirect()->route('warna.index')->with('successUpdate', 'Data Berhasil Di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warna  $warna
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warna $warna)
    {
                // dd($warna['id']);
                $data = Warna::find($warna['id']);

                // dd($data);
                // Check if the resource exists
                if (!$data) {
                    return redirect()->route('warna.index')->with('errorDelete', 'Data tidak ditemukan');
                }
        
                // Delete the resource
                $data->delete();
        
                return redirect()->route('warna.index')->with('successDelete', 'Data Berhasil Dihapus');
    }
}
