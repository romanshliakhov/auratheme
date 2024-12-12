document.addEventListener('DOMContentLoaded', function () {
    const galleryContainer = document.getElementById('portfolio-gallery');
    const loadingIndicator = document.getElementById('loading-indicator');
    let offset = 6; // Сколько изображений уже загружено
    let isLoading = false; // Флаг загрузки
    let allLoaded = false; // Флаг окончания загрузки всех изображений

    if(galleryContainer) {
        const loadMoreImages = () => {
            if (isLoading || allLoaded) return; // Если уже идёт загрузка или изображения закончились

            isLoading = true;
            loadingIndicator.style.display = 'block';

            fetch(ajaxurl, { // Используем ajaxurl, переданный WordPress
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'load_more_gallery_images',
                    offset: offset,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        galleryContainer.insertAdjacentHTML('beforeend', data.data); // Добавляем новые изображения
                        offset += 6; // Увеличиваем офсет
                        isLoading = false;

                        // Если больше нет изображений, помечаем как загруженные
                        if (data.data.trim() === '') {
                            allLoaded = true;
                            loadingIndicator.style.display = 'none';
                        }
                    } else {
                        allLoaded = true; // Если изображения закончились
                        loadingIndicator.style.display = 'none';
                    }
                })
                .catch(() => {
                    console.error('Ошибка загрузки данных');
                    isLoading = false;
                    loadingIndicator.style.display = 'none';
                });
        };

        const onScroll = () => {
            const { scrollTop, scrollHeight, clientHeight } = document.documentElement;

            // Проверяем, если пользователь приблизился к нижней части страницы
            if (scrollTop + clientHeight >= scrollHeight - 200 && !isLoading) {
                loadMoreImages();
            }
        };

        // Слушаем событие скроллинга
        window.addEventListener('scroll', onScroll);
    }
});
