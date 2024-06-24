sprint_editor.registerBlock("my_faq", function ($, $el, data, settings) {
	settings = settings || {}

	data = $.extend(
		{
			faq: []
		},
		data
	)

	let editors = []

	this.getData = function () {
		return data
	}

	this.collectData = function () {
		data.faq = []

		$el.find(".faq-row").each(function (i, row) {
			let question = $(this).find('[name="question"]').val()
			let answer = editors[i].getData()

			if (question == "" || answer == "") {
				return
			}

			data.faq.push({
				question: question,
				answer: answer
			})
		})

		return data
	}

	this.afterRender = function () {
		$el.find(".add-row").click(function () {
			renderItem("", "")
		})

		$.each(data.faq, function (i, item) {
			renderItem(item.question, item.answer)
		});
	}

	var renderItem = function (question, answer) {
		$el.find('.faq').append(sprint_editor.renderTemplate("my_faq-row", {
			question: question,
			answer: answer
		}))

		let textarea = $el.find(".faq-row").last().find('[name="answer"]').get(0)
		ClassicEditor.create(textarea, {}).then((newEditor) => {
			editors.push(newEditor)
		})
	}
})
