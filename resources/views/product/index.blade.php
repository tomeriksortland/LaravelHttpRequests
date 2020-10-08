<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/superhero/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="container">
            <ul class="nav nav-pills">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('customers.index') }}">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('products.index') }}">Products</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
                  </li>
              </ul>
        </div>

            <br>
            <br>
            <h1>Products</h1>
            <br>

        <div>
        <table class="table">
            <thead>
              <tr class="table-dark">
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Price</th>
                <th scope="col">Stock Quantity</th>
              </tr>
            </thead>
            <tbody>             
              @foreach($response as $product)
              <tr class="table-dark">
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['name'] }}</td>
                <td>{{ $product['status'] }}</td>
                <td>{{ $product['price'] }}</td>
                <td>{{ $product['stock_quantity'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table> 
        </div>
    </div>
</body>
</html>