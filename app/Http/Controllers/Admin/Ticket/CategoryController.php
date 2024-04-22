<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\TicketCategoryRequest;
use App\Models\Ticket\TicketCategory;
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
        $categories = TicketCategory::orderBy('created_at','DESC')->paginate(20);
        return view('admin.ticket.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ticket.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketCategoryRequest $request)
    {
        $inputs = $request->all();
        TicketCategory::create($inputs);
        return redirect()->route('admin.ticket.category.index')->with('swal-success', 'دسته بندی با موفقیت ساخته شد');
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
    public function edit($id)
    {
        $category = TicketCategory::find($id);
        return view('admin.ticket.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketCategoryRequest $request, $id)
    {
        $category = TicketCategory::find($id);
        $inputs = $request->all();
        $category->update($inputs);
        return redirect()->route('admin.ticket.category.index')->with('swal-success', 'دسته بندی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = TicketCategory::find($id);
        $category->delete();
        return redirect()->route('admin.ticket.category.index')->with('swal-success', 'دسته بندی با موفقیت حذف شد');
    }

    public function ajaxChangeStatus($id)
    {
        $category = TicketCategory::find($id);
        $category->status == 1 ? $category->status = 0 : $category->status = 1;
        $result = $category->save();
        if ($result) {
            if ($category->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            }
            return response()->json(['status' => true, 'checked' => true]);
        }
        return response()->json(['status' => true]);
    }
}
