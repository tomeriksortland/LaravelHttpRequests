<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customers</title>
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
                  <a class="nav-link active" href="{{ route('customers.index') }}">Customers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.index') }}">Orders</a>
                  </li>
              </ul>
        </div>

            <h1>Customers</h1>
            <br>
            <br>
            
        <div>
        <table class="table">
            <thead>
              <tr class="table-dark">
                <th scope="col">Id</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            <tbody>             
              @foreach($response as $customer)
              <tr class="table-dark">
                <td>{{ $customer['id'] }}</td>
                <td>{{ $customer['first_name'] }}</td>
                <td>{{ $customer['last_name'] }}</td>
                <td>{{ $customer['email'] }}</td>
                <td>{{ $customer['role'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table> 
        </div>
    </div>
</body>
</html>