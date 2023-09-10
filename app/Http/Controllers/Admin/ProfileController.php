<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordUpdateRequest;
use App\Http\Requests\AdminProfileUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Traits\FileUploadTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::guard('admin')->user();
        return view('admin.profile.index',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProfileUpdateRequest $request, string $id)
    {
        /** handle image */
        $imagePath = $this->handleFileUpload($request , 'image' , $request->old_image);

        /**store image */
        $admin = Admin::findOrFail($id);
        $admin->image = !empty($imagePath) ? $imagePath : $request->old_image;
        $admin->name = $request->name;
        $admin->email=$request->email;
        $admin->save();

        toast(__('Updated Successfuly !'),'success')->width('400');
        return redirect()->back();
    }

    public function passwordUpdate(AdminPasswordUpdateRequest $request , string $id)
    {
        $admin = Admin::findOrFail($id);
        $admin->password = bcrypt($request->password);
        $admin->save();

        toast( __('Updated Successfuly !') ,'success')->width('400');
        return redirect()->back();
    }


}
