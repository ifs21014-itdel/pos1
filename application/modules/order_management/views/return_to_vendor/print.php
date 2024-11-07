
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
                <td align="center"><span style="font-size: 18px; font-weight: bold">RETURN TO VENDOR</span><br /></td>
            </tr>
            <tr>
                    <table width="100%" border=0>
                        <tr>
                            <td width=50%>
                                <table width="100%" border=0>
                                    <tr>
                                        <td width="25%"><strong>REF NO.</strong></td>
                                        <td width="1%">:</td>
                                        <td width="74%"><?php echo $rtv->reference ?></td>
                                    </tr>
                                    <tr>
                                        <td width="25%" valign="top">Vendor</td>
                                        <td width="1%" valign="top">:</td>
                                        <td width="74%"><?php echo $rtv->vendor_name ?></td>
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
                                <th width="11%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Kode Barang</th>
                                <th width="30%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Nama Barang</th>
                                <th width="5%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Satuan</th>
                                <th width="10%" style="border: 1px solid; font-weight: bold;"
                                    align="center">Quantity</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 10;
                            $counter = 1;
//                             print_r($item);
                            foreach ($item as $result) {
                                ?>
                                <tr>
                                    <td style="border-left: 1px #000 solid; border-right: 1px solid;"><?php echo $counter++; ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;"><?php echo $result->item_code ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;"><?php echo $result->item_name ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="center"><?php echo $result->unit_code ?>&nbsp;</td>
                                    <td style="border-right: 1px #000 solid;" align="right"><?php echo $result->quantity ?>&nbsp;</td>
                                </tr>
                                <?php
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
					<br /><br />
                </td>
            </tr>
        </table>
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td width="25%" align="left">Diajukan Oleh: <br /> <br /> <br /> <br />
                    <hr
                        style="width: 100px; float: left; border: 1px solid #000; padding: 0px;" />
                    <br /> Date :
                </td>
                <td width="25%" align="left">Diketahui Oleh: <br /> <br /> <br /> <br />
                    <hr
                        style="width: 100px; float: left; border: 1px solid #000; padding: 0px;" />
                    <br /> Date :
                </td>
                <td width="25%" align="left">Disetujui Oleh: <br /> <br /> <br /> <br />
                    <hr
                        style="width: 100px; float: left; border: 1px solid #000; padding: 0px;" />
                    <br /> Date :
                </td>
                <td width="50%" align="left">Diterima Oleh: <br /> <br /> <br /> <br />
                    <hr
                        style="width: 100px; float: left; border: 1px solid #000; padding: 0px;" />
                    <br /> Date :
                </td>
            </tr>
        </table>
    </body>
</html>
