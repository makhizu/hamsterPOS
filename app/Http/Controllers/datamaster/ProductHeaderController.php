<?php

namespace App\Http\Controllers\datamaster;

use App\Http\Controllers\Controller;
use App\Http\Controllers\datamaster\ProductDetailController;
use Illuminate\Http\Request;
use App\Models\Jenis;
use App\Models\ProductDetail;
use App\Models\ProductHeader;
use App\Models\Size;
use App\Models\TipeModel; 
use App\Models\Warna;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

class ProductHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('datamaster.productheader', [
            'product_header' => ProductHeader::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jenis = Jenis::all();
        
        return view('datamaster.modal_create.Cproductheader', [
            'size' => Size::orderBy('nama_size', 'asc')->get(),
            'warna' => Warna::orderBy('nama_warna', 'asc')->get(),
            'jenis' => $jenis,
            'model' => TipeModel::orderBy('id_jenis', 'asc')->orderBy('nama_model', 'asc')->get()
        ]);
    }

    public function getModel(Request $request)
    {
        $selectedJenis  = $request->input('jenis');
        $models = TipeModel::where('id_jenis', $selectedJenis )->get();
    
        return response()->json(['models' => $models]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request;

        // return $data['kode_barang'];

        // $validator = Validator::make($request->all(), [
        //     'warna.*' => 'distinct', // Check for distinct values in the "warna" array
        // ]);
    
        // if ($validator->fails()) {
        //     return response()->json(['error' => 'Duplicate values found in the "warna" array.'], 422);
        // }
        $customeMessages = [
            'kode_barang.unique' => 'Kode Barang sudah dipakai, masukkan kode yang lain',
            // 'kode_barang.max' => 'Kode Barang Tidak boleh lebih besar dari 5 karakter',
            'warna.*.distinct' => 'Tidak boleh memilih warna yang sama'
        ]; 
            $validateData = $request->validate([            
                'id_ukuran' => 'required',
                'kode_model' => 'required',
                'kode_barang' => 'required|unique:product_headers|max:5',
                'nama_barang' => 'required',
                'hpp_barang' => 'required',
                'warna.*' => 'distinct',            
            ], $customeMessages);

            ProductHeader::create(
                [                
                    'id_ukuran' => $validateData['id_ukuran'],
                    'kode_model' => $validateData['kode_model'],
                    'kode_barang' => $validateData['kode_barang'],
                    'nama_barang' => $validateData['nama_barang'],
                    'hpp_barang' => $validateData['hpp_barang'],                
                    ]
                );

            $detail = new ProductDetailController();
            $datavalidate = $validateData;
            $datavalidate = $detail->store($request);
    
            // return $datavalidate;
                
        session()->flash('success', 'Data "'.$validateData['nama_barang'].'" Berhasil Ditambahkan.');
        return $this->index();   

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
        return 'masuk edit';
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
        // dd($id);
        $data = ProductHeader::find($id);
        
        // dd($data);
        // Check if the resource exists
        if (!$data) {
            return redirect()->back()->with('errorDelete', 'Data tidak ditemukan');
        }

        try {
            // Attempt to delete the record in the general_table
            $data->delete();
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                // Handle the case where a foreign key constraint prevents deletion
                return redirect()->back()->with('errorDelete', 'Data tidak bisa dihapus, hapus dulu data warna.');
            } else {
                // Handle other exceptions or errors
                return redirect()->back()->with('errorDelete', 'An error occurred.');
            }
        }

        // Delete the resource
        

        return redirect()->back()->with('successDelete', 'Data Berhasil Dihapus');
    }
}
