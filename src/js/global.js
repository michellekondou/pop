// //prevent scolling via touch in selected areas 
document.getElementById('side-menu').addEventListener('touchmove', function (e) {
    e.preventDefault();
}, { passive: false });

document.addEventListener("DOMContentLoaded", function () {
    new IOlazy({
        image: '.lazyload',
        threshold: 0.06,
        rootMargin: "10px 10px"
    });

    //----Start PhotoSwipe
    var initPhotoSwipeFromDOM = function (gallerySelector) {

        var parseThumbnailElements = function (el) {
            var thumbElements = el.childNodes,
                numNodes = thumbElements.length,
                items = [],
                el,
                childElements,
                thumbnailEl,
                size,
                item;

            for (var i = 0; i < numNodes; i++) {
                el = thumbElements[i];

                // include only element nodes 
                if (el.nodeType !== 1) {
                    continue;
                }

                childElements = el.children;

                size = el.getAttribute('data-size').split('x');

                // create slide object
                item = {
                    src: el.getAttribute('href'),
                    w: parseInt(size[0], 10),
                    h: parseInt(size[1], 10),
                    author: el.getAttribute('data-author')
                };

                item.el = el; // save link to element for getThumbBoundsFn

                if (childElements.length > 0) {
                    item.msrc = childElements[0].getAttribute('src'); // thumbnail url
                    if (childElements.length > 1) {
                        item.title = childElements[1].innerHTML; // caption (contents of figure)
                    }
                }


                var mediumSrc = el.getAttribute('data-med');
                if (mediumSrc) {
                    size = el.getAttribute('data-med-size').split('x');
                    // "medium-sized" image
                    item.m = {
                        src: mediumSrc,
                        w: parseInt(size[0], 10),
                        h: parseInt(size[1], 10)
                    };
                }
                // original image
                item.o = {
                    src: item.src,
                    w: item.w,
                    h: item.h
                };

                items.push(item);
            }

            return items;
        };

        // find nearest parent element
        var closest = function closest(el, fn) {
            return el && (fn(el) ? el : closest(el.parentNode, fn));
        };

        var onThumbnailsClick = function (e) {
            e = e || window.event;
            e.preventDefault ? e.preventDefault() : e.returnValue = false;

            var eTarget = e.target || e.srcElement;

            var clickedListItem = closest(eTarget, function (el) {
                return el.tagName === 'A';
            });

            if (!clickedListItem) {
                return;
            }

            var clickedGallery = clickedListItem.parentNode;

            var childNodes = clickedListItem.parentNode.childNodes,
                numChildNodes = childNodes.length,
                nodeIndex = 0,
                index;

            for (var i = 0; i < numChildNodes; i++) {
                if (childNodes[i].nodeType !== 1) {
                    continue;
                }

                if (childNodes[i] === clickedListItem) {
                    index = nodeIndex;
                    break;
                }
                nodeIndex++;
            }

            if (index >= 0) {
                openPhotoSwipe(index, clickedGallery);
            }
            return false;
        };

        var photoswipeParseHash = function () {
            var hash = window.location.hash.substring(1),
                params = {};

            if (hash.length < 5) { // pid=1
                return params;
            }

            var vars = hash.split('&');
            for (var i = 0; i < vars.length; i++) {
                if (!vars[i]) {
                    continue;
                }
                var pair = vars[i].split('=');
                if (pair.length < 2) {
                    continue;
                }
                params[pair[0]] = pair[1];
            }

            if (params.gid) {
                params.gid = parseInt(params.gid, 10);
            }

            return params;
        };

        var openPhotoSwipe = function (index, galleryElement, disableAnimation, fromURL) {
            var pswpElement = document.querySelectorAll('.pswp')[0],
                gallery,
                options,
                items;

            items = parseThumbnailElements(galleryElement);

            // define options (if needed)
            options = {

                galleryUID: galleryElement.getAttribute('data-pswp-uid'),

                getThumbBoundsFn: function (index) {
                    // See Options->getThumbBoundsFn section of docs for more info
                    var thumbnail = items[index].el.children[0],
                        pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                        rect = thumbnail.getBoundingClientRect();

                    return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
                },

                addCaptionHTMLFn: function (item, captionEl, isFake) {
                    if (!item.title) {
                        captionEl.children[0].innerText = '';
                        return false;
                    }
                    captionEl.children[0].innerHTML = item.title + '<br/><small>Photo: ' + item.author + '</small>';
                    return true;
                },

            };


            if (fromURL) {
                if (options.galleryPIDs) {
                    // parse real index when custom PIDs are used 
                    // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                    for (var j = 0; j < items.length; j++) {
                        if (items[j].pid == index) {
                            options.index = j;
                            break;
                        }
                    }
                } else {
                    options.index = parseInt(index, 10) - 1;
                }
            } else {
                options.index = parseInt(index, 10);
            }

            // exit if index not found
            if (isNaN(options.index)) {
                return;
            }

            if (disableAnimation) {
                options.showAnimationDuration = 0;
            }

            // Pass data to PhotoSwipe and initialize it
            gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);

            // see: http://photoswipe.com/documentation/responsive-images.html
            var realViewportWidth,
                useLargeImages = false,
                firstResize = true,
                imageSrcWillChange;

            gallery.listen('beforeResize', function () {

                var dpiRatio = window.devicePixelRatio ? window.devicePixelRatio : 1;
                dpiRatio = Math.min(dpiRatio, 2.5);
                realViewportWidth = gallery.viewportSize.x * dpiRatio;


                if (realViewportWidth >= 1200 || (!gallery.likelyTouchDevice && realViewportWidth > 800) || screen.width > 1200) {
                    if (!useLargeImages) {
                        useLargeImages = true;
                        imageSrcWillChange = true;
                    }

                } else {
                    if (useLargeImages) {
                        useLargeImages = false;
                        imageSrcWillChange = true;
                    }
                }

                if (imageSrcWillChange && !firstResize) {
                    gallery.invalidateCurrItems();
                }

                if (firstResize) {
                    firstResize = false;
                }

                imageSrcWillChange = false;

            });

            gallery.listen('gettingData', function (index, item) {
                if (useLargeImages) {
                    item.src = item.o.src;
                    item.w = item.o.w;
                    item.h = item.o.h;
                } else {
                    item.src = item.m.src;
                    item.w = item.m.w;
                    item.h = item.m.h;
                }
            });

            gallery.init();
        };

        // select all gallery elements
        var galleryElements = document.querySelectorAll(gallerySelector);
        for (var i = 0, l = galleryElements.length; i < l; i++) {
            galleryElements[i].setAttribute('data-pswp-uid', i + 1);
            galleryElements[i].onclick = onThumbnailsClick;
        }

        // Parse URL and open gallery if it contains #&pid=3&gid=1
        var hashData = photoswipeParseHash();
        if (hashData.pid && hashData.gid) {
            openPhotoSwipe(hashData.pid, galleryElements[hashData.gid - 1], true, true);
        }
    };

    initPhotoSwipeFromDOM('.magnifiable');

});

    

    // Array.from(document.querySelectorAll('a')).forEach((item) => {

    //     item.addEventListener('click', function(e){
            
    //         if(item.getAttribute('data-size') !== '') {

    //             if( !PhotoSwipe || !PhotoSwipeUI_Default ) {
    //                 return;
    //             }
    //             e.preventDefault();
    //             openPhotoSwipe( this );
        
    //         }

    //     });
     
    // }); 

    // const parseThumbnailElements = (gallery, el) => {
    //     const elements = gallery.querySelectorAll('a[data-size]');
    //     const galleryItems = [];
    //     const index;

    //     console.log(gallery, elements);
    //     // var
    //     //     elements = $(gallery).find('a[data-size]').has('img'),
    //     //     galleryItems = [],
    //     //     index;
    // }

    

    //     $('body').on('click', 'a[data-size]', function(e) {
          
    //       if( !PhotoSwipe || !PhotoSwipeUI_Default ) {
    //         return;
    //       }

    //       e.preventDefault();
    //       openPhotoSwipe( this );

    //     });

    //     var parseThumbnailElements = function(gallery, el) {
    //       var 
    //         elements = $(gallery).find('a[data-size]').has('img'),
    //         galleryItems = [],
    //         index;

    //       elements.each(function(i) {
    //         var 
    //           $el = $(this),
    //           size = $el.data('size').split('x'),
    //           caption;

    //         if( $el.next().is('.wp-caption-text') ) {
    //           // image with caption
    //           caption = $el.next().text();
    //         } else if( $el.parent().next().is('.wp-caption-text') ) {
    //           // gallery icon with caption
    //           caption = $el.parent().next().text();
    //         } else {
    //           caption = $el.attr('title');
    //         }         

    //         galleryItems.push({
    //           src: $el.attr('href'),
    //           w: parseInt(size[0], 10),
    //           h: parseInt(size[1], 10),
    //           title: caption,
    //           msrc: $el.find('img').attr('src'),
    //           el: $el
    //         });

    //         if( el === $el.get(0) ) {
    //           index = i;
    //         }

    //       });

    //     return [galleryItems, parseInt(index, 10)];
    //   }; // parseThumbnailElements

    //   var openPhotoSwipe = function( element, disableAnimation ) {
    //     var 
    //       pswpElement = $('.pswp').get(0),
    //       galleryElement = $(element).parents('.photoswipe, .hentry, .main, body').first(),
    //       gallery,
    //       options,
    //       items, 
    //       index;

    //       items = parseThumbnailElements(galleryElement, element);
    //       index = items[1];
    //       items = items[0];

    //     options = {
    //       index: index,
    //       getThumbBoundsFn: function(index) {
    //         var image = items[index].el.find('img'),
    //         offset = image.offset();
    //         return {x:offset.left, y:offset.top, w:image.width()};
    //       },
    //       showHideOpacity: true,
    //       history: false,
    //       captionEl: true,
    //       // showHideOpacity: false,
    //       // showAnimationDuration: 150,
    //       // hideAnimationDuration: 150,
    //       bgOpacity: 1,
    //       shareEl: true,
    //       // spacing: 0.12,
    //       // allowPanToNext: true,
    //       // maxSpreadZoom: 2,
    //       // loop: 1,
    //       pinchToClose: true,
    //       closeOnScroll: true,
    //       // closeOnVerticalDrag: true,
    //       escKey: true,
    //       arrowKeys: true,
    //       zoomEl: false

    //     };

    //     if(disableAnimation) {
    //       options.showAnimationDuration = 0;
    //     }

    //     // Pass data to PhotoSwipe and initialize it
    //     gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
    //     gallery.init();

    //   };

      //----End PhotoSwipe
// });

// //masonry
// //client width + 141 to take effect
// window.onload = showViewport;
// window.onresize = showViewport;

// function showViewport() {
//     var width = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
//     var height = Math.max(document.documentElement.clientHeight, window.innerHeight || 0)
//     //console.log( "Viewport size is " + width + "x" + height );
// }

// var elem = document.querySelector('.grid');
// var cw = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
// var masonryColWidth;
// var masonryGutter;

// if (cw < 1892 && cw >= 1840) {
//     masonryColWidth = 325;
//     masonryGutter = 80;
// } else if (cw < 1840 && cw >= 1780) {
//     masonryColWidth = 325;
//     masonryGutter = 60;
// } else if (cw < 1780 && cw >= 1750) {
//     masonryColWidth = 325;
//     masonryGutter = 50;
// } else if (cw < 1750 && cw >= 1515) {
//     masonryColWidth = 325;
//     masonryGutter = 120;
// } else if (cw < 1515 && cw >= 1455) {
//     masonryColWidth = 300;
//     masonryGutter = 101;
// } else if (cw < 1455 && cw >= 1375) {
//     masonryColWidth = 300;
//     masonryGutter = 80;
// } else if (cw < 1375 && cw >= 1305) {
//     masonryColWidth = 280;
//     masonryGutter = 80;
// } else if (cw < 1305 && cw >= 1230) {
//     masonryColWidth = 250;
//     masonryGutter = 80;
// } else if (cw < 1230 && cw >= 1170) {
//     masonryColWidth = 230;
//     masonryGutter = 80;
// } else if (cw < 1170 && cw >= 960) {
//     masonryColWidth = 230;
//     masonryGutter = 50;
// } else if (cw < 960) {
//     masonryColWidth = 230;
//     masonryGutter = 100;
// } else {
//     masonryColWidth = 325;
//     masonryGutter = 101;
// }

// // imagesLoaded(elem, function (instance) {
// //     var msnry = new Masonry(elem, {
// //         gutter: masonryGutter,
// //         columnWidth: masonryColWidth,
// //         itemSelector: '.grid-item',
// //         //percentPosition: true,
// //         //horizontalOrder: true
// //     });
// // });


