const modal = document.getElementById("modal");
const showModalBtn = document.getElementById("showModal");
const closeModalBtn = document.getElementById("closeModal");

showModalBtn.addEventListener("click", () => {
   modal.classList.remove("hidden");
});

closeModalBtn.addEventListener("click", () => {
   modal.classList.add("hidden");
});
