<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;


class BasketController extends Controller
{
    public function basket()
    {
        $orderId = session('orderID');
        if (!is_null($orderId)) {
            $order = Order::findOrFail($orderId);
        }
        return view('basket', compact('order'));
    }

    public function basketConfirm(Request $request)
    {
        $orderId = session('orderID');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }

        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);

        if ($success) {
            session()->flash('success', 'Buyurtmangiz muvaffaqiyatli qabul qilindi');
        } else {
            session()->flash('warning', 'Buyurtma qabul qilishda xatolik sodir bo`ldi!!!');
        }

        return redirect()->route('index');
    }

    public function basketPlace()
    {
        $orderId = session('orderID');
        if (is_null($orderId)) {
            return redirect()->route('index');
        }

        $order = Order::find($orderId);

        return view('order', compact('order'));
    }

    public function basketAdd($productId)
    {
        $orderId = session('orderID');
        if (is_null($orderId)) {
            $order = Order::create()->id;
            session(['orderID' => $order]);
        } else {
            $order = Order::find($orderId);
        }

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($productId);
        }

        $product = Product::find($productId);
        session()->flash('success', $product->name . ' qo`shildi');

        return redirect()->route('basket');
    }

    public function basketRemove($productId)
    {
        $orderId = session('orderID');
        if (is_null($orderId)) {
            return redirect()->route('basket');
        }

        $order = Order::find($orderId);

        if ($order->products->contains($productId)) {
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($productId);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
        $product = Product::find($productId);
        session()->flash('warning', $product->name . ' o`chirildi');

        return redirect()->route('basket');
    }
}
