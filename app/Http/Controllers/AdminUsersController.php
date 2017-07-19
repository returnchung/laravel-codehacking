<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersEditRequest;

use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        return view('admin.users.create',compact('roles'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        
        if(trim($request->password) == '' ){
            
            $input = $request->except('password');
        }else{
            
            $input = $request->all();
            // $input['password'] = bcrypt($request->password);
        }
        
        // both below are working
        // if($file = $request->file('photo_id')){
        if($file = $request->photo_id){

            $name = time().$file->getClientOriginalName();
            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
            
        }
        
        User::create($input);
        
        return redirect('/admin/users');
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
        $user = User::findOrFail($id);

        $roles = Role::pluck('name','id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        // return $request->all();
        
        if(trim($request->password) == '' ){
            
            $input = $request->except('password');
        }else{
            
            $input = $request->all();
            // $input['password'] = bcrypt($request->password);
        }   

        $user = User::findOrFail($id);

        if ($file = $request->file('photo_id')) {
            
            $name = time().$file->getClientOriginalName();
            
            $file->move('images',$name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }

        // User::create($input);
        $user->update($input);

        return redirect('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return 'DESTROY';

        $user = User::findOrFail($id);

        // remove the file at public/images/filename and record in photos table
        unlink(public_path().$user->photo->file);
        Photo::findOrFail($user->photo_id)->delete();
        
        Session::flash('deleted_user',$user->name);

        $user->delete();

        return redirect('/admin/users');
    }

}
