
@extends('layouts.master')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Parcel Report')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('admin.dashboard'),
            'Parcel'=>route('admin.parcel.index'),
            'Parcel Report'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Parcel Report' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Parcel Report</h4>
                            </div>
                            <div class="card-body">
                                <form action="" class="">
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label for="daterange">Range</label>
                                            <input type="text" id="daterange" class="form-control flatpickr-range" name="daterange" placeholder="YYYY-MM-DD to YYYY-MM-DD"  autocomplete="off">
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="fp-range"></label>
                                            <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="button" id="search_button">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="searchResult"></div>
                    </div>
                </div>
            </section>
            <!-- Basic Inputs end -->
        </div>
    </div>

@endsection

@push('script')
    <script src="{{asset('admin/app-assets/js/moment.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/daterangepicker.js')}}"></script>
    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left',
                autoUpdateInput: false,
            }, function(start, end, label) {
                $('input[name="daterange"]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#search_button').on('click', function() {
                let daterange = $('#daterange').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.parcel-summary-before-date-search') }}",
                    data: {
                        dateRange: daterange
                    },
                    success: function(response) {
                        $("#searchResult").html(response);
                    }

                });
            });
        });
    </script>
@endpush

