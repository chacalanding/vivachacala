$(document).ready(function(){
    $('.discover_carousel').slick({
      infinite: false,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        },
        {
          breakpoint: 980,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            centerMode:true,
            centerPadding:"10px"
          }
        },
        {
          breakpoint: 680,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            centerMode:true,
            centerPadding:"10px"
          }
        }
      ]
    });
    $('.currSpecial_carousel').slick({
      infinite: false,
      slidesToShow: 4,
      slidesToScroll: 3,
      arrows:false,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        },
        {
          breakpoint: 980,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            centerMode:true,
            centerPadding:"10px"
          }
        },
        {
          breakpoint: 680,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            centerMode:true,
            centerPadding:"10px"
          }
        }
      ]
    });
    $('.home_reviews_carousel').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3
          }
        },
        {
          breakpoint: 980,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            centerMode:true,
            centerPadding:"10px"
          }
        },
        {
          breakpoint: 680,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            centerMode:true,
            centerPadding:"0px"
          }
        }
      ]
    });
    $('.rental_reviews_carousel').slick({
      infinite: true,
      slidesToShow: 2,
      slidesToScroll: 2,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 980,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
            infinite: true,
            centerMode:true,
            centerPadding:"10px"
          }
        },
        {
          breakpoint: 680,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            infinite: true,
            centerMode:true,
            centerPadding:"0px"
          }
        }
      ]
    });

  });

//   let noOfCharac = 400;
// let contents = document.querySelectorAll(".content");
// contents.forEach(content => {
//     //If text length is less that noOfCharac... then hide the read more button
//     if(content.textContent.length < noOfCharac){
//         content.nextElementSibling.style.display = "none";
//     }
//     else{
//         let displayText = content.textContent.slice(0,noOfCharac);
//         let moreText = content.textContent.slice(noOfCharac);
//         content.innerHTML = `${displayText}<span class="dots">...</span><span class="hide more">${moreText}</span>`;
//     }
// });

// function readMore(btn){
//     let post = btn.parentElement;
//     post.querySelector(".dots").classList.toggle("hide");
//     post.querySelector(".more").classList.toggle("hide");
//     btn.textContent == "Read More" ? btn.textContent = "Read Less" : btn.textContent = "Read More";
// }
  