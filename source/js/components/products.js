 document.addEventListener("DOMContentLoaded", function () {
    const filters = document.getElementById("products-filters");
    const list = document.getElementById("products-list");
    let currentPage = 1;
    let isFetching = false;
    let maxPage = Infinity;

    if (typeof ajax_params === "undefined") {
        console.error("AJAX parameters not found. Please check your WordPress setup.");
        return;
    }

    // Извлекаем категорию из URL (последний сегмент)
    const pathParts = window.location.pathname.split("/").filter(part => part !== "");
    const initialCategorySlug = pathParts.length > 1 ? pathParts[pathParts.length - 1] : "";

    // Устанавливаем активную категорию и загружаем данные
    if (initialCategorySlug) {
        document.querySelector(`[data-category-slug="${initialCategorySlug}"]`)?.classList.add("active");
        fetchPosts(initialCategorySlug, 1, loadSuccess);
    }

    // Обработчик фильтров
    if (filters) {
        filters.addEventListener("click", function (e) {
            if (e.target.classList.contains("products-section__category-btn")) {
                e.preventDefault();
                const categorySlug = e.target.getAttribute("data-category-slug");

                document.querySelectorAll(".products-section__category-btn").forEach(btn => btn.classList.remove("active"));
                e.target.classList.add("active");

                // Обновляем URL
                updateURL(categorySlug);

                // Обнуляем и загружаем новую категорию
                currentPage = 1;
                maxPage = Infinity;
                list.innerHTML = "";
                fetchPosts(categorySlug, 1, loadSuccess);
            }
        });
    }

    function loadSuccess({ data }) {
        list.innerHTML += data.posts;
        maxPage = data.max_page;
        isFetching = false;
    }

    function fetchPosts(categorySlug, page, callback) {
        if (isFetching || page > maxPage) return;

        isFetching = true;
        const data = new URLSearchParams();
        data.append("action", "filter_granite_products");
        data.append("category_slug", categorySlug);
        data.append("page", page);

        fetch(ajax_params.ajax_url, {
            method: "POST",
            body: data,
        })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    callback(result);
                } else {
                    console.error(result.data);
                    showError("Ничего не найдено.");
                }
            })
            .catch(error => {
                console.error(error);
                showError("Ошибка при загрузке данных. Попробуйте позже.");
            });
    }

    function showError(message) {
        list.innerHTML = `<p>${message}</p>`;
        isFetching = false;
    }

    // Обновление URL без ?category
    function updateURL(categorySlug) {
        const newPath = `/granite-products/${categorySlug}`;
        history.replaceState(null, "", newPath);
    }
});  