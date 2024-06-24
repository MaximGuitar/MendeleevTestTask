sprint_editor.registerBlock("my_quote", function ($, $el, data, settings) {
	data = $.extend(
		{
			quote: "",
			fio: "",
		},
		data
	)

	this.getData = function () {
		return data
	}

	this.collectData = function () {
		data.quote = $el.find("textarea").val()
		data.fio = $el.find("[name='fio']").val()
		return data
	}

	this.afterRender = function () {
		console.log(data)
	}
})
