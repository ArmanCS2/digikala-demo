<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Content\FooterRequest;
use App\Models\Content\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $footers = Footer::orderBy('order')->paginate(20);
        return view('admin.content.footer.index', compact('footers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.content.footer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FooterRequest $request)
    {
        //dd($request->all());
        Footer::create([
            'title' => $request->title,
            'order' => $request->order,
            'link' => $request->link,
            'status' => $request->status,
        ]);
        return redirect()->route('admin.content.footer.index')->with('swal-success', 'فوتر با موفقیت ساخته شد');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Footer $footer)
    {
        return view('admin.content.footer.edit', compact('footer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(FooterRequest $request, Footer $footer)
    {
        $footer->update([
            'title' => $request->title ?? $footer->title,
            'order' => $request->order ?? $footer->order,
            'link' => $request->link ?? $footer->link,
            'status' => $request->status ?? $footer->status
        ]);
        return redirect()->route('admin.content.footer.index')->with('swal-success', 'فوتر با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Footer $footer)
    {
        $footer->delete();
        return redirect()->route('admin.content.footer.index')->with('swal-success', 'فوتر با موفقیت حذف شد');
    }

    public function ajaxChangeStatus(Footer $footer)
    {
        $footer->status == 1 ? $footer->status = 0 : $footer->status = 1;
        $result = $footer->save();
        if ($result) {
            if ($footer->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
