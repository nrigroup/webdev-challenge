<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\User::orderBy('id', 'desc')->paginate();

        return view('admin/user/user_list', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("user_form");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $user = \App\User::firstOrNew(['username'=>$request->username]);

      if(!$user->exists){
         $user->password=encrypt($request->password);
         $user->notificationToken=$request->notificationToken;
         $user->save();
         return response()->json([
            'status' => 'success'
            ]);
     } else {
        return redirect()->back()->withDanger('Duplicated username!');
    }
        //$user = new User(Input::all());

}

public function login(Request $request){
  $users=\App\User::where('username',$request->username)->first();

  if($user==null){
     return redirect()->back()->withDanger('User does not exist!');
 }else{
    if(decrypt($user->password)!=$request->password){
        return redirect()->back()->withDanger('Wrong password!');
    }

    return redirect('user')->withSuccess('Welcome back');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("user_form");
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

        $users=\App\User::where('id',$id)->get();
        if($users->isEmpty()){
            // update user's push notification token

            return response()->json([
                'status' => 'User not exists'
                ]);
        }else{
            if(decrypt($users[0]->password)!=$request->password){
                return response()->json([
                    'status' => 'Wrong password'
                    ]);
            }
            if($request->params==null){
                return response()->json([
                    'status' => 'Lacking parameters'
                    ]);
            }
            $params=$request->params;
            if($request->params['password']!=null){

                $params['password']=encrypt($request->params['password']);
            }
            $users[0]->fill($params);
            $users[0]->save();
            return response()->json([
                'status' => 'success',
                'user' => $users[0]
                ]);
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
        try {
            DB::transaction(function() use($id)
            {
                $user = \App\User::findOrFail($id);
                $files=$user->files()->get();
                $lots=$user->lots()->get();
                foreach ($files as $file) {
                    Storage::delete($file->path);
                    $file->delete();
                }
                foreach ($lots as $lot) {
                    $lot->delete();
                }
                $user->delete();
            });   
            return redirect()->back()->withSuccess('The user and related lots and files have been deleted');
        } catch (Exception $e){
            return redirect()->back()->withDanger('Woops, something went wrong! Please try again latter.');
        }
        
    }
}
