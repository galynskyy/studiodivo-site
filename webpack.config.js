const path = require("path");

module.exports = {
    entry: path.join(__dirname, "src/scripts/", "App.js"),
    output: {
        path: path.join(__dirname, "public/"),
        filename: "scripts/bundle.js"
    },
    module: {
        rules: [
            { test: /\.js$/, exclude: /node_modules/, loader: "babel-loader" }
        ],
    },
};