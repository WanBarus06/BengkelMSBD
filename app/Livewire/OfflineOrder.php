<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class OfflineOrder extends Component
{
    public $customerName;
    public $products;
    public $orderItems = [];
    public $product_id;
    public $quantity;

    public function mount()
    {
        $this->products = Product::all(); // Ambil produk dari database
    }

    public function addOrderItem()
    {
        // Validasi input
        $this->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        // Tambahkan item ke list sementara
        $product = $this->products->find($this->product_id);
        $this->orderItems[] = [
            'product_id' => $product->id,
            'product_name' => $product->product_name,
            'quantity' => $this->quantity,
        ];

        // Reset input
        $this->product_id = null;
        $this->quantity = null;
    }

    public function removeOrderItem($index)
    {
        unset($this->orderItems[$index]);
        $this->orderItems = array_values($this->orderItems); // Reset index array
    }

    public function placeOrder()
    {
        // Validasi data pemesanan
        $this->validate([
            'customerName' => 'required',
            'orderItems' => 'required|array|min:1',
        ]);

        // Simpan pesanan ke database jika diperlukan
        // Contoh:
        // Order::create([
        //     'customer_name' => $this->customerName,
        //     'items' => $this->orderItems,
        // ]);

        session()->flash('success', 'Pesanan berhasil dibuat!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.offline-order');
    }

}
