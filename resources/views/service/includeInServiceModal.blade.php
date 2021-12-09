 
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
      
                <div class="form-group">
                  {{-- <label for="IncludeProductID">Product</label> --}}
                  {{-- <select class="form-control" name="IncludeProductID" id="IncludeProductID">
                    <option value="">Select Product</option>
                    @foreach ($product as $item)
                    <option value="{{$item['MasterID']}}" data-price="{{$item['Price']}}" >{{$item['Name'] }}</option>
                    
                  @endforeach
                  </select> --}}
                  {{-- <input type="hidden" class="form-control" name="MasterID" id="MasterID"  value="{{ $MasterID }}">
                  <input type="hidden" class="form-control" name="MasterType" id="MasterType"  value="{{ $MasterType }}"> --}}
                  {{-- <button type="button" data-url="{{ route('save_includeproduct') }}" id="IncludeProduct" class="btn btn-outline-light">Add as include</button> --}}
                </div>
                      
            </form> 
<div id="include_list">
  <table class="table">

<tr>
  <th>Product</th><th>Description</th> <th>Status</th>
</tr>
 @foreach ($product_include as $include_item)
 @php($ProductID=$include_item['ProductID'])
            <tr>
              <td>{{ $include_item['ProductName']}}</td>
              <td>
                <input class="form-control" type="text" 
                id="Description{{ $ProductID  }}" 
                name="Description{{ $ProductID  }}" 
                value="{{ $include_item['Description'] }}" 
                onfocus="ChangeStatusToAction('{{ $ProductID }}');">
              </td>
              <td>
               
                <div id="StatusText{{ $ProductID  }}">
                  {{ $include_item['Status'] }}
                  {{-- {{ $ServiceID }} --}}
                </div>
                <div  id="StatusButton{{ $ProductID  }}"  style="display:none">
                  <a href="javascript:" class="btn btn-primary SaveIncludeProduct" 
                  data-url="{{ route('save_product_include_in_service') }}"
                  data-productid="{{ $ProductID  }}"
                  data-serviceid="{{ $ServiceID  }}" >Confirm</a>
                </div>
           
              </td>
              
              
             
            </tr>
            
                
            @endforeach
       </table>       
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
 
 
  
