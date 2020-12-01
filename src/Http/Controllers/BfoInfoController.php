<?php

namespace Totaa\TotaaBfo\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Totaa\TotaaBfo\DataTables\BfoInfoDataTable;

class BfoInfoController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index(BfoInfoDataTable $dataTable)
    {
        if (Auth::user()->bfo_info->hasAnyPermission(["view-bfo"])) {
            return $dataTable->render('totaa-bfo::bfo', ['title' => 'Quản lý Thông tin BFO']);
        } else {
            return view('errors.dynamic', [
                'error_code' => '403',
                'error_description' => 'Không có quyền truy cập',
                'title' => 'Quản lý Thông tin BFO',
            ]);
        }
    }
}
