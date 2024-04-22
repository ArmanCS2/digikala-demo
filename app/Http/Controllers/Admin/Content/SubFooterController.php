<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Models\Content\Footer;
use App\Models\Content\SubFooter;
use Illuminate\Http\Request;

class SubFooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Footer $footer)
    {
        $subFooters = $footer->subFooters()->orderBy('order')->paginate(20);
        return view('admin.content.footer.sub-footer.index', compact('subFooters', 'footer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Footer $footer)
    {
        return view('admin.content.footer.sub-footer.create', compact('footer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Footer $footer)
    {
        SubFooter::create([
            'title' => $request->title,
            'order' => $request->order,
            'link' => $request->link,
            'status' => $request->status,
            'footer_id' => $footer->id,
        ]);
        return redirect()->route('admin.content.sub-footer.index', $footer)->with('swal-success', 'زیر فوتر با موفقیت ساخته شد');
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
    public function edit(SubFooter $subFooter)
    {
        $footers = Footer::all();
        return view('admin.content.footer.sub-footer.edit', compact('footers', 'subFooter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubFooter $subFooter)
    {
        $subFooter->update([
            'title' => $request->title ?? $subFooter->title,
            'order' => $request->order ?? $subFooter->order,
            'link' => $request->link ?? $subFooter->link,
            'status' => $request->status ?? $subFooter->status,
        ]);
        return redirect()->route('admin.content.sub-footer.index', $subFooter->footer)->with('swal-success', 'زیر فوتر با موفقیت ویرایش شد');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubFooter $subFooter)
    {
        $subFooter->delete();
        return redirect()->route('admin.content.sub-footer.index', $subFooter->footer)->with('swal-success', 'زیر فوتر با موفقیت حذف شد');

    }


    public function ajaxChangeStatus(SubFooter $subFooter)
    {
        $subFooter->status == 1 ? $subFooter->status = 0 : $subFooter->status = 1;
        $result = $subFooter->save();
        if ($result) {
            if ($subFooter->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
