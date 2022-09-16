<?php

namespace App\Http\Controllers;

use App\Models\UserRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(){
     return view('index');
   }

   public function fetchEmp(){
      $user = UserRecord::all();
      $claim_details = [];
      foreach($user as $value){
        $claim_details[] = array(
          'emp' => $value,
          'experience'=> $value['status'] == 0 ? Carbon::createFromDate($value['join_date'])->diff($value['leave_date'])->format('%y years, %m months') : Carbon::createFromDate($value['join_date'])->diff(Carbon::now())->format('%y years, %m months'),
        );
      }
      return response()->json([
          'status'=>200,
          'user'=>$claim_details
      ]);
   }

   public function formSubmit(Request $request){
      
      $rules = [
        'fname' => 'required',
        'email' => 'required',
        'join_date' => 'required',
        'avatar' => 'required|max:500|mimes:jpg,jpeg,png'
      ];

      $custommessages = [
        'fname.required' => 'Full name required',
        'email.required' => 'Email required',
        'join_date.required' => 'Joining date required',
        'avatar.required' => 'Image required',
        'avatar.max' => 'File should be less than 500kb',
        'avatar.mimes' => 'File must be in jpg,jpeg,png',
      ];

      $this->validate($request, $rules, $custommessages);

      $user = new UserRecord();
      $user->fname = $request->fname;
      $user->email = $request->email;
      $user->join_date = $request->join_date;
      $user->leave_date = $request->leave_date;
      $user->status = $request->leave_date == null ? 1 : 0 ;
      if ($request->hasFile('avatar')) {
        $data = $request->file('avatar');
        $extension = $data->getClientOriginalExtension();
        $filename = uniqid(rand()) . 'avatar' . '.' . $extension;
        $path = public_path('avatar/');
        $upload_success = $data->move($path, $filename);
        $user->avatar = 'avatar/'.$filename;
      }
      $user->save();

      return back();
   }
   public function edit($id){
      $employee = UserRecord::find($id);
      if($employee){
          return response()->json([
              'status'=>200,
              'employee'=>$employee
          ]);
      }else{
          return response()->json([
              'status'=>404,
              'message'=>'Id not found'
          ]);
      }
  }
  public function update(Request $request, $id){
    $rules = [
      'avatar' => 'max:500|mimes:jpg,jpeg,png'
    ];

    $custommessages = [
      'avatar.max' => 'File should be less than 500kb',
      'avatar.mimes' => 'File must be in jpg,jpeg,png',
    ];

    $this->validate($request, $rules, $custommessages);

    $employee = UserRecord::find($id);
    if($employee){
        $employee->fname = $request->fname;
        $employee->email = $request->email;
        $employee->join_date = $request->join_date;
        $employee->leave_date = $request->leave_date;
        $employee->status = $request->leave_date == null ? 1 : 0;

        if ($request->hasFile('avatar')) {
            $data = $request->file('avatar');
            $extension = $data->getClientOriginalExtension();
            $filename = uniqid(rand()) . 'avatar' . '.' . $extension;
            $path = public_path('avatar/');
            $upload_success = $data->move($path, $filename);
            $avatar = 'avatar/' . $filename;
        }else {
          $avatar = '';
      }
      $employee->avatar = $avatar;
        $employee->update();
        return response()->json([
            'status'=>200,
            'message'=>'User updated successfully'
        ]);
      }else{
          return response()->json([
              'status'=>404,
              'message'=>'Id not found'
          ]);
      }
    }
    public function delete($id){
      $employee = UserRecord::find($id);
      $employee->delete();
      return response()->json([
          'status'=>200,
          'message'=>'User deleted successfully'
      ]);
  }
}
