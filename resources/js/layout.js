document.addEventListener('DOMContentLoaded', function () {
    const dropdownToggles = document.querySelectorAll('[data-bs-toggle="collapse"]');

    dropdownToggles.forEach((toggle) => {
        toggle.addEventListener('click', function () {
            const icon = toggle.querySelector('.rotate-icon');
            const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

            if (isExpanded) {
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
                toggle.setAttribute('aria-expanded', 'false');
            } else {
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
                toggle.setAttribute('aria-expanded', 'true');
            }
        });
    });
});
