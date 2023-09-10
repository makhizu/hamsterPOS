<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Models\TipeModel;
use App\Models\Size;
use App\Models\Jenis;
use App\Http\Controllers\Controller;

class TipeModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('datamaster.model', [
            'Model' => TipeModel::all(),
            'Jenis' => Jenis::all(),
            'Size' => Size::all()
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
        //   return($request);  
        
        $validateData = $request->validate([            
            'nama_model' => 'required',
            'id_jenis' => 'required',
            'deskripsi' => 'nullable|max:225'
        ]);

        $code = $this->generateProductCode($request['id_jenis']);
        // return($code);
        
        TipeModel::create(
            [
                'kode_model' => $code,
                'nama_model' => $validateData['nama_model'],
                'deskripsi' => $validateData['deskripsi'],
                'id_jenis' => $validateData['id_jenis']
            ]
        );
        session()->flash('success', 'Data "'.$validateData['nama_model'].'" Berhasil Ditambahkan.');
        return back();
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
        //
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
        // var_dump($id);
        // dd($id);
        // var_dump($request);
        $data = TipeModel::find($id);
        // dd($data);
        // return $data;

        $rules = [
            'nama_model' => 'required',
            'deskripsi' => 'nullable|max:225'
        ];
        
        $validateData = $request->validate($rules);

        // return $validateData;
        // dd($validateData);
        TipeModel::where('id', $id)->update($validateData);


        return redirect()->route('model.index')->with('successUpdate', 'Data Berhasil Di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $data = TipeModel::find($id);

        // dd($data);
        // Check if the resource exists
        if (!$data) {
            return redirect()->route('model.index')->with('errorDelete', 'Data tidak ditemukan');
        }

        // Delete the resource
        $data->delete();

        return redirect()->route('model.index')->with('successDelete', 'Data Berhasil Dihapus');
    }

    function generateProductCode($jenisId) {
        // Get the selected size
        $jenis = Jenis::find($jenisId);
        // dd($jenis);

        if (!$jenis) {
            return null; // Handle the case where the size doesn't exist
        }

        // Calculate the next available sequence for the selected size
        $lastProduct = TipeModel::where('id_jenis', $jenis->id)->orderBy('id', 'desc')->first();
        // dd($lastProduct);
        // Debugging: Check the values
        var_dump($lastProduct);

        if ($lastProduct) {
            $lastCode = $lastProduct->kode_model;

            // Debugging: Check the last code
            // var_dump($lastCode);
            // dd($lastCode);

            // Extract the numeric parts of the code using a regular expression pattern
            preg_match('/M(\d{2})(\d{3})/', $lastCode, $matches);
            $lastSizeCode = isset($matches[1]) ? intval($matches[1]) : 0;
            $lastSequenceCode = isset($matches[2]) ? intval($matches[2]) : 0;
            $nextSequenceCode = $lastSequenceCode + 1;

            // Debugging: Check the extracted values
            var_dump($lastSizeCode);
            var_dump($lastSequenceCode);
        } else {
            $lastSizeCode = $jenis->id;
            $nextSequenceCode = 1;
        }

        // Ensure that both the size code and sequence have two and three digits respectively, with leading zeros if needed
        $jenisCode = str_pad($lastSizeCode, 2, '0', STR_PAD_LEFT);
        $sequenceCode = str_pad($nextSequenceCode, 3, '0', STR_PAD_LEFT);

        // Debugging: Check the padded values
        var_dump($jenisCode);
        var_dump($sequenceCode);

        // Generate the code with the formatted size code and sequence
        $code = 'M' . $jenisCode . $sequenceCode;

        // Debugging: Check the final generated code
        var_dump($code);

        return $code;
    }
}
