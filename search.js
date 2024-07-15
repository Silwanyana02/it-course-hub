document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const courses = document.querySelectorAll('.course');
    const noResults = document.getElementById('noResults');
    const searchResults = document.getElementById('searchResults');

    function searchCourses() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        searchResults.innerHTML = '';

        if (searchTerm === '') {
            noResults.style.display = 'none';
            return;
        }

        let found = false;

        courses.forEach(course => {
            const description = course.querySelector('.description p').textContent.toLowerCase();
            const courseVisible = description.includes(searchTerm);

            if (courseVisible) {
                const clone = course.cloneNode(true);
                searchResults.appendChild(clone);
                found = true;
            }
        });

        noResults.style.display = found ? 'none' : 'block';
    }

    searchButton.addEventListener('click', searchCourses);
    searchInput.addEventListener('input', searchCourses);
});