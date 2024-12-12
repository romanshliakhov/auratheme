// document.addEventListener("DOMContentLoaded", function () {
//     const filterButtons = document.querySelectorAll(".filter-btn");
//     const listContainer = document.getElementById("monument-list");
//     const pagination = document.getElementById("pagination");

//     filterButtons.forEach(button => {
//         button.addEventListener("click", function () {
//             const categorySlug = this.getAttribute("data-category");
//             fetchMonuments(categorySlug, 1);
//         });
//     });

//     function fetchMonuments(categorySlug, page) {
//         const data = new URLSearchParams();
//         data.append("action", "filter_monuments");
//         data.append("category", categorySlug);
//         data.append("page", page);

//         fetch(ajax_params.ajax_url, {
//             method: "POST",
//             body: data,
//         })
//             .then(response => response.json())
//             .then(result => {
//                 if (result.success) {
//                     listContainer.innerHTML = result.data.posts;
//                     pagination.innerHTML = result.data.pagination;
//                 } else {
//                     console.error(result.data);
//                 }
//             })
//             .catch(error => console.error(error));
//     }
// });
