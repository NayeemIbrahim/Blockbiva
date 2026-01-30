module.exports = {
    proxy: "localhost/wordpress",
    files: ["*.php", "inc/**/*.php", "assets/css/*.css", "assets/js/*.js"],
    notify: false,
    open: true,
    ghostMode: {
        clicks: true,
        location: true,
        forms: true,
        scroll: true,
    },
};
