<?php namespace App\Http\Controllers;

use App\Contact;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Request;

use App\Http\Requests\ContactRequest;


class ContactController extends Controller {

    public function getList(){
        $data = Contact::select('id','name','alias','email','telno','address','content','status','created_at','updated_at')->orderBy('id','DESC')->get()->toArray();
        return view('admin.contact.list',compact('data'));
    }
    public function getAdd(){
        return view('admin.contact.add');
    }
    public function postAdd(ContactRequest $contactRequest){
        $contact = new Contact();
        $contact->name = $contactRequest->txtName;
        $contact->alias = changeTitle($contactRequest->txtName);
        $contact->email = $contactRequest->txtEmail;
        $contact->telno = $contactRequest->txtTelno;
        $contact->content = $contactRequest->txtContent;
        $contact->address = $contactRequest->txtAddress;
        $contact->status  = 0;
        $contact->save();
        $data =['hoten'=> ContactRequest::input('name')];
        Mail::send('emails.blanks',$data,function ($msg){
            $msg->from('ntkiet27595@gmail.com','Tuấn Kiệt');
            $msg->to('mitanit000@gmail.com','Tuyết Kha')->subject('Đây là mail xác nhận liên hệ');
        });
        return redirect()->route('admin.contact.list')->with(['flash_level'=>'success','flash_message'=>'Success! Complete Add Contact']);
    }
    public function getDelete($id){
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('admin.contact.list')->with(['flash_level'=>'success','flash_message'=>'Success! Complete Delete Contact']);
    }
    public function getChange($id){
        $contact = Contact::find($id);
        if(($contact->status)== 0)
            $contact->status  = 1;
        else
            $contact->status  = 0;
        $contact->save();
        return redirect()->route('admin.contact.list');
    }

}
