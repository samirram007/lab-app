 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('save-payment')}}">
            @csrf  
   
          <div class="modal-body bg-light">
            
            
              <div class="form-group">
                <label for="Code">Code</label>
                <input type="text" class="form-control" name="Code" id="Code" placeholder="" value="{{ $Code }}">
              </div>
              <div class="form-group">
                <label for="BookingID">BookingID</label>
                <input type="text" class="form-control" name="BookingID" id="BookingID" placeholder="BookingID" value="{{ $BookingID }}">
              </div>
              <div class="form-group">
                <label for="PaymentNo">PaymentNo</label>
                <input type="text" class="form-control" name="PaymentNo" id="PaymentNo" placeholder="PaymentNo" value="{{ $PaymentNo }}">
              </div>
              <div class="form-group">
                <label for="PaymentID">PaymentID</label>
                <input type="text" class="form-control" name="PaymentID" id="PaymentID" placeholder="PaymentID" value="{{ $PaymentID }}">
              </div>
              <div class="form-group">
                <label for="Amount">Amount</label>
                <input type="text" class="form-control" name="Amount" id="Amount" placeholder="Amount" value="{{ $Amount }}">
              </div>
              <div class="form-group">
                <label for="PaymentMode">PaymentMode</label>
                <input type="text" class="form-control" name="PaymentMode" id="PaymentMode" placeholder="PaymentMode" value="{{ $PaymentMode }}">
              </div>
              <div class="form-group">
                <label for="Origin">Origin</label>
                <input type="text" class="form-control" name="Origin" id="Origin" placeholder="Origin" value="{{ $Origin }}">
              </div>
              <div class="form-group">
                <label for="PaymentDate">PaymentDate</label>
                <input type="text" class="form-control" name="PaymentDate" id="PaymentDate" placeholder="PaymentDate" value="{{ $PaymentDate }}">
              </div>
              <div class="form-group">
                <label for="TransactionNo">TransactionNo</label>
                <input type="text" class="form-control" name="TransactionNo" id="TransactionNo" placeholder="TransactionNo" value="{{ $TransactionNo }}">
              </div>
                        
              
           
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" class="form-control" name="MasterID" id="MasterID"  value="{{ $MasterID }}">
            <input type="hidden" class="form-control" name="MasterType" id="MasterType"  value="{{ $MasterType }}">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-light">Save changes</button>
          </div> 
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    {{-- </div> --}}
   
   
    
  
