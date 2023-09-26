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
                    @can('create', App\Models\Supplier::class)
                        <button type="button" class="btn btn-primary" data-mode="create" data-target="#modalInputSupplier"
                            data-toggle="modal">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.suppliers.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.suppliers.inputs.nama_pemasok')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier->nama_pemasok ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $supplier)
                                                <a>
                                                    <button type="button" class="btn btn-light"
                                                        data-target="#modalInputSupplier"
                                                        data-json="{{ json_encode($supplier) }}" data-toggle="modal"
                                                        data-mode="edit">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('view', $supplier)
                                                <a>
                                                    <button type="button" class="btn btn-light"
                                                        data-json="{{ json_encode($supplier) }}"
                                                        data-target="#modalInputSupplier" data-toggle="modal" data-mode="view">
                                                        <i class="icon ion-md-eye"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $supplier)
                                                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
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
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('app.suppliers.createM')
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#modalInputSupplier').on('show.bs.modal', function(e) {
                let btn = $(e.relatedTarget)
                let mode = btn.data('mode')

                //get modal element
                let mMethod = $('#method')
                let mForm = $('#x-form')
                let mTitle = $('#title')
                let mInput = $('#nama_pemasok')
                let mSubmit = $('#btn-submit')
                let mJson


                switch (mode) {
                    case 'create':

                        break;

                    case 'edit':
                        mTitle.text('Edit Pemasok');
                        mJson = btn.data('json')
                        mJson = JSON.parse(JSON.stringify(mJson))
                        mSubmit.removeClass('d-none');
                        mInput.val(mJson.nama_pemasok)
                        mMethod.html(`@method('PUT')`);
                        mForm.attr('action', `suppliers/${mJson.id}`);
                        break;

                    case 'view':
                        mTitle.text('Lihat Pemasok')
                        mJson = btn.data('json')
                        mJson = JSON.parse(JSON.stringify(mJson))
                        mSubmit.addClass('d-none');
                        mInput.val(mJson.nama_pemasok)
                        break;

                    default:
                        break;
                }
            })
        });
    </script>
@endpush
