const webpack = require("webpack")
const config = require("../webpack.config")
const notifier = require("node-notifier")
const { watchAssets, imageMin } = require("./assets")

const compilerCallback = (err, stats) => {
	console.clear()

	if (stats.hasErrors() || err) {
		notifier.notify("Ошибка сборки")
	}

	console.log(
		stats.toString({
			colors: true,
			chunks: false,
			chunkGroups: false,
			assets: false,
		})
	)
}
const mode = process.env.NODE_ENV || "development"
const isDev = mode === "development"
const compiler = webpack(config)

function dev() {
	compiler.watch({}, compilerCallback)
	watchAssets()
}

function prod() {
	compiler.run((err, stats) => {
		compilerCallback(err, stats)
		compiler.close((closeErr) => {})
	})
}

isDev ? dev() : prod()
