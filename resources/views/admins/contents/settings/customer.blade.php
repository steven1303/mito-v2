<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Customer</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            @canany(['customer.store', 'customer.update'], Auth::user())
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title" id="formTitle">Add New Customer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form  role="form" id="customerForm" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" id="id" name="id">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="nama">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Input Name"> 
                                        <span class="text-danger error-text name_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Input City">
                                        <span class="text-danger error-text city_error"></span>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="phone">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Input Email">
                                        <span class="text-danger error-text phone_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Input Phone">
                                        <span class="text-danger error-text phone_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="phone">Telp (Optional)</label>
                                        <input type="text" class="form-control" id="telp" name="telp" placeholder="Input Telp">
                                        <span class="text-danger error-text telp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="phone">PIC (Optional)</label>
                                        <input type="text" class="form-control" id="pic" name="pic" placeholder="Input PIC">
                                        <span class="text-danger error-text pic_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="phone">KTP</label>
                                        <input type="text" class="form-control" id="ktp" name="ktp" placeholder="Input KTP Number">
                                        <span class="text-danger error-text ktp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>BOD</label>
                                        <div class="input-group date" id="bod" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" name="bod" id="bod_val" data-target="#bod" />
                                            <div class="input-group-append" data-target="#bod" data-toggle="datetimepicker">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <span class="text-danger error-text bod_error"></span>
                                    </div>
                                </div>                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address 1</label>
                                        <input type="text" class="form-control" id="address1" name="address1" placeholder="Input Address 1">
                                        <span class="text-danger error-text address1_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address">Address 2</label>
                                        <input type="text" class="form-control" id="address2" name="address2" placeholder="Input Address 2">
                                        <span class="text-danger error-text address_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="npwp">NPWP</label>
                                        <input type="text" class="form-control" id="npwp" name="npwp" placeholder="NPWP Number">
                                        <span class="text-danger error-text npwp_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Tax</label>
                                        <select name="tax" class="form-control" id="tax" >
                                            @foreach ($taxs as $tax)
                                            <option value="{{ $tax->id }}"  >{{ $tax->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    </div>
                            </div> 
                        </div>
                      <!-- /.card-body -->
      
                        <div class="card-footer">
                            <button id="btnSave" type="submit" class="btn btn-primary">Create New</button>
                            <button type="button" class="btn btn-default" onclick="cancel()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcanany
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List customer</h3>
                    </div>
                    <div class="card-body">
                        <table id="customerTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>NPWP</th>
                                <th>Phone</th>
                                <th>Piutang</th>
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
<!-- /.content -->
@include('admins.javascript.settings.customer') 