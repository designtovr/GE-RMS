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

	$scope.gridOptions = {
		pagination: {
			itemsPerPage: '10'
		},
		data:[],
	   	sort: {

	   	},
	   	urlSync: true
	};

	$scope.getcustomers = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/customers'
		}).then(function success(response) {
		    $scope.gridOptions.data = response.data.data;
		  }, function error(response) {

		  });
	}

	$scope.ResetCustomerSearch = function()
	{
		$scope.filtercustomercode = '';
		$scope.filterCustomerName = '';
		$scope.filterAddress = '';
		$scope.filterContactPerson = '';
		$scope.filtergst = '';
		$scope.filterEmail = '';
		$scope.filterContactNo = '';
		$scope.filterSite = '';
		$scope.filterLocation = '';
	}

	$scope.getproducts = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/products'
		}).then(function success(response) {
		    $scope.gridOptions.data = response.data.data;
		}, function error(response) {
		});
	}

	$scope.ResetProductSearch = function()
	{
		$scope.filtermodelno = '';
		$scope.filterProductType = '';
		$scope.filterCategory = '';
	}

	$scope.getlocations = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/locations'
		}).then(function success(response) {
		    $scope.gridOptions.data = response.data.data;
		}, function error(response) {
		});
	}

	$scope.getsites = function()
	{
		$http({
		  method: 'GET',
		  url: '/ge/sites'
		}).then(function success(response) {
		    $scope.gridOptions.data = response.data.data;
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
		    $scope.gridOptions.data = response.data.data;
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
		    $scope.gridOptions.data = response.data.data;
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
		$('#customermodal').modal('hide');
	}

	$scope.OpenProductTypeModal = function(producttype)
	{
		if (!producttype)
		{
			$scope.producttype = {};
			$scope.producttypemodal = [];
			$scope.producttypemodal.title = 'Add Product Type';
			$scope.producttype.edit = false;
		}
		else
		{
			$scope.producttypemodal.title = 'Edit Product Type';
			$scope.producttype.id = producttype.id;
			$scope.producttype.category = producttype.category;
			$scope.producttype.code = producttype.code;
			$scope.producttype.name = producttype.name;
			$scope.producttype.description = producttype.description;
			$scope.producttype.edit = true;
		}
		$('#producttypemodal').modal('show');
	}

	$scope.OpenProductModal = function(product)
	{
		$scope.getproducttypes();
		if (!product)
		{
			$scope.product = {};
			$scope.productmodal = [];
			$scope.productmodal.title = 'Add Product';
			$scope.product.edit = false;
		}
		else
		{
			$scope.productmodal.title = 'Edit Product';
			$scope.product.id = product.id;
			$scope.product.type = product.type;
			$scope.product.category = product.category;
			$scope.product.part_no = product.part_no;
			$scope.product.description = product.description;
			$scope.product.edit = true;
		}
		$('#productmodal').modal('show');
	}

	$scope.OpenLocationModal = function(location=0)
	{
		if (!location)
		{
			$scope.location = {};
			$scope.locationmodal = [];
			$scope.locationmodal.title = 'Add Location';
			$scope.locationmodal.edit = false;
		}
		else
		{
			$scope.locationmodal.title = 'Edit Location';
			$scope.locationmodal.edit = true;
			$scope.location.id = location.id;
			$scope.location.code = location.code;
			$scope.location.name = location.name;
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
			$scope.sitemodal.edit = false;
		}
		else
		{
			$scope.sitemodal.title = 'Edit Site';
			$scope.site.code = site.code;
			$scope.site.name = site.name;
			$scope.site.id = site.id;
			$scope.sitemodal.edit = true;
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

	$scope.OpenUserModal = function(user=0)
	{
		$scope.getroles();
		if (!user)
		{
			$scope.user = {};
			$scope.usermodal = [];
			$scope.usermodal.title = 'Add User';
			$scope.usermodal.edit = false;
		}
		else
		{
			console.log(user)
			$scope.usermodal.title = 'Edit User';
			$scope.usermodal.edit = true;
			$scope.user.id = user.id;
			$scope.user.name = user.name;
			$scope.user.email = user.email;
			$scope.user.role = user.role_id;
			$scope.user.password = user.password;
			console.log($scope.user)
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
		$('#materialmodal').modal('hide');
	}

	$scope.CloseUserModal = function()
	{
		$('#usermodal').modal('hide');
	}

	$scope.CloseManufactureModal = function()
	{
		$('#manufacturemodal').modal('hide');
	}

	$scope.CloseMaterialTypeModal = function()
	{
		$('#materialtypemodal').modal('hide');
	}

	$scope.ClosePackingStyleModal = function()
	{
		$('#packingstylemodal').modal('hide');
	}

	$scope.CloseRackModal = function()
	{
		$('#rackmodal').modal('hide');
	}

	$scope.CloseRackTypeModal = function()
	{
		$('#racktypemodal').modal('hide');
	}

	$scope.CloseSiteModal = function()
	{
		$('#sitemodal').modal('hide');
	}

	$scope.CloseProductModal = function()
	{
		$('#productmodal').modal('hide');
	}

	$scope.CloseProductTypeModal = function()
	{
		$('#producttypemodal').modal('hide');
	}

	$scope.CloseLocationModal = function()
	{
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
		    content: 'Are you sure want to delete '+ 'Customer:<b>' + code +'</b>?',
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
				Notification.success(response.data.message)
				$('#producttypemodal').modal('hide');
				$scope.getproducttypes();
			}
			else if (response.data.status == 'failure')
			{
				Notification.error(response.data.message)
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

	$scope.AddProduct = function()
	{
		$http({
			method: 'post',
			url: '../addproduct',
			data: {
				'product': $scope.product
			},
		}).then(function success(response){
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message);
				$('#productmodal').modal('hide');
				$scope.getproducts();
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
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message)
				$('#locationmodal').modal('hide');
				$scope.getlocations();
			}
			else if(response.data.status == 'failure')
			{
				Notification.error(response.data.message)
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

	$scope.ResetLocationSearch = function()
	{
		$scope.filterCode = '';
		$scope.filterName = '';
	}

	$scope.ResetSiteSearch = function()
	{
		$scope.filterCode = '';
		$scope.filterName = '';
	}

	$scope.ResetProductTypeSearch = function()
	{
		$scope.filterCode = '';
		$scope.filterName = '';
		$scope.filterCategory = '';
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
					Notification.error(errors[error][0]);
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
			if (response.data.status == 'success')
			{
				Notification.success(response.data.message + ' With Id: <b>'+ response.data.data.name + '</b>');
				$('#usermodal').modal('hide');
				$scope.getusers();
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

	$scope.DeleteUser = function(user)
	{
		$ngConfirm({
		    title: 'Warning!',
		    content: 'Are you sure want to delete User:<b>'+ user.name + '</b>?',
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        tryAgain: {
		            text: 'Delete',
		            btnClass: 'btn-red',
		            action: function(){
		            	$http({
							method: 'delete',
							url: '../user/'+user.id,
						}).then(function success(response){
							if (response.data.status == 'success')
							{
								Notification.success(response.data.message);
								$('#materialmodal').modal('hide');
								$scope.getusers();
							}
							else if (response.data.status == 'failure')
							{
								Notification.error(response.data.message);
							}
						}, function failure(response){

						});
		            }
		        },
		        close: function () {
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

	$scope.DeleteSite = function(id,code)
	{
		$ngConfirm({
		    title: 'Warning!',
		    content: 'Are you sure want to delete Site:<b>'+ code + '</b>?',
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

	$scope.DeleteLocation = function(id, code)
	{
		$ngConfirm({
		    title: 'Warning!',
		    content: 'Are you sure want to delete Location:<b>'+ code + '</b>?',
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        tryAgain: {
		            text: 'Delete',
		            btnClass: 'btn-red',
		            action: function(){
		            	$http({
						  method: 'DELETE',
						  url: '../location/'+id,
						}).then(function success(response) {
						    if (response.data.status == 'success')
							{
								Notification.success(response.data.message);
								$scope.getlocations();
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

	$scope.DeleteProductType = function(id, code)
	{
		$ngConfirm({
		    title: 'Warning!',
		    content: 'Are you sure want to delete Product type: <b>'+ code + '</b>?',
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        tryAgain: {
		            text: 'Delete',
		            btnClass: 'btn-red',
		            action: function(){
		            	$http({
						  method: 'DELETE',
						  url: '../producttype/'+id,
						}).then(function success(response) {
						    if (response.data.status == 'success')
							{
								Notification.success(response.data.message);
								$scope.getproducttypes();
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

	$scope.DeleteProduct = function(id, code)
	{
		$ngConfirm({
		    title: 'Warning!',
		    content: 'Are you sure want to delete Product: <b>'+ code + '</b>?',
		    type: 'red',
		    typeAnimated: true,
		    buttons: {
		        tryAgain: {
		            text: 'Delete',
		            btnClass: 'btn-red',
		            action: function(){
		            	$http({
						  method: 'DELETE',
						  url: '../product/'+id,
						}).then(function success(response) {
						    if (response.data.status == 'success')
							{
								Notification.success(response.data.message);
								$scope.getproducts();
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