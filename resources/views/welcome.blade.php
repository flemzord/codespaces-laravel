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
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                background-color: #f3f4f6;
            }
            .container {
                max-width: 800px;
                margin: 40px auto;
                padding: 20px;
            }
            .welcome-messages {
                margin-top: 20px;
            }
            .message {
                background-color: white;
                border-radius: 8px;
                padding: 20px;
                margin-bottom: 15px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            }
            h1 {
                color: #1a202c;
                margin-bottom: 30px;
            }
            .content {
                color: #4a5568;
                font-size: 1.1em;
            }
            .timestamp {
                color: #718096;
                font-size: 0.9em;
                margin-top: 10px;
            }
        </style>
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
