<div class="modal fade" id="modalInputProduk" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal-title" class="modal-title">Tambah Produk</h5>

            </div>
            <div class="modal-body">
                <x-form method="POST" action="" class="mt-4">
                    @include('app.products.form-inputs')
                    <div id="method"></div>
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-light">
                            <i class="icon ion-md-return-left text-primary"></i>
                            @lang('crud.common.back')
                        </a>

                        <button type="button" class="btn btn-secondary float-right mx-2"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary float-right submit">
                            <i class="icon ion-md-save"></i>
                            @lang('crud.common.create')
                        </button>
                    </div>
                </x-form>
            </div>
        </div>
    </div>
</div>
