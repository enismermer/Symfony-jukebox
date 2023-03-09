/********** Console.log() ***********/ 
console.log("Marty McFly");
console.log("Doc Emmett Brown");
console.log("Retour vers le futur");




/********************************************
            Gérer le Swiper.js         
********************************************/ 
const swiper = new Swiper('.swiper' , {

    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
    },

    // autoplay: {
    //     delay: 2500,
    //     disableOnInteraction: false,
    // },

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
        type: 'fraction',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    keyboard: {
        enabled: true,
        onlyInViewport: false,
      },
});





  

/**********************************************************
            Apparition et disparition du vinyle
**********************************************************/
let audio = document.querySelectorAll('audio');
console.log(audio);
let vinyle = document.querySelector('.record-container');

for (let i = 0; i < audio.length; i++) {
    audio[i].onplay = function () {
        // console.log("Je suis en play");
        vinyle.style.visibility = "visible";
        vinyle.style.transform = "rotate(360deg)";
    }
    audio[i].onpause = function () {
        vinyle.style.visibility = "hidden";
    }
}