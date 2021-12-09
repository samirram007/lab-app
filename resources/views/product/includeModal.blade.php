 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
      <div class="modal-content bg-secondary">
        <div class="modal-header">
          <h4 class="modal-title">{{$info['title']}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
       
        <div class="modal-body bg-light">
           <form method="post" action="{{ route('save-product')}}">
                @csrf  
                {{-- <div class="input-group mb-3">
                  <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">@example.com</span>
                  </div>
                </div> --}}
                  <div class="form-group ">
                    <div class="input-group mb-3">
                    <label for="IncludeProductID">Product</label>
                    <select class="form-control" name="IncludeProductID" id="IncludeProductID">
                      <option value="">Select Product</option>
                      @foreach ($product as $item)
                      <option value="{{$item['MasterID']}}" data-price="{{$item['Price']}}" >{{$item['Name'] }}</option>
                      
                    @endforeach
                    </select>
                    <div class="input-group-append">
                    <input type="hidden" class="form-control" name="MasterID" id="MasterID"  value="{{ $MasterID }}">
                    <input type="hidden" class="form-control" name="MasterType" id="MasterType"  value="{{ $MasterType }}">
                    <button type="button" data-url="{{ route('save_includeproduct') }}" id="IncludeProduct" class="btn btn-primary">Add as include</button>
                  </div>
                  </div>
                </div>
                      
            </form> 
<div id="include_list">
 @foreach ($product_include as $include_item)
            <li>{{ $include_item['ProductName']}}
            
                
            @endforeach
</div>
           
         
        </div>
        <div class="modal-footer justify-content-between">
         
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          
        </div> 
     
      <div>
     

      </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  {{-- </div> --}}
 
 
  
