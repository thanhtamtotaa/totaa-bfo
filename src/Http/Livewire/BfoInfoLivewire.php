<?php

namespace Totaa\TotaaBfo\Http\Livewire;

use Livewire\Component;
use Auth;
use Illuminate\Support\Facades\Cache;

class BfoInfoLivewire extends Component
{
    /**
     * Các biến sử dụng trong Component
     *
     * @var mixed
     */
    public $team_id, $team, $name, $team_type_id, $main_team_id, $kenh_kd_id, $nhom_kd_id, $order, $active, $created_by, $quanlys, $members;
    public $bfo_info, $modal_title, $toastr_message, $team_type_arrays, $bfo_info_arrays, $kenh_kd_arrays, $nhom_kd_arrays, $team_arrays;

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
    protected $listeners = ['add_team', 'edit_team', 'set_team_member', ];

    /**
     * Validation rules
     *
     * @var array
     */
    protected function rules() {
        return [
            'team_id' => 'nullable|exists:teams,id',
            'name' => 'required',
            'team_type_id' => 'required|exists:team_types,id',
            'main_team_id' => 'nullable|exists:teams,id',
            'kenh_kd_id' => 'nullable|exists:kenh_kinhdoanhs,id',
            'nhom_kd_id' => 'nullable|exists:nhom_kinhdoanhs,id',
            'order' => 'nullable|numeric',
            'active' => 'nullable|boolean',
            'created_by' => 'required|exists:bfo_infos,mnv',
            'quanlys' => 'nullable|array',
            'quanlys.*' => 'nullable|exists:bfo_infos,mnv',
            'members' => 'nullable|array',
            'members.*' => 'nullable|exists:bfo_infos,mnv',
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
        $this->bfo_info_arrays = [];
    }

}
