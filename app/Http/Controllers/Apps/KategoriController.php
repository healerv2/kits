<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Kategori';
        activity()->log('akses menu kategori');

        return view('kategori.index',compact('title'));
    }

    public function data()
    {
        $kategori = Kategori::orderBy('id', 'desc')->get();

        return datatables()
            ->of($kategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('kategori.update', $kategori->id) .'`)" class="btn btn-primary btn-action mr-1" data-toggle="tooltip"><i class="fa fa-edit"></i></button>
                    <button onclick="deleteData(`'. route('kategori.destroy', $kategori->id) .'`)" class="btn btn-danger btn-action" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi'])
            ->make(true);
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
        //
        $findKategori = Kategori::where('nama_kategori', $request->nama_kategori)->first();
        if ($findKategori != null) {
            return response()->json([
            'success' => false, 
            'message' => 'Data kategori sudah tersimpan!' 
        ]);
        }

       activity()->log('add data kategori');

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->kode_kategori = $request->kode_kategori;
        $kategori->note_kategori = $request->note_kategori;
        $kategori->save();

        return response()->json([
            'success' => true, 
            'message' => 'Data berhasil disimpan' 
        ]);
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
        $kategori = Kategori::find($id);
        activity()->log('klik menu edit data kategori');

        return response()->json($kategori);
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
        //
        $kategori = Kategori::find($id);
        $kategori->nama_kategori = $request->nama_kategori;
        $kategori->kode_kategori = $request->kode_kategori;
        $kategori->note_kategori = $request->note_kategori;
        $kategori->update();

        activity()->log('update data kategori');

        return response()->json([
            'success' => true, 
            'message' => 'Data berhasil diupdate' 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
         try {
            $kategori = Kategori::find($id);
            $kategori->delete();
            activity()->log('hapus data angkatan');
            return response()->json([
                'success' => true, 
                'message' => 'Data berhasil dihapus' 
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. code 500'
            ]);
        }
    }
}
