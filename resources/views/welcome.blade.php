<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <title> تتبع القطيع - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport " content="width=device-width, initial-scale=.8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>


</head>

<body> 
<center>
<br>
<br>
<br>
<br>
<br>


        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" >التحكم </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline"> تسجل
                        الدخول</a><br><br>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">التسجيل </a>
                    @endif
                @endauth
            </div>
        @endif

        


        
        </center>
</body>

</html>
