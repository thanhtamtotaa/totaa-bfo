
@extends('layouts.layout-2')
@section('styles')
    <link rel="stylesheet" href="{{ mix('/vendor/libs/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ mix('/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}">
@endsection

@section('scripts')
    <!-- Dependencies -->
    <script src="{{ mix('/vendor/libs/datatables/datatables.js') }}"></script>
    <script src="{{ mix('/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ mix('/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ mix('/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.vi.min.js') }}"></script>
@endsection

@push('datatables')
    {{$dataTable->scripts()}}
@endpush

@section('content')
    <h4 class="font-weight-bold py-3 mb-4">Quản lý Thông tin BFO</h4>

    <div class="card">


        @livewire('totaa-bfo::bfo-livewire')

        <div class="card-datatable table-responsive pt-2">
            {{$dataTable->table(["totaa-datatables", "class" => "table table-striped table-bordered", "width" => "100%"])}}
        </div>

    </div>

@endsection
