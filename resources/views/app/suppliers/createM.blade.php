<div class="modal fade" id="modalInputSupplier" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a data-dismiss="modal" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                            <h6 id="title">Tambah Supplier</h6>
                        </h4>

                        <x-form method="POST" action="" class="mt-4">
                            <div id="method"></div>
                            @include('app.suppliers.form-inputs')
                            <button type="submit" id="btn-submit" class="btn btn-primary float-right">
                                <i class="icon ion-md-save"></i>
                                Simpan
                            </button>
                    </div>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</div>
