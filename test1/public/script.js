// Day/Night Mode Toggle
document.getElementById("toggleTheme").addEventListener("click", function () {
    document.body.classList.toggle("night");
    document.body.classList.toggle("day");

    // Save the theme preference to localStorage
    const currentTheme = document.body.classList.contains("night") ? "night" : "day";
    localStorage.setItem("theme", currentTheme);
});

// Apply saved theme on page load
window.addEventListener("load", function () {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        document.body.classList.add(savedTheme);
    } else {
        document.body.classList.add("day"); // Default theme
    }
});

// Menu toggle functionality
document.getElementById("menuToggle").addEventListener("click", function () {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.querySelector(".main-content");

    if (sidebar.style.left === "-250px") {
        sidebar.style.left = "0"; // Show sidebar
        mainContent.style.marginLeft = "250px"; // Shift content right
    } else {
        sidebar.style.left = "-250px"; // Hide sidebar
        mainContent.style.marginLeft = "0"; // Shift content back to normal
    }
});

// Close the menu when the "X" button is clicked
document.getElementById("closeBtn").addEventListener("click", function () {
    const sidebar = document.getElementById("sidebar");
    const mainContent = document.querySelector(".main-content");

    sidebar.style.left = "-250px"; // Hide sidebar
    mainContent.style.marginLeft = "0"; // Reset content position
});

// Search Functionality
document.getElementById("searchBox").addEventListener("input", function () {
    const searchQuery = this.value.toLowerCase();
    const animeItems = document.querySelectorAll(".anime-card");

    animeItems.forEach((item) => {
        const title = item.getAttribute("data-title").toLowerCase();
        item.style.display = title.includes(searchQuery) ? "block" : "none";
    });
});
