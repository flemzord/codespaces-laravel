<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome Messages</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1>Welcome Messages</h1>
            <div class="welcome-messages">
                @if(isset($welcomes) && $welcomes->count() > 0)
                    @foreach($welcomes as $welcome)
                        <div class="message">
                            <div class="content">{{ $welcome->content }}</div>
                            <div class="timestamp">{{ $welcome->created_at->format('Y-m-d H:i:s') }}</div>
                        </div>
                    @endforeach
                @else
                    <div class="message">
                        <div class="content">No welcome messages found.</div>
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
