<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders</title>
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
                    <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" href="{{ route('orders.index') }}">Orders</a>
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
                <th scope="col">Tax</th>
                <th scope="col">Date created</th>
              </tr>
            </thead>
            <tbody>             
              @foreach($orders as $order)
              <tr class="table-dark">
                <td>{{ $order['id'] }}</td>
                <td>{{ $order['total_price'] }}</td>
                <td>{{ $order['tax_amount'] }}</td>
                <td>{{ $order['created_at'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table> 
        </div>
        {{ $orders->links() }}
    </div>
</body>
</html>