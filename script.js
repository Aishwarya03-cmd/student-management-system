
// Student Search Functionality

const searchInput = document.querySelector(
    '.table-section input'
);

const studentRows = document.querySelectorAll(
    '.table-section tbody tr'
);

searchInput.addEventListener('input', function () {

    const searchValue = searchInput.value.toLowerCase();

    studentRows.forEach(function (row) {

        const studentData = row.textContent.toLowerCase();

        if (studentData.includes(searchValue)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }

    });

});


// Add Student Form Functionality

const studentForm = document.querySelector('.form-section form');

studentForm.addEventListener('submit', function (event) {

    event.preventDefault();

    const studentName = studentForm.querySelector(
        'input[type="text"]'
    ).value.trim();

    const studentEmail = studentForm.querySelector(
        'input[type="email"]'
    ).value.trim();

    const studentCourse = studentForm.querySelector(
        'select'
    ).value;

    if (!studentName || !studentEmail || !studentCourse) {
        alert('Please fill all the fields!');
        return;
    }

    alert('Student details entered successfully!');

    studentForm.reset();

});
