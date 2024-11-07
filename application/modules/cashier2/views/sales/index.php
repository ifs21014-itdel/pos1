<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bezmart POS</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" media="screen" />
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap-theme.min.css') ?>" rel="stylesheet" media="screen" />

    <link href="<?php echo base_url() ?>assets/angular/ng-table/ng-table.min.css" rel="stylesheet" media="screen" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="<?php echo base_url() ?>assets/css/cashier/cashier.css" rel="stylesheet" media="screen" />

    <link href="<?php echo base_url() ?>assets/fonts/fontello/css/animation.css" rel="stylesheet" media="screen" />
    <link href="<?php echo base_url() ?>assets/fonts/fontello/css/fontello.css" rel="stylesheet" media="screen" />

    <script>
      var baseUrl = "<?php echo site_url() ?>";
    </script>
  </head>

  <body ng-app="cashierApp">

    <div class="content-wrapper" ng-controller="oderController">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="row">
                  <div class="col-md-8">
                      <div class="logo">
                        <span class="logo-lg"><b>Bezmart</b>POS</span>
                      </div>
                  </div>
                  <div class="col-md-4 product">
                    <form class="product-form">
                      <div class="input-group">
                        <input type="text" name="search-product" class="form-control" placeholder="Search..." search-product ng-model="searchProduct"  autocomplete="off">
                        <span class="input-group-btn">
                          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="icon icon-search"></i>
                          </button>
                        </span>
                      </div>
                    </form>
                  </div>
                </div>
            </nav>
        </header>

        <div class="cashier-container">
          <div class="row">
            <div class="col-md-8 order">
              <div class="table-order">
              <table class="table table-condensed table-bordered table-striped" id="table-order" sticky-header>
                <thead>
                <tr fsm-sticky-header scroll-body="#table-order" scroll-stop='50'>
                  <th>No</th>
                  <th data-title="'Nama Barang'"> Nama Barang</th>
                  <th data-title="'Satuan'">Satuan</th>
                  <th data-title="'Harga Jual'">Harga Jual</th>
                  <th data-title="'Quantity'">Quantity</th>
                  <th data-title="'Discount'">Discount</th>
                  <th data-title="'Amound (+ Discount)'">Total</th>
                </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="item in order.items" ng-class="{'selected': $index==selectedItemIndex}" auto-scroll>
                    <td ng-cloak>{{$index + 1}}</td>
                    <td ng-cloak>{{item.name}}</td>
                    <td ng-cloak>{{item.uom}}</td>
                    <td ng-cloak align="right">{{item.price | currency:'':0}}</td>
                    <td ng-cloak align="center">{{item.quantity}}</td>
                    <td ng-cloak align="right">{{item.discount | currency:'':0}}</td>
                    <td ng-cloak align="right">{{item.total | currency:'':0}}</td>
                  </tr>
                </tbody>

              </table>
              </div>
            </div>
            <div class="col-md-4 payment-detail">
              <header>
                <span><i class="icon icon-basket"></i></span>
                <h2>Detail Belanja</h2>
              </header>

              <div class="payment-detail-price">
                <div class="row">
                  <div class="col-md-12 item">
                    <div class="col-md-6 title">Subtotal</div>
                    <div class="col-md-6 detail">{{oderPrice()| currency:'':0}}</div>
                  </div>

                  <div class="col-md-12 item">
                    <div class="col-md-6 title">Discount</div>
                    <div class="col-md-6 detail">{{totalOrderDiscount()| currency:'':0}}</div>
                  </div>

                  <div class="col-md-12 item total">
                    <div class="col-md-6 title"></div>
                    <div class="col-md-6 detail">{{totalOrderPrice()| currency:'':0}}</div>
                  </div>
                </div>
              </div>
              <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                <a href="#" class="btn btn-pay-order" role="button">Pay</a>
                <a href="#" class="btn btn-pay-order" role="button">Print</a>
              </div>
              <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                <a href="#" class="btn btn-cancel-order" role="button">Cancel</a>
              </div>
            </div>
          </div>
        </div>


        <div class="cashier-container customer">
          <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4 detail">
              <header>
                <span><i class="icon  icon-user"></i></span>
                <h2>Data Pelanggan</h2>
              </header>
              <form class="form-horizontal">
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" placeholder="ID Pelanggan" fetch-customer class="form-control" id="idPelanggan" ng-model="customer.barcode">
                  </div>
                </div>
                <div class="form-group">
                  <label for="namaPelanggan" class="col-sm-3 control-label">Nama</label>
                  <div class="col-sm-9">
                    <span ng-bind="customer.name"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="alamatPelanggan" class="col-sm-3 control-label">Alamat</label>
                  <div class="col-sm-9">
                    <span ng-bind="customer.address"></span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="type" class="col-sm-3 control-label">Type</label>
                  <div class="col-sm-9">
                    <span ng-bind="customer.customertype"></span>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

    <script type="text/ng-template" id="customer-modal.html">
      <div class="modal-header">
          <h3 class="modal-title">Search Customer</h3>
          <a href="#" class="close" ng-click="$dismiss()"><i class="demo-icon icon-cancel"></i></a>
      </div>
      <div class="modal-body search-product">
          <div class="row mb-10">
            <div class="col-md-8">
              <form class="form-inline">
              <div class="form-group">
                <label class="sr-only" for="seachCustomerPopup"></label>
                <div class="input-group">
                  <input type="text" class="form-control" id="seachCustomerPopup" ng-model="customerName">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="icon icon-search"></i>
                    </button>
                  </span>
                </div>
              </div>
            </form>

            </div>
          </div>

          <table ng-table="defaultConfigTableParams" class="table table-condensed table-bordered table-striped">
            <tr ng-repeat="row in $data" ng-click="selectCustomer(row)">
              <td data-title="'#'">{{ $index + 1}}</td>
              <td data-title="'Name'">{{row.name}}</td>
              <td data-title="'Barcode'">{{row.barcode}}</td>
              <td data-title="'Address'">{{row.address}}</td>
              <td data-title="'Type'">{{row.customertype}}</td>
            </tr>
          </table>
      </div>
    </script>

    <script type="text/ng-template" id="search-item-modal.html">
      <div class="modal-header">
          <h3 class="modal-title">Search Product</h3>
          <a href="#" class="close" ng-click="$dismiss()"><i class="demo-icon icon-cancel"></i></a>
      </div>
      <div class="modal-body search-product">
          <div class="row mb-10">
            <div class="col-md-8">
              <form class="form-inline">
              <div class="form-group">
                <label class="sr-only" for="seachItemPopup"></label>
                <div class="input-group">
                  <input type="text" class="form-control" id="seachItemPopup" ng-model="itemName" placeholder="Search Product" autocomplete="off">
                  <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="icon icon-search"></i>
                    </button>
                  </span>
                </div>
              </div>
            </form>

            </div>
          </div>

          <table ng-table="defaultConfigTableParams" class="table table-condensed table-bordered table-striped" bind-table="isProductsListenerActive" selected-index="selectedProductsIndex" bind-id="'products'">
            <tr ng-repeat="row in $data" ng-click="selectItem(row)" bind-row="row" bind-id="'products'" increase-on-add="false">
              <td data-title="'#'">{{ $index + 1}}</td>
              <td data-title="'Name Barang'">{{row.name}}</td>
              <td data-title="'Satuan'">{{row.uom}}</td>
              <td data-title="'Haga Jual'" text-align="right">{{row.price | currency:'':0}}</td>
              <td data-title="'Discount (%)'" text-align="right">{{row.discount}}</td>
              <td data-title="'PPN (%)'" text-align="right">{{row.taxed}}</td>
            </tr>
          </table>
      </div>
    </script>

    <script type="text/ng-template" id="modal-pay-bill.html">
      <div class="modal-header">
          <h3 class="modal-title">Payment</h3>
          <a href="#" class="close" ng-click="$dismiss()"><i class="demo-icon icon-cancel"></i></a>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="form-group">
            <label for="intputTotalPrice" class="col-sm-2 control-label">Total Price</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="intputTotalPrice" ng-model="totalPrice" ng-disabled="true">
            </div>
          </div>
          <div class="form-group" ng-if="showCash">
            <label for="intputTotalCash" class="col-sm-2 control-label">Total Cash</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="intputTotalCash" ng-model="cash.amount">
            </div>
          </div>

          <div class="form-group" ng-if="showDebit">
            <label for="intputDebitCardNo" class="col-sm-2 control-label">Debit Card No</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="intputDebitCardNo" ng-model="debit.no">
            </div>
          </div>
          <div class="form-group"  ng-if="showDebit">
            <label for="intputDebitCardAmount" class="col-sm-2 control-label">Amount</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="intputDebitCardAmount" ng-model="debit.amount">
            </div>
          </div>
          <div class="form-group"  ng-if="showDebit">
            <label for="intputDebitCardBank" class="col-sm-2 control-label">Bank</label>
            <div class="col-sm-10">
                <select name="intputDebitCardBank" class="form-control" id="intputDebitCardBank" ng-model="debit.bank" ng-model="creditCard.bank" ng-options="debit as debit.name for debit in debitType track by debit.id">
                </select>
            </div>
          </div>

          <div class="form-group" ng-if="showCredit">
            <label for="intputCreditCardNo" class="col-sm-2 control-label">Credit Card No</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="intputCreditCardNo" ng-model="creditCard.no">
            </div>
          </div>
          <div class="form-group"  ng-if="showCredit">
            <label for="intputCreditCardAmount" class="col-sm-2 control-label">Amount</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="intputCreditCardAmount" ng-model="creditCard.amount">
            </div>
          </div>
          <div class="form-group"  ng-if="showCredit">
            <label for="intputDebitCardBank" class="col-sm-2 control-label">Bank</label>
            <div class="col-sm-10">
                <select name="intputCreditCardBank" class="form-control" id="intputCreditCardBank" ng-model="creditCard.bank" ng-options="cc as cc.name for cc in creditCardType track by cc.id">
                </select>
            </div>
          </div>

          <div class="form-group" ng-if="showVoucher">
            <label for="intputVoucherNo" class="col-sm-2 control-label">Voucher Number</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="intputVoucherNo" ng-model="voucher.no">
            </div>
          </div>
          <div class="form-group"  ng-if="showVoucher">
            <label for="intputVoucherAmount" class="col-sm-2 control-label">Amount</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="intputVoucherAmount" ng-model="voucher.amount">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-10 col-md-offset-2">
              <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                <a href="#" class="btn btn-default" role="button" ng-click="showCash=!showCash">Payment Cash [F9]</a>
                <a href="#" class="btn btn-default" role="button" ng-click="showDebit=!showDebit">Payment Debit Card [F9]</a>
                <a href="#" class="btn btn-default" role="button" ng-click="showCredit=!showCredit">Payment Credit Card [F9]</a>
                <a href="#" class="btn btn-default" role="button" ng-click="showVoucher=!showVoucher">Payment Voucher [F9]</a>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-2 col-md-7">
              <ul class="list-group">
                <li class="list-group-item">
                  Total Harga : <span>{{totalPrice}}</span>
                </li>
                <li class="list-group-item">
                  Total Payment : <span>{{totalBayar}}</span>
                </li>
                <li class="list-group-item" ng-if="showCash">
                  Kembali : <span>{{getKembalian()}}</span>
                </li>
              </ul>
            </div>
            <div class="col-sm-3">
              <button type="submit" class="btn btn-default pull-right">Print[F2]</button>
              <button type="submit" class="btn btn-default pull-right">Reset[F9]</button>
            </div>
          </div>
        </form>
      </div>
    </script>

    <script type="text/ng-template" id="modal-change-discount.html">
      <div class="modal-header">
          <h3 class="modal-title">Change Discount</h3>
          <a href="#" class="close" ng-click="$dismiss()"><i class="demo-icon icon-cancel"></i></a>
      </div>
      <div class="modal-body change-discount">
        <form>
          <div class="form-group">
            <label for="itemName" class="col-sm-3 control-label">Nama Barang</label>
            <input type="text" class="form-control" id="itemName" ng-model="item.name" ng-readonly="true">
          </div>
          <div class="form-group">
            <label for="discountType" class="col-sm-3 control-label">Tipe Diskon</label>
            <select type="text" class="form-control" id="discountType" ng-model="item.discountType" ng-options="option.value as option.name for option in discountOptions"></select>
          </div>
          <div class="form-group">
            <label for="discount" class="col-sm-3 control-label">Discount</label>
            <input type="text" focus-first class="form-control" id="discount" ng-model="item.discount">
          </div>
        </form>
      </div>
    </script>

    <script type="text/ng-template" id="modal-change-quantity.html">
      <div class="modal-header">
          <h3 class="modal-title">Change Quantity</h3>
          <a href="#" class="close" ng-click="$dismiss()"><i class="demo-icon icon-cancel"></i></a>
      </div>
      <div class="modal-body change-quantity">
        <form>
          <div class="form-group">
            <label for="itemName">Item Name</label>
            <input type="text" class="form-control" id="itemName" ng-model="item.name" ng-readonly="true">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Quantity</label>
            <input type="text" class="form-control" focus-first id="quantity" ng-model="item.quantity" >
          </div>
        </form>
      </div>
    </script>

    <script type="text/ng-template" id="modal-print-receive.html">
      <div class="modal-body" style="height:400px;">
        <iframe ng-src="{{url}}" style="border:none" width="100%" height="100%"></iframe>
      </div>
    </script>

    <script type="text/ng-template" id="modal-login.html">
      <div class="modal-body">
        <div class="loginmodal-container">
          <h1>Login to Your Account</h1><br>
          <form class="form-login" ng-submit="processLogin()">
            <input type="text" name="username" placeholder="Username" ng-model="username">
            <input type="password" name="password" placeholder="Password" ng-model="password">
            <input type="submit" name="login" class="login loginmodal-submit" value="Login">
          </form>

          <div class="login-help">
            <a href="#">Register</a> - <a href="#">Forgot Password</a>
          </div>
        </div>
      </div>
    </script>

    <script src="<?php echo base_url() ?>assets/angular/1.5.3/angular.min.js"></script>
    <script src="<?php echo base_url() ?>assets/angular/1.5.3/angular-animate.min.js"></script>
    <script src="<?php echo base_url() ?>assets/angular/1.5.3/angular-touch.min.js"></script>
    <script src="<?php echo base_url() ?>assets/angular/ng-table/ng-table.min.js"></script>
    <script src="<?php echo base_url() ?>assets/angular/angular-hotkeys.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery-2.0.3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/ui-bootstrap-tpls-1.3.3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/js/jquery.stickytableheaders.min.js"></script>

    <script src="<?php echo base_url() ?>js/cashier/cashier.app.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.resource.service.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.superKey.service.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.detectSuperKey.directive.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.searchProduct.directive.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.customer.directive.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.tableHotkeys.directive.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.order.controller.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.focusFirst.directive.js"></script>
  </body>
</html>