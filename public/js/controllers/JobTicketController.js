app.controller('JobTicketController', ['$scope', '$http', function($scope, $http){
	$scope.showjtform = false;

	$scope.gridOptions = {
	   data: [
	   		{
	   			'part_no': '001',
	   			'value': '002',
	   			'old_pcb': 'One',
	   			'new_pcb': 'AS',
	   			'comment': 'SA',
	   		},
	   		{
	   			'part_no': '001',
	   			'value': '002',
	   			'old_pcb': 'One',
	   			'new_pcb': 'AS',
	   			'comment': 'SA',
	   		},
	   		{
	   			'part_no': '001',
	   			'value': '002',
	   			'old_pcb': 'One',
	   			'new_pcb': 'AS',
	   			'comment': 'SA',
	   		}
	   ], //required parameter - array with data
	   //optional parameter - start sort options
	   sort: {
	       predicate: 'companyName',
	       direction: 'asc'
	   }
   	};

	$scope.CloseJTForm = function()
	{
		$scope.showjtform = false;
	}

	$scope.OpenJTForm = function()
	{
		$scope.showjtform = true;
	}

}]);