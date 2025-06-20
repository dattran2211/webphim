<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    public function create() {
        $info = Info::find(1);
        return view('admincp.info.form',compact('info'));
    }
    

    public function update(Request $request, $id)
    {
        $data = $request->validate(
            [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=2000,max_height=2000', 
            'copyright' => 'required|max:255',
             ],
            [
                
                'title.required' => 'Tên tiêu đề phải có nhé',
                'description.required' => 'Mô tả phải có nhé',
            ]
        );        
        $info = Info::find($id);
        $info->title =$data['title'];
        $info->description =$data['description'];
        $info->copyright =$data['copyright'];
        $get_image = $request->file('image');
        if($get_image){
            if(file_exists('uploads/logo/'.$info->logo)) {
                unlink('uploads/logo/'.$info->logo);
            } else {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/logo/',$new_image);
            $info->logo = $new_image;
            }
}
        $info->save();
        toastr()->success('Thành công','Sửa thông tin website thành công');
        return redirect()->back();
    }

    
}
