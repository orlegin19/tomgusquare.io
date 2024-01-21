<html>
<head>
    <title>receipt</title>
    <style>
    #tabel {
        font-size: 15px;
        border-collapse: collapse;
    }

    #tabel td {
        padding-left: 5px;
        border: 1px solid black;
    }

    hr {
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
    }
    </style>
</head>
<?php 
    $user = $this->db->query("SELECT * FROM users where id = $id")->row();
	$order = $this->db->query("SELECT * FROM orders where id = $id")->row();
	$sales = $this->db->query("SELECT * FROM sales where order_id = $id")->row();
	$queue = $this->db->query("SELECT * FROM queue_list where order_id = $id")->row();
?>
<body style='font-family:tahoma; font-size:8pt;'>
    <center>
        <h1>Tomgu Square</h1>
    </center>
    <center>
        <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' vertical-align:top><span style='color:black;'>
                    <span style='font-size:12pt'>Address: Poblacion Madridejos Cebu</span></br>
                    <span style='font-size:12pt'>Queue No. &nbsp;<?php echo $queue->queue ?></span></br>
                    <span style='font-size:12pt'>Reference ID: &nbsp;<?php echo $order->ref_id ?></span></br>
                    <br>
                    <span style='font-size:12pt'>Date: &nbsp;<?php echo date("M. d, Y") ?></span></br>
                    <span style='font-size:12pt'>Cashier: <?php echo $_SESSION['firstname']?>
                        <?php echo $_SESSION['lastname'] ?></span></br>
            </td>
        </table>
        <br>
        <table cellspacing='0' cellpadding='0'
            style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>

            <tr align='center'>
                <td width='10%'>#</td>
                <td width='10%'>Item</td>
                <td width='13%'>Price</td>
                <td width='4%'>Qty</td>
                <td width='13%'>Total</td>
            <tr>
                <td colspan='5'>
                    <hr>
                </td>
            </tr>
            </tr>
            <?php 
			$i =0 ;
			$items = $this->db->query("SELECT o.*,p.name as pname FROM order_list o inner join product p on p.id = o.product_id where o.order_id = $id");
				foreach($items->result_array() as $row):
					$i++;
			?>

            <tr>
                <td>
                    <center><?php echo $i ?></center>
                </td>
                <td style='vertical-align:top'>
                    <center><?php echo ($row['pname'])?></center>
                </td>
                <td style='vertical-align:top; text-align:right; padding-right:10px'>
                    <center>
                        <?php echo number_format($row['price']) ?></center>
                </td>
                <td style='vertical-align:top; text-align:right; padding-right:10px'>
                    <center>
                        <?php echo number_format($row['qty']) ?></center>
                </td>
                <td style='text-align:right; vertical-align:top'>
                    <center><?php echo number_format($row['total_amount'],2) ?></center>
                </td>
            </tr>
            <tr>
                <?php endforeach; ?>
                <td colspan='5'>
                    <hr size="2" color="black">
                </td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Total Amount:</div>
                </td>
                <td style='text-align:center'><?php echo number_format($order->total_amount,2) ?></td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Tendered Amount:</div>
                </td>
                <td style='text-align:center'><?php echo number_format($sales->amount_tendered,2) ?></td>
            </tr>
            <tr>
                <td colspan='4'>
                    <div style='text-align:right'>Change:</div>
                </td>
                <td style='text-align:center'>
                    <?php echo number_format($sales->amount_tendered - $order->total_amount,2) ?></td>
            </tr>
        </table>
        <br>
        <br>
        <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr></br>
                <td align='center'>****** THANK YOU ******</br></td>
            </tr>
        </table>
    </center>
</body>

</html>