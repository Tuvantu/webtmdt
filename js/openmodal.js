document.getElementById("openModalBtn").addEventListener("click", function(event) {
    event.preventDefault();
    var modal = document.getElementById("myModal");
    modal.style.display = modal.style.display === "block" ? "none" : "block";
});

document.querySelector(".close").addEventListener("click", function() {
    document.getElementById("myModal").style.display = "none";
});

