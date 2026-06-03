const btn = document.querySelector(".btn");
const video = document.querySelector(".backgroundVideo");
const fa = document.querySelector(".fa-solid");
const preloader = document.querySelector(".preloader");

btn.addEventListener("click", () => {
  if (video.paused) {
    video.play();

    fa.classList.add("fa-pause");
    fa.classList.remove("fa-play");
  } else {
    video.pause();

    fa.classList.remove("fa-pause");
    fa.classList.add("fa-play");
  }
});

window.addEventListener("load", () => {
  preloader.style.zIndex = "-2";
  video.play();
})
