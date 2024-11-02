<!DOCTYPE html>
<html>
    <head>
        <title>Simple Chat App</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="//unpkg.com/alpinejs" defer></script>

        {{--blade-formatter-disable--}}
        <style type="text/tailwindcss">
            /* resources/css/app.css */

            /* Message container styles */
            .message {
                @apply p-3 rounded-lg max-w-xs; /* Padding, border radius, and max width */
            }

            /* Sent messages */
            .message.sent {
                @apply bg-green-100 ml-auto; /* Align right and background color for sent messages */
            }

            /* Received messages */
            .message.received {
                @apply bg-gray-200 mr-auto; /* Align left and background color for received messages */
            }

            /* Timestamp styles */
            .timestamp {
                @apply text-xs text-gray-500 block mt-1; /* Styles for the timestamp */
            }

            /* Flex parent for messages */
            .flex {
                display: flex;
                margin-bottom: 0.5rem; /* Spacing between messages */
            }



        </style>
        {{--blade-formatter-enable--}}

        @yield('styles')

        <div>
            <nav class ="mb-4">
                <a href="{{route('chat.index')}}" class="link">←HOME</a>
            </nav>
        </div>

    </head>

    <body class="container mx-auto mt-10 mb-10 max-w-lg" >

        <h1 class="mb-4 text-2xl">
            @if (isset($sender) && !empty($sender->name))
                {{ $sender->name }}
            @else
                @yield('title') <!-- This will yield a title defined in a child template -->
            @endif
        </h1>

        <h2 class ="mb-4 text-2xl">@yield('receiver')</h2>


            @yield('content')
        </div>
    </body>
</html>
