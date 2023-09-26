@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('items.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.items.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.items.inputs.kode_barang')</h5>
                    <span>{{ $item->kode_barang ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.items.inputs.nama_barang')</h5>
                    <span>{{ $item->nama_barang ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.items.inputs.satuan')</h5>
                    <span>{{ $item->satuan ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.items.inputs.harga_jual')</h5>
                    <span>{{ $item->harga_jual ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.items.inputs.stok')</h5>
                    <span>{{ $item->stok ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.items.inputs.ditarik')</h5>
                    <span>{{ $item->ditarik ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.items.inputs.product_id')</h5>
                    <span
                        >{{ optional($item->product)->nama_produk ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.items.inputs.user_id')</h5>
                    <span>{{ optional($item->user)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('items.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Item::class)
                <a href="{{ route('items.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
