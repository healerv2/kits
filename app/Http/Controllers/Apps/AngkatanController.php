<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Angkatan;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Angkatan Kits';
        activity()->log('akses menu angkatan');

        return view('angkatan.index',compact('title'));
    }

    public function data()
    {
        $angkatan = Angkatan::orderBy('id', 'desc')->get();

        return datatables()
            ->of($angkatan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($angkatan) {
                return '
                <div class="btn-group">
                    <button onclick="editForm(`'. route('angkatan.update', $angkatan->id) .'`)" class="btn btn-primary btn-action mr-1" data-toggle="tooltip"><i class="fa fa-edit"></i></button>
                    <button onclick="deleteData(`'. route('angkatan.destroy', $angkatan->id) .'`)" class="btn btn-danger btn-action" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
        $findAngkatan = Angkatan::where('nama_angkatan', $request->nama_angkatan)->first();
        if ($findAngkatan != null) {
            return response()->json([
            'success' => false, 
            'message' => 'Data angkatan sudah tersimpan!' 
        ]);
        }
        activity()->log('add data angkatan');

        $angkatan = new Angkatan();
        $angkatan->nama_angkatan = $request->nama_angkatan;
        $angkatan->note_angkatan = $request->note_angkatan;
        $angkatan->save();

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
        $angkatan = Angkatan::find($id);
        activity()->log('klik menu edit data angkatan');

        return response()->json($angkatan);

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
        $angkatan = Angkatan::find($id);
        $angkatan->nama_angkatan = $request->nama_angkatan;
        $angkatan->note_angkatan = $request->note_angkatan;
        $angkatan->update();

        activity()->log('update data angkatan');

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
            $angkatan = Angkatan::find($id);
            $angkatan->delete();
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
