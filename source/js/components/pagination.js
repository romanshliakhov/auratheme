import {addCustomClass, removeClassInArray, removeCustomClass} from "../functions/customFunctions";
import {getAcfFields} from "../functions/ajax-get-data";

export function filterButtonsHandler(buttons, mainParent, ajaxAction, callback) {
    const { ajax_url, themeUrl } = ajax_params;

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            const category = this.getAttribute('data-category');

            if (button.closest('[data-url]')) {
                const url = button.closest('[data-url]').getAttribute('data-url');
                localStorage.setItem('active_category', category);
                if (url) {
                    window.location.href = url;
                    return;
                }
            }


            removeCustomClass(mainParent, 'loader,loaded');
            removeClassInArray(buttons, 'active');

            addCustomClass(this, 'active');
            addCustomClass(mainParent, 'loader');

            const params = `category_id=${category}&page=1`;

            getAcfFields(ajax_url, ajaxAction, params, function (data) {
                if (!data.success) {
                    console.error('Error:', data.message);
                    return;
                }

                callback(mainParent, data, category);
            });
        });
    });
}

export function updatePagination(paginationContainer, totalPages, currentPage, category, postsContainer) {
    removeCustomClass(postsContainer, 'loaded')
    const { themeUrl } = ajax_params;
    paginationContainer.innerHTML = `
        <button class="page-nav__btn prev" ${currentPage === 1 ? 'disabled' : ''}>
            <svg width="24" height="24">
            	<use href="${themeUrl}/assets/img/sprite/sprite.svg#arrow-l"></use>
            </svg>
        </button>
        <ul>
            ${generatePageLinks(totalPages, currentPage)}
        </ul>
        <button class="page-nav__btn next" ${currentPage === totalPages ? 'disabled' : ''}>
            <svg width="24" height="24">
            	<use href="${themeUrl}/assets/img/sprite/sprite.svg#arrow-l"></use>
            </svg>
        </button>
    `;

    paginationContainer.querySelector('.prev').addEventListener('click', function() {
        if (currentPage > 1) {
            fetchPage(category, currentPage - 1, postsContainer);
        }
    });

    paginationContainer.querySelector('.next').addEventListener('click', function() {
        if (currentPage < totalPages) {
            fetchPage(category, currentPage + 1, postsContainer);
        }
    });

    paginationContainer.querySelectorAll('ul li button').forEach(button => {
        button.addEventListener('click', function() {
            const page = parseInt(this.getAttribute('data-page'));
            fetchPage(category, page, postsContainer);
        });
    });
}

function generatePageLinks(totalPages, currentPage) {
    let links = '';
    let maxLinks = 5;
    let start = Math.max(1, currentPage - Math.floor(maxLinks / 2));
    let end = Math.min(totalPages, start + maxLinks - 1);

    if (start > 1) {
        links += `<li><button data-page="1">1</button></li>`;
        if (start > 2) {
            links += `<li>...</li>`;
        }
    }

    for (let i = start; i <= end; i++) {
        links += `
            <li>
                <button data-page="${i}" class="${i === currentPage ? 'active' : ''}">${i}</button>
            </li>
        `;
    }

    if (end < totalPages) {
        if (end < totalPages - 1) {
            links += `<li>...</li>`;
        }
        links += `<li><button data-page="${totalPages}">${totalPages}</button></li>`;
    }

    return links;
}

export function fetchPage(category, page, postsContainer) {
    const params = `category_id=${category}&page=${page}`;
    addCustomClass(postsContainer, 'loader')

    getAcfFields(ajax_params.ajax_url, 'filter_blogs', params, function (data) {
        if (!data.success) {
            console.error('Error:', data.message);
            return;
        }

        console.log(postsContainer)
        const { posts, total_pages, current_page } = data;
        postsContainer.innerHTML = '';
        const postItemsHTML = posts.map(post => `<li class="blog-list__item">${post}</li>`);
        postsContainer.innerHTML = postItemsHTML.join('');

        updatePagination(document.querySelector('.page-nav'), total_pages, current_page, category, postsContainer);

        setTimeout(function () {
            addCustomClass(postsContainer, 'loaded');
        }, 400);
    });
}