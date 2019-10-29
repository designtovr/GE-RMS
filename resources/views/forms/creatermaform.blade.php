<div class="col-lg-12" ng-init="GetRMAList();GetCustomerList();GetEndCustomerList();">
    <div class="card">
        <div class="card-header">
            <strong>RMA</strong> Form
        </div>
        <div class="card-body card-block">
        	<form name="RMAForm1" id="RMAForm1" class="form-horizontal" novalidate>
                <div class="row form-group" ng-if="rmaformdata.edit">
                    <div class="col col-md-3">
                        <label for="id" class=" form-control-label">RMA Reference No</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input 
                        	type="text" 
                        	id="id" 
                        	name="id"
                        	ng-model="rmaformdata.id"
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
                        ng-model="rmaformdata.gs_no"
                        placeholder="GS No"
                        class="form-control"
                        ng-minlength="3"
                        ng-maxlength="50"
                        required>
                        <div ng-show="RMAForm1.gs_no.$touched && RMAForm1.gs_no.$error">
                            <span class="help-block"
                             ng-show="RMAForm1.gs_no.$error.required">
                                Please Enter GS Number
                            </span>
                            <span class="help-block"
                             ng-show="RMAForm1.gs_no.$error.minlength">
                                Minimum 3 Characters Required
                            </span>
                            <span class="help-block"
                             ng-show="RMAForm1.gs_no.$error.maxlength">
                                Maximum 50 Characters Allowed
                            </span>
                        </div>
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
                        ng-model="rmaformdata.act_reference"
                        placeholder="Act reference" 
                        class="form-control"
                        ng-disabled="addpvform"
                        >
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
                        ng-model="rmaformdata.date"
                        placeholder="Date"
                        class="form-control"
                        ng-disabled="addpvform"
                        required>
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
                    <form name="RMAForm2" id="RMAForm2" class="form-horizontal" novalidate>
                    <div id="accordion" ng-repeat="pv in selectedpvs track by $index">
                        <div class="card">
                            <div class="card-header" id="heading@{{$index}}">
                              <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse@{{$index}}" aria-expanded="true" aria-controls="collapse@{{$index}}">
                                  Relay Id #@{{pv.id}}
                                </button>
                              </h5>
                            </div>
                            <div id="collapse@{{$index}}" class="collapse show" aria-labelledby="heading@{{$index}}" data-parent="#accordion">
                                <div class="col-lg-12 p-b-20 p-t-10">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="model_no" class=" form-control-label">  Model No
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                      <input 
                                                        type="text" 
                                                        id="model_no_@{{$index}}"
                                                        name="model_no_@{{$index}}"
                                                        ng-model="pv.part_no"
                                                        placeholder="Model No"
                                                        class="form-control"
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="category" class=" form-control-label">Type Of Material</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input 
                                                    type="text" 
                                                    id="category_@{{$index}}"
                                                    name="category_@{{$index}}"
                                                    ng-model="pv.category"
                                                    placeholder="Type of Material"
                                                    class="form-control"
                                                    disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" ng-if="pv.part_no.id == -1">
                                        <div class="col-lg-6">
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="model_no_@{{$index}}" class=" form-control-label">Model No
                                                    </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input 
                                                    type="text" 
                                                    id="model_no_@{{$index}}" 
                                                    name="model_no_@{{$index}}"
                                                    ng-model="pv.part_no"
                                                    placeholder="Model No" 
                                                    class="form-control"
                                                    ng-minlength="3" 
                                                    ng-maxlength="10"
                                                    required>
                                                    <div ng-show="RMAForm2.model_no_@{{$index}}.$touched && RMAForm2.model_no_@{{$index}}.$error">
                                                        <span class="help-block"
                                                         ng-show="RMAForm2.model_no_@{{$index}}.$error.required">
                                                            Please Enter Model Number
                                                        </span>
                                                        <span class="help-block"
                                                         ng-show="RMAForm2.model_no_@{{$index}}.$error.minlength">
                                                            Minimum 3 Characters Required
                                                        </span>
                                                        <span class="help-block"
                                                         ng-show="RMAForm2.model_no_@{{$index}}.$error.maxlength">
                                                            Maximum 10 Characters Allowed
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row form-group">
                                                <div class="col-md-4">
                                                    <label for="serial_no_@{{$index}}" class=" form-control-label">Serial Number</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div>
                                                        <input 
                                                        type="text" 
                                                        id="serial_no_@{{$index}}" 
                                                        name="serial_no_@{{$index}}"
                                                        ng-model="pv.serial_no"
                                                        placeholder="Serial Number" 
                                                        class="form-control"
                                                        disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="sw_version_@{{$index}}" class=" form-control-label">SW
                                                        Version</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <input 
                                                    type="text" 
                                                    id="sw_version_@{{$index}}" 
                                                    name="sw_version_@{{$index}}"
                                                    ng-model="pv.sw_version"
                                                    placeholder="SW Version" 
                                                    class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label for="service_type" class=" form-control-label">Service Type
                                                        </label>
                                                </div>
                                                <div class="col-md-8">
                                                    <select 
                                                    name="service_type" 
                                                    id="service_type" 
                                                    ng-model="rmaformdata.relay.service_type"
                                                    class="form-control"
                                                    ng-options="type.id as type.name for type in servicetypes"
                                                    required>
                                                        <option value="" style="display: none;"></option>
                                                    </select>
                                                    <div ng-show="RMAForm2.service_type.$touched && RMAForm2.service_type.$error">
                                                        <span class="help-block"
                                                         ng-show="RMAForm2.service_type.$error.required">
                                                            Please Select Service Type
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="row form-group">
                                                <div class="col col-md-4">
                                                    <label class=" form-control-label">Warrenty</label>
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
                                                                ng-model="pv.warrenty"
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
                                                                ng-model="pv.warrenty"
                                                                ng-value="0"
                                                                class="form-check-input">No
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="desc_of_fault" class=" form-control-label">Description
                                                of
                                                Fault/Modification Required </label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <textarea 
                                            type="text" 
                                            id="desc_of_fault_@{{$index}}" 
                                            name="desc_of_fault_@{{$index}}"
                                            ng-model="pv.desc_of_fault"
                                            placeholder="Description of Fault" 
                                            class="form-control"
                                            rows="4"
                                            ng-maxlength="200"
                                            ></textarea>
                                            <div ng-show="RMAForm2.desc_of_fault_@{{$index}}.$touched && RMAForm2.desc_of_fault.$error">
                                                <span class="help-block"
                                                 ng-show="RMAForm2.desc_of_fault.$error.maxlength">
                                                    Maximum 200 Characters Allowed
                                                </span>
                                            </div>
                                        </div>
                                    </div>
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
                                            ng-model="pv.sales_order_no"
                                            placeholder="WBS/Sales Order No" 
                                            class="form-control">
                                        </div>
                                    </div>
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
                                                        ng-model="pv.field_volts_used"
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
                                                        ng-model="pv.field_volts_used"
                                                        ng-value="0"
                                                        class="form-check-input">No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                        ng-model="pv.equip_failed_on_installation"
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
                                                        ng-model="pv.equip_failed_on_installation"
                                                        ng-value="0"
                                                        class="form-check-input">No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                        ng-model="pv.equip_failed_on_service"
                                                        ng-value="1"
                                                        class="form-check-input">Yes
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label for="equip_failed_on_service2_@{{$index}}"
                                                           class="form-check-label ">
                                                        <input 
                                                        type="radio" 
                                                        id="equip_failed_on_service2_@{{$index}}"
                                                        name="equip_failed_on_service_@{{$index}}"
                                                        ng-model="pv.equip_failed_on_service"
                                                        ng-value="0"
                                                        class="form-check-input">No
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4">
                                            <label for="how_long_@{{$index}}" class=" form-control-label">How
                                                Long</label>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <input 
                                            type="text" 
                                            id="how_long_@{{$index}}" 
                                            name="how_long_@{{$index}}"
                                            ng-model="pv.how_long"
                                            placeholder="How Long" 
                                            class="form-control">
                                            <div ng-show="RMAForm2.how_long_@{{$index}}.$touched && RMAForm2.how_long.$error">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion -->
                    </form>
                </div>
                <div class="card-footer" ng-if="addpvform">
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="RMAForm2.$invalid" ng-click="SubmitRMAUnitForm();">
                        <i class="fa fa-dot-circle-o"></i> Save Unit
                    </button>
                    <button id="closermabutton" name="closermabutton" class="btn btn-secondary btn-sm" ng-click="HideRMAForm();CloseCreateRMA();">
                        <i class="fa fa-ban"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row" ng-if="!addpvform">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <strong>Customer Invoice Address</strong>
                </div>
                <div class="card-body card-block">
                	<form name="RMAForm5" id="RMAForm5" class="form-horizontal" novalidate>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="invoice_customer_name" class=" form-control-label">Customer Name
                                    <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <ui-select ng-model="rmaformdata.invoice_info.invoice_customer_name" theme="selectize" title="Select Customer Name" ng-change="ChangeInvoiceAddress(rmaformdata.invoice_info.invoice_customer_name);" id="invoice_customer_name" 
                                name="invoice_customer_name" required>
								    <ui-select-match placeholder="Select Customer Name">@{{$select.selected.name}}</ui-select-match>
								    <ui-select-choices repeat="customer in customers | filter: $select.search">
								      <span ng-bind-html="customer.name | highlight: $select.search"></span>
								      <small ng-bind-html="customer.site_name | highlight: $select.search"></small>
								    </ui-select-choices>
								  </ui-select>
                                  <div ng-show="RMAForm5.invoice_customer_name.$touched && RMAForm5.invoice_customer_name.$error">
                                        <span class="help-block"
                                         ng-show="RMAForm5.invoice_customer_name.$error.required">
                                            Please Select Customer
                                        </span>
                                    </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="end_cus" class=" form-control-label">End Customer <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                            	<ui-select ng-model="rmaformdata.invoice_info.end_cus" theme="selectize" title="Select End Customer" id="end_cus" 
                                name="end_cus" required>
								    <ui-select-match placeholder="Select End Customer">@{{$select.selected.end_customer}}</ui-select-match>
								    <ui-select-choices repeat="customer in endcustomers | filter: $select.search">
								      <span ng-bind-html="customer.end_customer | highlight: $select.search"></span>
								    </ui-select-choices>
								  </ui-select>
                                  <div ng-show="RMAForm5.end_cus.$touched && RMAForm5.end_cus.$error">
                                        <span class="help-block"
                                         ng-show="RMAForm5.end_cus.$error.required">
                                            Please Select End Customer
                                        </span>
                                    </div>
								  <div ng-if="rmaformdata.invoice_info.end_cus.end_customer == 'Add New'">
								  	<input 
                                        type="text" 
                                        id="manual_end_customer"
                                        name="manual_end_customer" 
                                        ng-model="rmaformdata.invoice_info.manual_end_customer" 
                                        placeholder="End Cusotmer"
                                        class="form-control"
                                        ng-minlength="3"
                                        ng-maxlength="25"
                                        required>
                                        <div ng-show="RMAForm5.manual_end_customer.$touched && RMAForm5.manual_end_customer.$error">
                                            <span class="help-block"
                                             ng-show="RMAForm5.manual_end_customer.$error.required">
                                                Please Enter End Customer
                                            </span>
                                            <span class="help-block"
                                             ng-show="RMAForm5.manual_end_customer.$error.minlength">
                                                Minimum 3 Characters Required
                                            </span>
                                            <span class="help-block"
                                             ng-show="RMAForm5.manual_end_customer.$error.maxlength">
                                                Maximum 25 Characters Allowed
                                            </span>
                                        </div>
								  </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="invoice_address" class=" form-control-label">Customer Invoice Address <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <textarea 
                                name="invoice_address" 
                                id="invoice_address" 
                                rows="3" 
                                placeholder="Address..."
                                ng-model="rmaformdata.invoice_info.invoice_address" 
                                class="form-control"
                                disabled></textarea>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="invoice_contact_name" class=" form-control-label">Contact Name <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="invoice_contact_name"
                                name="invoice_contact_name" 
                                ng-model="rmaformdata.invoice_info.contact_name" 
                                placeholder="Contact Name"
                                class="form-control"
                                disabled>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="invoice_tel_no" class=" form-control-label">Tel No 
                                	<span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="invoice_tel_no" 
                                name="invoice_tel_no"
                                ng-model="rmaformdata.invoice_info.invoice_tel_no" 
                                placeholder="Tel No" 
                                class="form-control"
                                disabled>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="invoice_email" class=" form-control-label">Email <span
                                class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="invoice_email" 
                                name="invoice_email"
                                ng-model="rmaformdata.invoice_info.invoice_email"
                                placeholder="Email" 
                                class="form-control"
                                disabled>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="invoice_gst" class=" form-control-label">GST <span
                                class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="invoice_gst" 
                                name="invoice_gst"
                                ng-model="rmaformdata.invoice_info.gst"
                                placeholder="GST" 
                                class="form-control"
                                disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <strong>Customer Return Delivery Address</strong>
                </div>
                <div class="card-body card-block">
                	<form name="RMAForm6" id="RMAForm6" class="form-horizontal" novalidate>
                		<div class="row form-group">
                            <div class="col col-md-4">
                                <label for="copy_invoice_address" class=" form-control-label">Copy Invoice Address <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <label class="au-checkbox">
                                    <input type="checkbox" ng-model="rmaformdata.copy_invoice_address_to_delivery_address" ng-change="ChangeDeliveryAddress();">
                                    <span class="au-checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="delivery_address" class=" form-control-label">Customer Delivery Address <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <textarea 
                                id="delivery_address"
                                name="delivery_address"
                                rows="3" 
                                placeholder="Address..."
                                ng-model="rmaformdata.delivery_info.address" 
                                class="form-control"
                                ng-minlength="3" 
                                ng-maxlength="100"
                                required></textarea>
                                <div ng-show="RMAForm6.delivery_address.$touched && RMAForm6.delivery_address.$error">
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_address.$error.required">
                                        Please Enter Delivery Address
                                    </span>
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_address.$error.minlength">
                                        Minimum 3 Characters Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_address.$error.maxlength">
                                        Maximum 100 Characters Allowed
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="delivery_contact_name" class=" form-control-label">Contact Name <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="delivery_contact_name"
                                name="delivery_contact_name" 
                                ng-model="rmaformdata.delivery_info.contact_person" 
                                placeholder="Contact Name"
                                class="form-control"
                                ng-minlength="3" 
                                ng-maxlength="50"
                                required>
                                <div ng-show="RMAForm6.delivery_contact_name.$touched && RMAForm6.delivery_contact_name.$error">
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_contact_name.$error.required">
                                        Please Enter Contact Name
                                    </span>
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_contact_name.$error.minlength">
                                        Minimum 3 Characters Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_contact_name.$error.maxlength">
                                        Maximum 50 Characters Allowed
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="delivery_tel_no" class=" form-control-label">Tel No
                                    <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="delivery_tel_no" 
                                name="delivery_tel_no"
                                ng-model="rmaformdata.delivery_info.tel_no" 
                                placeholder="Tel No" 
                                class="form-control"
                                ng-minlength="7" 
                                ng-maxlength="15"
                                ng-pattern="/^[0-9]*$/"
                                required>
                                <div ng-show="RMAForm6.delivery_tel_no.$touched && RMAForm6.delivery_tel_no.$error">
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_tel_no.$error.required">
                                        Please Enter Tel No
                                    </span>
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_tel_no.$error.minlength">
                                        Minimum 7 Numbers Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_tel_no.$error.maxlength">
                                        Maximum 15 Numbers Allowed
                                    </span>
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_tel_no.$error.pattern">
                                        Only Numbers Allowed
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="delivery_email" class=" form-control-label">Email <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="delivery-email" 
                                name="delivery_email"
                                ng-model="rmaformdata.delivery_info.email" 
                                placeholder="Email" 
                                class="form-control"
                                ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/"
                                required>
                                <div ng-show="RMAForm6.delivery_email.$touched && RMAForm6.delivery_email.$error">
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_email.$error.required">
                                        Please Enter Email
                                    </span>
                                    <span class="help-block"
                                     ng-show="RMAForm6.delivery_email.$error.pattern">
                                        Invalid Email
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="gst_number" class=" form-control-label">GST Number <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="gst_number" 
                                name="gst_number"
                                ng-model="rmaformdata.delivery_info.gst" 
                                placeholder="GST Number" 
                                class="form-control"
                                ng-minlength="15" 
                                ng-maxlength="15"
                                required>
                                <div ng-show="RMAForm6.gst_number.$touched && RMAForm6.gst_number.$error">
                                    <span class="help-block"
                                     ng-show="RMAForm6.gst_number.$error.required">
                                        Please Enter GST Number
                                    </span>
                                    <span class="help-block"
                                     ng-show="RMAForm6.gst_number.$error.minlength">
                                        Should Not Be Less Than 15 Characters
                                    </span>
                                    <span class="help-block"
                                     ng-show="RMAForm6.gst_number.$error.maxlength">
                                        Should Not Be Greater Than 15 Characters
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row" ng-if="!addpvform">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-footer">
                    <button ng-if="!rmaformdata.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="RMAForm1.$invalid || RMAForm2.$invalid || RMAForm5.$invalid || RMAForm6.$invalid" ng-click="SubmitRMAForm();">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button ng-if="rmaformdata.edit" type="submit" class="btn btn-primary btn-sm" ng-disabled="RMAForm1.$invalid || RMAForm2.$invalid || RMAForm5.$invalid || RMAForm6.$invalid" ng-click="SubmitRMAForm();">
                        <i class="fa fa-dot-circle-o"></i> Update
                    </button>
                    <button ng-if="rmaformdata.status != 3" class="btn btn-secondary btn-sm" ng-click="SaveRMAForm();">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <button id="closermabutton" name="closermabutton" class="btn btn-danger btn-sm" ng-click="HideRMAForm();">
                        <i class="fa fa-ban"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$("#date").datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy',
        todayHighlight: true,
        setDate: new Date(),
        update: new Date()
    });
</script>