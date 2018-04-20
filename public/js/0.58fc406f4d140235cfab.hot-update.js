webpackHotUpdate(0,[
/* 0 */,
/* 1 */
/***/ (function(module, exports) {

//prevent scolling via touch in selected areas 
document.getElementById('side-menu').addEventListener('touchmove', function (e) {
    e.preventDefault();
}, { passive: false });

//masonry
var elem = document.querySelector('.grid');
// var msnry = new Masonry(elem, {
//     // options
//     itemSelector: '.grid-item',
//     columnWidth: 200,
//     gutter: 100
// });
console.log('masonry el: ', elem);

/***/ })
])