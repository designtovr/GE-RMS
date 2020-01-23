@extends('layouts.app')
@section('title', 'Dispatch Report')
@section('content')
<div class="main-content" ng-controller="DispatchReportController">
	<div class="section__content section__content--p30">
        <div class="container-fluid">
        	<div class="row">
				<div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <strong>Dispatch</strong>
                            <small> Details</small>
                        </div>
                        <div class="card-body card-block">
                            <p><b>R Id: </b>{{$formatted_pv_id}}</p>
							<p><b>Dispatched Date: </b>{{$dispatched_date}}</p>
							<p><b>Dispatched by: </b>{{$dispatched_by}}</p>
                            <p><b>DC No: </b>
                                @if(!is_null($dc_no))
                                    {{$dc_no}}
                                @else
                                    NA
                                @endif
                            </p>
                            <p><b>Docket Details: </b>
                                @if(!is_null($docket_details) || !empty($docket_details))
                                    {{$docket_details}}
                                @else
                                    NA
                                @endif
                            </p>
                            <p><b>Courier Name: </b>
                                @if(!is_null($courier_name) || !empty($courier_name))
                                    {{$courier_name}}
                                @else
                                    NA
                                @endif
                            </p>
                            <p><b>Person Name: </b>
                                @if(!is_null($person_name) || !empty($person_name))
                                    {{$person_name}}
                                @else
                                    NA
                                @endif
                            </p>
                            <p><b>Concern Name: </b>
                                @if(!is_null($concern_name) || !empty($concern_name))
                                    {{$concern_name}}
                                @else
                                    NA
                                @endif
                            </p>
                            <p><b>Contact: </b>
                                @if(!is_null($contact) || !empty($contact))
                                    {{$contact}}
                                @else
                                    NA
                                @endif
                            </p>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm" ng-click="Back();">Back</button>
                        </div>
                    </div>
                </div>
			</div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="{{url('public/js/controllers/DispatchReportController.js')}}"></script>
@endsection