<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Hash;
use App\User;
use Auth;

class UserController extends Controller {

    public function getList(){
        $user = User::select('id','username','level')->orderBy('id','DESC')->get()->toArray();
        return view('admin.user.list',compact('user'));
    }
    public function getAdd(){
        /*$parent = Cate::select('id','name','parent_id')->get()->toArray();*/
        return view('admin.user.add'/*compact('parent')*/);
    }
    public function postAdd(UserRequest $request){
        $user = new User();
        $user->username = $request->txtUser;
        $user->password = Hash::make($request->txtPass);
        $user->	email = $request->txtEmail;
        $user->level = $request->rdoLevel;
        $user->remember_token = $request->_token;
        $user->save();
        return redirect()->route('admin.user.list')->with(['flash_level'=>'success','flash_message'=>'Success! Complete Add User']);
    }
    public function getDelete($id){
       $user_current_login = Auth::user()->id;
       $user = User::find($id);
       if(($id == 2)||($user_current_login != 2 && $user['level'] == 1  )){
           return redirect()->route('admin.user.list')->with(['flash_level'=>'danger','flash_message'=>'Sorry! You Can\'t Access User']);
       }else{
           $user->delete();
           return redirect()->route('admin.user.list')->with(['flash_level'=>'success','flash_message'=>'Success! Complete Delete User']);
       }
    }
    public function getEdit($id){
        $data = User::find($id);
        if((Auth::user()->id != 2) && ($id ==2 || ($data["level"]== 1 && (Auth::user()->id != $id)))){
            return redirect()->route('admin.user.list')->with(['flash_level'=>'danger','flash_message'=>'Sorry! You Can\'t Edit User']);
        }
        return view('admin.user.edit',compact('data','id'));
    }
    public function postEdit(Request $request,$id){
        $user = User::find($id);
        if($request->input('txtPass')){
            $this->validate($request,['txtRePass'=>'same:txtRePass'],['txtRePass'=>'Two Password Don\'t Match']);
            $pass = $request->input('txtPass');
            $user->password = Hash::make($pass);
        }
        $user->email = $request->txtEmail;
        $user->level = $request->rdoLevel;
        $user->remember_token = $request->input('_token');
        $user->save();
        return redirect()->route('admin.user.list')->with(['flash_level'=>'success','flash_message'=>'Success! Complete Edit User']);
    }

}
