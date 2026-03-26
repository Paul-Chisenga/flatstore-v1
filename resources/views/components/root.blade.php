<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- CSRF token for security - added in ajax requests --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        (function () {
            // Dark mode support
            var root = document.documentElement;
            var mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');

            function setOutputMessage(message) {
                var output = document.getElementById('output');

                if (output) {
                    output.textContent = message;
                }
            }

            function applyTheme(isDark) {
                root.classList.toggle('dark', isDark);
                root.style.colorScheme = isDark ? 'dark' : 'light';
            }

            applyTheme(mediaQuery.matches);

            if (typeof mediaQuery.addEventListener === 'function') {
                mediaQuery.addEventListener('change', function (event) {
                    applyTheme(event.matches);
                });
            } else if (typeof mediaQuery.addListener === 'function') {
                mediaQuery.addListener(function (event) {
                    applyTheme(event.matches);
                });
            }

            // WebView communication
            if (window.ReactNativeWebView) {
                window.ReactNativeWebView.postMessage(JSON.stringify({
                    customValue: 'Hello from WebView!'
                }));

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', function () {
                        setOutputMessage('Sent message to React Native WebView: Hello from WebView!');
                    });
                } else {
                    setOutputMessage('Sent message to React Native WebView: Hello from WebView!');
                }
            }

        })();
    </script>

    <title>{{ $title ?? config('app.name', 'Flatstore - Find your perfect product') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    {{ $slot }}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>