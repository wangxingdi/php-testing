/**
 * the javascript about login and register
 * @author wangxd
 * @date 2019-04-22
 */
function openMenu() {
    var n = document.getElementById("mobile-dropdown");
    "dropdown-content" === n.className ? n.className += " open" : n.className = "dropdown-content"
}
function openSearch() {
    var e = document.getElementById("open-mobile-search")
      , s = document.getElementById("mob-search");
    "selected" === e.className ? e.classList.remove("selected") : e.classList.add("selected"),
    "mobile-search-box" === s.className ? s.className += " open" : s.className = "mobile-search-box"
}
window.onscroll = function() {
    shrinkMenuIcons()
};
var navbar = document.getElementById("masthead")
  , navbar_right = document.getElementById("navbarRight")
  , sticky = 50;
function shrinkMenuIcons() {
    window.pageYOffset >= sticky ? (navbar.classList.add("shrink"),
    navbar_right.classList.add("shrink-list")) : (navbar.classList.remove("shrink"),
    navbar_right.classList.remove("shrink-list"))
}
function changeColor() {
    var n = document.getElementById("dropdown");
    "dropdown open" === n.className ? n.className += " colorReverse" : n.classList.remove("colorReverse")
}
/*login & register & popup on header*/
function popup(t) {
    var e = (screen.width - 700) / 2
      , i = "width=700, height=400";
    return i += ", top=" + (screen.height - 400) / 2 + ", left=" + e,
    i += ", directories=no",
    i += ", location=no",
    i += ", menubar=no",
    i += ", resizable=no",
    i += ", scrollbars=no",
    i += ", status=no",
    i += ", toolbar=no",
    newwin = window.open(t, "windowname5", i),
    window.focus && newwin.focus(),
    !1
}
$(document).ready(function() {
    $("#FromLogin").on("submit", function(t) {
        t.preventDefault(),
        $("#output-login").html('<div class="alert alert-info">Logging you in.. Please wait..</div>'),
        $(this).ajaxSubmit({
            target: "#output-login"
        })
    })
}),
$(document).ready(function() {
    $("#FromRegister").on("submit", function(t) {
        t.preventDefault(),
        $("#output-register").html('<div class="alert alert-info">Working.. Please wait..</div>'),
        $(this).ajaxSubmit({
            target: "#output-register"
        })
    })
});
