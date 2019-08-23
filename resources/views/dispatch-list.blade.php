@extends('layouts.app')
@section('title', 'Dispatch List')
@section('content')
<div class="section__content section__content--p30">
    <div class="container-fluid">
    	<div class="row">
			<div class="col-md-12">
		        <div class="overview-wrap">
		            <h6 class="display-5">Dispatch List</h6>
		            <button type="button" class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i>&nbsp; <a href="{{url('add-dispatch')}}" class="white-text">Add Item</a></button>
		        </div>
		    </div>
		    <div class="col-md-12">
		    	<div class="table-responsive">
                    <table class="table table-borderless table-data3 table-custom m-b-0">
                    	<thead>
                            <tr>
                                <th>
	                                <input type="text" id="se-from-date" name="se-from-date" placeholder="From Date" class="form-control-sm form-control">
                            	</th>
                                <th>
                                	<input type="text" id="se-to-date" name="se-to-date" placeholder="To Date" class="form-control-sm form-control">
                                </th>
                                <th>
                                	<select name="field-volts-used" id="field-volts-used" class="form-control-sm form-control">
                                        <option value="0">From</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                        <option value="2">Customer</option>
                                    </select>
                                </th>
                                <th>
                                	<select name="field-volts-used" id="field-volts-used" class="form-control-sm form-control">
                                        <option value="0">To</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                        <option value="2">Customer</option>
                                    </select>
                                </th>
                                <th>
                                	<input type="text" id="se-cus" name="se-cus" placeholder="Customer" class="form-control-sm form-control">
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
                                <th>date</th>
                                <th>type</th>
                                <th>description</th>
                                <th>status</th>
                                <th>price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2018-09-29 05:57</td>
                                <td>Mobile</td>
                                <td>iPhone X 64Gb Grey</td>
                                <td class="process">Processed</td>
                                <td>$999.00</td>
                                <td>
	                                <div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
	                                        <i class="zmdi zmdi-mail-send"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
	                                        <i class="zmdi zmdi-more"></i>
	                                    </button>
	                                </div>
	                            </td>
                            </tr>
                            <tr>
                                <td>2018-09-28 01:22</td>
                                <td>Mobile</td>
                                <td>Samsung S8 Black</td>
                                <td class="process">Processed</td>
                                <td>$756.00</td>
                                <td>
	                                <div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
	                                        <i class="zmdi zmdi-mail-send"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
	                                        <i class="zmdi zmdi-more"></i>
	                                    </button>
	                                </div>
	                            </td>
                            </tr>
                            <tr>
                                <td>2018-09-27 02:12</td>
                                <td>Game</td>
                                <td>Game Console Controller</td>
                                <td class="denied">Denied</td>
                                <td>$22.00</td>
                                <td>
	                                <div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
	                                        <i class="zmdi zmdi-mail-send"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
	                                        <i class="zmdi zmdi-more"></i>
	                                    </button>
	                                </div>
	                            </td>
                            </tr>
                            <tr>
                                <td>2018-09-26 23:06</td>
                                <td>Mobile</td>
                                <td>iPhone X 256Gb Black</td>
                                <td class="denied">Denied</td>
                                <td>$1199.00</td>
                                <td>
	                                <div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
	                                        <i class="zmdi zmdi-mail-send"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
	                                        <i class="zmdi zmdi-more"></i>
	                                    </button>
	                                </div>
	                            </td>
                            </tr>
                            <tr>
                                <td>2018-09-25 19:03</td>
                                <td>Accessories</td>
                                <td>USB 3.0 Cable</td>
                                <td class="process">Processed</td>
                                <td>$10.00</td>
                                <td>
	                                <div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
	                                        <i class="zmdi zmdi-mail-send"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
	                                        <i class="zmdi zmdi-more"></i>
	                                    </button>
	                                </div>
	                            </td>
                            </tr>
                            <tr>
                                <td>2018-09-29 05:57</td>
                                <td>Accesories</td>
                                <td>Smartwatch 4.0 LTE Wifi</td>
                                <td class="denied">Denied</td>
                                <td>$199.00</td>
                                <td>
	                                <div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
	                                        <i class="zmdi zmdi-mail-send"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
	                                        <i class="zmdi zmdi-more"></i>
	                                    </button>
	                                </div>
	                            </td>
                            </tr>
                            <tr>
                                <td>2018-09-24 19:10</td>
                                <td>Camera</td>
                                <td>Camera C430W 4k</td>
                                <td class="process">Processed</td>
                                <td>$699.00</td>
                                <td>
	                                <div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
	                                        <i class="zmdi zmdi-mail-send"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
	                                        <i class="zmdi zmdi-more"></i>
	                                    </button>
	                                </div>
	                            </td>
                            </tr>
                            <tr>
                                <td>2018-09-22 00:43</td>
                                <td>Computer</td>
                                <td>Macbook Pro Retina 2017</td>
                                <td class="process">Processed</td>
                                <td>$10.00</td>
                                <td>
	                                <div class="table-data-feature">
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Send">
	                                        <i class="zmdi zmdi-mail-send"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Edit">
	                                        <i class="zmdi zmdi-edit"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
	                                        <i class="zmdi zmdi-delete"></i>
	                                    </button>
	                                    <button class="item" data-toggle="tooltip" data-placement="top" title="More">
	                                        <i class="zmdi zmdi-more"></i>
	                                    </button>
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
@endsection