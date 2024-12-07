document.addEventListener("DOMContentLoaded", function () {
    const filters = document.getElementById("products-filters");
    const list = document.getElementById("products-list");
    const loadingIndicator = document.getElementById("loading-indicator");
    let currentPage = 1;
    let isFetching = false;
    let maxPage = Infinity;

    // Получение текущей категории из URL
    const urlParams = new URLSearchParams(window.location.search);
    const initialCategorySlug = urlParams.get("category") || "";

    // Установка активной категории при загрузке
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
        maxPage = data.max_page; // Обновление максимального количества страниц
        isFetching = false;
    }

    function updateURL(categorySlug) {
        const currentURL = new URL(window.location.href);
        currentURL.searchParams.set("category", categorySlug);
        history.pushState(null, "", currentURL.toString());
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
                }
            })
            .catch(error => console.error(error));
    }

    // Обработчик для бесконечного скролла
    window.addEventListener("scroll", function () {
        const categorySlug = document.querySelector(".products-section__category-btn.active")?.getAttribute("data-category-slug") || "";

        if (
            window.innerHeight + window.scrollY >= document.body.offsetHeight - 200 && // Если почти у конца страницы
            !isFetching // Если запрос уже не выполняется
        ) {
            currentPage++;
            fetchPosts(categorySlug, currentPage, loadSuccess);
        }
    });
});
