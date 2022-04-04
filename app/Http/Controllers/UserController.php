<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.list', [
            'title' => 'Daftar User',
            'users' => User::with('roles')->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create', [
            'title' => 'Tambah Admin',
            'users' => User::paginate(10)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user=User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email
        ]);

        $user->syncRoles(Role::ROLE_ADMIN);

        return redirect()->route('user.index')->with('message', 'User berhasil ditambahkan');
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
    public function edit(User $user)
    {
        return view('user.edit', [
            'title' => 'Edit',
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('user.index')->with('message', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('message', 'User berhasli dihapus!');
    }

    public function create_kasir(){
        return view('user.createkasir', [ 
            'tittle'=>'Daftar Kasir',
            'users' => User::paginate(10) ]);
    }

    public function store_kasir(UserRequest $request){
        $user = User::create([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
        ]);

        $user->syncRoles(Role::ROLE_KASIR);

        return redirect()->route('user.index')->with('message', 'User Berhasil Ditambahkan');
    }

    public function create_owner(){
        return view('user.createowner', [ 
        'tittle'=>'Daftar Owner',
        'users' => User::paginate(10) ]);
    }

    public function store_owner(UserRequest $request){
        $user = User::create([
            'nama'=>$request->nama,
            'username'=>$request->username,
            'password'=>Hash::make($request->password),
            'email'=>$request->email,
        ]);

        $user->syncRoles(Role::ROLE_OWNER);

        return redirect()->route('user.index')->with('message', 'User Berhasil Ditambahkan');
    }
}
