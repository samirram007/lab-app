 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title">{{$info['title']}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="{{ route('save-service')}}">
          @csrf  
 
        <div class="modal-body bg-light">
          <div class="form-group">
            <label for="CustomerID">Customer</label>
            <select class="form-control" name="CustomerID" id="CustomerID">
              <option value="">Select Customer</option>
              @foreach ($customer as $cust)
              <option value="{{$cust['UserID']}}"  data-id="{{$cust['UserID']}}"
               {{ $CustomerID==$cust['UserID'] ? 'selected':''}}>
                {{$cust['Name'] }}
              </option>
              @endforeach
            </select>
            
          </div>

          <div class="form-group">
            <label for="ProductID">Product</label>
            <select class="form-control" name="ProductID" id="ProductID">
              <option value="">Select Product</option>
              @foreach ($product as $item)
              <option value="{{$item['MasterID']}}" data-price="{{$item['Price']}}"
              {{ $ProductID==$item['MasterID'] ? 'selected':''}}>{{$item['Name'] }}</option>
              
             @endforeach
            </select>
            
          </div>
          <div class="form-group">
            <label for="Description">Description</label>
            <textarea class="form-control" id="Description" name="Description" rows="3">{{ $Description }}</textarea>
          </div>
            <div class="form-group">
              <label for="Price">Price/ Charges</label>
              <input type="text" class="form-control" name="Price" id="Price" placeholder="Price" value="{{ $Amount }}">
            </div>
             <div class="form-group">
              <label for="Status">Status</label>
             
              
              <select class="form-control" name="Status" id="Status">
                <option value="">Select Status</option>
                @foreach ($status as $stat)
                <option value="{{$stat['Status']}}"  data-id="{{$stat['Status']}}"
                 {{ $Status==$stat['Status'] ? 'selected':''}}>
                  {{$stat['Status'] }}
                </option>
                @endforeach
              </select>
            </div>
         </div>
        <div class="modal-footer justify-content-between">
          <input type="hidden" class="form-control" name="ServiceID" id="ServiceID"  value="{{ $ServiceID }}">
          {{-- <input type="hidden" class="form-control" name="CustomerID" id="CustomerID"  value="{{ $CustomerID }}"> --}}
          {{-- <input type="hidden" class="form-control" name="CustomerID" id="CustomerID"  value="{{ $CustomerID }}"> --}}
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-light">Save changes</button>
        </div> 
      </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <script>
     // $(document).on("change", "#ProductID", function() {
$("#ProductID" ).change(function() {
  var Price=$("#ProductID option:selected").data('price');
  $("#Price").val(Price);
});
$("#CustomerID" ).change(function() {
  var UserID=$("#CustomerID option:selected").data('id');
  $("#Description").append(UserID);
});

    </script>
    <!-- /.modal-dialog -->
  {{-- </div> --}}
 
 
  
