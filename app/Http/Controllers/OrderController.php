<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::query()
            ->select('id', 'customer_name', 'customer_email', 'customer_phone', 'customer_address', 'status', 'total_price', 'created_at')
            ->oldest()
            ->get();

        $count = Order::query()->count();

        return view('orders.index', compact('orders', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();

        return view('orders.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id', // c'est quoi le * ? https://laravel.com/docs/8.x/validation#validating-arrays
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        $order = new Order();
        $order->customer_name = $validated['customer_name'];
        $order->customer_email = $validated['customer_email'];
        $order->customer_phone = $validated['customer_phone'];
        $order->customer_address = $validated['customer_address'];
        $order->status = 'pending';
        $order->total_price = 0;
        $order->save();

        $totalPrice = 0;

        foreach ($validated['products'] as $productData) {
            $product = Product::find($productData['id']);
            $quantity = $productData['quantity'];
            $unitPrice = $product->price;
            $totalPrice += $unitPrice * $quantity;

            $order->products()->attach($product->id, [
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
            ]);
        }

        $order->update(['total_price' => $totalPrice]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::findOrFail($id);

        $products = Product::query()
            ->select('id', 'name', 'description', 'price', 'in_stock', 'width', 'height', 'depth', 'image_url', 'category_id')
            ->whereHas('orders', function ($query) use ($id) {
                $query->where('order_id', $id);
            })
            ->with(['category:id,name'])
            ->get();

        $count = $products->count();

        return view('orders.show', compact('order', 'products', 'count'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Valider les données entrantes
        $validated = $request->validate([
            'status' => 'required|string|in:pending,delivered,shipped,cancelled', // Remplacez par vos statuts réels
        ]);

        // Récupérer la commande ou échouer si elle n'existe pas
        $order = Order::findOrFail($id);

        // Mettre à jour le statut de la commande avec la valeur validée
        $order->status = $validated['status'];
        $order->save();

        // Rediriger avec un message de succès
        return redirect()->route('orders.index')->with('success', 'Commande mise à jour avec succès!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Supprimé avec succès!');
    }
}
