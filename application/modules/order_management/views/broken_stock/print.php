
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
                <td align="center"><span style="font-size: 18px; font-weight: bold">BROKEN STOCK</span><br /></td>
            </tr>
            <tr>
                    <table width="100%" border=0>
                        <tr>
                            <td width=50%>
                                <table width="100%" border=0>
                                    <tr>
                                        <td width="10%"><strong>Toko</strong></td>
                                        <td width="1%">:</td>
                                        <td width="74%"><?php echo $settings['STORE_CODE']." ".$settings['STORE_NAME'];?></td>
                                    </tr>
                                    <tr>
                                        <td width="10%"><strong>Tanggal</strong></td>
                                        <td width="1%">:</td>
                                        <td width="74%"><?php echo date("j M, Y",strtotime($start_date))?></td>
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
                                <th width="10%" style="border: 1px solid; font-weight: bold;"
                                    align="center">SKU</th>
                                <th width="10%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Barcode</th>
                                <th width="30%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Nama Barang</th>
                                <th width="5%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Satuan</th>
                                <th width="5%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Quantity</th>
                                <th width="15%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Keterangan</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 10;
                            $counter = 1;
                            $total_quantity = 0;
//                             print_r($item);
                            foreach ($item as $result) {
                                ?>
                                <tr>
                                    <td style="border-left: 1px #000 solid; border-right: 1px solid;">&nbsp<?php echo $counter++; ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="left">&nbsp<?php echo $result->sku ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;">&nbsp<?php echo $result->item_code ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;">&nbsp<?php echo $result->item_name ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="center"><?php echo $result->unit_code ?></td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo $result->quantity ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="left">&nbsp<?php echo $result->description ?>&nbsp;</td>
                                </tr>
                                <?php
                                $total_quantity+=$result->quantity;
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
                                                    <td width="60%" align="right" style="padding: 2px;"><b><?php echo number_format($total_quantity) ?></b></td>
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
