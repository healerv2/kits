<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Carbon\Carbon;
use App\Models\Tutorial;
use App\Models\Kategori;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kategori = Kategori::all();
        $title = 'Tutorial';
        activity()->log('akses menu tutorial');

        return view('tutorial.index',compact('title','kategori'));
    }

    public function data()
    {
        $tutorial = Tutorial::with('kategori','user')->orderBy('id', 'desc')->get();

        return datatables()
            ->of($tutorial)
            ->addIndexColumn()
            ->editColumn('download', function ($tutorial) {
                if ($tutorial->status == 4)
                return '<a href="'.url('tutorial',$tutorial->file).'" target="_blank" class="btn btn-info btn-action"><i class=" fa fa-download"></i></a>';
            })
            ->addColumn('aksi', function ($tutorial) {
                if (auth()->user()->level == 1)
                return '
                <div class="btn-group">
                    <a class="btn btn-info btn-action mr-1" data-toggle="tooltip" href="'. route('tutorials.detail', $tutorial->id) .'"><i class="fa fa-search-plus"></i></a>
                    <button onclick="deleteData(`'. route('tutorials.destroy', $tutorial->id) .'`)" class="btn btn-danger btn-action" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                </div>
                ';
                else if (auth()->user()->level == 2)
                return '
                <div class="btn-group">
                <a class="btn btn-info btn-action mr-1" data-toggle="tooltip" href="'. route('tutorials.detail', $tutorial->id) .'"><i class="fa fa-search-plus"></i></a>
                <button onclick="deleteData(`'. route('tutorials.destroy', $tutorial->id) .'`)" class="btn btn-danger btn-action" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
                </div>
                ';
                else if (auth()->user()->level == 3)
                return '
                <p>tidak ada akses</p>
               ';
               else
               return '
               <p>tidak ada akses</p>
               ';
            })
            ->rawColumns(['aksi','download'])
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
        $title = 'Tutorial';
        $kategori = Kategori::all();
        activity()->log('akses menu add tutorial');

        return view('tutorial.add',compact('title','kategori'));
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
        $request->validate([
             'file' => 'required|mimes:pdf|max:2048'
        ]);

        if($request->hasFile('file')) {
            $uploadPath = public_path('tutorial');

            if(!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file = $request->file('file');
            $explode = explode('.', $file->getClientOriginalName());
            $originalName = $explode[0];
            $extension = $file->getClientOriginalExtension();
            $rename = 'tutorial_' . date('YmdHis') . '.' . $extension;
            $mime = $file->getClientMimeType();
            $filesize = $file->getSize();

            if($file->move($uploadPath, $rename)) {
                $tutorial = new Tutorial;
                $tutorial->name_tutorial = $request->name_tutorial;
                $tutorial->slug = SlugService::createSlug(Tutorial::class, 'slug', $request->name_tutorial);
                $tutorial->kategori_id = $request->kategori_id;
                $tutorial->users_id = auth()->id();
                $tutorial->name = $originalName;
                $tutorial->file = $rename;
                $tutorial->extension = $extension;
                $tutorial->size = $filesize;
                $tutorial->mime = $mime;
                $tutorial->save();

                activity()->log('add data tutorial');

                // return redirect()->route('tutorials.index');

                if ($tutorial) {
                    return redirect()
                    ->route('tutorials.index')
                    ->with([
                        'success' => 'success'
                    ]);
                } else {
                    return redirect()
                    ->back()
                    ->withInput()
                    ->with([
                        'error' => 'Some problem occurred, please try again'
                    ]);
                }

            }
            return response()->json([
                'success' => false, 
                'message' => 'Error, file tidak dapat di upload' 
            ]);

            //return redirect()->back()->with('message', 'Error, file tidak dapat di upload');
        }
        return response()->json([
                'success' => false, 
                'message' => 'Error, tidak ada file ditemukan' 
            ]);
        // return redirect()->back()->with('message', 'Error, tidak ada file ditemukan');
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
        //
            $tutorial = Tutorial::find($id);
            if($tutorial) {
                $file = public_path('tutorial/' . $tutorial->file);

                if(File::exists($file)) {
                    File::delete($file);
                }
                $tutorial->delete();
                activity()->log('hapus data tutorial');
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

    public function detail($title = 'Detail Tutorial ', Request $request)
    {

        $tutorial = Tutorial::with('kategori','user')->where('id', $request->segment((3)))->first();
        
        $params = [
            'title' => $title,
            'data' => $tutorial
        ];

        activity()->log('akses detail tutorial');

        return view('tutorial.detail',compact('tutorial','title','params'));
    }

    public function updatestatus(Request $request)
    {
       $tutorial = Tutorial::where('id', $request->id)->first();
       if ($tutorial == null) {
        return response()->json(['success' => false, 'message' => 'ID Tutorial tidak ditemukan']);
       }

       $tutorial->update([
        'status' => $request->status,
        'updated_at'=>Carbon::now()
    ]);
       activity()->log('update status tutorial');

       return response()->json([
        'success' => true, 
        'message' => 'Status berhasil diupdate' 
    ]);
   }
}
