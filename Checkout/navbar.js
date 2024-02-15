var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  if (prevScrollpos > currentScrollPos) {
    document.getElementById("nav_menu").style.bottom = "15px";
  } else {
    document.getElementById("nav_menu").style.bottom= "-100px";
  }
  prevScrollpos = currentScrollPos;
}