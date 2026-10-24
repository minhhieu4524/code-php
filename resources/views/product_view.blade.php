<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin bài viết</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2 class="text-success">THÔNG TIN BÀI VIẾT VỪA NHẬP</h2>
            <hr>
            
            <h3>Title: {{ session('title') }}</h3>
            <h3>Slug: <code>{{ session('slug') }}</code></h3>
            <p><strong>Description:</strong></p>
            <p class="well">{{ session('description') }}</p>

            <a href="/" class="btn btn-default">Quay lại nhập tiếp</a>
        </div>
    </div>
</div>

</body>
</html>