$.extend($.fn, {
	serializeObject: function() {
		var paramObj = {};
		var paramArr = $(this).serializeArray();
		for (var i = -1, len = paramArr.length; ++i < len; ) {
			paramObj[paramArr[i].name] = paramArr[i].value;
		}
		return paramObj;
	}
});