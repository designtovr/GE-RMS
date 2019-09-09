@extends('layouts.app')
@section('title', 'Relay Repair Status List')
@section('content')
<div class="main-content">
	<div class="section__content section__content--p30">
	    <div class="container-fluid">
	    	<div class="row">
				<div class="col-md-12">
			        <div class="overview-wrap">
			            <h6 class="pb-4 display-5">Other Relay Repair Status List</h6>
			            <!-- <button type="button" class="btn btn-primary btn-sm">
	                        <i class="fa fa-plus"></i>&nbsp; <a href="{{url('add-relay-repair-status')}}" class="white-text">Add Item</a></button> -->
			        </div>
			    </div>
			    <div class="col-md-12">
			    	<div class="table-responsive">
	                    <table class="table table-borderless table-data3 table-custom">
	                    	<thead>
	                            <tr>
	                                <th>
		                                <input type="text" id="se-from-date" name="se-from-date" placeholder="From Date" class="form-control-sm form-control">
	                            	</th>
	                                <th>
	                                	<input type="text" id="se-to-date" name="se-to-date" placeholder="To Date" class="form-control-sm form-control">
	                                </th>
	                                <th>
	                                    <input type="text" id="se-from" name="se-from" placeholder="From" class="form-control-sm form-control">
	                                </th>
	                                <th>
	                                	<input type="text" id="se-to" name="se-to" placeholder="To" class="form-control-sm form-control">
	                                </th>
	                                <th>
	                                	<input type="text" id="se-cus" name="se-cus" placeholder="Customer" class="form-control-sm form-control">
	                                </th>
	                                <th>
	                                	<input type="text" id="se-rid" name="se-rid" placeholder="RID" class="form-control-sm form-control">
	                                </th>
	                                <th>
	                                	<input type="text" id="se-rma" name="se-rma" placeholder="RMA" class="form-control-sm form-control">
	                                </th>
	                                <th>
	                                	<button type="button" class="btn btn-outline-secondary btn-sm">Reset</button>
	                                </th>
	                                <th>
	                                	<button type="button" class="btn btn-outline-primary btn-sm">
	                                            <i class="fa fa-search"></i>&nbsp; Search</button>
	                                </th>
	                            </tr>
	                        </thead>
	                    </table>
	                </div>
			    </div>
	            <div class="col-md-12">
	                <!-- DATA TABLE-->
	                <div class="table-responsive m-b-40">
	                    <table class="table table-borderless table-data3">
	                        <thead>
	                            <tr>
	                                <th>RID</th>
	                                <th>RMA No</th>
	                                <th>Comment</th>
	                                <th>Status</th>
	                                <th>Actions</th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                            <tr>
	                                <td>1</td>
	                                <td>1234</td>
	                                <td>Comment</td>
	                                <td class="process">Processed</td>
	                                <td>
	                                	<div class="table-data-feature">
			                                <div class="btn-group">
	                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-info">Action</button>
	                                            <!-- <button class="item" data-toggle="dropdown" data-placement="top" title="More" aria-haspopup="true" aria-expanded="false">
			                                        <i class="zmdi zmdi-more"></i>
			                                    </button> -->
	                                            <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
	                                                <button type="button" tabindex="0" class="dropdown-item">Open</button>
	                                                <button type="button" tabindex="0" class="dropdown-item">Completed</button>
	                                                <button type="button" tabindex="0" class="dropdown-item">Processed</button>
	                                                <div tabindex="-1" class="dropdown-divider"></div>
	                                                <button type="button" tabindex="0" class="dropdown-item">Denied</button>
	                                            </div>
	                                        </div>
	                                    </div>
		                            </td>
	                            </tr>
	                            <tr>
	                                <td>2</td>
	                                <td>12345</td>
	                                <td>Comment 2</td>
	                                <td class="denied">Closed</td>
	                                <td>
		                                <div class="table-data-feature">
			                                <div class="btn-group">
	                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-info">Action</button>
	                                            <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
	                                                <button type="button" tabindex="0" class="dropdown-item">Open</button>
	                                                <button type="button" tabindex="0" class="dropdown-item">Completed</button>
	                                                <button type="button" tabindex="0" class="dropdown-item">Processed</button>
	                                                <div tabindex="-1" class="dropdown-divider"></div>
	                                                <button type="button" tabindex="0" class="dropdown-item">Denied</button>
	                                            </div>
	                                        </div>
	                                    </div>
		                            </td>
	                            </tr>
	                            <tr>
	                                <td>3</td>
	                                <td>12346</td>
	                                <td>Comment 3</td>
	                                <td class="process">Open</td>
	                                <td>
		                                <div class="table-data-feature">
			                                <div class="btn-group">
	                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-info">Action</button>
	                                            <!-- <button class="item" data-toggle="dropdown" data-placement="top" title="More" aria-haspopup="true" aria-expanded="false">
			                                        <i class="zmdi zmdi-more"></i>
			                                    </button> -->
	                                            <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
	                                                <button type="button" tabindex="0" class="dropdown-item">Open</button>
	                                                <button type="button" tabindex="0" class="dropdown-item">Completed</button>
	                                                <button type="button" tabindex="0" class="dropdown-item">Processed</button>
	                                                <div tabindex="-1" class="dropdown-divider"></div>
	                                                <button type="button" tabindex="0" class="dropdown-item">Denied</button>
	                                            </div>
	                                        </div>
	                                    </div>
		                            </td>
	                            </tr>
	                            <tr>
	                                <td>4</td>
	                                <td>12347</td>
	                                <td>Comment 5</td>
	                                <td class="denied">Denied</td>
	                                <td>
		                                <div class="table-data-feature">
			                                <div class="btn-group">
	                                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle btn btn-info">Action</button>
	                                            <!-- <button class="item" data-toggle="dropdown" data-placement="top" title="More" aria-haspopup="true" aria-expanded="false">
			                                        <i class="zmdi zmdi-more"></i>
			                                    </button> -->
	                                            <div tabindex="-1" aria-hidden="true" role="menu" class="dropdown-menu">
	                                                <button type="button" tabindex="0" class="dropdown-item">Open</button>
	                                                <button type="button" tabindex="0" class="dropdown-item">Completed</button>
	                                                <button type="button" tabindex="0" class="dropdown-item">Processed</button>
	                                                <div tabindex="-1" class="dropdown-divider"></div>
	                                                <button type="button" tabindex="0" class="dropdown-item">Denied</button>
	                                            </div>
	                                        </div>
	                                    </div>
		                            </td>
	                            </tr>
	                        </tbody>
	                    </table>
	                </div>
	                <!-- END DATA TABLE-->
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection