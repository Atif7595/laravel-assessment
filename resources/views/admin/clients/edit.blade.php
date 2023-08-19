@include('layouts.admin.head')
@include('layouts.admin.header')
<div class="container-fluid">
   <div class="card">
      <div class="card-body">
         <h5 class="card-title fw-semibold mb-4">Assign prices</h5>
         <div class="card">
            <div class="card-body">
               <div class="mb-3">
                  <label for="status" class="form-label">status</label>
                  <select  id="product-select" name="status" class="form-select">
                     @foreach ($products as  $product)
                     <option value="{{$product->id  }}">{{  $product->name }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
         </div>
         <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Price Assign to Client
            </h5>
            <div class="card">
               <form action="{{ route('assingMultiprice') }}" method="post">
                  @csrf
                  <input type="hidden" name="client_id" value="{{$client->id }}">
                  <div id="product-details"></div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   $(document).ready(function () {
       $('#product-select').on('change', function () {
           var productId = $(this).val();
           var productName = $(this).find('option:selected').text();

           // Remove any existing div for this product
           $('.product-div[data-product-id="' + productId + '"]').remove();

           // Create the div with the input field
           if (productId) {
               var existingDivs = $('.product-div');
               var divAlreadyExists = false;

               existingDivs.each(function () {
                   if ($(this).data('product-id') === productId) {
                       divAlreadyExists = true;
                       return false; // Break the loop
                   }
               });

               if (!divAlreadyExists) {
                   var divContent = `
                       <div class="product-div form-control" data-product-id="${productId}">
                           <input type="hidden" name="product_ids[]" value="${productId}">
                           <label for="prices[${productId}]">${productName}</label>
                           <input class="form-control"  type="number" step="0.01" name="prices[]" value="${parseFloat($('#base-price-' + productId).text()).toFixed(2)}">
                           <button  class="remove-product btn btn-danger" type="button">Remove</button>
                       </div>
                   `;
                   $('#product-details').append(divContent);
               }
           }
       });

       // Event delegation for dynamically added remove buttons
       $('#product-details').on('click', '.remove-product', function () {
           $(this).closest('.product-div').remove();
       });
   });




</script>
