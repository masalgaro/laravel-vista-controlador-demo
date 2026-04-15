# Model View Controller Web Application Demo using Laravel

Made for the Topics in Software Engineering class, at EAFIT University. Following the instructions (and book) made by the professor Daniel Correa.

## Implementation

This is a standard Laravel example project, which can easily be created using [composer](https://getcomposer.org/).

You can effortlessly create this project using the command `composer create-project laravel/laravel example "12.*" --prefer.dist` (though you can switch 'example' for any name you want the project to have).

While you don't need any other tools to make this simple demo function, it is made simpler to execute and test using a web server of some kind, like XAMPP. Moving this project into the XAMPP folder (or creating it there) might require admin permission, depending on your OS.

On **Windows**, it should be enough to run CMD or MSYS as administrator.

On **Linux** you can just run this using `sudo`, or use `sudo mv path/to/project /opt/lampp/htdocs`

Then, it's as simple as running XAMPP on your OS, and going to localhost on your web browser of preference.

## Tutorial 10 stuff

Given that some files are *outside* of the main laravel project, in order to reflect their existence, I've decided to add them to this file, for documentation and evidence that I DID MY WORK!!!! (caps for dramatic purposes)

### API REST Test using GET 

```html
<!DOCTYPE html>
<html>
<head>
  <title>Laravel - API test example</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" crossorigin="anonymous"></script>
</head>
<body>

<div id="infoProducts">
  
</div>
   
<script type="text/javascript">
  $.ajax({
    type: "GET",
    dataType: "json",
    url: 'http://127.0.0.1:8000/api/v3/products',
    success: function(data){
      $('#infoProducts').html(JSON.stringify(data));
    }
  });
</script>
   
</body>
</html>
```

This is the one that's included in the tutorial by itself, using the GET HTTP method.

### API REST Test using POST

```html
<!DOCTYPE html>
<html>
<head>
  <title>Laravel - API test example</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" crossorigin="anonymous"></script>
</head>
<body>

<h2>Add a product</h2>

<div id="message"></div>

<form id="productForm">
  <div>
    <label for="name">Product name</label>
    <input type="text" id="name" placeholder="Product" required>
  </div>
  <div>
    <label for="price">Product price</label>
    <input type="number" id="price" placeholder="Product price" step="0.01" min="0" required>
  </div>
  <button type="submit">Add product</button>
</form>

<!--JavaScript stuff below-->

<script type="text/javascript">
  $('#productForm').on('submit', function(e) {
    e.preventDefault();

    const payload = {
      name: $("#name").val().trim(),
      price: parseFloat($('#price').val())
    };

    $.ajax({
      type: 'POST',
      url: 'http://127.0.0.1:8000/api/v3/products/store',
      contentType: 'application/json',
      data: JSON.stringify(payload),
      headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      success: function(data) {
        showMessage('Product "' + data.name + '" added successfully', 'success');
        $('#productForm')[0].reset();
      },
      error: function(xhr) {
        const err = xhr.responseJSON;
        const msg = (err && err.message) ? err.message : 'Oops. Unexpected error.';
        showMessage(msg, 'error');
      }
    });
  });

  function showMessage(text, type) {
    $('#message').removeClass('success error').addClass(type).text(text).show();

    setTimeout(() => $('#message').fadeOut(), 4000);
  }
</script>
</body>
</html>
```

The above uses the POST method to add a new entry to the products table in the database. The only kind of "flourish" or extra detail added was the message thing that just makes debugging this thing easier, since it also displays whatever Laravel error message, like if you write down the incorrect url and it tells you that the POST method isn't supported.

