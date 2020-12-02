<?php

namespace Totaa\TotaaBfo\Http\Livewire;

use Livewire\Component;
use Auth;
use Illuminate\Support\Facades\Cache;
use Totaa\TotaaBfo\Models\BfoInfo;
use Totaa\TotaaTeam\Models\Team;

class BfoInfoLivewire extends Component
{
    /**
     * Các biến sử dụng trong Component
     *
     * @var mixed
     */
    public $nhanvien, $mnv, $full_name, $name, $birthday, $ngay_vao_lam, $active;
    public $bfo_info, $modal_title, $toastr_message, $team_arrays = [], $teams;

    /**
     * Cho phép cập nhật updateMode
     *
     * @var bool
     */
    public $updateMode = false;
    public $editStatus = false;

    /**
     * Các biển sự kiện
     *
     * @var array
     */
    protected $listeners = ['add_bfo_info', 'view_bfo_info', 'edit_bfo_info', 'delete_bfo_info', 'set_bfo_info_team', ];

    /**
     * Validation rules
     *
     * @var array
     */
    protected function rules() {
        return [
            'full_name' => 'required',
            'name' => 'required',
            'birthday' => 'nullable|date_format:d-m-Y',
            'ngay_vao_lam' => 'nullable|date_format:d-m-Y',
            'active' => 'nullable|boolean',
            'teams' => 'nullable|exists:teams,id',
        ];
    }

    /**
     * render view
     *
     * @return void
     */
    public function render()
    {
        return view('totaa-bfo::livewire.bfo-livewire');
    }

    /**
     * mount data
     *
     * @return void
     */
    public function mount()
    {
        $this->bfo_info = Auth::user()->bfo_info;
        $this->created_by = $this->bfo_info->mnv;
    }

    /**
     * On updated action
     *
     * @param  mixed $propertyName
     * @return void
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFullName()
    {
        $this->full_name = mb_convert_case(trim($this->full_name), MB_CASE_TITLE, "UTF-8");
        $names = explode(' ', $this->full_name);
        $this->name = array_pop($names);
    }

    public function updatedMnv()
    {
        if ((!!$this->nhanvien && $this->nhanvien->mnv != $this->mnv) || !!!$this->nhanvien) {
            $this->validate([
                'mnv' => 'required|unique:bfo_infos,mnv',
            ]);
        }
    }

    /**
     * cancel
     *
     * @return void
     */
    public function cancel()
    {
        $this->updateMode = false;
        $this->editStatus = false;
        $this->resetValidation();
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('hide_modal');
    }

    /**
     * add_bfo_info method
     *
     * @return void
     */
    public function add_bfo_info()
    {
        if ($this->bfo_info->cannot("add-bfo")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->modal_title = "Thêm nhân viên mới";
        $this->toastr_message = "Thêm nhân viên thành công";
        $this->active = true;
        $this->dispatchBrowserEvent('show_modal', "#add_edit_modal");
    }

    /**
     * edit_bfo_info method
     *
     * @return void
     */
    public function edit_bfo_info($mnv)
    {
        if ($this->bfo_info->cannot("edit-bfo")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->modal_title = "Chỉnh sửa nhân viên";
        $this->toastr_message = "Chỉnh sửa nhân viên thành công";
        $this->editStatus = true;
        $this->updateMode = true;

        $this->mnv = $mnv;
        $this->nhanvien = BfoInfo::find($this->mnv);
        $this->full_name = $this->nhanvien->full_name;
        $this->name = $this->nhanvien->name;
        $this->birthday = !!$this->nhanvien->birthday ? $this->nhanvien->birthday->format("d-m-Y") : NULL;
        $this->ngay_vao_lam = !!$this->nhanvien->ngay_vao_lam ? $this->nhanvien->ngay_vao_lam->format("d-m-Y") : NULL;
        $this->active = !!$this->nhanvien->active;

        $this->dispatchBrowserEvent('show_modal', "#add_edit_modal");
    }

    /**
     * save_bfo_info
     *
     * @return void
     */
    public function save_bfo_info()
    {
        if ($this->bfo_info->cannot("add-bfo")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        if ((!!$this->nhanvien && $this->nhanvien->mnv != $this->mnv) || !!!$this->nhanvien) {
            $this->validate([
                'mnv' => 'required|unique:bfo_infos,mnv',
            ]);
        }

       $validateData = $this->validate();

       $validateData["mnv"] = $this->mnv;

       if (!!!$validateData["birthday"]) {
        $validateData["birthday"] = NULL;
       }

       if (!!!$validateData["ngay_vao_lam"]) {
        $validateData["ngay_vao_lam"] = NULL;
       }

       try {
            if (!!$this->nhanvien) {
                $this->nhanvien->update($validateData);
            } else {
                BfoInfo::create($validateData);
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $toastr_message = $this->toastr_message;
        $this->cancel();
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => $toastr_message]);
    }

    /**
     * set_bfo_info_team method
     *
     * @return void
     */
    public function set_bfo_info_team($mnv)
    {
        if ($this->bfo_info->cannot("edit-bfo")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->modal_title = "Set nhóm cho nhân viên";
        $this->toastr_message = "Set nhóm cho nhân viên thành công";
        $this->editStatus = true;
        $this->updateMode = true;

        $this->mnv = $mnv;
        $this->nhanvien = BfoInfo::find($this->mnv);
        $this->full_name = $this->nhanvien->full_name;
        $this->teams = $this->nhanvien->member_of_teams->pluck("id");

        $this->team_arrays = Team::where("active", true)->orderBy("order")->orderBy("id")->select("id", "name")->get()->toArray();

        $this->dispatchBrowserEvent('show_modal', "#set_bfo_team_modal");
    }

    /**
     * save_bfo_info_team
     *
     * @return void
     */
    public function save_bfo_info_team()
    {
        if ($this->bfo_info->cannot("edit-bfo")) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => "Bạn không có quyền thực hiện hành động này"]);
            return null;
        }

        $this->validate([
            'teams' => 'nullable|array',
            'teams.*' => 'nullable|exists:teams,id',
        ]);

        try {
            $this->nhanvien->member_of_teams()->sync($this->teams);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toastr', ['type' => 'warning', 'title' => "Thất bại", 'message' => implode(" - ", $e->errorInfo)]);
            return null;
        }

        //Đầy thông tin về trình duyệt
        $this->dispatchBrowserEvent('dt_draw');
        $toastr_message = $this->toastr_message;
        $this->cancel();
        $this->dispatchBrowserEvent('toastr', ['type' => 'success', 'title' => "Thành công", 'message' => $toastr_message]);
    }
}
