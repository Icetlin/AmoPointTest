// script.js (Подключается на любом сайте)
fetch('https://ipapi.co/json/')
    .then(r => r.json())
    .then(data => {
        const visitorData = {
            ip: data.ip,
            city: data.city,
            device: navigator.userAgent,
            url: location.href
        };

        // Отправка данных на бэкенд
        fetch('адрес серверааа/collect', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(visitorData)
        });
    });