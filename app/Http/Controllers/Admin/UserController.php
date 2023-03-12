<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        if($validator->fails()){
            return redirect()
                ->route('admin.users.create')
                ->withErrors($validator)
                ->withInput();
        }
        $image = $request->file('avatar');
        if ($image) { // был загружен файл изображения
            $path = $image->store('avatar', 'public');
            $base = basename($path);
        }
        $user = User::create([
            'name' => $request->name,
            'avatar' => $base ?? null,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->pasword),
        ]);
        if($user) {
            return redirect()
                ->route('admin.users.index')
                ->withSuccess('User create successful');
        }
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
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'last_name' => 'required',
            //'email' => 'required|email|unique:users',
        ]);
        if($validator->fails()){
            return redirect()
                ->route('admin.users.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::find($id);
        $image = $request->file('avatar');
        $fon_image = $request->file('fon_image');
        if ($image) { // был загружен файл изображения
            $old = $user->avatar;
            if ($old) {
                Storage::disk('public')->delete('avatar/' . $old);
            }
            $path = $image->store('avatar', 'public');
            $base = basename($path);
            if($base)
                $user->avatar = $base;
            unset($old);
            unset($base);
        }
        if ($fon_image) { // был загружен файл изображения
            $old = $user->fon_image;
            if ($old) {
                Storage::disk('public')->delete('fon_image/' . $old);
            }
            $path = $fon_image->store('fon_image', 'public');
            $base = basename($path);
            if($base)
                $user->fon_image = $base;
        }
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        $user->save();
        if($user->save()){
            return redirect()
                ->route('admin.users.index')
                ->withSuccess('Update success');
        }else{
            return redirect()
                ->route('admin.users.edit', $user->id)
                ->withErrors('Update failed');
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
    }
}
