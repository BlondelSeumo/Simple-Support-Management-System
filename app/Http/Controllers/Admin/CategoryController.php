<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends BackendController
{
    private $id;

    public function __construct()
    {
        $this->middleware(['permission:category'])->only('index');
        $this->middleware(['permission:category_create'])->only('create', 'store');
        $this->middleware(['permission:category_edit'])->only('edit', 'update');
        $this->middleware(['permission:category_destroy'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories'] = Category::latest()->get();
        return view('backend.category.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $niceNames = [];
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $category       = new category;
        $category->name = $request->name;
        $category->save();

        return redirect(route('admin.category.index'))->withSuccess('The category Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['category'] = Category::findOrfail($id);
        return view('backend.category.edit', $this->data);
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
        $category = Category::findOrfail($id);

        $niceNames = [];
        $this->id  = $id;
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $category->name = $request->name;
        $category->save();

        return redirect(route('admin.category.index'))->withSuccess('The category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrfail($id);
        $category->delete();
        return redirect(route('admin.category.index'))->withSuccess('The category deleted successfully');
    }

    private function validateArray()
    {
        return [
            'name' => ['required', 'string', Rule::unique("categories", "name")->ignore($this->id), 'max:100'],
        ];
    }
}
