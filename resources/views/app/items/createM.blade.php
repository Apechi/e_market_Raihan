<div class="modal fade" id="modalInputItems">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <h4 id="title" class="card-title">
                            <a data-dismiss="modal" class="mr-4"><i class="icon ion-md-arrow-back"></i></a>
                            Tambah Barang
                        </h4>

                        <x-form method="POST" action="" class="mt-4">
                            @include('app.items.form-inputs')
                            <div class="method"></div>
                            <div class="mt-4">
                                <button id="submit" type="submit" class="btn btn-primary float-right">
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
</div>
