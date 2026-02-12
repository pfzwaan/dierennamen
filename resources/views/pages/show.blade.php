<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;500;600;700&family=Onest:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-white text-slate-900">
    @include('pages.header')

    <main>
        @if(empty($page->content))
            <h1 class="mb-8 text-3xl font-bold md:text-4xl">{{ $page->title }}</h1>
        @endif

        @foreach(($page->content ?? []) as $block)
            @php($type = \Illuminate\Support\Str::of($block['type'] ?? '')->replaceMatches('/[^a-z0-9_-]/i', '')->value())
            @php($data = $block['data'] ?? [])

            @if($type !== '')
                @includeIf('pages.blocks.' . $type, ['data' => $data, 'block' => $block, 'page' => $page])
            @endif
        @endforeach
    </main>

    @include('pages.footer')
</body>
</html>
