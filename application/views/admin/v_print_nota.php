<html>

<head>
    <title>Print kwitansi {{kwitansiNo}}</title>
    <style type="text/css">
        .lead {
            font-family: "Verdana";
            font-weight: bold;
        }

        .value {
            font-family: "Verdana";
        }

        .value-big {
            font-family: "Verdana";
            font-weight: bold;
            font-size: large;
        }

        .td {
            valign: "top";
        }

        /* @page { size: with x height */
        /*@page { size: 20cm 10cm; margin: 0px; }*/
        @page {
            size: A4;
            margin: 0px;
        }

        /*		@media print {
			  html, body {
			  	width: 210mm;
			  }
			}*/
        /*body { border: 2px solid #000000;  }*/
    </style>

</head>

<body>
    <table border="1px">
        <tr>
            <td>
                <table cellpadding="4">
                    <tr>
                        <td width="200px">
                            <div class="lead">No kwitansi:
                        </td>
                        <td>
                            <div class="value">43543534</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Telah terima dari:</div>
                        </td>
                        <td>
                            <div class="value">gdsrtstr</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Untuk Pembayaran:</div>
                        </td>
                        <td>
                            <div class="value">34534543</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Tanggal:</div>
                        </td>
                        <td>
                            <div class="value">43534543</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Rupiah:</div>
                        </td>
                        <td>
                            <div class="value-big">Rp. 35443</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Uang Sejumlah:</div>
                        </td>
                        <td>
                            <div class="value">43543 rupiah</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="lead">Kasir:</div>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>____________________________________________________</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <div class="value">ret}</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <hr>

</html>