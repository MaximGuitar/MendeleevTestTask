const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const { WebpackManifestPlugin } = require("webpack-manifest-plugin");

const isDev = process.env.NODE_ENV === "development";

module.exports = {
    entry: {
        main: "./src/app.ts",
    },
    devtool: isDev ? "inline-cheap-module-source-map" : "source-map",
    watchOptions: {
        ignored: /node_modules/,
    },
    mode: process.env.NODE_ENV,
    module: {
        rules: [
            {
                test: /\.(js|ts)$/,
                loader: "swc-loader",
                exclude: /node_modules/,
            },
            {
                test: /\.css$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader"],
            },
            {
                test: /\.s[ac]ss$/i,
                use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
            },
            {
                test: /\.(woff|woff2|eot|ttf|otf)$/i,
                type: "asset/resource",
            },
            {
                test: /\.(png|svg|jpg|jpeg|gif)$/i,
                type: "asset/resource",
            },
        ],
    },
    resolve: {
        extensions: [".ts", ".js"],
        alias: {
            '@': path.resolve(__dirname, 'src/'),
        }
    },
    output: {
        filename: "[name].[fullhash:6].js",
        path: path.resolve(__dirname, "dist"),
        clean: true,
        chunkFilename: "[name].[chunkhash:6].js",
    },
    optimization: {
        realContentHash: true,
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: "[name].[fullhash:6].css",
            chunkFilename: "[name].[chunkhash:6].css",
        }),
        new WebpackManifestPlugin({
            publicPath: "dist",
        }),
    ],
};
