@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="input-group">
                            <input id="indexSearch" type="text" name="search" placeholder="{{ __('crud.common.search') }}"
                                value="{{ $search ?? '' }}" class="form-control" autocomplete="off" />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary">
                                    <i class="icon ion-md-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\Item::class)
                        <button type="button" data-toggle="modal" data-target="#modalInputItems" data-mode="create"
                            class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.items.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.items.inputs.kode_barang')
                                </th>
                                <th class="text-left">
                                    @lang('crud.items.inputs.nama_barang')
                                </th>
                                <th class="text-left">
                                    @lang('crud.items.inputs.satuan')
                                </th>
                                <th class="text-right">
                                    @lang('crud.items.inputs.harga_jual')
                                </th>
                                <th class="text-left">
                                    @lang('crud.items.inputs.stok')
                                </th>
                                <th class="text-right">
                                    @lang('crud.items.inputs.ditarik')
                                </th>
                                <th class="text-left">
                                    @lang('crud.items.inputs.product_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>{{ $item->kode_barang ?? '-' }}</td>
                                    <td>{{ $item->nama_barang ?? '-' }}</td>
                                    <td>{{ $item->satuan ?? '-' }}</td>
                                    <td>{{ $item->harga_jual ?? '-' }}</td>
                                    <td>{{ $item->stok ?? '-' }}</td>
                                    <td>{{ $item->ditarik ?? '-' }}</td>
                                    <td>
                                        {{ optional($item->product)->nama_produk ?? '-' }}
                                    </td>

                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $item)
                                                <a>
                                                    <button type="button" data-toggle="modal" data-target="#modalInputItems"
                                                        data-mode="update" data-json="{{ $item }}"
                                                        class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $item)
                                                <a>
                                                    <button type="button" data-toggle="modal" data-target="#modalInputItems"
                                                        data-mode="view" class="btn btn-light" data-json="{{ $item }}">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $item)
                                                <form action="{{ route('items.destroy', $item) }}" method="POST"
                                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="9">{!! $items->render() !!}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('app.items.createM')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#modalInputItems').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget)
                let mode = btn.data('mode')

                //ModalItems
                let mTitle = $('#title')
                let mMethod = $('.method')
                let mSubmit = $('#submit')

                //inputs
                let mKodeBarang = $('kode_barang')
                let mNamaBarang = $('mNamaBarang')
                let mSatuan
                let mHargaJual
                let mDitarik = $('#ditarik')
                let mStok = $('#stok')
                let mProduct = $('#product_id')
                let data



                switch (mode) {
                    case 'create':
                        mTitle.text('Tambah Barang')


                        break;

                    case 'update':
                        mTitle.text('Edit Barang')
                        data = JSON.parse(JSON.stringify(btn.data('json')))
                        mSubmit.removeClass('d-none')
                        mProduct.removeAttr('disabled');
                        mStok.removeAttr('disabled');
                        mDitarik.removeAttr('disabled');
                        break;

                    case 'view':
                        mTitle.text('Lihat Barang')
                        data = JSON.parse(JSON.stringify(btn.data('json')))
                        mProduct.attr('disabled', '');
                        mStok.attr('disabled', '')
                        mDitarik.attr('disabled', '')
                        mSubmit.addClass('d-none');
                        break;

                    default:
                        break;
                }

            });
        });
    </script>
@endpush
