@php $editing = isset($supplier) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text id="nama_pemasok" name="nama_pemasok" label="Nama Pemasok" :value="old('nama_pemasok', $editing ? $supplier->nama_pemasok : '')" maxlength="50"
            placeholder="Nama Pemasok" required></x-inputs.text>
    </x-inputs.group>
</div>
