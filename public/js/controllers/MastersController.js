app.controller('MastersController', ['$scope', '$http', 'Notification', '$ngConfirm', function($scope, $http, Notification, $ngConfirm){
	$scope.customers = [];
	$scope.products = [];
	$scope.locations = [];
	$scope.sites = [];
	$scope.racktypes = [];
	$scope.racks = [];
	$scope.materials = [];
	$scope.packingstyles = [];
	$scope.producttypes = [];
	$scope.materialtypes = [];
	$scope.manufactures = [];
	$scope.users = [];
	$scope.roles = [];

	$scope.customermodal = [];
	$scope.customer = {};
	$scope.producttypemodal = [];
	$scope.producttype = {};
	$scope.product = {};
	$scope.productmodal = [];
	$scope.location = {};
	$scope.locationmodal = [];
	$scope.site = {};
	$scope.sitemodal = [];
	$scope.racktype = {};
	$scope.racktypemodal = [];
	$scope.rack = {};
	$scope.rackmodal = [];
	$scope.packingstyle = {};
	$scope.packingstylemodal = [];
	$scope.materialtype = {};
	$scope.materialtypemodal = [];
	$scope.manufacture = {};
	$scope.manufacturemodal = [];
	$scope.user = {};
	$scope.usermodal = [];

	$scope.getcustomers = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/customers'
		}).then(function success(response) {
		    $scope.customers = response.data.data;
		  }, function error(response) {

		  });
	}

	$scope.getproducts = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/products'
		}).then(function success(response) {
		    $scope.products = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getlocations = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/locations'
		}).then(function success(response) {
		    $scope.locations = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getsites = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/sites'
		}).then(function success(response) {
		    $scope.sites = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getracktypes = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/rack-types'
		}).then(function success(response) {
		    $scope.racktypes = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getracks = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/racks'
		}).then(function success(response) {
		    $scope.racks = response.data.data;
		}, function error(response) {

		});
	}

	$scope.getmaterials = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/materials'
		}).then(function success(response) {
		    $scope.materials = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getpackingstyles = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/packing-styles'
		}).then(function success(response) {
		    $scope.packingstyles = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getproducttypes = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/product-types'
		}).then(function success(response) {
		    $scope.producttypes = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getmaterialtypes = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/material-types'
		}).then(function success(response) {
		    $scope.materialtypes = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getmanufactures = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/manufactures'
		}).then(function success(response) {
		    $scope.manufactures = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getusers = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/users'
		}).then(function success(response) {
		    $scope.users = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getroles = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/roles'
		}).then(function success(response) {
		    $scope.roles = response.data.data;
		}, function error(response) {
		});
	}

	$scope.OpenCustomerModal = function(id = 0)
	{
		$scope.getsites();
		$scope.getlocations();
		if (!id)
		{
			$scope.customer = {};
			$scope.customermodal = [];
			$scope.customermodal.title = 'Add Customer';
			$scope.customermodal.edit = false;
		}
		else
		{
			$scope.customermodal.title = 'Edit Customer';
			$scope.customermodal.edit = true;
			$http({
			  method: 'GET',
			  url: '/ge/getcustomer/'+id
			}).then(function success(response) {
				if (response.data.status == 'success')
				{
			    	$scope.customer = response.data.customer;
			    	$scope.customer.contact = parseInt($scope.customer.contact);
				}
			}, function error(response) {

			});
		}
		$('#customermodal').modal('show');
	}

	$scope.CloseCustomerModal = function()
	{
		$scope.AddCustomerForm.$setPristine();
		$scope.AddCustomerForm.$setValidity();
		$scope.AddCustomerForm.$setUntouched();
		$('#customermodal').modal('hide');
	}

	$scope.OpenProductTypeModal = function(id=0)
	{
		if (!id)
		{
			$scope.producttype = {};
			$scope.producttypemodal = [];
			$scope.producttypemodal.title = 'Add Product Type';
		}
		else
		{
			$scope.producttypemodal.title = 'Edit Product Type';
		}
		$('#producttypemodal').modal('show');
	}

	$scope.OpenProductModal = function(id=0)
	{
		if (!id)
		{
			$scope.product = {};
			$scope.productmodal = [];
			$scope.productmodal.title = 'Add Product';
			$scope.getproducttypes();
		}
		else
		{
			$scope.productmodal.title = 'Edit Product Type';
		}
		$('#productmodal').modal('show');
	}

	$scope.OpenLocationModal = function(id=0)
	{
		if (!id)
		{
			$scope.location = {};
			$scope.locationmodal = [];
			$scope.locationmodal.title = 'Add Location';
		}
		else
		{
			$scope.locationmodal.title = 'Edit Location';
		}
		$('#locationmodal').modal('show');
	}

	$scope.OpenSiteModal = function(site=0)
	{
		if (!site)
		{
			$scope.site = {};
			$scope.sitemodal = [];
			$scope.sitemodal.title = 'Add Site';
		}
		else
		{
			$scope.sitemodal.title = 'Edit Site';
			$scope.site.code = site.code;
			$scope.site.name = site.name;
			$scope.site.id = site.id;
		}
		$('#sitemodal').modal('show');
	}

	$scope.OpenRackModal = function(id=0)
	{
		if (!id)
		{
			$scope.rack = {};
			$scope.rackmodal = [];
			$scope.getracktypes();
			$scope.rackmodal.title = 'Add Rack';
		}
		else
		{
			$scope.rackmodal.title = 'Edit Rack';
		}
		$('#rackmodal').modal('show');
	}

	$scope.OpenPackingStyleModal = function(id=0)
	{
		if (!id)
		{
			$scope.packingstyle = {};
			$scope.packingstylemodal = [];
			$scope.packingstylemodal.title = 'Add Rack';
		}
		else
		{
			$scope.packingstylemodal.title = 'Edit Rack';
		}
		$('#packingstylemodal').modal('show');
	}

	$scope.OpenRackTypeModal = function(id=0)
	{
		if (!id)
		{
			$scope.racktype = {};
			$scope.racktypemodal = [];
			$scope.racktypemodal.title = 'Add Packing Style';
		}
		else
		{
			$scope.racktypemodal.title = 'Edit Packing Style';
		}
		$('#racktypemodal').modal('show');
	}

	$scope.OpenMaterialTypeModal = function(id=0)
	{
		if (!id)
		{
			$scope.materialtype = {};
			$scope.materialtypemodal = [];
			$scope.materialtypemodal.title = 'Add Material Type';
		}
		else
		{
			$scope.racktypemodal.title = 'Edit Material Type';
		}
		$('#materialtypemodal').modal('show');
	}

	$scope.OpenManufactureModal = function(id=0)
	{
		if (!id)
		{
			$scope.manufacture = {};
			$scope.manufacturemodal = [];
			$scope.manufacturemodal.title = 'Add Manufacture';
		}
		else
		{
			$scope.racktypemodal.title = 'Edit Manufacture';
		}
		$('#manufacturemodal').modal('show');
	}

	$scope.OpenUserModal = function(id=0)
	{
		if (!id)
		{
			$scope.user = {};
			$scope.usermodal = [];
			$scope.usermodal.title = 'Add User';
			$scope.getroles();
		}
		else
		{
			$scope.usermodal.title = 'Edit User';
		}
		$('#usermodal').modal('show');
	}

	$scope.OpenMaterialModal = function(id=0)
	{
		if (!id)
		{
			$scope.material = {};
			$scope.materialmodal = [];
			$scope.materialmodal.title = 'Add Material';
			$scope.getmaterialtypes();
		}
		else
		{
			$scope.materialmodal.title = 'Edit Material';
		}
		$('#materialmodal').modal('show');
	}

	$scope.CloseMaterialModal = function()
	{
		$scope.AddMaterialForm.$setPristine();
		$scope.AddMaterialForm.$setValidity();
		$scope.AddMaterialForm.$setUntouched();
		$('#materialmodal').modal('hide');
	}

	$scope.CloseUserModal = function()
	{
		$scope.AddUserForm.$setPristine();
		$scope.AddUserForm.$setValidity();
		$scope.AddUserForm.$setUntouched();
		$('#usermodal').modal('hide');
	}

	$scope.CloseManufactureModal = function()
	{
		$scope.AddManufactureForm.$setPristine();
		$scope.AddManufactureForm.$setValidity();
		$scope.AddManufactureForm.$setUntouched();
		$('#manufacturemodal').modal('hide');
	}

	$scope.CloseMaterialTypeModal = function()
	{
		$scope.AddMaterialTypeForm.$setPristine();
		$scope.AddMaterialTypeForm.$setValidity();
		$scope.AddMaterialTypeForm.$setUntouched();
		$('#materialtypemodal').modal('hide');
	}

	$scope.ClosePackingStyleModal = function()
	{
		$scope.AddPackingStyleForm.$setPristine();
		$scope.AddPackingStyleForm.$setValidity();
		$scope.AddPackingStyleForm.$setUntouched();
		$('#packingstylemodal').modal('hide');
	}

	$scope.CloseRackModal = function()
	{
		$scope.AddRackForm.$setPristine();
		$scope.AddRackForm.$setValidity();
		$scope.AddRackForm.$setUntouched();
		$('#rackmodal').modal('hide');
	}

	$scope.CloseRackTypeModal = function()
	{
		$scope.AddRackTypeForm.$setPristine();
		$scope.AddRackTypeForm.$setValidity();
		$scope.AddRackTypeForm.$setUntouched();
		$('#racktypemodal').modal('hide');
	}

	$scope.CloseSiteModal = function()
	{
		$scope.AddSiteForm.$setPristine();
		$scope.AddSiteForm.$setValidity();
		$scope.AddSiteForm.$setUntouched();
		$('#sitemodal').modal('hide');
	}

	$scope.CloseProductModal = function()
	{
		$scope.ProductForm.$setPristine();
		$scope.ProductForm.$setValidity();
		$scope.ProductForm.$setUntouched();
		$('#productmodal').modal('hide');
	}

	$scope.CloseProductTypeModal = function()
	{
		$scope.ProductTypeForm.$setPristine();
		$scope.ProductTypeForm.$setValidity();
		$scope.ProductTypeForm.$setUntouched();
		$('#producttypemodal').modal('hide');
	}

	$scope.CloseLocationModal = function()
	{
		$scope.AddLocationForm.$setPristine();
		$scope.AddLocationForm.$setValidity();
		$scope.AddLocationForm.$setUntouched();
		$('#locationmodal').modal('hide');
	}

	$scope.AddCustomer = function()
	{
		$http({
			method: 'post',
			url: '../addcustomers',
			data: {
				'customer': $scope.customer,
			},
		}).then(function success(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message + ' with Id: ' + response.data.data.code);
				$('#customermodal').modal('hide');
				$scope.getcustomers();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					Notification.error(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.DeleteCustomer = function(id, code)
	{
		$ngConfirm({
		    title: 'Warning!',
		    content: 'Are you sure want to delete '+ 'Customer:' + code +'?',
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        tryAgain: {
		            text: 'Delete',
		            btnClass: 'btn-red',
		            action: function(){
		            	$http({
						  method: 'DELETE',
						  url: '../customer/'+id,
						}).then(function success(response) {
						    if (response.data.status == 'success')
							{
								Notification.success(response.data.message);
								$scope.getcustomers();
							}
						  }, function error(response) {

						  });
		            }
		        },
		        close: function () {
		        }
		    }
		});
	}

	$scope.AddProductType = function()
	{
		$http({
			method: 'post',
			url: '../addproducttype',
			data: {
				'producttype': $scope.producttype
			},
		}).then(function success(response){
			if (response.data.status == 'success')
			{
				alert(response.data.message)
				$('#producttypemodal').modal('hide');
				$scope.getproducttypes();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.AddProduct = function()
	{
		$http({
			method: 'post',
			url: '../addproduct',
			data: {
				'product': $scope.product
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.message)
				$('#productmodal').modal('hide');
				$scope.getproducts();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.ChangeProductCategory = function()
	{
		if ($scope.product.type)
		{
			for (var i = 0; i < $scope.producttypes.length; i++) 
			{
				if ($scope.producttypes[i].id == $scope.product.type)
					$scope.product.category = $scope.producttypes[i].category;
			}
		}
	}

	$scope.AddLocation = function()
	{
		$http({
			method: 'post',
			url: '../addlocation',
			data: {
				'location': $scope.location
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.message)
				$('#locationmodal').modal('hide');
				$scope.getlocations();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.AddSite = function()
	{
		$http({
			method: 'post',
			url: '../addsite',
			data: {
				'site': $scope.site
			},
		}).then(function success(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$('#sitemodal').modal('hide');
				$scope.getsites();
			}
			else if (response.data.status == 'failure')
			{
				Notification.error(response.data.message);
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.AddRackType = function()
	{
		$http({
			method: 'post',
			url: '../addracktype',
			data: {
				'racktype': $scope.racktype
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.message)
				$('#racktypemodal').modal('hide');
				$scope.getracktypes();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.AddRack = function()
	{
		$http({
			method: 'post',
			url: '../addrack',
			data: {
				'rack': $scope.rack
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.message)
				$('#rackmodal').modal('hide');
				$scope.getracks();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.AddPackingStyle = function()
	{
		$http({
			method: 'post',
			url: '../addpackingstyle',
			data: {
				'packingstyle': $scope.packingstyle
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.message)
				$('#packingstylemodal').modal('hide');
				$scope.getpackingstyles();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.AddMaterialType = function()
	{
		$http({
			method: 'post',
			url: '../addmaterialtype',
			data: {
				'materialtype': $scope.materialtype
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.message)
				$('#materialtypemodal').modal('hide');
				$scope.getmaterialtypes();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.AddManufacture = function()
	{
		$http({
			method: 'post',
			url: '../addmanufacture',
			data: {
				'manufacture': $scope.manufacture
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.message)
				$('#manufacturemodal').modal('hide');
				$scope.getmanufactures();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.AddUser = function()
	{
		$http({
			method: 'post',
			url: '../adduser',
			data: {
				'user': $scope.user
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.message)
				$('#usermodal').modal('hide');
				$scope.getusers();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.AddMaterial = function()
	{
		$http({
			method: 'post',
			url: '../addmaterial',
			data: {
				'material': $scope.material
			},
		}).then(function success(response){
			if (response.status == 200)
			{
				alert(response.data.message)
				$('#materialmodal').modal('hide');
				$scope.getmaterials();
			}
		}, function failure(response){
			if (response.status == 422)
			{
				var errors = response.data.errors;
				for(var error in errors)
				{
					alert(errors[error][0]);
					break;
				}
			}
		});
	}

	$scope.DeleteSite = function(id)
	{
		$ngConfirm({
		    title: 'Warning!',
		    content: 'Are you sure want to delete?',
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        tryAgain: {
		            text: 'Delete',
		            btnClass: 'btn-red',
		            action: function(){
		            	$http({
						  method: 'DELETE',
						  url: '../site/'+id,
						}).then(function success(response) {
						    if (response.data.status == 'success')
							{
								Notification.success(response.data.message);
								$scope.getsites();
							}
						  }, function error(response) {

						  });
		            }
		        },
		        close: function () {
		        }
		    }
		});
	}

}]);