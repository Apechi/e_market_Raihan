@php $editing = isset($product) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text id="nama_produk" name="nama_produk" label="Nama Produk" :value="old('nama_produk', $editing ? $product->nama_produk : '')" maxlength="255"
            placeholder="Nama Produk" required></x-inputs.text>
    </x-inputs.group>
</div>
