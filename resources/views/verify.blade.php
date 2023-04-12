<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Проверка на робота</title>

    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>
    <h1>Проверка на робота</h1>
    <div id="captcha-container" class="smart-captcha"
         style="height: 100px; max-width: 400px; width: 100%;"
         id="captcha-container"
         class="smart-captcha"
         data-sitekey="ysc1_Bl5LTVdDZjTf3YCR7l7fF1Ly9lazj66Sb7f725DM51ed7c0f"
         data-hl="ru"
         data-callback="yandex_captcha"
    >
    </div>
</body>
<script>

    async function yandex_captcha() {
        let smart_token = document.querySelector('input[name="smart-token"]').value;
        const body = {
            'token': smart_token,
        }
        const response = await fetch('/api/verify', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json;charset=utf-8'
            },
            body: JSON.stringify(body),
        });

        const result = await response.json();

        window.location.href = '/';
    }

</script>
</html>
