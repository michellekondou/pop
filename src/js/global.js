//prevent scolling via touch in selected areas 
document.getElementById('side-menu').addEventListener('touchmove', function (e) {
    e.preventDefault();
}, { passive: false }); 

document.addEventListener("DOMContentLoaded", function () {
    new IOlazy({
        image: '.lazyload',
        threshold: 0.06,
        rootMargin: "10px 10px"
    });
});

//masonry
//client width + 141 to take effect
window.onload = showViewport;
window.onresize = showViewport;

function showViewport() {
    var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
    var height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0)
   //console.log( "Viewport size is " + width + "x" + height );
}

var elem = document.querySelector('.grid');
var cw = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
var masonryColWidth;
var masonryGutter;

 if (cw < 1892 && cw >= 1840) {
    masonryColWidth = 325;
    masonryGutter = 80;
 } else if (cw < 1840 && cw >= 1780) {
    masonryColWidth = 325;
    masonryGutter = 60;
 } else if (cw < 1780 && cw >= 1750) {
     masonryColWidth = 325;
     masonryGutter = 50;
 } else if (cw < 1750 && cw >= 1515) {
     masonryColWidth = 325;
     masonryGutter = 120;
 } else if (cw < 1515 && cw >= 1455) {
     masonryColWidth = 300;
     masonryGutter = 101;
 } else if (cw < 1455 && cw >= 1375) {
     masonryColWidth = 300;
     masonryGutter = 80;
 } else if (cw < 1375 && cw >= 1305) {
     masonryColWidth = 280;
     masonryGutter = 80;
 } else if (cw < 1305 && cw >= 1230) {
     masonryColWidth = 250;
     masonryGutter = 80;
 } else if (cw < 1230 && cw >= 1170) {
     masonryColWidth = 230;
     masonryGutter = 80;
 } else if (cw < 1170 && cw >= 960 ) {
     masonryColWidth = 230;
     masonryGutter = 50;
 } else if (cw < 960) {
     masonryColWidth = 230;
     masonryGutter = 100;
 } else {
     masonryColWidth = 325;
     masonryGutter = 101;
 }

imagesLoaded(elem, function (instance) {
    var msnry = new Masonry(elem, {
        gutter: masonryGutter,
        columnWidth: masonryColWidth,
        itemSelector: '.grid-item',
        //percentPosition: true,
        //horizontalOrder: true
    });
});


