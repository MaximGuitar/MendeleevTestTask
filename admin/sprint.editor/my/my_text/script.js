sprint_editor.registerBlock("my_text", function ($, $el, data, settings) {
	settings = settings || {}

	data = $.extend(
		{
			value: "",
		},
		data
	)

	let editor

	this.getData = function () {
		return data
	}

	this.collectData = function () {
		data.value = editor.getData()
		return data
	}

	this.afterRender = function () {
		ClassicEditor.create($el.find(".sp-text").get(0), {}).then((newEditor) => {
			editor = newEditor
		})
	}
})
