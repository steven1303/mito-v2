<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>PO Stock Form</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            @canany(['adjustment.store', 'adjustment.update'], Auth::user())
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title" id="formTitle">Detail PO Stock ({{$po_stock->status}})</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form  role="form" id="TransferBranchForm">
                        {{ csrf_field() }} {{ method_field('PATCH') }}
                        <input type="hidden" id="id" name="id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nama">Document Number</label>
                                        <input type="text" class="form-control" id="po_no" name="po_no" placeholder="Input Stock Number" value="{{$po_stock->po_no}}" readonly> 
                                        <span class="text-danger error-text stock_no_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nama">Transfer Number</label>
                                        <input type="text" class="form-control" id="spbd_no" name="spbd_no" placeholder="Input Stock Number" value="{{$po_stock->spbd_no}}" readonly> 
                                        <span class="text-danger error-text stock_no_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Vendor</label>
                                        <input type="text" class="form-control" id="vendor" name="vendor" placeholder="Input Stock Number"  readonly> 
                                        <span class="text-danger error-text vendor_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>PPN</label>
                                        <input type="text" class="form-control" id="ppn" name="ppn" value="{{config('mito.tax.name')}}" readonly> 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="city">PO Stock Date</label>
                                        <input type="text" id="datemask" name="date" class="form-control" value="{{ $po_stock->approve }}" readonly>
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                </div>
                            </div> 
                        </div>
                      <!-- /.card-body -->
      
                        <div class="card-footer">
                            @if($po_stock->status == 'Draft' )
                                <button id="btnSave" type="button" onclick="request_transfer_receipt()" class="btn btn-primary">Request</button>
                            @endif                            
                            <button type="button" class="btn btn-default" onclick="ajaxLoad('{{route('po.stock.index')}}')">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcanany
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">PO Stock Item</h3>
                    </div>
                    <div class="card-body">
                        <table id="poStockDetailTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Stock Master</th>
                                <th>QTY</th>
                                <th>Price</th>
                                <th>Disc</th>
                                <th>Satuan</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">SPBD Item</h3>
                    </div>
                    <div class="card-body">
                        <table id="spbdDetailTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Stock Master</th>
                                <th>QTY</th>
                                <th>Order</th>
                                <th>Satuan</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

@canany(['po.stock.store', 'po.stock.update'], Auth::user())
<div class="modal fade" id="modal-input-item">
    <div class="modal-dialog modal-lg">
        <form role="form" id="poStockDetailForm" method="POST">
            {{ csrf_field() }} {{ method_field('POST') }}
            <input type="hidden" id="id" name="id">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modal_title" class="modal-title">Adds Items</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>                    
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Stock No</label>
                            <select class="form-control select2" id="stock_master" name="stock_master" style="width: 100%;">
                                <option></option>
                            </select>                            
                            <span class="text-danger error-text stock_master_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>QTY</label>
                            <input type="text" class="form-control" id="qty" name="qty" placeholder="Input QTY">
                            <span class="text-danger error-text qty_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan" readonly>
                            <span class="text-danger error-text satuan_error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Input keterangan">
                            <span class="text-danger error-text keterangan_error"></span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal"  onclick="cancel()">Cancel</button>
                    <button id="button_modal" type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endcanany
<!-- /.content -->
@include('admins.javascript.ordering.poStock.poStockForm',['po_stock' => $po_stock])