<!-- Main content -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pasaran</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">

    <div class="container-fluid">
        <div class="row">
            @canany(['market.store', 'market.update'], Auth::user())
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Input Market</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form  role="form" id="marketForm" method="POST">
                        {{ csrf_field() }} {{ method_field('POST') }}
                        <input type="hidden" id="id" name="id">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Name</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama">
                            </div>
                            <div class="form-group">
                                <label for="username">Time Result 1</label>
                                <div class="input-group date" id="timepicker1" data-target-input="nearest">
                                    <input type="text" name="time1" class="form-control datetimepicker-input" data-target="#timepicker1" readonly/>
                                    <div class="input-group-append" data-target="#timepicker1" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Time Result 2</label>
                                <div class="input-group date" id="timepicker2" data-target-input="nearest">
                                    <input type="text" name="time2" class="form-control datetimepicker-input" data-target="#timepicker2" readonly/>
                                    <div class="input-group-append" data-target="#timepicker2" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Time Result 3</label>
                                <div class="input-group date" id="timepicker3" data-target-input="nearest">
                                    <input type="text" name="time3" class="form-control datetimepicker-input" data-target="#timepicker3" readonly/>
                                    <div class="input-group-append" data-target="#timepicker3" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="far fa-clock"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <!-- /.card-body -->
      
                        <div class="card-footer">
                            <button id="btnSave" type="submit" class="btn btn-primary">Create</button>
                            <button type="button" class="btn btn-default" onclick="cancel()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
            @endcanany
            @canany(['market.store', 'market.update'], Auth::user())
            <div class="col-md-8">
            @elsecanany(['market.view'], Auth::user())
            <div class="col-md-12">
            @endcanany
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Market</h3>
                    </div>
                    <div class="card-body">
                        <table id="marketTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Market Name</th>
                                <th>Time 1</th>
                                <th>Time 2</th>
                                <th>Time 3</th>
                                <th>Status</th>
                                @canany(['market.delete', 'market.update'], Auth::user())
                                <th>Action</th>
                                @endcanany
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

@include('admins.javascript.market')