<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
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
                    <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
                  </li>
              </ul>
        </div>
            <br>
            <br>
            <h1>Orders</h1>
            <br>
            
        <div>
        <table class="table">
            <thead>
              <tr class="table-dark">
                <th scope="col">Id</th>
                <th scope="col">Price</th>
                <th scope="col">Currency</th>
                <th scope="col">Status</th>
                <th scope="col">Customer ID</th>
              </tr>
            </thead>
            <tbody>             
              @foreach($response as $product)
              <tr class="table-dark">
                <td>{{ $product['id'] }}</td>
                <td>{{ $product['total'] }}</td>
                <td>{{ $product['currency'] }}</td>
                <td>{{ $product['status'] }}</td>
                <td>{{ $product['customer_id'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table> 
        </div>
    </div>
</body>
</html>