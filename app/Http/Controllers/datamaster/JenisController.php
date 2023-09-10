<?php

namespace App\Http\Controllers\datamaster;

use App\Models\Jenis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class JenisController extends Controller
{
    public function index()
    {
        return view('datamaster.jenis', [
            'jenis' => Jenis::all()
        ]);
    }

    public function store(Request $request)
    {

        // return($request);

        $validateData = $request->validate([            
            'nama_jenis' => 'required',
            'deskripsi' => 'nullable|max:225'
        ]);

        // // Retrieve existing codes from the database table
        // $existingCodes = Jenis::pluck('kode_jenis')->toArray();

        // $KodeJenis = $this->generateUniqueCode($validateData['nama_jenis'], $existingCodes);

        // return $validateData;
        // return $KodeJenis;

        Jenis::create(
            [
                // 'kode_jenis' => $KodeJenis,
                'nama_jenis' => $validateData['nama_jenis'],
                'deskripsi' => $validateData['deskripsi'],
            ]
        );
        session()->flash('success', 'Data "'.$validateData['nama_jenis'].'" Berhasil Ditambahkan.');
        return back();
    }

    function generateUniqueCode($name, $existingCodes = []) {
        // Remove all non-alphanumeric characters and convert to uppercase
        $cleanedName = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $name));
    
        // Take the first four characters of the cleaned name or the entire cleaned name if it's shorter
        $prefix = Str::substr($cleanedName, 0, 4);
    
        // If the prefix is less than 4 characters, fill the rest with random uppercase letters
        $missingCharacters = 4 - Str::length($prefix);
        for ($i = 0; $i < $missingCharacters; $i++) {
            $randomLetter = chr(rand(65, 90)); // Random ASCII code for uppercase letters (A-Z)
            $prefix .= $randomLetter;
        }
    
        // Ensure the generated code is unique
        $uniqueCode = $prefix;
        $attempt = 1;
        while (in_array($uniqueCode, $existingCodes)) {
            $uniqueCode = $prefix . $attempt;
            $attempt++;
        }
    
        return $uniqueCode;
    }

    public function update(Request $request, $id)
    {
        $data = Jenis::find($id);
        // dd($request);
        // return $data;

        $rules = [
            'nama_jenis' => 'required',
            'deskripsi' => 'nullable|max:225'
        ];
        
        $validateData = $request->validate($rules);

        // return $validateData;
        Jenis::where('id', $id)->update($validateData);


        return redirect()->route('jenis.show')->with('successUpdate', 'Data Berhasil Di update');
    }

    public function delete($id)
    {
        // dd($id);
        $data = Jenis::find($id);

        // dd($data);
        // Check if the resource exists
        if (!$data) {
            return redirect()->route('jenis.show')->with('errorDelete', 'Data tidak ditemukan');
        }

        // Delete the resource
        $data->delete();

        return redirect()->route('jenis.show')->with('successDelete', 'Data Berhasil Dihapus');
    }
}
