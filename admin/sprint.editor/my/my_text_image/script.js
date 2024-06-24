sprint_editor.registerBlock("my_text_image", function ($, $el, data, settings) {
	settings = settings || {}

	data = $.extend(
		{
			imagePosition: "left",
		},
		data
	)

	var areas = [
		{
			dataKey: "text",
			blockName: "my_text",
			container: ".text",
		},
		{
			dataKey: "image",
			blockName: "my_image",
			container: ".image",
		},
	]

	this.getAreas = function () {
		return areas
	}

	this.getData = function () {
		return data
	}

	this.collectData = function () {
		data.imagePosition = $el.find(".image-postion").val()
		return data
	}

	this.afterRender = function () {
		$el.find(".image-postion").val(data.imagePosition)
	}
})
