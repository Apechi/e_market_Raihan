@php $editing = isset($customer) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="kode_pelanggan"
            label="Kode Pelanggan"
            :value="old('kode_pelanggan', ($editing ? $customer->kode_pelanggan : ''))"
            maxlength="50"
            placeholder="Kode Pelanggan"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nama"
            label="Nama"
            :value="old('nama', ($editing ? $customer->nama : ''))"
            maxlength="255"
            placeholder="Nama"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea name="alamat" label="Alamat" maxlength="255" required
            >{{ old('alamat', ($editing ? $customer->alamat : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="no_telp"
            label="No Telp"
            :value="old('no_telp', ($editing ? $customer->no_telp : ''))"
            maxlength="20"
            placeholder="No Telp"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $customer->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>
</div>
