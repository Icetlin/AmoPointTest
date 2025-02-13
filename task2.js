// Получаем выпадающий список
const selectElement = document.querySelector('select[name="type_val"]');

// Получаем все элементы с атрибутом name
const elements = document.querySelectorAll('[name]');

// Функция для обновления видимости элементов
function updateVisibility() {
    // Получаем выбранное значение из выпадающего списка
    const selectedValue = selectElement.value;

    // Проходимся по всем элементам с атрибутом name
    elements.forEach(element => {
        // Проверяем, содержит ли атрибут name выбранное значение
        if (element.name.includes(selectedValue)) {
            element.style.display = 'inline'; // Показываем элемент
        } else {
            element.style.display = 'none'; // Скрываем элемент
        }
    });
}

// Добавляем обработчик события изменения выбора
selectElement.addEventListener('change', updateVisibility);

// Вызываем функцию при загрузке страницы для инициализации состояния
updateVisibility();