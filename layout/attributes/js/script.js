// sticky navbar
window.onscroll = function() {
    var navbar = document.getElementById("navbar");
    var menu = document.getElementById("menu");

    if (window.pageYOffset > navbar.offsetTop) {
        navbar.classList.add("sticky");
    }
    else {
        navbar.classList.remove("sticky");
    }
}
// confirm password in register
function cpass()