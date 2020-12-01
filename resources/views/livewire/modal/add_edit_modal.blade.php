
<div wire:ignore.self class="modal fade" id="add_edit_modal" tabindex="-1" role="dialog" aria-labelledby="add_edit_modal" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content py-2">
            <div class="modal-header">
                <h4 class="modal-title text-purple"><span class="fas fa-user-cog mr-3"></span>{{ $modal_title }}</h4>
                <button type="button" wire:click.prevent="cancel()" class="close" data-dismiss="modal" wire:loading.attr="disabled" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="container-fluid mx-0 px-0">
                    <form>
                        <div class="row">

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="mnv">Mã nhân viên:</label>
                                    <div id="mnv_div">
                                        <input type="text" class="form-control px-2" wire:model.lazy="mnv" id="mnv" style="width: 100%" placeholder="Mã nhân viên ..." autocomplete="off">
                                    </div>
                                    @error('mnv')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="full_name">Họ và tên:</label>
                                    <div id="full_name_div">
                                        <input type="text" class="form-control px-2" wire:model.lazy="full_name" id="full_name" style="width: 100%" placeholder="Họ và tên ..." autocomplete="off">
                                    </div>
                                    @error('full_name')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="birthday">Ngày sinh:</label>
                                    <div id="birthday_div">
                                        <input type="text" wire:model="birthday" startview-totaa="3" container-totaa="#birthday_div" class="datepicker-totaa form-control px-2" readonly placeholder="Ngày sinh ...">
                                    </div>
                                    @error('birthday')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="ngay_vao_lam">Ngày vào làm:</label>
                                    <div id="ngay_vao_lam_div">
                                        <input type="text" wire:model="ngay_vao_lam" startview-totaa="0" container-totaa="#ngay_vao_lam_div" class="datepicker-totaa form-control px-2" readonly placeholder="Ngày vào làm, ngày thử việc ...">
                                    </div>
                                    @error('ngay_vao_lam')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            @if ($editStatus)
                                <div class="col-12">
                                    <div class="input-group form-group border-bottom cpc1hn-border py-2">
                                        <div class="input-group-prepend mr-4">
                                            <label class="col-form-label col-6 text-left pt-0 input-group-text border-0" for="active">Kích hoạt nhân viên:</label>
                                        </div>
                                        <label class="switcher switcher-square">
                                            <input type="checkbox" class="switcher-input form-control" wire:model="active" id="active" style="width: 100%">
                                            <span class="switcher-indicator">
                                                <span class="switcher-yes"></span>
                                                <span class="switcher-no"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer mx-auto">
                <button wire:click.prevent="cancel()" class="btn btn-danger" wire:loading.attr="disabled" data-dismiss="modal">Đóng</button>
                <button wire:click.prevent="save_bfo_info()" totaa-click-block-ui class="btn btn-success" wire:loading.attr="disabled">Xác nhận</button>
            </div>

        </div>
    </div>

</div>
