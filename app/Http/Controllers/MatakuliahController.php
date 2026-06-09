<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $matakuliahs = Matakuliah::with('jurusan')
            ->when($search, function ($query, $search) {
                return $query->where('nama_matakuliah', 'like', "%{$search}%")
                             ->orWhereHas('jurusan', function ($q) use ($search) {
                                 $q->where('nama_jurusan', 'like', "%{$search}%");
                             });
            })->paginate(10)->withQueryString();

        return view('matakuliah.index', compact('matakuliahs', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::all();

        return view('matakuliah.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_matakuliah' => 'required|string|max:100',
            'sks'             => 'required|integer|min:1|max:6',
            'id_jurusan'      => 'required|exists:jurusans,id_jurusan',
        ], [
            'nama_matakuliah.required' => 'Nama matakuliah wajib diisi.',
            'sks.required'             => 'SKS wajib diisi.',
            'sks.min'                  => 'SKS minimal 1.',
            'sks.max'                  => 'SKS maksimal 6.',
            'id_jurusan.required'      => 'Jurusan wajib dipilih.',
            'id_jurusan.exists'        => 'Jurusan yang dipilih tidak valid.',
        ]);

        Matakuliah::create($request->only('nama_matakuliah', 'sks', 'id_jurusan'));

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Data matakuliah berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $jurusans   = Jurusan::all();

        return view('matakuliah.edit', compact('matakuliah', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);

        $request->validate([
            'nama_matakuliah' => 'required|string|max:100',
            'sks'             => 'required|integer|min:1|max:6',
            'id_jurusan'      => 'required|exists:jurusans,id_jurusan',
        ], [
            'nama_matakuliah.required' => 'Nama matakuliah wajib diisi.',
            'sks.required'             => 'SKS wajib diisi.',
            'sks.min'                  => 'SKS minimal 1.',
            'sks.max'                  => 'SKS maksimal 6.',
            'id_jurusan.required'      => 'Jurusan wajib dipilih.',
            'id_jurusan.exists'        => 'Jurusan yang dipilih tidak valid.',
        ]);

        $matakuliah->update($request->only('nama_matakuliah', 'sks', 'id_jurusan'));

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Data matakuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->delete();

        return redirect()->route('matakuliah.index')
                         ->with('success', 'Data matakuliah berhasil dihapus.');
    }

    //print csv
    public function exportCsv(){
        $fileName = 'matakuliah.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',         
        ];

        $callback = function(){
         $file = fopen('php://output' , 'w');
         
         fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
         
         fputcsv($file, [
            'ID', 
            'Nama Matakuliah', 
            'SKS', 
            'Jurusan'], ';');
         
        $matakuliah = Matakuliah::with('jurusan')->get();

        foreach($matakuliah as $item){
            fputcsv($file, [
                $item->id_matakuliah,
                $item->nama_matakuliah,
                $item->sks,
                $item->jurusan->nama_jurusan ?? '-',
            ], ';');
        } 
        fclose($file);
    };  
        return response()->stream($callback, 200, $headers);
    }

    //print pdf
    public function print(){
        $matakuliah = Matakuliah::with('jurusan')->get();
        return view('matakuliah.print', compact('matakuliah'));
    }

    //print excel
    public function exportExcel(){
        $matakuliah = Matakuliah::with('jurusan')->get();

        return response()
        ->view('matakuliah.excel', compact('matakuliah'))
        ->header('content-Type', 'application/vnd.ms-excel')
        ->header('Content-Disposition', 'attachment; filename="matakuliah.xls"');
    }
}
