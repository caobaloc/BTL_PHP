const listButtons = document.querySelectorAll(".btn");

for (let btn of listButtons) {
  btn.addEventListener("click", () => {
    toggleBtn(btn);
  });
}

function toggleBtn(btn) {
  const btnActived = document.querySelector(".active");
  btnActived.classList.remove("active");

  btn.classList.add("active");
}
