//prevent scolling via touch in selected areas 
document.getElementById('side-menu').addEventListener('touchmove', function (e) {
    e.preventDefault();
}, { passive: false }); 

//masonry
var elem = document.querySelector('.grid');
var msnry = new Masonry(elem, {
    // options
    gutter: 150,
    columnWidth: '.grid-sizer',
    itemSelector: '.grid-item',
    percentPosition: true,
    //horizontalOrder: true
});
