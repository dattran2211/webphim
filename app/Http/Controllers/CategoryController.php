<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::orderby('position','asc')->get();
        return view('admincp.category.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admincp.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->validate(
        [
        'title' => 'required|unique:categories|max:255',
        'slug' => 'required|unique:categories|max:255',
        'description' => 'required|max:255',
        'status' => 'required',
        ],
        [
            'title.unique' => 'Tên danh mục đã có, xin điền tên khác',
            'slug.unique' => 'Slug danh mục đã có, xin điền tên khác',
            'title.required' => 'Tên danh mục phải có nhé',
            'slug.required' => 'Tên slug phải có nhé',
            'description.required' => 'Mô tả danh mục phải có nhé',
        ]
    );
        $category = new Category();
        $category->title =$data['title'];
        $category->slug =$data['slug'];
        $category->description =$data['description'];
        $category->status =$data['status'];
        $category->save();
        toastr()->success('Thành công','Thêm danh mục thành công');
        return redirect()->route('category.index');
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
        $category = Category::find($id);
        $list = Category::orderby('position','asc')->get();
        return view('admincp.category.form',compact('list','category'));
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
        $data = $request->validate(
            [
            'title' => 'required|unique:categories|max:255',
            'slug' => 'required|unique:categories|max:255',
            'description' => 'required|max:255',
            'status' => 'required',
            ],
            [
                'title.unique' => 'Tên danh mục đã có, xin điền tên khác',
                'slug.unique' => 'Slug danh mục đã có, xin điền tên khác',
                'title.required' => 'Tên danh mục phải có nhé',
                'slug.required' => 'Tên slug phải có nhé',
                'description.required' => 'Mô tả danh mục phải có nhé',
            ]
        );        
        $category = Category::find($id);
        $category->title =$data['title'];
        $category->slug =$data['slug'];
        $category->description =$data['description'];
        $category->status =$data['status'];
        $category->save();
        toastr()->success('Thành công','Thêm danh mục thành công');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->back();

    }
    public function resorting(Request $request) {
        $data = $request->all();
         foreach($data['array_id'] as $key => $value) {
            $category = Category::find($value);
            $category->position = $key;
            $category->save();
         }
    }

}
