<?php

namespace App\Http\Controllers\datamaster;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SizeController extends Controller
{
    public function index()
    {
        return view('datamaster.size', [
            'size' => Size::all()
        ]);
    }

    public function store(Request $request)
    {

        // return($request);

        $validateData = $request->validate([
            'nama_size' => 'required',
            'deskripsi' => 'nullable|max:225'
        ]);
        // return $validateData;

        Size::create(
            [
                'nama_size' => $validateData['nama_size'],
                'deskripsi' => $validateData['deskripsi'],
            ]
        );
        session()->flash('success', 'Data "'.$validateData['nama_size'].'" Berhasil Ditambahkan.');
        return back();
    }

    public function update(Request $request, $id)
    {
        $data = Size::find($id);
        // dd($request);
        // return $data;

        $rules = [
            'nama_size' => 'required',
            'deskripsi' => 'nullable|max:225'
        ];
        
        $validateData = $request->validate($rules);

        // return $validateData;
        Size::where('id', $id)->update($validateData);


        return redirect()->route('size.show')->with('successUpdate', 'Data Berhasil Di update');
    }

    public function delete($id)
    {
        // dd($id);
        $data = Size::find($id);

        // dd($data);
        // Check if the resource exists
        if (!$data) {
            return redirect()->route('size.show')->with('errorDelete', 'Data tidak ditemukan');
        }

        // Delete the resource
        $data->delete();

        return redirect()->route('size.show')->with('successDelete', 'Data Berhasil Dihapus');
    }
}
