$(document).ready(function () {
  $('.js-video-button').modalVideo({
    youtube: {
      controls: 0,
      nocookie: true,
    },
  })
})

window.addEventListener('scroll', function () {
  var header = document.querySelector('header')
  header.classList.toggle('sticky', window.scrollY > 0)
})
