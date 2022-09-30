<section class="content-header">
    <h1>
        Stock Movement Part
        {{-- <small>it all starts here</small> --}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="#">Inventory</a></li>
        <li><a href="#">Stock Master</a></li>
        <li class="active"><a href="#"> Stock Movement</a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-4">
            <div class="box box-widget widget-user">
                <div class="widget-user-header bg-yellow">
                    <h3 class="widget-user-username">Stock Nomor</h3>
                    <h5 class="widget-user-desc">Name</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>
                            <a href="#"> Branch <span class="pull-right badge bg-blue">Total</span></a>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-sm-3 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ $stock_detail->stock_movement()->where([['order_qty','>', 0],['status','=', 0]])->sum('order_qty') - 0 }}</h5>
                                <span class="description-text">Order</span>
                            </div>
                        </div>
                        <div class="col-sm-3 border-right">
                            <div class="description-block">
                                <h5 class="description-header">{{ $stock_detail->stock_movement()->where([['sell_qty','>', 0],['status','=', 0]])->sum('sell_qty') - 0 }}</h5>
                                <span class="description-text">Sell</span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="description-block">
                                <h5 class="description-header">{{ $stock_detail->stock_movement()->where([['in_qty','>', 0],['status','=', 0]])->sum('in_qty') - 0 }}</h5>
                                <span class="description-text">In</span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="description-block">
                                <h5 class="description-header">{{ $stock_detail->stock_movement()->where([['out_qty','>', 0],['status','=', 0]])->sum('out_qty') - 0 }}</h5>
                                <span class="description-text">Out</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">Detail Price</h3>
                </div>
                <div class="box-body">
                    <table class="table table-condensed">
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 300px">Keterangan</th>
                            <th>Harga</th>
                        </tr>
                        <tr>
                            <td>1.</td>
                            <td>Harga Jual</td>
                            <td>RP 12000</td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Harga rata-rata jual</td>
                            <td>RP 10000</td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Max. Stock</td>
                            <td> 10 </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Min. Stock</td>
                            <td>10</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">History Stock Movement</h3>
                </div>
                <div class="box-body">
                    <table class="table table-bordered table-striped"  id="stockMasterTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Type</th>
                                <th>Document</th>
                                <th>Tanggal</th>
                                <th>Order</th>
                                <th>Sell</th>
                                <th>In</th>
                                <th>Out</th>
                                <th>Status</th>
                                <!-- <th>Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
