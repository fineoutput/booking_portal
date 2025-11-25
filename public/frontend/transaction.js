document.addEventListener("DOMContentLoaded", function () {
    console.log('nnnnnnnnnnnnnnnnnnnnnnnnn');
    
    const searchInput = document.getElementById("search");
    const buttons = document.querySelectorAll(".filter-btn");
    const rows = document.querySelectorAll("#tableBody tr");

    let activeFilter = "all";

    // Filter buttons click event
    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            buttons.forEach(b => b.classList.remove("active"));
            btn.classList.add("active");

            activeFilter = btn.dataset.type;
            filterTable();
        });
    });

    // Search input event
    searchInput.addEventListener("keyup", filterTable);

    function filterTable() {
        const searchText = searchInput.value.toLowerCase();

        rows.forEach(row => {
            const type = row.children[2].innerText.toLowerCase(); // CREDIT or DEBIT
            const text = row.innerText.toLowerCase();

            const matchText = text.includes(searchText);
            const matchType = (activeFilter === "all" || activeFilter === type.toLowerCase());

            row.style.display = (matchText && matchType) ? "" : "none";
        });
    }
});