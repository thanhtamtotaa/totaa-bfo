
<div wire:ignore.self class="modal fade" id="add_edit_modal" tabindex="-1" role="dialog" aria-labelledby="add_edit_modal" aria-hidden="true" data-toggle="modal" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content py-2">
            <div class="modal-header">
                <h4 class="modal-title text-purple"><span class="fas fa-users mr-3"></span>{{ $modal_title }}</h4>
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
                                    <label class="col-form-label" for="name">Tên nhóm:</label>
                                    <div id="name_div">
                                        <input type="text" class="form-control px-2" wire:model.lazy="name" id="name" style="width: 100%" placeholder="Tên nhóm ..." autocomplete="off">
                                    </div>
                                    @error('name')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="team_type_id">Phân loại nhóm:</label>
                                    <div id="team_type_id_div">
                                        <select class="form-control px-2 select2-totaa" totaa-placeholder="Phân loại nhóm ..." totaa-search="10" wire:model="team_type_id" id="team_type_id" style="width: 100%">
                                            <option selected></option>
                                            @if (!!optional($team_type_arrays)->count())
                                                @foreach ($team_type_arrays as $team_type_array)
                                                    <option value="{{ $team_type_array->id }}">{{ $team_type_array->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('team_type_id')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="kenh_kd_id">Kênh kinh doanh:</label>
                                    <div id="kenh_kd_id_div">
                                        <select class="form-control px-2 select2-totaa" totaa-placeholder="Kênh kinh doanh ..." totaa-search="10" wire:model="kenh_kd_id" id="kenh_kd_id" style="width: 100%">
                                            <option selected></option>
                                            @if (!!optional($kenh_kd_arrays)->count())
                                                @foreach ($kenh_kd_arrays as $kenh_kd_array)
                                                    <option value="{{ $kenh_kd_array->id }}">{{ $kenh_kd_array->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('kenh_kd_id')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="nhom_kd_id">Nhóm sản phẩm:</label>
                                    <div id="nhom_kd_id_div">
                                        <select class="form-control px-2 select2-totaa" totaa-placeholder="Nhóm kinh doanh ..." totaa-search="10" wire:model="nhom_kd_id" id="nhom_kd_id" style="width: 100%">
                                            <option selected></option>
                                            @if (!!optional($nhom_kd_arrays)->count())
                                                @foreach ($nhom_kd_arrays as $nhom_kd_array)
                                                    <option value="{{ $nhom_kd_array->id }}">{{ $nhom_kd_array->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('nhom_kd_id')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="quanlys">Quản lý:</label>
                                    <div class="select2-success" id="quanlys_div">
                                        <select class="form-control px-2 select2-totaa" multiple totaa-placeholder="Quản lý ..." totaa-search="10" wire:model="quanlys" id="quanlys" style="width: 100%">
                                            @if (!!count($bfo_info_arrays))
                                                @foreach ($bfo_info_arrays as $bfo_info_array)
                                                    <option value="{{ $bfo_info_array["mnv"] }}">[{{ $bfo_info_array["mnv"] }}] {{ $bfo_info_array["full_name"] }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('quanlys')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="col-form-label" for="main_team_id">Trực thuộc nhóm:</label>
                                    <div class="select2-success" id="main_team_id_div">
                                        <select class="form-control px-2 select2-totaa" totaa-placeholder="Trực thuộc nhóm ..." totaa-search="10" wire:model="main_team_id" id="main_team_id" style="width: 100%">
                                            <option selected></option>
                                            @if (!!optional($team_arrays)->count())
                                                @foreach ($team_arrays as $team_array)
                                                    <option value="{{ $team_array->id }}">{{ $team_array->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    @error('main_team_id')
                                        <label class="pl-1 small invalid-feedback d-inline-block" ><i class="fas mr-1 fa-exclamation-circle"></i>{{ $message }}</label>
                                    @enderror
                                </div>
                            </div>

                            @if ($editStatus)
                                <div class="col-12">
                                    <div class="input-group form-group border-bottom cpc1hn-border py-2">
                                        <div class="input-group-prepend mr-4">
                                            <label class="col-form-label col-6 text-left pt-0 input-group-text border-0" for="active">Kích hoạt nhóm:</label>
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
                <button wire:click.prevent="save_team()" class="btn btn-success" wire:loading.attr="disabled">Xác nhận</button>
            </div>

        </div>
    </div>

</div>
