const swiper = new Swiper('.mySwiper', {
    autoplay: {
      delay: 5000,
    },
      loop: true,
  });
  console.log("marchetoi");
  
  setInterval(showVinyle, 1000)

  let video = document.querySelectorAll('.mySwiper');
  let vinyle = document.querySelector('.record-container');

  function showVinyle() {
    video.addEventListener('click', function() {
        vinyle.style.visibility = "visible";
        vinyle.style.transform = "rotate(360deg)";
    })
  }
  