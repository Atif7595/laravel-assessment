@include('layouts.admin.head')
@include('layouts.admin.header')
<style>
   .invalid-feedback{
   display: block !important;
   }
</style>
<!--  Header End -->
<div class="container-fluid">
   <div class="container-fluid">
      <div class="card">
         <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Product</h5>
            <div class="card">
               <div class="card-body">
                  <form action="{{ route('product.Update',$product->id) }}" method="POST" enctype="multipart/form-data">
                     @csrf
                     <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="price" class="form-label">price</label>
                        <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}">
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" class="form-control" id="description" name="description"> {{ $product->description }}</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="quantity" class="form-label">quantity</label>
                        <input type="text" class="form-control" id="quantity" name="quantity" value="{{ $product->quantity }}"
                           >
                        @error('quantity')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image"
                           >
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="mb-3">
                        <label for="status" class="form-label">status</label>
                        <select id="disabledSelect" name="status" class="form-select">
                        <option value="active" @selected($product->status=='active')>Active</option>
                        <option value="inactive" @selected($product->status=='inactive')>Inactive</option>
                        </select>
                     </div>
                     <button type="submit" class="btn btn-primary">Update</button>
                  </form>
               </div>
            </div>
         </div>
         <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Prices Assigned To Clients</h5>
            <div class="card">
               <div class="card-body">

                    @foreach ($product->specialPrices as  $price)


                     <div class="mb-3">
                        <label for="name" class="form-label">client Name: </label>
                        <label for="name" class="form-label">{{ $price->name }}</label>

                        <input type="text" class="form-control" id="price" name="prices[]" value="{{ $price->pivot->special_price }}" readonly>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     @endforeach


                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
