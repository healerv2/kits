<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Kandidat;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Daftar Kandiat';
        activity()->log('akses daftar kandidat');

        return view('kandidat.index',compact('title'));
    }

    public function data()
    {
        $kandidat = Kandidat::orderBy('id', 'desc')->get();

        return datatables()
            ->of($kandidat)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kandidat) {
                return '
                <div class="btn-group">
                   <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" href="'. route('candidate.detail', encrypt($kandidat->id)) .'"><i class="fa fa-search-plus"></i></a>
                    <a class="btn btn-info btn-action mr-1" data-toggle="tooltip" href="'. route('candidate.edit', $kandidat->id) .'"><i class="fa fa-edit"></i></a>
                    <button onclick="deleteData(`'. route('candidate.destroy', $kandidat->id) .'`)" class="btn btn-danger btn-action" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
        $title = 'Kandiat';
        activity()->log('akses menu add kandidat');

        return view('kandidat.add',compact('title'));
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
        $kandidat = new Kandidat();
        $kandidat->nama_ketua = $request->nama_ketua;
        $kandidat->visi = $request->visi;
        $kandidat->misi = $request->misi;
        $kandidat->program_kerja = $request->program_kerja;

        if ($request->hasFile('photo_paslon')) {
            $file = $request->file('photo_paslon');
            $nama = 'kandidat-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/kandidat'), $nama);

            $kandidat->photo_paslon = "/kandidat/$nama";
        }
        
        $kandidat->save();
        if ($kandidat) {
            return redirect()->route('candidate.index')->with([
                'success' => true, 
                'message' => 'Data berhasil disimpan'
            ]);
        } else {
            return redirect()->route('candidate.index')->with([
                'message' => 'Terjadi kesalahan pada sistem error 500'
            ]);
        }

        // return response()->json([
        //     'success' => true, 
        //     'message' => 'Data berhasil disimpan' 
        // ]);
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
        $title = 'Kandiat';
        $kandidat = Kandidat::findOrFail($id);
        activity()->log('akses menu edit kandidat');

        return view('kandidat.edit',compact('title','kandidat'));
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
        $kandidat = Kandidat::findOrFail($id);
        #Check if uploaded file already exist in Folder
        if($request->hasFile('photo_paslon'))
        {
            #Get Image Path from Folder
           $file = public_path('kandidat/' . $kandidat->file);

            if(File::exists($file)) {
                File::delete($file);
            }

            $file = $request->file('photo_paslon');
            $nama = 'kandidat-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/kandidat'), $nama);
            $kandidat->photo_paslon = "/kandidat/$nama";
 
            $kandidat->nama_ketua = $request->nama_ketua;
            $kandidat->visi = $request->visi;
            $kandidat->misi = $request->misi;
            $kandidat->program_kerja = $request->program_kerja;
            $kandidat->update();

            return redirect()->route('candidate.index')->with('message', 'update successfully');
         }
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
        $kandidat = Kandidat::find($id);
           if($kandidat) {
            $file = public_path('kandidat/' . $kandidat->file);

            if(File::exists($file)) {
                File::delete($file);
            }
            $kandidat->delete();
            activity()->log('hapus data kandidat');
            return response()->json([
                'success' => true, 
                'message' => 'Data berhasil dihapus' 
            ]);
        } 
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan sistem. code 500'
        ]);
    }

    public function detail($id, Request $request)
    {

        $ID = decrypt($id);
        $kandidat = Kandidat::where('id',$ID, $request->segment((3)))->first();
        $title = 'Detail kandidat';
        activity()->log('akses detail kandidat');

        return view('kandidat.detail',compact('kandidat','title'));
    }
}
