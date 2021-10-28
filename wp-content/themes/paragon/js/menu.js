//close mobile menu
document.querySelector(".mobile-close").addEventListener("click", () => {
    document.querySelector(".mobile-menu").style.cssText = `
    -webkit-transform: translateX(-85vw);
       -moz-transform: translateX(-85vw);
       -ms-transform: translateX(-85vw);
       -o-transform: translateX(-85vw); 
       transform: translateX(-85vw);`
    removeModalMenu()
})
//open mobile menu
document.querySelector(".mobile-switcher").addEventListener("click", () => {
    document.querySelector(".mobile-menu").style.cssText = `
       -webkit-transform: translateX(0);
       -moz-transform: translateX(0);
       -ms-transform: translateX(0);
       -o-transform: translateX(0); 
       transform: translateX(0); `
    addModalMenu()
})

//size of header
sizeOfTopMenu()
window.onresize = () => {
    sizeOfTopMenu()
}

function sizeOfTopMenu() {
    const elem = document.querySelector(".header-box")
    const hHeader = elem.getBoundingClientRect().height
    let is_main_box = document.querySelector(".main-box")
    if (is_main_box) {
        is_main_box.style.cssText = `padding-top: ${hHeader}px;`
    }
    const brHead = document.querySelector(".broker-head")
    if (brHead) {
        document.querySelector(".broker-head").style.cssText = `min-height: ${hHeader}px`
    }
}


function addModalMenu() {
    document.querySelector(".modal-black-menu").classList.remove("d-none")
    document.querySelector(".modal-black-menu").style.cssText = `z-index:0;`
    // document.querySelector(".head-block").classList.remove("bg-white")
    document.querySelector(".head-block").classList.add("bg-modal")
    document.querySelector(".head-block-start").classList.remove("bg-white")
    document.querySelector(".head-block-start").classList.add("bg-modal3")
}

function removeModalMenu() {
    document.querySelector(".modal-black-menu").classList.add("d-none")
    document.querySelector(".modal-black-menu").style.cssText = ``
    // document.querySelector(".head-block").classList.add("bg-white")
    document.querySelector(".head-block").classList.remove("bg-modal")
    document.querySelector(".head-block-start").classList.add("bg-white")
    document.querySelector(".head-block-start").classList.remove("bg-modal3")
}


var url = new URL(window.location.href);
//console.log(url)
// to mark menu on index page
const items = document.querySelectorAll('.menu-item ')
items.forEach((val) => {
    val.addEventListener('click', (e) => {
        del_class()
        val.classList.add('current-menu-item')
    })
})

// get hash (#) on index page
function get_hash() {
    url = new URL(window.location.href);
    let val_hash = url.hash
    if (val_hash !== '') {
        del_class()
        document.querySelector('a[href="/' + val_hash + '"]').classList.add('current-menu-item')
    }

}

// delete mark on index page
function del_class() {
   url = new URL(window.location.href);
    const items2 = document.querySelectorAll('.current-menu-item ')
    for (let i = 0; i < items2.length; i++) {
        items2[i].classList.remove('current-menu-item')
    }

}

//get pathname and mark menu
function get_pathname() {
     url = new URL(window.location.href);
    let path = ''
    let pathPage = ''
    let val_pathname = url.pathname

    if (val_pathname !== '/' && val_pathname !== '') {
        del_class()
        let path_separate = url.pathname.split("/", 2)
        path = path_separate[1] + '/'

        if (path === 'property/') {
            path = '#properties'
            pathPage = document.querySelector('a[href="/' + path + '"]')
            if (pathPage) {
                pathPage.classList.add('current-menu-item')
            }
        }
        if (path === 'investment-consulting/' || path === 'brokerage/' || path === 'commercial-lending/') {
            path = '#our_services'
            pathPage = document.querySelector('a[href="/' + path + '"]')
            if (pathPage) {
                pathPage.classList.add('current-menu-item')
            }
        }


        pathPage = document.querySelector('a[href="' + url.protocol + '//' + url.host + '/' + path_separate[1] + '/"]')
        if (pathPage) {
            pathPage.classList.add('current-menu-item')
        }
        let pathPage2 = document.querySelector('a[href="' + '/' + path_separate[1] + '/"]')
        if (pathPage2) {
            pathPage2.classList.add('current-menu-item')
        }

        //console.log('a[href="' + url.protocol + '//' + url.host + '/' + path_separate[1] + '/"]')
       //console.log(url.pathname.split("/",2))
    }

}

document.addEventListener('DOMContentLoaded', () => {
    del_class()
    get_pathname()
    get_hash()
})

let isBigImage55 = document.querySelector(".big-images")
if (isBigImage55) {
    isBigImage55.parentNode.style.cssText = 'min-width:100vw;'
}

let isAbout = document.querySelector("#about")
if (isAbout) {
    isAbout.children[0].classList.add('container')
}
let isServices = document.querySelector("#our_services")
if (isServices) {
    isServices.children[0].classList.add('container')
}
let isProperties = document.querySelector("#properties")
if (isProperties) {
    isProperties.children[0].classList.add('container')
}
let isNews = document.querySelector("#market_news")
if (isNews) {
    isNews.children[0].classList.add('container')
}
let newSizeOfScreen = document.documentElement.clientWidth
if (newSizeOfScreen > 768) {
    let isNewsBox = document.querySelector(".home-news-box")
    if (isNewsBox) {
        isNewsBox.children[0].classList.add('container')
    }
}
window.onresize = () => {
    newsBox()
}

function newsBox() {
    let newSizeOfScreen2 = document.documentElement.clientWidth
    if (newSizeOfScreen2 <= 768) {
        let isNewsBox2 = document.querySelector(".home-news-box")
        if (isNewsBox2) {
            isNewsBox2.children[0].classList.remove('container')
        }
    }
}


    const mobMenClick = document.querySelector('.mobile-menu')
    if (mobMenClick) {
        const arrMenus = mobMenClick.querySelectorAll('.menu-item')
        if (arrMenus) {
            arrMenus.forEach((val) => {
                val.addEventListener('click', () => {
                    document.querySelector(".mobile-menu").style.cssText = `
    -webkit-transform: translateX(-85vw);
       -moz-transform: translateX(-85vw);
       -ms-transform: translateX(-85vw);
       -o-transform: translateX(-85vw);
       transform: translateX(-85vw);`
                    removeModalMenu()
                })

            })
        }
    }
//
//
// jQuery(document).ready(function ($) {
//
//     $(function () {
//         $('a[href*=#]:not([href=#])').click(function () {
//             del_class()
//             get_pathname()
//             get_hash()
//
//             if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
//                 var target = $(this.hash);
//                 target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
//                 if (target.length) {
//                     document.querySelector(".mobile-menu").style.cssText = `
//     -webkit-transform: translateX(-85vw);
//        -moz-transform: translateX(-85vw);
//        -ms-transform: translateX(-85vw);
//        -o-transform: translateX(-85vw);
//        transform: translateX(-85vw);`
//                     removeModalMenu()
//
//                     $('html,body').animate({
//                         scrollTop: target.offset().top - 70
//                     }, 1000);
//
//
//                     return false;
//                 }
//             }
//
//
//         });
//     });
//
// })