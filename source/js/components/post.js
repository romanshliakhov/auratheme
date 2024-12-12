document.addEventListener("DOMContentLoaded", function () {
    const typeID = document.querySelector('[data-type]')?.getAttribute('data-type').split('|')[1] || 'blog';
    const activeCategory = document.querySelector('[data-type]')?.getAttribute('data-type').split('|')[0] || '5';

    function secusess({data}){
        const list = document.querySelector('.post__items');

        list.innerHTML = '';
        list.innerHTML = data.posts;

        const existingPagination = document.querySelector(".pagination");
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
        if (document.querySelector(".pagination")) {
            document.querySelector(".pagination").addEventListener("click", function (e) {
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
