
<html>
    <head>
        <title>Print Cashier Sales</title>
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
                <td align="center"><span style="font-size: 18px; font-weight: bold">CASHIER REPORT</span><br /></td>
            </tr>
            <tr>
            <table width="100%" border=0>
                <tr>
                    <td width=50%>
                        <table width="100%" border=0>
                            <tr>
                                <td width="25%"><strong>TOKO</strong></td>
                                <td width="1%">:</td>
                                <td width="74%"><?php echo $store_name; ?></td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Tanggal</strong></td>
                                <td width="1%">:</td>
                                <td width="74%"><?php echo $report_date ?></td>
                            </tr>
                        </table>
                    </td>
                <tr>

            </table>

            <td>

                </tr>
            <tr>
                <td>
                    SALES SUMMARY
                    <table width="100%"
                           style="border: 1px #000 solid; border-collapse: collapse; margin-top: 15px">
   
                        <thead>
                            <tr>
                                <th width="1%" style="border: 1px solid; font-weight: bold;" align="left">No</th>
                                <th style="border: 1px solid; font-weight: bold;" align="center">CASHIER</th>
                                <th style="border: 1px solid; font-weight: bold;" align="center">CASH</th>
                                <th style="border: 1px solid; font-weight: bold;" align="center">DEBIT</th>
                                <th style="border: 1px solid; font-weight: bold;" align="center">CREDIT CARD</th>
                                <th style="border: 1px solid; font-weight: bold;" align="center">VOUCHER</th>
                                <th style="border: 1px solid; font-weight: bold;" align="center">TOTAL</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 2;
                            $counter = 1;
                            $total_sales = 0;
                            $total_sales_return = 0;
//                             print_r($item);
                            foreach ($sales as $result) {
                                ?>
                                <tr>
                                    <td style="border-left: 1px #000 solid; border-right: 1px solid;"><?php echo $counter++; ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="left"><?php echo $result->name; ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo number_format($result->cash); ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo number_format($result->debit); ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo number_format($result->credit_card); ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo number_format($result->voucher); ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo number_format($result->total); ?>&nbsp;</td>
                                </tr>
                                <?php
                                $total_sales+=$result->total;
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
                                        <td style="border-right: 1px #000 solid;" align="right">&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    <?php if(count($sales_return>0)) { ?>
                    <BR><br>SALES RETURN SUMMARY
                    <table width="100%"
                           style="border: 1px #000 solid; border-collapse: collapse; margin-top: 15px">
                            <thead>
                            <tr>
                                <th width="1%" style="border: 1px solid; font-weight: bold;" align="left">No</th>
                                <th style="border: 1px solid; font-weight: bold;" align="center">CASHIER</th>
                                <th style="border: 1px solid; font-weight: bold;" align="center">SALES RETURN</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 2;
                            $counter = 1;
//                             print_r($item);
                            foreach ($sales_return as $result) {
                                ?>
                                <tr>
                                    <td style="border-left: 1px #000 solid; border-right: 1px solid;"><?php echo $counter++; ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="left"><?php echo $result->name; ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo number_format($result->sales_return); ?>&nbsp;</td>
                                </tr>
                                <?php
                                $total_sales_return+=$result->sales_return;
                                $count--;
                            }
                            if ($count > 0) {
                                for ($i = 0; $i < $count; $i++) {
                                    ?>
                                    <tr>
                                        <td style="border-left: 1px #000 solid; border-right: 1px solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;">&nbsp;</td>
                                        <td style="border-right: 1px #000 solid;" align="right">&nbsp;</td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php } ?>
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
                                                    <td width="40%" height="25" align="right">Total :</td>
                                                    <td width="60%" align="right" style="padding: 2px;"><b><?php echo number_format($total_sales-$total_sales_return) ?></b>&nbsp;</td>
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
        </table>
    </body>
</html>
