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


const url = new URL(window.location.href);
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
    let val_hash = url.hash
    if (val_hash !== '') {
        del_class()
        document.querySelector('a[href="/' + val_hash + '"]').classList.add('current-menu-item')
    }
}

// delete mark on index page
function del_class() {
    const items2 = document.querySelectorAll('.current-menu-item ')
    for (let i = 0; i < items2.length; i++) {
        items2[i].classList.remove('current-menu-item')
    }

}

//get pathname and mark menu
function get_pathname() {
    let path=''
    let pathPage=''
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
        } if (path === 'investment-consulting/' || path === 'brokerage/'  || path === 'commercial-lending/' ) {
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
       let  pathPage2 = document.querySelector('a[href="'  + '/' + path_separate[1] + '/"]')
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