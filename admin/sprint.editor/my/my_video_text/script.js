sprint_editor.registerBlock("my_video_text", function ($, $el, data) {
	data = $.extend(
		{
			value: "",
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
			dataKey: "video",
			blockName: "video",
			container: ".video",
		},
	]

	this.getData = function () {
		return data
	}

	this.collectData = function () {
		return data
	}

	this.getAreas = function () {
		return areas
	}
})
