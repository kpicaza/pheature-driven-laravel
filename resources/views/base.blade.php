<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pheature Driven Laravel</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    @stack('stylesheets')
</head>
<body>
@stack('heading')

<div class="container-fluid">
    <div class="row flex-xl-nowrap">
        <div class="col-12 container mt-2">
            @stack('body')
        </div>
    </div>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
