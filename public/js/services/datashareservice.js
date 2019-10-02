app.service('DataShareService', function(){

	var RId = [], getRIdList, setRIdList;
	
	getRIdList = function()
	{
		return RId;
	}

	setRIdList = function(list)
	{
		RId = list;
	}

	return {
		getRIdList : getRIdList,
		setRIdList : setRIdList
	};

});