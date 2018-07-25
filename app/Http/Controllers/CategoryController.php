<?php

namespace App\Http\Controllers;

use App\Category;
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
        try{
            $categories = Category::paginate(15);
            return view('pages.category.index', compact('categories'));
        }catch(\Exception $e){

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $category = new Category();
            $category->name = trim($request->name);
            $category->slug = trim(strtolower(str_replace(' ', '-', $request->name)));
            $category->save();
            return response()->json([
                'status'=> true,
                'data'  => $category,
                'msg'   => "Seccess"
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status'=> false,
                'data'  => $e,
                'msg'   => "Error"
            ]);            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            // dd($id);
            Category::destroy($id);
            return response()->json([
                'status'=> true,
                'data'  => '',
                'msg'   => 'Data Deleted Seccessfully.'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status'=> false,
                'data'  => '',
                'msg'   => 'Data Not Deleted.'
            ]);
        }
    }
}
