<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website E-commerce</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        section {
            margin: 20px;
        }

        h3, h4 {
            color: #333;
        }

        .actor-list {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .actor-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin: 10px;
            padding: 15px;
            width: 300px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        <h1>Website E-commerce</h1>
    </header>

    <section>
        <h3>I. Khái quát công cụ, ngôn ngữ sử dụng</h3>
        <p>Ngôn ngữ lập trình: PHP</p>
        <p>Framework: Laravel</p>
        <p>Model: MVC</p>
    </section>

    <section>
        <h3>II. Danh sách Actors</h3>

        <div class="actor-list">
            <div class="actor-card">
                <h4>1. Khách hàng</h4>
                <ul>
                    <li>Đăng nhập (Google)</li>
                    <li>Đăng kí</li>
                    <li>Đặt lại mật khẩu</li>
                    <li>Xem thông tin sản phẩm</li>
                    <li>Xem danh mục sản phẩm</li>
                    <li>Thêm sản phẩm vào giỏ hàng</li>
                    <li>Đặt hàng</li>
                    <li>Thanh toán bằng Momo</li>
                </ul>
            </div>

            <div class="actor-card">
                <h4>2. Admin</h4>
                <ul>
                    <li>Đăng nhập</li>
                    <li>Xem thông tin đơn hàng</li>
                    <li>Thêm sản phẩm</li>
                    <li>Cập nhật sản phẩm</li>
                    <li>Xóa sản phẩm</li>
                </ul>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Website E-commerce. All rights reserved.</p>
    </footer>

</body>
</html>
