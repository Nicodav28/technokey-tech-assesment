document.addEventListener('DOMContentLoaded', function () {
    const sortLinks = document.querySelectorAll('th a');
    sortLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            fetch(link.href)
                .then(response => response.text())
                .then(html => {
                    document.querySelector('main').innerHTML = html;
                });
        });
    });
});
