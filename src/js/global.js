//prevent scolling via touch in selected areas 
document.getElementById('side-menu').addEventListener('touchmove', function (e) {
    e.preventDefault();
}, { passive: false }); 

document.addEventListener("DOMContentLoaded", function () {
    new IOlazy({
        image: '.lazyload',
        threshold: 0.9,
        rootMargin: "100px 100px"
    });
    console.log('hello');
});

//masonry
var elem = document.querySelector('.grid');
var msnry = new Masonry(elem, {
    // options
    gutter: 101,
    columnWidth: 325,
    itemSelector: '.grid-item',
    //percentPosition: true,
    //horizontalOrder: true
});
