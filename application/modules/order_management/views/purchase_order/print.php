
<html>
    <head>
        <title>Print Purchase Order</title>
        <style>
            * {
                font-size: 8pt;
                font-family: Tahoma;
            }
        </style>
    </head>
    <body>
        <table width="100%" align="center" border="0" cellpadding="0"
               cellspacing="0"">
            <tr>
                <td style="border-bottom: 1px solid black"><span
                        style="font-size: 18px; font-weight: bold">PT Bez Retailindo</span><br />
                    Komp SOHO Park No.28 Lt.4<br /> Jl. Boulevard Gading Serpong<br />
                    Tangerang 15810<br /> NPWP : 31.819.764.7-451.000<br /></td>
            </tr>
            <tr>
                <td align="center"><span style="font-size: 18px; font-weight: bold">PURCHASE
                        ORDER</span><br /></td>
            </tr>
            <tr>
                    <table width="100%" border=0>
                        <tr>
                            <td width=50% valign="top">
                                <table width="100%" border=0>
                                    <tr>
                                        <td width="25%"><strong>P.O NO</strong></td>
                                        <td width="1%">:</td>
                                        <td width="74%"><?php echo $po->reference ?></td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Date</td>
                                        <td width="1%">:</td>
                                        <td width="74%"><?php echo date("d/m/Y",  strtotime($po->tanggal)); ?></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" valign="top">Supplier</td>
                                        <td width="1%" valign="top">:</td>
                                        <td width="74%"><?php echo "<b>$po->vendor_name</b>"; ?></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" valign="top">Supplier NPWP</td>
                                        <td width="1%" valign="top">:</td>
                                        <td width="74%"><?php echo $po->vendor_npwp ?></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" valign="top">Supplier Address</td>
                                        <td width="1%" valign="top">:</td>
                                        <td width="74%"><?php echo nl2br($po->vendor_address); ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width=50% valign="top">
                                <table width="100%" border=0>
                                    <tr>
                                        <td width="25%">Expected Delivery</td>
                                        <td width="1%">:</td>
                                        <td width="74%"><?php echo date("d/m/Y",  strtotime($po->shipment_date)); ?></td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Term Of Payment</td>
                                        <td width="1%">:</td>
                                        <td width="74%"><?php echo $po->term_of_payment ?></td>
                                    </tr>
                                    <tr>
                                        <td width="25%">Currency</td>
                                        <td width="1%">:</td>
                                        <td width="74%"><?php echo $po->currency ?></td>
                                    </tr>
<!--                                    <tr>
                                        <td width="25%">PKP</td>
                                        <td width="1%">:</td>
                                        <td width="74%"><?php if($po->pkp == 'f') echo 'TIDAK'; else echo 'YA'; ?></td>
                                    </tr>-->
                                    <tr>
                                        <td width="25%" valign="top">Ship To</td>
                                        <td width="1%" valign="top">:</td>
                                        <td width="74%"><?php echo "<b>".$po->store_name."</b><BR/>".nl2br($po->store_address); ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>


                        <tr>

                    </table>

                <td>

            </tr>
            <tr>
                <td>
                    <table width="100%"
                           style="border: 1px #000 solid; border-collapse: collapse; margin-top: 15px">
                        <thead>
                            <tr>
                                <th width="1%" style="border: 1px solid; font-weight: bold;"
                                    align="center">No</th>
                                <th width="9%" style="border: 1px solid; font-weight: bold;"
                                    align="center">SKU</th>
                                <th width="14%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Barcode</th>
                                <th style="border: 1px solid; font-weight: bold;"
                                    align="center">Nama Barang</th>
                                <th width="5%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Satuan</th>
                                <th width="5%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Qty</th>
                                <th width="11%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Harga/Satuan</th>
                                <th width="11%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 5;
                            $counter = 1;
//                             print_r($item);
                            $total_price = 0;
                            foreach ($item as $result) {
                                ?>
                                <tr>
                                    <td style="border-left: 1px #000 solid; border-right: 1px solid;"><?php echo $counter++; ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;"><?php echo $result->item_code ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;"><?php echo $result->barcode ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;"><?php echo $result->item_name ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="center"><?php echo $result->unit_code ?>&nbsp;<?php if($result->unit_conversion > 1) echo "($result->unit_conversion)"; ?></td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo $result->quantity ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo number_format($result->price) ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo number_format($result->total_price) ?>&nbsp;</td>
                                </tr>
                                <?php
                                $total_price+=$result->total_price;
                                $count--;
                            }
                            if ($count > 0) {
                                for ($i = 0; $i < $count; $i++) {
                                    ?>
                                    <tr>
                                        <td style="border-left: 1px #000 solid; border-right: 1px solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                           style="padding-top: 10px;">
                        <tr>
                            <td width="66%" valign="top"></td>
                            <td width="34%" valign="top">
                                <table width="100%">
                                    <tr valign="top">
                                        <td width="100%">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="border: 1px #000 solid; border-radius: 3px;">
                                                <tr>
                                                    <td width="40%" height="25" align="right">Sub Total :</td>
                                                    <td width="60%" align="right" style="padding: 2px;"><b><?php echo number_format($total_price) ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td width="40%" height="25" align="right">Discount :</td>
                                                    <td width="60%" align="right" style="padding: 2px;"><b><?php $discount = $po->discount*$total_price/100; echo number_format($discount); ?></b></td>
                                                </tr>
                                                <tr>
                                                    <td width="40%" height="25" align="right">PPN (10%) :</td>
                                                    <td width="60%" align="right" style="padding: 2px;"><b><?php $ppn=0; if($po->pkp == 't') $ppn = ($total_price-$discount)*10/100;  echo number_format($ppn); ?></b></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="100%">
                                            <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                                   style="border: 1px #000 solid; border-radius: 3px;">
                                                <tr>
                                                    <td width="40%" height="30" align="right"
                                                        style="font-weight: bold;">Grand Total :</td>
                                                    <td width="60%" style="font-weight: bold; padding: 2px;"
                                                        align="right"><b><?php echo number_format($total_price - $discount + $ppn); ?></b></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                </td>
            </tr>
        <br>
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td width="25%" align="left">Dibuat Oleh: <br /><br /> <br /> <br /> <br />
                    <hr
                        style="width: 100px; float: left; border: 1px solid #000; padding: 0px;" />
                    <br /> MD Administrator
                </td>
                <td width="25%" align="left">Diketahui Oleh: <br /><br /> <br /> <br /> <br />
                    <hr
                        style="width: 100px; float: left; border: 1px solid #000; padding: 0px;" />
                    <br /> Category Manager
                </td>
                <td width="25%" align="left">Disetujui Oleh: <br /><br /> <br /> <br /> <br />
                    <hr
                        style="width: 100px; float: left; border: 1px solid #000; padding: 0px;" />
                    <br /> MD Manager
                </td>
            </tr>
        </table>
    </body>
</html>
