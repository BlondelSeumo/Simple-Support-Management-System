<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BackendController;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class FaqController extends BackendController
{
    private $id;

    public function __construct()
    {
        $this->middleware(['permission:faq'])->only('index');
        $this->middleware(['permission:faq_create'])->only('create', 'store');
        $this->middleware(['permission:faq_edit'])->only('edit', 'update');
        $this->middleware(['permission:faq_destroy'])->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['faqs'] = Faq::latest()->get();
        return view('backend.faq.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.faq.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $niceNames = [];
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $faq = new Faq;
        $faq->title = $request->title;
        $faq->slug = Str::slug($request->title);
        $faq->status = $request->status;
        $faq->description = $request->description;
        $faq->save();

        return redirect(route('admin.faq.index'))->withSuccess('The faq Added Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['faq'] = Faq::findOrfail($id);
        return view('backend.faq.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $faq = Faq::findOrfail($id);

        $niceNames = [];
        $this->id = $id;
        $this->validate($request, $this->validateArray(), [], $niceNames);

        $faq->title = $request->title;
        $faq->slug = Str::slug($request->title);
        $faq->status = $request->status;
        $faq->description = $request->description;
        $faq->save();

        return redirect(route('admin.faq.index'))->withSuccess('The faq updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faq = Faq::findOrfail($id);
        $faq->delete();
        return redirect(route('admin.faq.index'))->withSuccess('The faq deleted successfully');
    }

    private function validateArray(): array
    {
        return [
            'title' => ['required', 'string', Rule::unique("faqs", "title")->ignore($this->id), 'max:200'],
            'status' => ['required', 'numeric', Rule::notIn([0])],
            'description' => ['required', 'string'],
        ];
    }
}
