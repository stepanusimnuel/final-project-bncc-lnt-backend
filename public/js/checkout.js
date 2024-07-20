const spans = document.querySelectorAll(".detail span");

spans[0].addEventListener("click", function () {
    if (spans[1].innerHTML > 1)
        spans[1].innerHTML = parseInt(spans[1].innerHTML) - 1;
});

spans[2].addEventListener("click", function () {
    spans[1].innerHTML = parseInt(spans[1].innerHTML) + 1;
});
