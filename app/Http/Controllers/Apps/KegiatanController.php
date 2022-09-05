<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use App\Models\Kegiatan;
use App\Jobs\KegiatanNotif;
use Carbon\Carbon;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Kegiatan';
        $kegiatan = Kegiatan::latest()->paginate(8);
        activity()->log('akses menu kegiatan');

        return view('kegiatan.index',compact('title','kegiatan'));
    }

     public function list()
    {
        //
        $title = 'List Kegiatan';
        activity()->log('akses menu list kegiatan');

        return view('kegiatan.list',compact('title'));
    }

    public function data()
    {
        $kegiatan = Kegiatan::with('user')->orderBy('id', 'desc')->get();

        return datatables()
            ->of($kegiatan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kegiatan) {
                return '
                <div class="btn-group">
                    <a class="btn btn-info btn-action mr-1" data-toggle="tooltip" href="'. route('kegiatans.detail', $kegiatan->slug) .'"><i class="fa fa-search-plus"></i></a>
                    <button onclick="deleteData(`'. route('kegiatans.destroy', $kegiatan->id) .'`)" class="btn btn-danger btn-action" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
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
        $title = 'Kegiatan';
        //$kategori = Kategori::all();
        activity()->log('akses menu add kegiatan');

        return view('kegiatan.add',compact('title'));
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
           'file' => 'required|mimes:pdf,jpeg,jpg,png|max:2048'
       ]);

        if($request->hasFile('file')) {
            $uploadPath = public_path('kegiatan');

            if(!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file = $request->file('file');
            $explode = explode('.', $file->getClientOriginalName());
            $originalName = $explode[0];
            $extension = $file->getClientOriginalExtension();
            $rename = 'kegiatan_' . date('YmdHis') . '.' . $extension;
            $mime = $file->getClientMimeType();
            $filesize = $file->getSize();

            if($file->move($uploadPath, $rename)) {
                $kegiatan = new Kegiatan;
                $kegiatan->name_kegiatan = $request->name_kegiatan;
                $kegiatan->slug = SlugService::createSlug(Kegiatan::class, 'slug', $request->name_kegiatan);
                $kegiatan->tanggal_kegiatan = $request->tanggal_kegiatan;
                $kegiatan->detail_kegiatan = $request->detail_kegiatan;
                $kegiatan->users_id = auth()->id();
                $kegiatan->name = $originalName;
                $kegiatan->file = $rename;
                $kegiatan->extension = $extension;
                $kegiatan->size = $filesize;
                $kegiatan->mime = $mime;
                $kegiatan->save();

                activity()->log('add data kegiatan');

                KegiatanNotif::dispatch($kegiatan->id)->delay(Carbon::create($kegiatan->tanggal_kegiatan)->subDays(7));
                KegiatanNotif::dispatch($kegiatan->id)->delay(Carbon::create($kegiatan->tanggal_kegiatan)->subDays(1));

                if ($kegiatan) {
                    return redirect()
                    ->route('kegiatans.index')
                    ->with([
                        'success' => true, 
                        'message' => 'Data berhasil disimpan'
                    ]);
                } else {
                    return redirect()
                    ->back()
                    ->withInput()
                    ->with([
                        'message' => 'Terjadi kesalahan pada sistem error 500'
                    ]);
                }

            }
            return response()->json([
                'success' => false, 
                'message' => 'Error, file tidak dapat di upload' 
            ]);

        }
        return response()->json([
            'success' => false, 
            'message' => 'Error, tidak ada file ditemukan' 
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
           $kegiatan = Kegiatan::find($id);
           if($kegiatan) {
            $file = public_path('kegiatan/' . $kegiatan->file);

            if(File::exists($file)) {
                File::delete($file);
            }
            $kegiatan->delete();
            activity()->log('hapus data kegiatan');
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

    public function detail( Request $request)
    {

        $kegiatan = Kegiatan::with('user')->where('slug', $request->segment((3)))->first();
        $title = 'Detail kegiatan';
        activity()->log('akses detail kegiatan');

        return view('kegiatan.detail',compact('kegiatan','title'));
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $title = 'Detail kegiatan';
        activity()->log('mencari data kegiatan');
        $kegiatan = Kegiatan::where('name_kegiatan', 'like', "%" . $keyword . "%")->paginate(8);
        return view('kegiatan.index', compact('kegiatan','title'))->with('i', (request()->input('page', 1) - 1) * 8);
    }
}
