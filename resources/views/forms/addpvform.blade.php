<div class="col-lg-12" ng-init="GetCustomerList();GetEndCustomerList();">
	<div class="card">
		<div class="card-header">
            <strong>RMA</strong> Form
        </div>
        <div class="card-body card-block">
        	<form name="AddPVForm1" id="AddPVForm1" class="form-horizontal" novalidate>
        		<div class="row form-group">
                    <div class="col col-md-3">
                        <label for="id" class=" form-control-label">RMA No</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input 
                        	type="text" 
                        	id="id" 
                        	name="id"
                        	ng-model="pvformdata.id"
                            placeholder="RMA Reference No"
                            class="form-control"
                            disabled>
                    </div>
                </div>
        		<div class="row form-group">
                    <div class="col col-md-3">
                        <label for="gs_no" class=" form-control-label">GS No</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input 
                        type="text" 
                        id="gs_no" 
                        name="gs_no" 
                        ng-model="pvformdata.gs_no"
                        placeholder="GS No"
                        class="form-control"
                        disabled>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="act_reference" class="form-control-label">ACT Reference</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input 
                        type="text" 
                        id="act_reference" 
                        name="act_reference"
                        ng-model="pvformdata.act_reference"
                        placeholder="ACT Reference" 
                        class="form-control"
                        disabled>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="date" class=" form-control-label">Date</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input 
                        type="text" 
                        id="date" 
                        name="date" 
                        ng-model="pvformdata.date"
                        placeholder="Date"
                        class="form-control"
                        disabled>
                    </div>
                </div>
        	</form>
        </div>
	</div>
	<div class="row">
        <div class="col-lg-12">
            <div class="card ">
            	<div class="card-header">
                    <strong>IDENTIFICATION OF UNIT & FAULT INFORMATION</strong>
                </div>
                <div class="card-body card-block">
                	<!-- start accordion -->
                	<form name="AddPVForm2" id="AddPVForm2" class="form-horizontal" novalidate>
	                	<div id="accordion" ng-repeat="addedpv in pvformdata.addedpvs track by $index">
							  <div class="card">
							    <div class="card-header" id="heading@{{$index}}">
							      <h5 class="mb-0">
							        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse@{{$index}}" aria-expanded="true" aria-controls="collapse@{{$index}}">
							          Relay Id #@{{addedpv.relay.id}}
							        </button>
							      </h5>
							    </div>

							    <div id="collapse@{{$index}}" class="collapse show" aria-labelledby="heading@{{$index}}" data-parent="#accordion">
							      <div class="card-body">
			                        <div class="col-lg-12 p-b-20 p-t-10" >
			                        	<div class="row">
			                        		<div class="col-md-12">
			                                    <button class="btn btn-danger btn-md float-right" id="removeunit@{{$index}}" name="removeunit@{{$index}}" ng-click="RemovePVUnit($index);">
			                                        <i class="fa fa-minus"></i>&nbsp; Remove
			                                    </button>
			                                </div>
			                        	</div>
			                        	<div class="row">
			                        		<div class="col-lg-6">
			                        			<div class="row form-group">
			                                        <div class="col-md-4">
			                                            <label for="relay_@{{$index}}" class=" form-control-label">	Relay Id
			                                            </label>
			                                        </div>
			                                        <div class="col-md-8">
			                                            <ui-select ng-model="addedpv.relay" theme="selectize" title="Select Relay Id" id="relay_@{{$index}}" 
			                                            name="relay_@{{$index}}" ng-change="ChangeRelayDetails($index, addedpv);CheckForAlreadeyExists($index, addedpv)">
														    <ui-select-match placeholder="Select Relay Id">@{{$select.selected.id}}
														    </ui-select-match>
														    <ui-select-choices repeat="pv in selectedpvs | filter: $select.search">
														      <span ng-bind-html="pv.id | highlight: $select.search"></span>
														    </ui-select-choices>
														  </ui-select>
						                        	</div>
						                        </div>
			                        		</div>
			                        	</div>
			                        	<div class="row">
			                        		<div class="col-lg-6">
			                        			<div class="row form-group">
			                                        <div class="col-md-4">
			                                            <label for="model_no_@{{$index}}" class=" form-control-label">Model
			                                                No</label>
			                                        </div>
			                                        <div class="col-md-8">
			                                            <input 
                                                        type="text" 
                                                        id="model_no_@{{$index}}"
                                                        name="model_no_@{{$index}}"
                                                        ng-model="addedpv.part_no"
                                                        placeholder="Model No"
                                                        class="form-control"
                                                        disabled>
			                                        </div>
			                                    </div>
			                        		</div>
			                        	</div>
			                        	<div class="row">
			                        		<div class="col-lg-6">
			                        			<div class="row form-group">
			                        				<div class="col-md-4">
			                                            <label for="type_of_material_@{{$index}}" class=" form-control-label">Type Of Material</label>
			                                        </div>
			                                        <div class="col-md-8">
			                                            <input 
			                                            type="text" 
			                                            id="type_of_material_@{{$index}}"
			                                            name="type_of_material_@{{$index}}"
			                                            ng-model="addedpv.category"
			                                            placeholder="Type of Material"
			                                            class="form-control"
			                                            disabled>
			                                        </div>
			                        			</div>
			                        		</div>
			                        		<div class="col-lg-6">
			                        			<div class="row form-group">
			                            			<div class="col-md-4">
			                                            <label for="serial_no_@{{$index}}" class=" form-control-label">Serial Number</label>
			                                        </div>
			                                        <div class="col-md-8">
			                                        	<input 
		                                                type="text" 
		                                                id="serial_no_@{{$index}}" 
		                                                name="serial_no_@{{$index}}"
		                                                ng-model="addedpv.serial_no"
		                                                placeholder="Serial Number" 
		                                                class="form-control"
		                                                disabled>
			                                        </div>
			                                    </div>
			                        		</div>
			                        	</div>
			                        	<div class="row">
			                        		<div class="col-lg-6">
			                        			<div class="row form-group">
			                                        <div class="col col-md-4">
			                                            <label for="sw_version_@{{$index}}" class=" form-control-label">SW Version</label>
			                                        </div>
			                                        <div class="col-md-8">
			                                            <input 
			                                            type="text" 
			                                            id="sw_version_@{{$index}}" 
			                                            name="sw_version_@{{$index}}"
			                                            ng-model="addedpv.sw_version"
			                                            placeholder="SW Version" 
			                                            class="form-control">
			                                        </div>
			                                    </div>
			                        		</div>
			                        		<div class="col-lg-6">
			                        			<div class="row form-group">
			                                        <div class="col col-md-4">
			                                            <label class=" form-control-label">Warranty</label>
			                                        </div>
			                                        <div class="col col-md-8">
			                                            <div class="form-check">
			                                                <div class="radio">
			                                                    <label for="warrenty1_@{{$index}}"
			                                                           class="form-check-label">
			                                                        <input 
			                                                        type="radio" 
			                                                        id="warrenty1_@{{$index}}"
			                                                        name="warrenty_@{{$index}}"
			                                                        ng-model="addedpv.warrenty"
			                                                        ng-value="1"
			                                                        class="form-check-input">Yes
			                                                    </label>
			                                                </div>
			                                                <div class="radio">
			                                                    <label for="warrenty2_@{{$index}}"
			                                                           class="form-check-label ">
			                                                        <input 
			                                                        type="radio" 
			                                                        id="warrenty2_@{{$index}}"
			                                                        name="warrenty_@{{$index}}"
			                                                        ng-model="addedpv.warrenty"
			                                                        ng-value="0"
			                                                        class="form-check-input">No
			                                                    </label>
			                                                </div>
			                                            </div>
			                                        </div>
			                                    </div>
			                        		</div>
			                        	</div>
			                        	<div class="row">
			                        		<div class="col-lg-12">
					                            <div class="row form-group">
					                                <div class="col col-md-4">
					                                    <label for="desc_of_fault_@{{$index}}" class=" form-control-label">Description of Fault </label>
					                                </div>
					                                <div class="col-12 col-md-8">
					                                    <textarea 
					                                    type="text" 
					                                    id="desc_of_fault_@{{$index}}" 
					                                    name="desc_of_fault_@{{$index}}"
					                                    ng-model="addedpv.desc_of_fault"
					                                    placeholder="Description of Fault" 
					                                    rows="4" 
					                                    class="form-control">
					                                    </textarea>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
			                        		<div class="col-lg-12">
					                            <div class="row form-group">
					                                <div class="col col-md-4">
					                                    <label for="sales_order_no_@{{$index}}" class=" form-control-label">WBS/Sales Order
					                                        No</label>
					                                </div>
					                                <div class="col-12 col-md-8">
					                                    <input 
					                                    type="text" 
					                                    id="sales_order_no_@{{$index}}" 
					                                    name="sales_order_no_@{{$index}}"
					                                    ng-model="addedpv.sales_order_no"
					                                    placeholder="WBS/Sales Order No" 
					                                    class="form-control">
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
			                        		<div class="col-lg-12">
					                            <div class="row form-group">
					                                <div class="col col-md-4">
					                                    <label for="field_volts_used_@{{$index}}" class=" form-control-label">Are Field Volts Used(Y/N)?</label>
					                                </div>
					                                <div class="col-12 col-md-8">
					                                	<div class="form-check">
					                                        <div class="radio">
					                                            <label for="field_volts_used1_@{{$index}}"
					                                                   class="form-check-label">
					                                                <input 
					                                                type="radio" 
					                                                id="field_volts_used1_@{{$index}}"
					                                                name="field_volts_used_@{{$index}}"
					                                                ng-model="addedpv.field_volts_used"
					                                                ng-value="1"
					                                                class="form-check-input">Yes
					                                            </label>
					                                        </div>
					                                        <div class="radio">
					                                            <label for="field_volts_used2_@{{$index}}"
					                                                   class="form-check-label ">
					                                                <input 
					                                                type="radio" 
					                                                id="field_volts_used2_@{{$index}}"
					                                                name="field_volts_used_@{{$index}}"
					                                                ng-model="addedpv.field_volts_used"
					                                                ng-value="0"
					                                                class="form-check-input">No
					                                            </label>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
			                        		<div class="col-lg-12">
					                            <div class="row form-group">
					                                <div class="col col-md-4">
					                                    <label class=" form-control-label">Equipment failed during
					                                        installation/commissioning</label>
					                                </div>
					                                <div class="col col-md-8">
					                                    <div class="form-check">
					                                        <div class="radio">
					                                            <label for="equip_failed_on_installation1_@{{$index}}"
					                                                   class="form-check-label">
					                                                <input 
					                                                type="radio" 
					                                                id="equip_failed_on_installation1_@{{$index}}"
					                                                name="equip_failed_on_installation_@{{$index}}"
					                                                ng-model="addedpv.equip_failed_on_installation"
					                                                ng-value="1"
					                                                class="form-check-input">Yes
					                                            </label>
					                                        </div>
					                                        <div class="radio">
					                                            <label for="equip_failed_on_installation2_@{{$index}}"
					                                                   class="form-check-label ">
					                                                <input 
					                                                type="radio" 
					                                                id="equip_failed_on_installation2_@{{$index}}"
					                                                name="equip_failed_on_installation_@{{$index}}"
					                                                ng-model="addedpv.equip_failed_on_installation"
					                                                ng-value="0"
					                                                class="form-check-input">No
					                                            </label>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
			                        		<div class="col-lg-12">
					                            <div class="row form-group">
					                                <div class="col col-md-4">
					                                    <label class=" form-control-label">Equipment failed during
					                                        service </label>
					                                </div>
					                                <div class="col col-md-8">
					                                    <div class="form-check">
					                                        <div class="radio">
					                                            <label for="equip_failed_on_service1_@{{$index}}"
					                                                   class="form-check-label ">
					                                                <input 
					                                                type="radio" 
					                                                id="equip_failed_on_service1_@{{$index}}"
					                                                name="equip_failed_on_service_@{{$index}}"
					                                                ng-model="addedpv.equip_failed_on_service"
					                                                ng-value="1"
					                                                class="form-check-input">Yes
					                                            </label>
					                                        </div>
					                                        <div class="radio">
					                                            <label for="equip_failed_service2_@{{$index}}"
					                                                   class="form-check-label ">
					                                                <input 
					                                                type="radio" 
					                                                id="equip_failed_service2_@{{$index}}"
					                                                name="equip_failed_on_service_@{{$index}}"
					                                                ng-model="addedpv.equip_failed_on_service"
					                                                ng-value="0"
					                                                class="form-check-input">No
					                                            </label>
					                                        </div>
					                                    </div>
					                                </div>
					                            </div>
					                        </div>
					                    </div>
					                    <div class="row">
			                        		<div class="col-lg-12">
					                            <div class="row form-group">
					                                <div class="col col-md-4">
					                                    <label for="how_long_@{{$index}}" class=" form-control-label">How Long</label>
					                                </div>
					                                <div class="col-12 col-md-8">
					                                    <input 
					                                    type="text" 
					                                    id="how_long_@{{$index}}" 
					                                    name="how_long_@{{$index}}"
					                                    ng-model="addedpv.how_long"
					                                    placeholder="How Long" 
					                                    class="form-control">
					                                </div>
					                            </div>
					                        </div>
					                    </div>
			                        </div>
							      </div>
							    </div>
							  </div>
						</div>
					</form>
                	<!-- end accordion -->
                </div>
                <div class="col-lg-12 p-b-20">
                	<div class="row">
                		<div class="col-md-12">
                            <button class="btn btn-primary btn-md float-right" ng-click="AddPVUnit();">
                                <i class="fa fa-plus fa-lg"></i>&nbsp;
                                <span id="payment-button-amount">Add Unit</span>
                            </button>
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="RMAForm2.$invalid" ng-click="SubmitRMAUnitForm();">
                        <i class="fa fa-dot-circle-o"></i> Save Unit
                    </button>
                    <button type="reset" class="btn btn-secondary btn-sm" ng-click="HidePVForm();">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>