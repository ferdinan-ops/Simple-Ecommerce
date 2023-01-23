const modal = document.querySelectorAll("#modal");
const showModalBtn = document.getElementById("showModal");
const closeModalBtn = document.querySelectorAll("#closeModal");

showModalBtn.addEventListener("click", () => {
   modal[0].classList.remove("hidden");
});

closeModalBtn.forEach((btn) => {
   btn.addEventListener("click", ({ target }) => {
      target.parentElement.parentElement.parentElement.classList.add("hidden");
   });
});
