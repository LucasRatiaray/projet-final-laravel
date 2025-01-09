<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()
            ->select('id', 'name', 'description', 'price', 'in_stock', 'width', 'height', 'depth', 'image_url', 'category_id')
            ->oldest()
            ->with(['category:id,name'])
            ->get();

        $count = Product::query()->count();

        return view('products.index', compact('products', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()
            ->select('id', 'name')
            ->oldest()
            ->get();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'depth' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'required|image|max:2048',
            'in_stock' => 'required|integer|in:0,1',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->width = $request->width;
        $product->height = $request->height;
        $product->depth = $request->depth;
        $product->category_id = $request->category_id;

        $image = $request->image;
        $imagePath = $image->store('products', 'public');

        $product->image_url = $imagePath;
        $product->in_stock = $request->in_stock;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::query()
            ->select('id', 'name', 'description', 'price', 'in_stock', 'width', 'height', 'depth', 'image_url', 'category_id')
            ->with(['category:id,name'])
            ->find($product->id);

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::query()
            ->select('id', 'name')
            ->oldest()
            ->get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'depth' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'image|max:2048',
            'in_stock' => 'required|integer|in:0,1',
        ]);

        $product->name = $request->get('name');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->width = $request->get('width');
        $product->height = $request->get('height');
        $product->depth = $request->get('depth');
        $product->category_id = $request->get('category_id');
        $product->in_stock = $request->get('in_stock');

        if ($request->hasFile('image')) {
            if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                Storage::disk('public')->delete($product->image_url);
            }

            $image = $request->file('image');
            $imagePath = $image->store('products', 'public');
            $product->image_url = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Produit modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return back()->with('success', 'Product deleted successfully.');
    }
}
