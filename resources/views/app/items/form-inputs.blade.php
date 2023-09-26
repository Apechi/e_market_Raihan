@php $editing = isset($item) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="kode_barang" id="kode_barang" label="Kode Barang" :value="old('kode_barang', $editing ? $item->kode_barang : '')" maxlength="50"
            placeholder="Kode Barang" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="nama_barang" id="nama_barang" label="Nama Barang" :value="old('nama_barang', $editing ? $item->nama_barang : '')" maxlength="255"
            placeholder="Nama Barang" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="satuan" id="satuan" label="Satuan" :value="old('satuan', $editing ? $item->satuan : '')" maxlength="10"
            placeholder="Satuan" required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number name="harga_jual" id="harga_jual" label="Harga Jual" :value="old('harga_jual', $editing ? $item->harga_jual : '')" step="0.01"
            placeholder="Harga Jual" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="stok" id="stok" label="Stok" :value="old('stok', $editing ? $item->stok : '')" maxlength="5" placeholder="Stok"
            required></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number id="ditarik" name="ditarik" label="Ditarik" :value="old('ditarik', $editing ? $item->ditarik : '')" max="255"
            placeholder="Ditarik" required></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="product_id" label="Product" id="product_id" required>
            @php $selected = old('product_id', ($editing ? $item->product_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Product</option>
            @foreach ($products as $value => $label)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group hidden class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $item->user_id : '')) @endphp
            <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
        </x-inputs.select>
    </x-inputs.group>
</div>
