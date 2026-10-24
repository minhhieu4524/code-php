<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create post</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<body>

<div class="container" style="margin-top: 30px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <!-- Tiêu đề lớn của trang -->
            <h2>Create post</h2>

            <!-- Hiển thị dòng thông báo lỗi in đậm giống trên slide khi bị thiếu dữ liệu -->
            @if(!empty(session('message')))
                <h3 class="text-danger" style="font-weight: bold; margin-bottom: 20px;">
                    {{ session('message') }}
                </h3>
            @endif

            <form action="/add-to-cart" method="POST">
                @csrf

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" class="form-control" name="slug" value="{{ old('slug') }}" />
                </div>

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" />
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea rows="5" class="form-control" name="description">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <p><span class="text-danger">*</span> - required fields</p>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Create
                    </button>
                    <button type="button" class="btn btn-default">
                        Cancel
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

</body>
</html>