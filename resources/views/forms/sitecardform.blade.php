<div class="col-lg-12" ng-init="GetCustomerList();GetEndCustomerList();">
    <div class="card">
        <div class="card-header">
            <strong>RMA</strong> Form
        </div>
        <div class="card-body card-block">
        	<form name="SiteCardForm1" id="SiteCardForm1" class="form-horizontal" novalidate>
                <div class="row form-group">
                    <div class="col col-md-3">
                        <label for="gs_no" class=" form-control-label">GS No</label>
                    </div>
                    <div class="col-12 col-md-6">
                        <input 
                        type="text" 
                        id="gs_no" 
                        name="gs_no" 
                        ng-model="sitecardform.gs_no"
                        placeholder="GS No"
                        class="form-control">
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
                        ng-model="sitecardform.act_reference"
                        placeholder="ACT Reference" 
                        class="form-control">
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
                        ng-model="sitecardform.date"
                        placeholder="Date"
                        class="form-control"
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
                	<form name="SiteCardForm2" id="SiteCardForm2" class="form-horizontal" novalidate>
	                	<div id="accordion" ng-repeat="info in sitecardform.unit_information track by $index">
							  <div class="card">
							    <div class="card-header" id="heading@{{$index}}">
							      <h5 class="mb-0">
							        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse@{{$index}}" aria-expanded="true" aria-controls="collapse@{{$index}}">
							          Product #@{{$index + 1}}
							        </button>
							      </h5>
							    </div>

							    <div id="collapse@{{$index}}" class="collapse show" aria-labelledby="heading@{{$index}}" data-parent="#accordion">
							      <div class="card-body">
			                        <div class="col-lg-12 p-b-20 p-t-10" >
			                        	<div class="row">
			                        		<div class="col-md-12">
			                                    <button class="btn btn-danger btn-md float-right" id="removeunit@{{$index}}" name="removeunit@{{$index}}" ng-click="RemoveSiteCardUnitInfo($index);">
			                                        <i class="fa fa-minus"></i>&nbsp; Remove
			                                    </button>
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
			                                            <ui-select id="model_no_@{{$index}}" 
			                                            name="model_no_@{{$index}}" ng-model="info.model" theme="selectize" ng-disabled="" title="Select Model No" ng-change="ChangeModelCategory($index,info);" required>
														    <ui-select-match placeholder="Select Model No">@{{$select.selected.part_no}}</ui-select-match>
														    <ui-select-choices repeat="product in products | filter: $select.search">
														      <span ng-bind-html="product.part_no | highlight: $select.search"></span>
														    </ui-select-choices>
														  </ui-select>
			                                            <div ng-show="SiteCardForm2.model_no_@{{$index}}.$touched && SiteCardForm2.model_no_@{{$index}}.$error">
			                                                <span class="help-block"
			                                                 ng-show="SiteCardForm2.model_no_@{{$index}}.$error.required">
			                                                    Please Select Model Number
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
			                                            <label for="type_of_material_@{{$index}}" class=" form-control-label">Type Of Material</label>
			                                        </div>
			                                        <div class="col-md-8">
			                                            <input 
			                                            type="text" 
			                                            id="type_of_material_@{{$index}}"
			                                            name="type_of_material_@{{$index}}"
			                                            ng-model="info.type_of_material"
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
		                                                ng-model="info.serial_no"
		                                                placeholder="Serial Number" 
		                                                class="form-control"
		                                                ng-minlength="3" 
				                                        ng-maxlength="50"
				                                        required>
				                                        <div ng-show="SiteCardForm2.serial_no_@{{$index}}.$touched && SiteCardForm2.serial_no_@{{$index}}.$error">
			                                                <span class="help-block"
			                                                 ng-show="SiteCardForm2.serial_no_@{{$index}}.$error.required">
			                                                    Please Enter Serial Number
			                                                </span>
			                                                <span class="help-block"
			                                                 ng-show="SiteCardForm2.serial_no_@{{$index}}.$error.minlength">
			                                                    Minimum 3 Characters Required
			                                                </span>
			                                                <span class="help-block"
			                                                 ng-show="SiteCardForm2.serial_no_@{{$index}}.$error.maxlength">
			                                                    Maximum 50 Characters Allowed
			                                                </span>
			                                            </div>
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
			                                            ng-model="info.sw_version"
			                                            placeholder="SW Version" 
			                                            class="form-control">
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
					                                    ng-model="info.desc_of_fault"
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
					                                    ng-model="info.sales_order_no"
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
					                                                ng-model="info.field_volts_used"
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
					                                                ng-model="info.field_volts_used"
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
					                                                ng-model="info.equip_failed_on_installation"
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
					                                                ng-model="info.equip_failed_on_installation"
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
					                                                ng-model="info.equip_failed_on_service"
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
					                                                ng-model="info.equip_failed_on_service"
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
					                                    ng-model="info.how_long"
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
                            <button class="btn btn-primary btn-md float-right" ng-click="AddSiteCardUnitInfo();">
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
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <strong>Customer Invoice Address</strong>
                </div>
                <div class="card-body card-block">
                	<form name="SiteCardForm5" id="SiteCardForm5" class="form-horizontal" novalidate>
                		<div class="row form-group">
                            <div class="col col-md-4">
                                <label for="copy_invoice_address" class=" form-control-label">Copy Delivery Address <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <label class="au-checkbox">
                                    <input type="checkbox" ng-model="sitecardform.copy_delivery_address_to_invoice_address" ng-change="ChangeSCInvoiceAddress();">
                                    <span class="au-checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="customer_name" class=" form-control-label">Customer Name <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="customer_name"
                                name="customer_name" 
                                ng-model="sitecardform.invoice_info.name" 
                                placeholder="Name"
                                class="form-control"
                                ng-minlength="3" 
                                ng-maxlength="200"
                                required>
                                <div ng-show="SiteCardForm5.customer_name.$touched && SiteCardForm5.customer_name.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.customer_name.$error.required">
                                        Please Enter Name
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.customer_name.$error.minlength">
                                        Minimum 3 Characters Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.customer_name.$error.maxlength">
                                        Maximum 200 Characters Allowed
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="end_customer" class=" form-control-label">End Customer <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input type="text" id="end_customer" name="end_customer" ng-model="sitecardform.invoice_info.end_customer" uib-typeahead="customer.end_customer for customer in endcustomers | filter:$viewValue | limitTo:8" placeholder="End Customer" class="form-control" typeahead-popup-template-url="{{url('public/bower_components/angular-bootstrap/template/typeahead/typeahead-popup.html')}}"
                                typeahead-template-url="{{url('public/bower_components/angular-bootstrap/template/typeahead/typeahead-match.html')}}" required>
                                <div ng-show="SiteCardForm5.end_customer.$touched && SiteCardForm5.end_customer.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.end_customer.$error.required">
                                        Please Enter End Customer
                                    </span>
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
                                ng-model="sitecardform.invoice_info.address" 
                                class="form-control"
                                ng-minlength="3" 
                                ng-maxlength="200"
                                required></textarea>
                                <div ng-show="SiteCardForm5.invoice_address.$touched && SiteCardForm5.invoice_address.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_address.$error.required">
                                        Please Enter Address
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_address.$error.minlength">
                                        Minimum 3 Characters Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_address.$error.maxlength">
                                        Maximum 200 Characters Allowed
                                    </span>
                                </div>
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
                                ng-model="sitecardform.invoice_info.contact_person" 
                                placeholder="Contact Name"
                                class="form-control"
                                ng-minlength="3" 
                                ng-maxlength="50"
                                required>
                                <div ng-show="SiteCardForm5.invoice_contact_name.$touched && SiteCardForm5.invoice_contact_name.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_contact_name.$error.required">
                                        Please Enter Name
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_contact_name.$error.minlength">
                                        Minimum 3 Characters Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_contact_name.$error.maxlength">
                                        Maximum 50 Characters Allowed
                                    </span>
                                </div>
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
                                ng-model="sitecardform.invoice_info.tel_no" 
                                placeholder="Tel No" 
                                class="form-control"
                                ng-minlength="7" 
                                ng-maxlength="15"
                                ng-pattern="/^[0-9]*$/"
                                required>
                                <div ng-show="SiteCardForm5.invoice_tel_no.$touched && SiteCardForm5.invoice_tel_no.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_tel_no.$error.required">
                                        Please Enter Tel No
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_tel_no.$error.minlength">
                                        Minimum 7 Numbers Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_tel_no.$error.maxlength">
                                        Maximum 15 Numbers Allowed
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_tel_no.$error.pattern">
                                        Only Numbers Allowed
                                    </span>
                                </div>
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
                                ng-model="sitecardform.invoice_info.email"
                                placeholder="Email" 
                                class="form-control"
                                ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/"
                                required>
                                <div ng-show="SiteCardForm5.invoice_email.$touched && SiteCardForm5.invoice_email.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_email.$error.required">
                                        Please Enter Email
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_email.$error.pattern">
                                        Invalid Email
                                    </span>
                                </div>
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
                                ng-model="sitecardform.invoice_info.gst"
                                placeholder="GST" 
                                class="form-control"
                                ng-minlength="15" 
                                ng-maxlength="15"
                                required>
                                <div ng-show="SiteCardForm5.invoice_gst.$touched && SiteCardForm5.invoice_gst.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_gst.$error.required">
                                        Please Enter GST Number
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_gst.$error.minlength">
                                        Should Not Be Less Than 15 Characters
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm5.invoice_gst.$error.maxlength">
                                        Should Not Be Greater Than 15 Characters
                                    </span>
                                </div>
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
                	<form name="SiteCardForm6" id="SiteCardForm6" class="form-horizontal" novalidate>
                		<!-- <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="delivery_select_customer" class=" form-control-label">Select Customer
                                    <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <ui-select id="delivery_select_customer" 
                                name="delivery_select_customer" ng-model="sitecardform.delivery_info.delivery_select_customer" theme="selectize" title="Select Customer" ng-change="ChangeSCDeliveryAddress(sitecardform.delivery_info.delivery_select_customer);">
								    <ui-select-match placeholder="Select Customer">@{{$select.selected.name}}</ui-select-match>
								    <ui-select-choices repeat="customer in customers | filter: $select.search">
								      <span ng-bind-html="customer.name | highlight: $select.search"></span>
								      <small ng-bind-html="customer.site_name | highlight: $select.search"></small>
								    </ui-select-choices>
								  </ui-select>
                            </div>
                        </div> -->
                		<div class="row form-group">
                            <div class="col col-md-4">
                                <label for="delivery_customer_name" class=" form-control-label">Customer Name <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="delivery_customer_name"
                                name="delivery_customer_name" 
                                ng-model="sitecardform.delivery_info.name" 
                                placeholder="Name"
                                class="form-control"
                                ng-minlength="3" 
                                ng-maxlength="200"
                                required>
                                <div ng-show="SiteCardForm6.delivery_customer_name.$touched && SiteCardForm6.delivery_customer_name.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_customer_name.$error.required">
                                        Please Enter Name
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_customer_name.$error.minlength">
                                        Minimum 3 Characters Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_customer_name.$error.maxlength">
                                        Maximum 200 Characters Allowed
                                    </span>
                                </div>
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
                                ng-model="sitecardform.delivery_info.address" 
                                class="form-control"
                                ng-minlength="3" 
                                ng-maxlength="200"
                                required></textarea>
                                <div ng-show="SiteCardForm6.delivery_address.$touched && SiteCardForm6.delivery_address.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_address.$error.required">
                                        Please Enter Delivery Address
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_address.$error.minlength">
                                        Minimum 3 Characters Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_address.$error.maxlength">
                                        Maximum 200 Characters Allowed
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
                                ng-model="sitecardform.delivery_info.contact_person" 
                                placeholder="Contact Name"
                                class="form-control"
                                ng-minlength="3" 
                                ng-maxlength="50"
                                required>
                                <div ng-show="SiteCardForm6.delivery_contact_name.$touched && SiteCardForm6.delivery_contact_name.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_contact_name.$error.required">
                                        Please Enter Contact Name
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_contact_name.$error.minlength">
                                        Minimum 3 Characters Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_contact_name.$error.maxlength">
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
                                ng-model="sitecardform.delivery_info.tel_no" 
                                placeholder="Tel No" 
                                class="form-control"
                                ng-minlength="7" 
                                ng-maxlength="15"
                                ng-pattern="/^[0-9]*$/"
                                required>
                                <div ng-show="SiteCardForm6.delivery_tel_no.$touched && SiteCardForm6.delivery_tel_no.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_tel_no.$error.required">
                                        Please Enter Tel No
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_tel_no.$error.minlength">
                                        Minimum 7 Numbers Required
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_tel_no.$error.maxlength">
                                        Maximum 15 Numbers Allowed
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_tel_no.$error.pattern">
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
                                id="delivery_email" 
                                name="delivery_email"
                                ng-model="sitecardform.delivery_info.email" 
                                placeholder="Email" 
                                class="form-control"
                                ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/"
                                required>
                                <div ng-show="SiteCardForm6.delivery_email.$touched && SiteCardForm6.delivery_email.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_email.$error.required">
                                        Please Enter Email
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.delivery_email.$error.pattern">
                                        Invalid Email
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-4">
                                <label for="gst_number" class=" form-control-label">GST <span class="mandatory">*</span></label>
                            </div>
                            <div class="col-12 col-md-8">
                                <input 
                                type="text" 
                                id="gst_number" 
                                name="gst_number"
                                ng-model="sitecardform.delivery_info.gst" 
                                placeholder="GST" 
                                class="form-control"
                                ng-minlength="15" 
                                ng-maxlength="15"
                                required>
                                <div ng-show="SiteCardForm6.gst_number.$touched && SiteCardForm6.gst_number.$error">
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.gst_number.$error.required">
                                        Please Enter GST Number
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.gst_number.$error.minlength">
                                        Should Not Be Less Than 15 Characters
                                    </span>
                                    <span class="help-block"
                                     ng-show="SiteCardForm6.gst_number.$error.maxlength">
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
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm" ng-disabled="SiteCardForm1.$invalid || SiteCardForm2.$invalid || SiteCardForm3.$invalid || SiteCardForm4.$invalid || SiteCardForm5.$invalid || SiteCardForm6.$invalid" ng-click="SubmitSiteCardForm();">
                        <i class="fa fa-dot-circle-o"></i> Submit
                    </button>
                    <button class="btn btn-secondary btn-sm" ng-click="SaveSiteCatdForm();">
                        <i class="fa fa-save"></i> Save
                    </button>
                    <button type="reset" class="btn btn-danger btn-sm" ng-click="HideSiteCardForm();">
                        <i class="fa fa-ban"></i> Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $( "#date" ).datepicker({
            autoclose: true,
            format: 'dd/mm/yyyy',
            todayHighlight: true,
            setDate: new Date(),
            update: new Date()
        });
    });
</script>