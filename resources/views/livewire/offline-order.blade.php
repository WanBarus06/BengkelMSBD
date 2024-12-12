<div>
    <h1>Pesanan Offline</h1>

    <!-- Form Input -->
    <div class="mb-3">
        <label for="customerName" class="form-label">Nama Pelanggan</label>
        <input type="text" id="customerName" class="form-control" wire:model="customerName">
        @error('customerName') <span class="text-danger">{{ $message }}</span> @enderror
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="product_id" class="form-label">Nama Produk</label>
            <select id="product_id" class="form-select" wire:model="product_id">
                <option value="">Pilih Produk</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
            @error('product_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-4">
            <label for="quantity" class="form-label">Jumlah</label>
            <input type="number" id="quantity" class="form-control" wire:model="quantity">
            @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button class="btn btn-primary w-100" wire:click="addOrderItem">Tambah</button>
        </div>
    </div>

    <!-- Tabel Dinamis -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $index => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>
                        <button class="btn btn-danger btn-sm" wire:click="removeOrderItem({{ $index }})">Hapus</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tombol Aksi -->
    <div class="mt-4">
        <button class="btn btn-success" wire:click="placeOrder">Pesan</button>
        <button class="btn btn-secondary" wire:click="reset">Batalkan</button>
    </div>
</div>
