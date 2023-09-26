@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <form>
                        <div class="input-group">

                        </div>
                    </form>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\Product::class)
                        <button type="button" data-toggle="modal" data-mode="create" data-target="#modalInputProduk"
                            class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </button>
                    @endcan

                    <a href="{{ route('products.export') }}">
                        <button type="submit" class="btn btn-success">
                            Export XLXS
                        </button>
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.products.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="tabelProduk">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.products.inputs.nama_produk')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->nama_produk ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $product)
                                                <a>
                                                    <button type="button" class="btn btn-light" data-target="#modalInputProduk"
                                                        data-toggle="modal" data-mode="edit"
                                                        data-json="{{ json_encode($product) }}">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $product)
                                                <a>
                                                    <button type="button" class="btn btn-light" data-target="#modalInputProduk"
                                                        data-toggle="modal" data-json="{{ json_encode($product) }}"
                                                        data-mode="view">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $product)
                                                <form action="{{ route('products.destroy', $product) }}" method="POST"
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
                                    <td colspan="2">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">{!! $products->render() !!}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#tabelProduk').DataTable()
            $('#modalInputProduk').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget)
                let mode = btn.data('mode')
                //get modal element
                let mMethod = $(this).find('#method')
                let mForm = $(this).find('#form')
                let mTitle = $(this).find('.modal-title')
                let mInput = $(this).find('#nama_produk')
                let Mbtn = $(this).find('.submit')
                let jsonObject
                let items

                switch (mode) {
                    case 'create':
                        mTitle.text("Tambah Produk")
                        Mbtn.removeClass('d-none');
                        mForm.attr('action', "{{ route('products.create') }}");
                        break;
                    case 'edit':
                        jsonObject = JSON.stringify(btn.data('json'))
                        items = JSON.parse(jsonObject)
                        mMethod.html('@method('PUT')')
                        mTitle.text("Edit Produk")
                        mInput.val(items.nama_produk)
                        Mbtn.removeClass('d-none');
                        Mbtn.text("Edit Produk")
                        mForm.attr('action', 'products/' + items.id);
                        break;
                    case 'view':
                        jsonObject = JSON.stringify(btn.data('json'))
                        items = JSON.parse(jsonObject)
                        mTitle.text("Lihat Produk")
                        mInput.val(items.nama_produk)
                        console.log(Mbtn);
                        Mbtn.addClass('d-none')
                        break;
                    default:
                        break;
                }


            })



        })
    </script>
@endpush
@include('app.products.createM')
