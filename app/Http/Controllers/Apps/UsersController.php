<?php

namespace App\Http\Controllers\Apps;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Angkatan;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Data Users';
        activity()->log('akses menu user');
        return view('users.index',compact('title'));
    }

    public function data()
    {
        $users = User::isNotAdmin()->where('level','3')->orWhere('level','4')->orderBy('id', 'desc')->get();

        return datatables()
        ->of($users)
        ->addIndexColumn()
        ->addColumn('aksi', function ($users) {
            if (auth()->user()->level == 1)
            return '
            <div class="btn-group">
            <a class="btn btn-info btn-action mr-1" data-toggle="tooltip" href="'. route('users.detail', encrypt($users->id)) .'"><i class="fa fa-search-plus"></i></a>
            <button onclick="editForm(`'. route('users.update', $users->id) .'`)" class="btn btn-primary btn-action mr-1" data-toggle="tooltip"><i class="fa fa-edit"></i></button>
            <button onclick="deleteData(`'. route('users.destroy', $users->id) .'`)" class="btn btn-danger btn-action" data-toggle="tooltip"><i class="fa fa-trash"></i></button>
            </div>';
            else if (auth()->user()->level == 2)
             return '
            <div class="btn-group">
            <a class="btn btn-info btn-action mr-1" data-toggle="tooltip" href="'. route('users.detail', encrypt($users->id)) .'"><i class="fa fa-search-plus"></i></a>
            <button onclick="editForm(`'. route('users.update', $users->id) .'`)" class="btn btn-primary btn-action mr-1" data-toggle="tooltip"><i class="fa fa-edit"></i></button>
            </div>';
            else if (auth()->user()->level == 3)
             return '
            <div class="btn-group">
            <a class="btn btn-info btn-action mr-1" data-toggle="tooltip" href="'. route('users.detail', encrypt($users->id)) .'"><i class="fa fa-search-plus"></i></a>
            </div>';
            else
             return '
            <div class="btn-group">
            <a class="btn btn-info btn-action mr-1" data-toggle="tooltip" href="'. route('users.detail', encrypt($users->id)) .'"><i class="fa fa-search-plus"></i></a>
            </div>';

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
        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->status_akun = $request->status_akun;
        $users->level = $request->level;
        // $user->foto = '/img/user.png';
        $users->password = bcrypt($request->password);
        $users->save();

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
        $users = User::find($id);

       return response()->json($users);
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
        $users = User::find($id);
        $users->name = $request->name;
        $users->status_akun = $request->status_akun;
        $users->level = $request->level;
        if ($request->has('password') && $request->password != "") 
            $users->password = bcrypt($request->password);
        $users->update();
        activity()->log('update user');

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
            $users = User::find($id);
            $users->delete();
            activity()->log('hapus data user');
            return response()->json([
                'success' => true, 
                'message' => 'user berhasil dihapus' 
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem. code 500'
            ]);
        }
    }

    public function profil()
    {
        $title = 'Profil';
        $angkatan = Angkatan::all();
        $profil = auth()->user();
        activity()->log('akses profil user');

        return view('users.profil', compact('profil','title','angkatan'));
    }

    public function updateprofil(Request $request)
    {
        $users = auth()->user();
        
        $users->name = $request->name;
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->status = $request->status;
        $users->angkatan_id = $request->angkatan_id;
        $users->detail_alamat = $request->detail_alamat;
        $users->tahun_lulus = $request->tahun_lulus;
        $users->aktivitas = $request->aktivitas;
        $users->detail_aktivitas = $request->detail_aktivitas;
        $users->bio = $request->bio;
        
        // if ($request->has('password') && $request->password != "") {
        //     if (Hash::check($request->old_password, $users->password)) {
        //         if ($request->password == $request->password_confirmation) {
        //             $users->password = bcrypt($request->password);
        //         } else {
        //             return response()->json('Konfirmasi password tidak sesuai', 422);
        //         }
        //     } else {
        //         return response()->json('Password lama tidak sesuai', 422);
        //     }
        // }

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama = 'foto-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $nama);

            $users->foto = "/img/$nama";
        }

        $users->update();

        activity()->log('update profil');

        return response()->json($users, 200);
        // return response()->json([
        //     'success' => true, 
        //     'message' => 'Data berhasil diupdate' 
        // ]);
    }

    public function detail($id, Request $request)
    {

        $ID = decrypt($id);
        $profil = User::with('angkatan')->where('id',$ID, $request->segment((3)))->first();
        $angkatan = Angkatan::all();
        $title = 'Detail users';
        activity()->log('akses detail user');

        return view('users.detail',compact('profil','title','angkatan'));
    }
}
