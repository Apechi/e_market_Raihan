@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('customers.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.customers.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.kode_pelanggan')</h5>
                    <span>{{ $customer->kode_pelanggan ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.nama')</h5>
                    <span>{{ $customer->nama ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.alamat')</h5>
                    <span>{{ $customer->alamat ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.no_telp')</h5>
                    <span>{{ $customer->no_telp ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.customers.inputs.email')</h5>
                    <span>{{ $customer->email ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('customers.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Customer::class)
                <a href="{{ route('customers.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
