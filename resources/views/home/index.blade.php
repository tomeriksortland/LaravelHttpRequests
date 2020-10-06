<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('index') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('customers.index') }}">Customers</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('products.index') }}">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
              </li>
          </ul>
    </div>
</body>
</html>