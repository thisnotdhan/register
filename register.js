// script.js

document.addEventListener("DOMContentLoaded", function () {
    const formPages = document.querySelectorAll(".form-page");
    const nextButtons = document.querySelectorAll(".next-page");
    const prevButtons = document.querySelectorAll(".prev-page");

    nextButtons.forEach(button => {
        button.addEventListener("click", function () {
            const currentPage = this.closest(".form-page");
            const nextPageId = this.getAttribute("data-next");
            const nextPage = document.getElementById(nextPageId);

            currentPage.style.display = "none";
            nextPage.style.display = "block";
        });
    });

    prevButtons.forEach(button => {
        button.addEventListener("click", function () {
            const currentPage = this.closest(".form-page");
            const prevPageId = this.getAttribute("data-prev");
            const prevPage = document.getElementById(prevPageId);

            currentPage.style.display = "none";
            prevPage.style.display = "block";
        });
    });
});