<!doctype html>
<html lang="en" class="dark">

<head>
    @include('layout._head')
</head>

<body class="bg-gray-50 dark:bg-gray-800">


    @include('layout._navbar')
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <div id="main-content"
            class="relative w-full max-w-screen-xl mx-auto h-full overflow-y-auto bg-gray-50 dark:bg-gray-900">
            <main>
                @yield('content')
            </main>     
            @include('layout._footer')  
        </div>

    </div>

    @include('layout._script')
</body>

</html>
