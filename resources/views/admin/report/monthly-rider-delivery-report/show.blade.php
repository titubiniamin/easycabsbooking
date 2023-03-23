@extends('layouts.master')
@push('style')
    <link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Delivery Charge Report Merchant Wise')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('admin.dashboard'),
            'Delivery Charge Report Merchant Wise'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Delivery Charge Report Merchant Wise' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Monthly Delivery Report</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" class="">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="month">Select Month </label>
                                            <select class="form-control select2" name="month" id="month">
                                                <?php for ($m = 1; $m <= 12; ++$m) {
                                                $month_label = date('F', mktime(0, 0, 0, $m, 1));
                                                ?>
                                                <option value="<?php echo $m; ?>"><?php echo $month_label; ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="year">Select Year </label>
                                            <select class="form-control select2" name="year" id="year">
                                                <?php
                                                $year = date('Y');
                                                $min = $year - 60;
                                                $max = $year;
                                                for ($i = $max; $i >= $min; $i--) {
                                                    echo '<option value=' . $i . '>' . $i . '</option>';
                                                }
                                                ?>
                                            </select>

                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label for="search_button"></label>
                                            <button class="btn btn-primary waves-effect waves-float waves-light form-control" id="search_button" type="button">Search
                                            </button>
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
    {{--    <script>--}}
    {{--        $(function() {--}}
    {{--            $('input[name="date_range"]').daterangepicker({--}}
    {{--                opens: 'left',--}}
    {{--                autoUpdateInput: false,--}}
    {{--            }, function(start, end, label) {--}}
    {{--                $('input[name="date_range"]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));--}}
    {{--                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}

    <script>
        $(document).ready(function() {
            $('#search_button').on('click', function() {
                let month = $('#month').val();
                let year = $('#year').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.monthly-rider-delivery-report.search-result') }}",
                    data: {
                        month: month,
                        year: year,
                    },
                    success: function(response) {
                        console.log(response)
                        $("#searchResult").html(response);
                    }
                });
            });
        });
    </script>
@endpush

