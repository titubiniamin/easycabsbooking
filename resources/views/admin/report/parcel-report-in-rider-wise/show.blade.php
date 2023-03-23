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
            'Parcel Report in rider'=>''
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
                                        <div class="form-group col-md-3">
                                            <label for="merchant_id">Select Rider </label>
                                            <select class="form-control select2" name="rider_id" id="rider_id">
                                                <option value="">Select One</option>
                                                @foreach($riders as $rider)
                                                    @if (old('rider_id')==$rider->id)
                                                        <option value={{$rider->id}} selected>{{$rider->name}}</option>
                                                    @else
                                                        <option value="{{$rider->id}}">{{$rider->name}}</option>
                                                    @endif
                                                @endforeach

                                            </select>
                                            <div>
                                                <span class="text-danger" id="rider_id"></span>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="status">Select Status</label>
                                            <select class="form-control select2" name="status" id="status">
                                                <option value="all" selected>All</option>
                                                <option value="waiting_for_pickup">Waiting for Pickup</option>
                                                <option value="pending">Pending</option>
                                                <option value="transit">Transit</option>
                                                <option value="delivered">Delivered/Cash</option>
                                                <option value="partial">Partial</option>
                                                <option value="hold">Hold</option>
                                                <option value="cancelled">Cancelled</option>
                                                <option value="cancel_accept_by_incharge">Cancel accept by incharge</option>
                                                <option value="cancel_accept_by_merchant">Cancel accept by merchant</option>
                                            </select>
                                            @if($errors->has('status'))
                                                <small class="text-danger">{{$errors->first('status')}}</small>
                                            @endif

                                        </div>

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
                let rider_id = $('#rider_id').val();
                let daterange = $('#daterange').val();
                let status = $('#status').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.parcel-summary-in-rider-wise-search') }}",
                    data: {
                        rider_id: rider_id,
                        dateRange: daterange,
                        status: status,
                    },
                    error:function (response) {
                        $('#rider_id').text(response.responseJSON.errors.rider_id);
                    },
                    success: function(response) {
                        $("#searchResult").html(response);
                    }

                });
                if (rider_id === '') {
                    alert('Please Select Rider Right Now');
                } else {

                }
            });
        });
    </script>
@endpush

