<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Str;
use Alert;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::latest()->get();

        $title = 'Hapus Data!';
        $text = "Apakah Anda Yakin?";
        confirmDelete($title, $text);

        return view('backend.category.index', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validate = $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $category       = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->save();
        toast('Data berhasil disimpan', 'success');
        return redirect()->route('backend.category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $category = Category::findOrFail($id);
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required',
        ]);

        $category       = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name, '-');
        $category->save();
        toast('Data berhasil di edit', 'success');
        return redirect()->route('backend.category.index');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        toast('Data berhasil dihapus', 'success');
        return redirect()->route('backend.category.index');
    }
}
