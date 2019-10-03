

app.filter('propsFilter', function() {
	return function(items, props) {
		var out = [];

		if (angular.isArray(items)) {
			var keys = Object.keys(props);

			items.forEach(function(item) {
				var itemMatches = false;

				for (var i = 0; i < keys.length; i++) {
					var prop = keys[i];
					var text = props[prop].toLowerCase();
					if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
						itemMatches = true;
						break;
					}
				}

				if (itemMatches) {
					out.push(item);
				}
			});
		} else {
      // Let the output be the input untouched
      out = items;
  }

  return out;
};
});


app.controller('WarrantyController', ['$scope', '$http', function($scope, $http) {

	wc = this;
	$scope.show_po = false;
	$scope.show_wbs = false;
	$scope.show_rca_options = false;
	$scope.people = [
	{ name: 'Sudhakar',      email: 'Sudhakar@email.com',      age: 12, country: 'United States' },
	{ name: 'Krishnan',    email: 'Krishnan@email.com',    age: 12, country: 'Argentina' },
	{ name: 'Balaji', email: 'Balaji@email.com', age: 21, country: 'Argentina' },
	{ name: 'Srinivas',    email: 'Srinivas@email.com',    age: 21, country: 'Ecuador' },
	{ name: 'Arun',  email: 'Arun@email.com',  age: 30, country: 'Ecuador' },
	{ name: 'Samantha',  email: 'samantha@email.com',  age: 30, country: 'United States' },
	{ name: 'Nicole',    email: 'nicole@email.com',    age: 43, country: 'Colombia' },
	{ name: 'Natasha',   email: 'natasha@email.com',   age: 54, country: 'Ecuador' },
	{ name: 'Michael',   email: 'michael@email.com',   age: 15, country: 'Colombia' },
	{ name: 'Nicolás',   email: 'nicolas@email.com',    age: 43, country: 'Colombia' }
	];
	
	$scope.selectedPeople =[$scope.people[0] ];
	$scope.selectedCCPeople =[ $scope.people [4]];

	$scope.warrantymodal = {};
	$scope.controller = {};
	$scope.warrantymodal.title = 'Warranty Form';
	$scope.gridOptions = {
		data: [
		{
			'rid_no': '0010',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},{
			'rid_no': '001',
			'product': 'One',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '002',
			'product': 'Two',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		},
		{
			'rid_no': '003',
			'product': 'Three',
			'customer_name': 'AS',
			'end_customer': 'SA',
			'serial_no': 'Fedx',
			'model_no': 'ASE',
			'courier_name': 'Fed',
			'docket_details': '123',
			'customer_comment': 'Sample'
		}
	   ], //required parameter - array with data
	   //optional parameter - start sort options
	   sort: {

	   },
	   urlSync: true
	};

	$scope.OpenWarrantyModal = function()
	{
		$('#warrantymodal').modal('show');
	}

	$scope.CloseWarrantyModal = function()
	{
		$('#warrantymodal').modal('hide');
	}

	$scope.ValidateStatus = function() {

		console.log($scope.show_po);
		console.log($scope.warrantymodal.pcp);

		if(($scope.warrantymodal.smp == "1" || $scope.warrantymodal.smp == "2")  && $scope.warrantymodal.pcp == "1")
		{
			$scope.show_po = true;
			$scope.show_wbs = false;
		}

		else if($scope.warrantymodal.smp == "1" && $scope.warrantymodal.pcp == "2")
		{
			$scope.show_po = false;
			$scope.show_wbs = true;
		}

		else
		{
			$scope.show_po = false;
			$scope.show_wbs = false;
		}
	}

		$scope.OnRCAChanged = function() {

		if($scope.warrantymodal.rca)
			$scope.show_rca_options = true;

		else
			$scope.show_rca_options = false;

	}

}]);