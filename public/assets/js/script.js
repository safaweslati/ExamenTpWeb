document.querySelectorAll("td").forEach((element) =>
    element.addEventListener("click", () => {
        element.classList.toggle("highlight");
    })
);