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
    <style>
      .mb-10{
        margin-bottom: 10px;
      }
      .total-price-container{

      }
      .total-price{
        display: table;
        margin: 0 auto;
      }
    </style>

    <style>
      .modal-transparent .modal-content{
        background-color: transparent;
        border:none;
        box-shadow: none;
      }
    </style>
    <style>
    @import url(http://fonts.googleapis.com/css?family=Roboto);

/****** LOGIN MODAL ******/
.loginmodal-container {
  padding: 30px;
  max-width: 350px;
  width: 100% !important;
  background-color: #F7F7F7;
  margin: 0 auto;
  border-radius: 2px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
  overflow: hidden;
  font-family: roboto;
}

.loginmodal-container h1 {
  text-align: center;
  font-size: 1.8em;
  font-family: roboto;
}

.loginmodal-container input[type=submit] {
  width: 100%;
  display: block;
  margin-bottom: 10px;
  position: relative;
}

.loginmodal-container input[type=text], input[type=password] {
  height: 44px;
  font-size: 16px;
  width: 100%;
  margin-bottom: 10px;
  -webkit-appearance: none;
  background: #fff;
  border: 1px solid #d9d9d9;
  border-top: 1px solid #c0c0c0;
  /* border-radius: 2px; */
  padding: 0 8px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.loginmodal-container input[type=text]:hover, input[type=password]:hover {
  border: 1px solid #b9b9b9;
  border-top: 1px solid #a0a0a0;
  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
}

.loginmodal {
  text-align: center;
  font-size: 14px;
  font-family: 'Arial', sans-serif;
  font-weight: 700;
  height: 36px;
  padding: 0 8px;
/* border-radius: 3px; */
/* -webkit-user-select: none;
  user-select: none; */
}

.loginmodal-submit {
  /* border: 1px solid #3079ed; */
  border: 0px;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.1);
  background-color: #4d90fe;
  padding: 17px 0px;
  font-family: roboto;
  font-size: 14px;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
}

.loginmodal-submit:hover {
  /* border: 1px solid #2f5bb7; */
  border: 0px;
  text-shadow: 0 1px rgba(0,0,0,0.3);
  background-color: #357ae8;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
}

.loginmodal-container a {
  text-decoration: none;
  color: #666;
  font-weight: 400;
  text-align: center;
  display: inline-block;
  opacity: 0.6;
  transition: opacity ease 0.5s;
}

.login-help{
  font-size: 12px;
}
</style>

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
              <table class="table table-condensed table-bordered table-striped" bind-table="isListenerActive" selected-index="selectedItemIndex" bind-id="'order'">
                <tr>
                  <th>No</th>
                  <th data-title="'Nama Barang'"> Nama Barang</th>
                  <th data-title="'Satuan'">Satuan</th>
                  <th data-title="'Harga Jual'">Harga Jual</th>
                  <th data-title="'Quantity'">Quantity</th>
                  <th data-title="'Discount'">Discount</th>
                  <th data-title="'Amound (+ Discount)'">Total</th>
                </tr>

                <tbody>
                  <tr ng-repeat="item in order.items" bind-row="item" bind-id="'order'">
                    <td>{{$index + 1}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.uom}}</td>
                    <td>{{item.price}}</td>
                    <td>{{item.quantity}}</td>
                    <td>{{item.discount}}</td>
                    <td>{{item.totalPrice}}</td>
                  </tr>
                </tbody>

              </table>
              </div>
            </div>
            <div class="col-md-4 payment-detail">
              <header>
                <span><i class="icon icon-basket"></i></span>
                <h2>Payment Detail</h2>
              </header>

              <div class="payment-detail-price">
                <div class="row">
                  <div class="col-md-12 item">
                    <div class="col-md-6 title">Subtotal</div>
                    <div class="col-md-6 detail">150000</div>
                  </div>

                  <div class="col-md-12 item">
                    <div class="col-md-6 title">Discount</div>
                    <div class="col-md-6 detail">50000</div>
                  </div>

                  <div class="col-md-12 item total">
                    <div class="col-md-6 title"></div>
                    <div class="col-md-6 detail">100000</div>
                  </div>
                </div>
              </div>
              <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
                <a href="#" class="btn btn-default" role="button">Pay</a>
                <a href="#" class="btn btn-default" role="button">Print</a>
              </div>
            </div>
          </div>
        </div>


        <div class="cashier-container customer">
          <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4 detail">
              <header>
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


          <!-- <div class="row" ng-controller="oderController">
            <div class="col-md-12">
              <table class="table table-condensed table-bordered table-striped" bind-table="isListenerActive" selected-index="selectedItemIndex" bind-id="'order'">
                <tr>
                  <th>#</th>
                  <th data-title="'Nama Barang'"> Nama Barang</th>
                  <th data-title="'Satuan'">Satuan</th>
                  <th data-title="'Harga Jual'">Harga Jual</th>
                  <th data-title="'Quantity'">Quantity</th>
                  <th data-title="'Amound Total'">Amound Total</th>
                  <th data-title="'Discount'">Discount</th>
                  <th data-title="'Amound (+ Discount)'">Amound (+ Discount)</th>
                </tr>

                <tbody>
                  <tr ng-repeat="item in order.items" bind-row="item" bind-id="'order'">
                    <td>{{$index + 1}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.uom}}</td>
                    <td>{{item.price}}</td>
                    <td>{{item.quantity}}</td>
                    <td>{{item.totalPrice}}</td>
                    <td>{{item.discount}}</td>
                    <td>{{item.totalPrice}}</td>
                  </tr>

                  <tr>
                    <td><input id="searchProduct" search-product width="50" type="text" ng-model="searchProduct"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>

              </table>
            </div>

          </div> -->
        </div>
    </div>

    <script type="text/ng-template" id="customer-modal.html">
      <div class="modal-header">
          <h3 class="modal-title">Im a modal!</h3>
      </div>
      <div class="modal-body">
          <div class="row mb-10">
            <div class="col-md-8">
              <form class="form-inline">
              <div class="form-group">
                <label class="sr-only" for="seachCustomerPopup"></label>
                <div class="input-group">
                  <div class="input-group-addon">$</div>
                  <input type="text" class="form-control" id="seachCustomerPopup" ng-model="customerName">
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Search</button>
            </form>

            </div>
          </div>

          <table ng-table="defaultConfigTableParams" class="table table-condensed table-bordered table-striped">
            <tr ng-repeat="row in $data" ng-click="selectCustomer(row)">
              <td>#</td>
              <td data-title="'Name'">{{row.name}}</td>
              <td data-title="'Barcode'">{{row.barcode}}</td>
              <td data-title="'Address'">{{row.address}}</td>
              <td data-title="'Discount'">{{row.discount}}</td>
            </tr>
          </table>
      </div>
    </script>

    <script type="text/ng-template" id="search-item-modal.html">
      <div class="modal-header">
          <h3 class="modal-title">Im a modal!</h3>
      </div>
      <div class="modal-body">
          <div class="row mb-10">
            <div class="col-md-8">
              <form class="form-inline">
              <div class="form-group">
                <label class="sr-only" for="seachItemPopup"></label>
                <div class="input-group">
                  <div class="input-group-addon">$</div>
                  <input type="text" class="form-control" id="seachItemPopup" ng-model="itemName">
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Search</button>
            </form>

            </div>
          </div>

          <table ng-table="defaultConfigTableParams" class="table table-condensed table-bordered table-striped" bind-table="isProductsListenerActive" selected-index="selectedProductsIndex" bind-id="'products'">
            <tr ng-repeat="row in $data" ng-click="selectItem(row)" bind-row="row" bind-id="'products'" increase-on-add="false">
              <td>#</td>
              <td data-title="'Name Barang'">{{row.name}}</td>
              <td data-title="'Satuan'">{{row.uom}}</td>
              <td data-title="'Haga Jual'">{{row.price}}</td>
              <td data-title="'Discount (%)'">{{row.discount}}</td>
              <td data-title="'PPN (%)'">{{row.taxed}}</td>
            </tr>
          </table>
      </div>
    </script>

    <script type="text/ng-template" id="modal-pay-bill.html">
      <div class="modal-header">
          <h3 class="modal-title">Im a modal!</h3>
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
      </div>
      <div class="modal-body" style="height:400px;">
        <form class="form-horizontal">
            <div class="form-group">
              <label for="itemName" class="col-sm-3 control-label">Nama Barang</label>
              <div class="col-sm-9">
                <input type="text" fetch-customer class="form-control" id="itemName" ng-model="item.name" ng-readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label for="discountType" class="col-sm-3 control-label">Tipe Diskon</label>
              <div class="col-sm-9">
                <select type="text" class="form-control" id="discountType" ng-model="item.discountType" ng-options="option.value as option.name for option in discountOptions"></select>
              </div>
            </div>
            <div class="form-group">
              <label for="discount" class="col-sm-3 control-label">Discount</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="discount" ng-model="item.discount">
              </div>
            </div>
          </form>
      </div>
    </script>

    <script type="text/ng-template" id="modal-change-quantity.html">
      <div class="modal-header">
          <h3 class="modal-title">Change Quantity</h3>
      </div>
      <div class="modal-body" style="height:400px;">
        <form class="form-horizontal">
            <div class="form-group">
              <label for="itemName" class="col-sm-3 control-label">Nama Barang</label>
              <div class="col-sm-9">
                <input type="text" fetch-customer class="form-control" id="itemName" ng-model="item.name" ng-readonly="true">
              </div>
            </div>
            <div class="form-group">
              <label for="quantity" class="col-sm-3 control-label">Quantity</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="quantity" ng-model="item.quantity" >
              </div>
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


    <script src="<?php echo base_url() ?>js/cashier/cashier.app.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.resource.service.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.superKey.service.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.detectSuperKey.directive.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.searchProduct.directive.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.customer.directive.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.tableHotkeys.directive.js"></script>
    <script src="<?php echo base_url() ?>js/cashier/cashier.order.controller.js"></script>
  </body>
</html>