
// Student Search Functionality

const searchInput = document.querySelector("#searchInput");

if (searchInput) {
    searchInput.addEventListener("input", function () {

        const searchValue = this.value.toLowerCase();

        const rows = document.querySelectorAll(
            ".table-section tbody tr"
        );

        rows.forEach(function (row) {
            const studentData = row.textContent.toLowerCase();

            row.style.display = studentData.includes(searchValue)
                ? ""
                : "none";
        });
    });
}


// Delete Confirmation

const deleteForms = document.querySelectorAll(".delete-form");

deleteForms.forEach(function (form) {

    form.addEventListener("submit", function (event) {

        const confirmDelete = confirm(
            "Are you sure you want to delete this student?"
        );

        if (!confirmDelete) {
            event.preventDefault();
        }

    });

});
