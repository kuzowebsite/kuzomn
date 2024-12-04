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