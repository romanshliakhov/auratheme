document.addEventListener("DOMContentLoaded", function () {
    // const filters = document.getElementById("category-filters");
    // const newsList = document.getElementById("news-list");
    const typeID = document.querySelector('[data-type]')?.getAttribute('data-type').split('|')[1] || 'blog';
    const activeCategory = document.querySelector('[data-type]')?.getAttribute('data-type').split('|')[0] || '5';

    // if (filters) {
    //     filters.addEventListener("click", function (e) {
    //         if (e.target.classList.contains("main-nav__btn")) {
    //             e.preventDefault();
    //             const categoryId = e.target.getAttribute("data-category-id");
    //             document.querySelectorAll(".main-nav__btn").forEach(btn => btn.classList.remove("active"));

    //             e.target.classList.add("active");
    //             fetchPosts(categoryId, 1, secusess);
    //         }
    //     });
    // }

    function secusess({data}){
        const list = document.querySelector('.post__items');

        list.innerHTML = '';
        list.innerHTML = data.posts;

        const existingPagination = document.querySelector(".page-nav");
        if (existingPagination) {
            existingPagination.remove();
        }

        if (data.pagination.length > 0) {
            list.insertAdjacentHTML('afterend',data.pagination)
            paginationInit()
        }


    }

    function fetchPosts(categoryId, page, callback) {
        const data = new URLSearchParams();
        data.append("action", "filter_posts");
        data.append("category_id", categoryId);
        data.append("type", typeID);
        data.append("page", page);

        fetch(ajax_params.ajax_url, {
            method: "POST",
            body: data,
        })
            .then(response => response.json())
            .then(result => {
                callback(result)
            });
    }

    function paginationInit() {
        if (document.querySelector(".page-nav")) {
            document.querySelector(".page-nav").addEventListener("click", function (e) {
                e.stopPropagation();

                if (e.target.hasAttribute("data-page")) {
                    e.preventDefault();

                    const page = e.target.getAttribute("data-page");

                    fetchPosts(activeCategory, page, secusess);
                }
            });
        }
    }

    paginationInit()

});
