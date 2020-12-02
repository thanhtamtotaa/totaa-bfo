<?php

namespace Totaa\TotaaBfo\DataTables;

use Totaa\TotaaBfo\Models\BfoInfo;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Auth;
use Totaa\TotaaTeam\Traits\BfoHasTeamTraits;

class BfoInfoDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                $Action_Icon="<div class='action-div icon-4 px-0 mx-1 d-flex justify-content-around text-center'>";

                if (Auth::user()->bfo_info->can("edit-bfo")) {
                    $Action_Icon.="<div class='col action-icon-w-50 action-icon' totaa-edit-bfo='$query->mnv'><i class='text-indigo fas fa-user-edit'></i></div>";
                }

                if ((trait_exists(BfoHasTeamTraits::class)) && (Auth::user()->bfo_info->can("edit-bfo"))) {
                    $Action_Icon.="<div class='col action-icon-w-50 action-icon' totaa-set-bfo-team='$query->mnv'><i class='text-success fas fa-users'></i></div>";
                }

                $Action_Icon.="</div>";

                return $Action_Icon;
            })
            ->editColumn('active', function ($query) {
                if (!!$query->active) {
                    return "Đã kích hoạt";
                } else {
                    return "Đã vô hiệu hóa";
                }
            })
            ->editColumn('member_of_teams', function ($query) {
                return implode(", ", $query->member_of_teams->pluck("name")->toArray());
            })
            ->editColumn('ngay_vao_lam', function ($query) {
                if (!!$query->ngay_vao_lam) {
                    return $query->ngay_vao_lam->format("d-m-Y");
                } else {
                    return NULL;
                }
            })
            ->editColumn('birthday', function ($query) {
                if (!!$query->birthday) {
                    return $query->birthday->format("d-m-Y");
                } else {
                    return NULL;
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Totaa\TotaaBfo\Models\BfoInfo $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BfoInfo $model)
    {
        $query = $model->newQuery();

        if (!request()->has('order')) {
            $query->orderBy('mnv', 'asc');
        };

        return $query->with(["member_of_teams:id,name"]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('bfoinfo-table')
                    ->columns($this->getColumns())
                    ->dom("<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'row'<'col-sm-12 table-responsive't>><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>")
                    ->parameters([
                        "autoWidth" => false,
                        "lengthMenu" => [
                            [10, 25, 50, -1],
                            [10, 25, 50, "Tất cả"]
                        ],
                        "order" => [],
                        'initComplete' => 'function(settings, json) {
                            var api = this.api();
                            window.addEventListener("dt_draw", function(e) {
                                api.draw(false);
                                e.preventDefault();
                            })
                            api.buttons()
                                .container()
                                .appendTo($("#datatable-button"));
                        }',
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center')
                    ->title("")
                    ->footer(""),
            Column::make('mnv')
                  ->title("Mã nhân viên")
                  ->width(15)
                  ->searchable(true)
                  ->orderable(true)
                  ->footer("Mã nhân viên"),
            Column::make('full_name')
                  ->title("Họ tên")
                  ->width(200)
                  ->searchable(true)
                  ->orderable(true)
                  ->footer("Họ tên"),
            Column::computed('birthday')
                  ->title("Ngày sinh")
                  ->width(80)
                  ->searchable(false)
                  ->orderable(true)
                  ->footer("Ngày sinh"),
            Column::computed('ngay_vao_lam')
                  ->title("Ngày vào làm")
                  ->width(80)
                  ->searchable(false)
                  ->orderable(true)
                  ->footer("Ngày vào làm"),
            Column::computed('member_of_teams')
                  ->title("Nhóm")
                  ->width(150)
                  ->searchable(false)
                  ->orderable(false)
                  ->footer("Nhóm"),
            Column::computed('active')
                  ->title("Trạng thái")
                  ->searchable(false)
                  ->orderable(false)
                  ->footer("Trạng thái"),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'BfoInfo_' . date('YmdHis');
    }
}
