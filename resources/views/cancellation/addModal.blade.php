 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('save-cancellation')}}">
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
                <label for="CancellationNo">CancellationNo</label>
                <input type="text" class="form-control" name="CancellationNo" id="CancellationNo" placeholder="CancellationNo" value="{{ $CancellationNo }}">
              </div>
              <div class="form-group">
                <label for="CancellationID">CancellationID</label>
                <input type="text" class="form-control" name="CancellationID" id="CancellationID" placeholder="CancellationID" value="{{ $CancellationID }}">
              </div>
              <div class="form-group">
                <label for="Amount">Amount</label>
                <input type="text" class="form-control" name="Amount" id="Amount" placeholder="Amount" value="{{ $Amount }}">
              </div>
              <div class="form-group">
                <label for="ReturnReason">ReturnReason</label>
                <input type="text" class="form-control" name="ReturnReason" id="ReturnReason" placeholder="ReturnReason" value="{{ $ReturnReason }}">
              </div>
              <div class="form-group">
                <label for="Origin">Origin</label>
                <input type="text" class="form-control" name="Origin" id="Origin" placeholder="Origin" value="{{ $Origin }}">
              </div>
              <div class="form-group">
                <label for="CancellationDate">CancellationDate</label>
                <input type="text" class="form-control" name="CancellationDate" id="CancellationDate" placeholder="CancellationDate" value="{{ $CancellationDate }}">
              </div>
              <div class="form-group">
                <label for="TestID">TestID</label>
                <input type="text" class="form-control" name="TestID" id="TestID" placeholder="TestID" value="{{ $TestID }}">
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
   
   
    
  
