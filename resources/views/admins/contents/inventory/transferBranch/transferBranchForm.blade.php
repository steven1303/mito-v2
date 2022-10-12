<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Trasfer Branch Form</h1>
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
                        <h3 class="card-title" id="formTitle">Detail Transfer Branch </h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form  role="form" id="stockMasterForm" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" id="id" name="id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nama">Transfer Number</label>
                                        <input type="text" class="form-control" id="transfer_no" name="transfer_no" placeholder="Input Stock Number" value="{{$transferBranch->transfer_no}}" readonly> 
                                        <span class="text-danger error-text stock_no_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="city">Transfer Date</label>
                                        <input type="text" id="datemask" name="date" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask="" value="{{$transferBranch->created_format}}" readonly="">
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Select Role</label>
                                        <select class="form-control"  id="branch" name="branch">
                                            @foreach ($branchs as $branch)
                                                @if($branch->id != Auth::user()->branch_id)
                                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text branch_error"></span>
                                    </div>
                                </div>
                            </div> 
                        </div>
                      <!-- /.card-body -->
      
                        <div class="card-footer">
                            @if($transferBranch->status == 'Draft' )
                                <button id="btnSave" type="button" onclick="request_adj()" class="btn btn-primary">Request</button>
                            @endif
                            <button type="button" class="btn btn-default" onclick="ajaxLoad('{{route('transfer.branch.index')}}')">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcanany
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Transfer Branch Item</h3>
                    </div>
                    <div class="card-body row">
                        <div class="col-md-1">                            
                            <button type="button" class="btn btn-outline-primary btn-block"  data-toggle="modal" data-target="#modal-input-item">Add item</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="transferBranchTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Stock Master</th>
                                <th>In</th>
                                <th>Out</th>
                                <th>Price in</th>
                                <th>Price out</th>
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

@canany(['adjustment.store', 'adjustment.update'], Auth::user())
<div class="modal fade" id="modal-input-item">
    <div class="modal-dialog modal-lg">
        <form role="form" id="AdjDetailForm" method="POST">
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
                            <label>In QTY</label>
                            <input type="text" class="form-control" id="in_qty" name="in_qty" placeholder="Input QTY">
                            <span class="text-danger error-text in_qty_error"></span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Out QTY</label>
                            <input type="text" class="form-control" id="out_qty" name="out_qty" placeholder="Input QTY">
                            <span class="text-danger error-text out_qty_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan">
                            <span class="text-danger error-text satuan_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Harga Modal</label>
                            <input type="text" class="form-control" id="harga_modal" name="harga_modal" placeholder="Input Modal">
                            <span class="text-danger error-text harga_modal_error"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Harga Jual</label>
                            <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Input Jual">
                            <span class="text-danger error-text harga_jual_error"></span>
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
@include('admins.javascript.inventory.transferBranch.transferBranchForm',['transferBranch' => $transferBranch, 'branchs', $branchs])