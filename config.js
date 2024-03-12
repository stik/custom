module.exports = {
	config: {
		tailwindjs: "./tailwind.config.js",
        proxy: "https://localhost/argo/",
	},
	paths: {
		root: "./",
		src: {
			base: "./src",
			css: "./src/css",
			js: "./src/js",
			img: "./src/img"
		},
		dist: {
			base: "./dist",
			css: "./dist/css",
			js: "./dist/js",
			img: "./dist/img"
		}
	}
}
