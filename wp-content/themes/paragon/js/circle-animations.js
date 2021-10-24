// Получаем нужный элемент
var element = document.querySelector('#circle_block');
let flag_circle = true
var Visible = function (target) {
    // Все позиции элемента
    var targetPosition = {
            top: window.pageYOffset + target.getBoundingClientRect().top,
            left: window.pageXOffset + target.getBoundingClientRect().left,
            right: window.pageXOffset + target.getBoundingClientRect().right,
            bottom: window.pageYOffset + target.getBoundingClientRect().bottom
        },
        // Получаем позиции окна
        windowPosition = {
            top: window.pageYOffset,
            left: window.pageXOffset,
            right: window.pageXOffset + document.documentElement.clientWidth,
            bottom: window.pageYOffset + document.documentElement.clientHeight
        };
    if (targetPosition.bottom > windowPosition.top &&
        targetPosition.top < windowPosition.bottom &&
        targetPosition.right > windowPosition.left &&
        targetPosition.left < windowPosition.right && flag_circle) {
        start_fill()
        flag_circle = false
    } else {

    }
    ;
};

window.addEventListener('scroll', function () {
    Visible(element);
});

Visible(element);

function start_fill() {

    last = document.getElementById('svg1')
    circle = last.getElementsByTagName('path')
    target = circle[1] // цель наш круг
    circle_length = circle[1].getTotalLength()
    counter = circle_length
    sector = circle_length - (circle_length / 100) * 65// количество процентов от общей длины
    speed = 1
    fill(target, counter, sector, speed)
    /////
    last2 = document.getElementById('svg2')
    circle2 = last2.getElementsByTagName('path')
    target2 = circle2[1] // цель наш круг
    circle_length2 = circle2[1].getTotalLength()
    counter2 = circle_length2
    sector2 = circle_length2 - (circle_length2 / 100) * 65 // количество процентов от общей длины
    speed2 = 1
    fill(target2, counter2, sector2, speed2)
    ///////
    last3 = document.getElementById('svg3')
    circle3 = last3.getElementsByTagName('path')
    target3 = circle3[1] // цель наш круг
    circle_length3 = circle3[1].getTotalLength()
    counter3 = circle_length3
    sector3 = circle_length3 - (circle_length3 / 100) * 65 // количество процентов от общей длины
    speed3 = 1
    fill(target3, counter3, sector3, speed3)
    ///////
    last4 = document.getElementById('svg4')
    circle4 = last4.getElementsByTagName('path')
    target4 = circle4[1] // цель наш круг
    circle_length4 = circle4[1].getTotalLength()
    counter4 = circle_length4
    sector4 = circle_length4 - (circle_length4 / 100) * 65 // количество процентов от общей длины
    speed4 = 1
    fill(target4, counter4, sector4, speed4)

    ///////

    function fill(target, counter, sector, speed) {
        setTimeout(() => {
            target.style.strokeDashoffset = `${counter}`
            if (counter > sector) {
                counter -= speed // скорость заполнения
            }
            fill(target, counter, sector, speed)
        }, 1)
    }
}

//
let valSwitcher = document.querySelector('.prop-switcher-button.active-button')
if (document.documentElement.clientWidth <= 991) {
    changeListAndMap(valSwitcher)
}
window.onresize = () => {
    if (document.documentElement.clientWidth <= 991){
        valSwitcher = document.querySelector('.prop-switcher-button.active-button')
    changeListAndMap(valSwitcher)
}else{
        document.querySelector('.home-map-col').classList.remove('d-none')
        document.querySelector('.block-inner').classList.remove('d-none')
        document.querySelector('.see-all-box').classList.remove('d-none')
    }
}
const buttons_index  = document.querySelectorAll('.prop-switcher-button')
if(buttons_index.length>0){
    buttons_index.forEach((val)=>{

        val.addEventListener('click',()=>{
            for(let i=0; i<buttons_index.length;i++){
                buttons_index[i].classList.remove('active-button')
            }
            val.classList.toggle('active-button')
            changeListAndMap(val)
        })
    })
}
function changeListAndMap(val){
    if(val.innerHTML==='List'){
        document.querySelector('.home-map-col').classList.add('d-none')
        document.querySelector('.block-inner').classList.remove('d-none')
        document.querySelector('.see-all-box').classList.remove('d-none')
    }
    if(val.innerHTML==='Map'){
        document.querySelector('.block-inner').classList.add('d-none')
        document.querySelector('.see-all-box').classList.add('d-none')
        document.querySelector('.home-map-col').classList.remove('d-none')
    }
}