@extends('merchant.layouts.master')
@section('title', 'Collection History')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('merchant.dashboard'),
                'Collection History'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Sub Area list' :links="$links" />
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> {{__('Collection History')}}</h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <h4 class="mb-0 text-primary">Total Balance: TK</h4>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table">
                                {{--  show from datatable--}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Responsive tables end -->
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            $('#dataTable').dataTable({
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{{ route('merchant.collection.index') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "parcel_info",title:"Parcel info", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "parcel_price",title:"Parcel Price", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "amount",title:"Collected Amount (TK)", name: "DT_RowIndex", searchable: false, orderable: false},
                ],
            });
        })
    </script>
@endpush

