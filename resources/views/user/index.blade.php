<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <title>Assignment</title>
      <link rel='stylesheet'
         href='https://fonts.googleapis.com/css2?family=Bebas+Neue&amp;family=Figtree:wght@300;600&amp;display=swap'>
      <link rel="stylesheet" href="{{ asset('assets/front/style.css') }}">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
         integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   </head>
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
         aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav mr-auto">
         </ul>
         @if (Auth::user())
         <a href="{{ route('get.Logout') }}" class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</a>
         @else
         <a href="{{ route('login') }}" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</a>
         <a href="{{ route('register') }}" class="btn btn-outline-success my-2 my-sm-0" type="submit">Register</a>
         @endif
      </div>
   </nav>
   <body>
      <!-- partial:index.partial.html -->
      <section class="articles">
         @foreach ($products as $product)
         <article>
            <div class="article-wrapper">
               <figure>
                  <img src="{{ asset('assets/productimage/'.$product->image_path ) }}" alt="" />
               </figure>
               <div class="article-body">
                  <h2>{{ $product->name }}</h2>
                  <p>
                     {{ $product->description }}
                  </p>
                  <p style="color: red">
                     @auth
                     <?php
                        // Get the user-specific price for the product using the static method in the Product model
                        $tmp = \App\Models\Product::getUserSpecificPrice($product, auth()->user()->id);
                        ?>
                     @endauth
                     @if (!empty($tmp))
                     <!-- Display the user-specific price if available -->
                     Price:{{ $tmp }}
                  </p>
                  @else
                  <!-- Display the default product price if no user-specific price is available -->
                  <p style="color: green">
                     Price:{{ $product->price }}
                  </p>
                  @endif
                  <p>
                     Quantity: {{ $product->quantity }}
                  </p>
               </div>
            </div>
         </article>
         @endforeach
      </section>
      <!-- partial -->
   </body>
</html>
