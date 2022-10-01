<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Stock Movement Part</h1>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-warning">
                        <h3 class="widget-user-username">Stock Nomor</h3>
                        <h5 class="widget-user-desc">{{ $stock_detail->stock_no }}</h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link"> Branch <span class="float-right badge bg-primary">{{ ($stock_detail->total_in_qty()->sum('in_qty') - 0) - ($stock_detail->total_out_qty()->sum('out_qty') - 0) }}</span></a>
                            </li>
                        </ul>
                        <div class="row">
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $stock_detail->total_order_qty()->sum('order_qty') - 0 }}</h5>
                                    <span class="description-text">Order</span>
                                </div>
                            </div>
                            <div class="col-sm-3 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $stock_detail->total_sell_qty()->sum('sell_qty') - 0 }}</h5>
                                    <span class="description-text">Sell</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $stock_detail->total_in_qty()->sum('in_qty') - 0 }}</h5>
                                    <span class="description-text">In</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="description-block">
                                    <h5 class="description-header">{{ $stock_detail->total_out_qty()->sum('out_qty') - 0 }}</h5>
                                    <span class="description-text">Out</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-warning">
                        <h3 class="card-title">Detail Price</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table table-sm">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th style="width: 300px">Keterangan</th>
                                <th>Harga</th>
                            </tr>
                            <tr>
                                <td>1.</td>
                                <td>Harga Jual</td>
                                <td>{{ $stock_detail->harga_jual - 0 }}</td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Harga rata-rata jual</td>
                                <td>{{ $stock_detail->avg_jual()->avg('harga_jual') - 0 }}</td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Max. Stock</td>
                                <td>{{ $stock_detail->max_soh - 0 }}</td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Min. Stock</td>
                                <td>{{ $stock_detail->min_soh - 0 }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header with-border">
                        <h3 class="card-title">History Stock Movement</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped"  id="stockMovementTable">
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
    </div>
</section>
