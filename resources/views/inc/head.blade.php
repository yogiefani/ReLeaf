<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>{{ @$page_title ? $page_title : env('APP_NAME')  }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">