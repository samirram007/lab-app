 
  {{-- <div class="modal fade" id="modalAddProduct"> --}}
  
    <div class="modal-dialog {{ 'modal-'.$info['size']}}  ">
        <div class="modal-content bg-secondary">
          <div class="modal-header">
            <h4 class="modal-title">{{$info['title']}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="post" action="{{ route('save-bookingdetails')}}">
            @csrf  
   
          <div class="modal-body bg-light">
            
            
              <div class="form-group">
                <label for="Code">Code</label>
                <input type="text" class="form-control" name="Code" id="Code" placeholder="" value="{{ $Code }}">
              </div>
              <div class="form-group">
                <label for="TestDate">TestDate</label>
                <input type="text" class="form-control" name="TestDate" id="TestDate" placeholder="TestDate" value="{{ $TestDate }}">
              </div>
              <div class="form-group">
                <label for="BookingDetailsID">BookingDetailsID</label>
                <input type="text" class="form-control" name="BookingDetailsID" id="BookingDetailsID" placeholder="BookingDetailsID" value="{{ $BookingDetailsID }}">
              </div>
              <div class="form-group">
                <label for="BookingID">BookingID</label>
                <input type="text" class="form-control" name="BookingID" id="BookingID" placeholder="BookingID" value="{{ $BookingID }}">
              </div>
              <div class="form-group">
                <label for="ReportDate">ReportDate</label>
                <input type="text" class="form-control" name="ReportDate" id="ReportDate" placeholder="ReportDate" value="{{ $ReportDate }}">
              </div>
              <div class="form-group">
                <label for="TestPackageID">TestPackageID</label>
                <input type="text" class="form-control" name="TestPackageID" id="TestPackageID" placeholder="TestPackageID" value="{{ $TestPackageID }}">
              </div>
              <div class="form-group">
                <label for="TestID">TestID</label>
                <input type="text" class="form-control" name="TestID" id="TestID" placeholder="TestID" value="{{ $TestID }}">
              </div>
              <div class="form-group">
                <label for="UnitValue">UnitValue</label>
                <input type="text" class="form-control" name="UnitValue" id="UnitValue" placeholder="UnitValue" value="{{ $UnitValue }}">
              </div>
              <div class="form-group">
                <label for="Quantity">Quantity</label>
                <input type="text" class="form-control" name="Quantity" id="Quantity" placeholder="Quantity" value="{{ $Quantity }}">
              </div>
              <div class="form-group">
                <label for="Discount">Discount</label>
                <input type="text" class="form-control" name="Discount" id="Discount" placeholder="Discount" value="{{ $Discount }}">
              </div>
              <div class="form-group">
                <label for="Amount">Amount</label>
                <input type="text" class="form-control" name="Amount" id="Amount" placeholder="Amount" value="{{ $Amount }}">
              </div>
              <div class="form-group">
                <label for="Status">Status</label>
                <input type="text" class="form-control" name="Status" id="Status" placeholder="Status" value="{{ $Status }}">
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
   
   
    
  
