<table class="table">

    <tr>
      <th>Product</th><th>Description</th> <th>Status</th>
    </tr>
     @foreach ($product_include as $include_item)
   
         @php($ProductID=$include_item['ProductID'])
         @php($ProductName=$include_item['ProductName'])
         @php($Status=$include_item['Status'])
         @php($Description=$include_item['Description']) 
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
                      {{ $Status }} 
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