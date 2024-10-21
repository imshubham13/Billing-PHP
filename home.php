<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
</head>

<body>
    <h1>Billing System</h1>
    <br>
    <?php
    include('conn.php');

    $burgerPrice = 0;
    $burgerQty = 0;
    $pizzaPrice = 0;
    $pizzaQty = 0;
    $total = 0;

    $sql = "select pName,pPrice,pQty from product where pName IN('Burger','Pizza')";

    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['pName'] == 'Burger') {
                $burgerPrice = $row['pPrice'];
                $burgerQty = $row['pQty'];
            }
            if ($row['pName'] == 'Pizza') {
                $pizzaPrice = $row['pPrice'];
                $pizzaQty = $row['pQty'];
            }
        }
    } else {
        echo "No Product Found";
    }

    if (isset($_POST['burgerPlus'])) {
        $burgerQty++;
        $conn->query("UPDATE product set pQty= $burgerQty where pName='Burger'");
    }

    if (isset($_POST['burgerMinus'])) {
        $burgerQty--;
        $conn->query("UPDATE product set pQty= $burgerQty where pName='Burger'");
    }

    if (isset($_POST['pizzaPlus'])) {
        $pizzaQty++;
        $conn->query("UPDATE product set pQty= $pizzaQty where pName='Pizza'");
    }

    if (isset($_POST['pizzaMinus'])) {
        $pizzaQty--;
        $conn->query("UPDATE product set pQty= $pizzaQty where pName='Pizza'");
    }

    // Fetch Result
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['pName'] == 'Burger') {
                $burgerQty = $row['pQty'];
            }
            if ($row['pName'] == 'Pizza') {
                $pizzaQty = $row['pQty'];
            }
        }
    }

    //Total Amount
    $totalAmount = ($burgerQty * $burgerPrice) + ($pizzaQty * $pizzaPrice);
    ?>

    <form method="post">
        <br>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>Name</th>
                <th>Qty</th>
                <!-- <th>Price</th> -->

            </tr>
            <tr>
                <td>Burger ($ <?php echo $burgerPrice; ?>)</td>
                <td>
                    <Button name="burgerMinus">-</Button>
                    <input type="number" name="$burgerQty" value="<?php echo $burgerQty ?>" min="0" readonly />
                    <Button name="burgerPlus">+</Button>
                </td>
            </tr>
            <tr>
                <td>Pizza ($ <?php echo $pizzaPrice; ?>)</td>
                <td>
                    <Button name="pizzaMinus">-</Button>
                    <input type="number" name="$pizzaQty" value="<?php echo $pizzaQty ?>" min="0" readonly />
                    <Button name="pizzaPlus">+</Button>
                </td>
            </tr>
        </table>
        <h2>Total : <?php echo $totalAmount; ?></h2>
    </form>
</body>

</html>