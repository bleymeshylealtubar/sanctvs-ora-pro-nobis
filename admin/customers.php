<?php
require '../functions/back-func.php';
require '../functions/complete-func.php';
require "../functions/theme-func.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SANCTVS: ORDINES</title>
        <link 
            rel="icon" type="image/x-icon" 
            href="<?php echo $currentTheme==='Silver Key'?
            '../assets/others/clavis-argentea.ico':'../assets/others/clavis-avrea.ico' ?>"
        >
        <link rel="stylesheet" type="text/css" href="../assets/styles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
    </head>
    <body>
        <header class="horizontal" style="<?php echo $currentTheme==='Silver Key'?'background-color: rgb(150,150,150);':''; ?>">
            <img 
                class="insigne-prodvcti"
                src="<?php echo $currentTheme==='Silver Key'?
                '../assets/others/modvs-beatvs.png':'../assets/others/modvs-sanctvs.png'; ?>"
                width="100px" height="100px"
            >
            <h3>ORDINES</h3>
            <a href="../admin/admin.php">CLIENTES</a>
        </header>
        <section class="orders" style="<?php echo $currentTheme==='Silver Key'?'background-color: rgb(200,200,200);':''; ?>">
            <div>
                <?php if (!empty($my_orders)): ?>
                    <?php foreach ($my_orders as $ord): ?>
                        <div class="ordo" style="<?php echo $currentTheme==='Silver Key'?
                            'background-color: rgb(150,150,150);':''; ?>"
                        >
                            <img 
                                src=".<?php echo htmlspecialchars($ord['_image_path_'], ENT_QUOTES, 'UTF-8'); ?>"
                                alt="<?php echo htmlspecialchars($ord['_product_name_'], ENT_QUOTES, 'UTF-8'); ?>"
                                title="<?php echo htmlspecialchars($ord['_product_name_'], ENT_QUOTES, 'UTF-8'); ?>"
                                width="150" height="200"
                            >
                            <p>
                                <strong>Total Cost</strong><br><br>
                                &#8369;<?php 
                                    echo htmlspecialchars(number_format((float)$ord['_total_cost_'], 2),ENT_QUOTES,'UTF-8'); ?> 
                                    <br>(<?php echo (int)$ord['_quantity_']; ?> + &#8369;<?php 
                                    echo htmlspecialchars(number_format((float)$ord['_shipping_'], 2), ENT_QUOTES, 'UTF-8'); 
                                ?>)
                            </p>
                            <p>
                                <strong>Complete Address</strong><br><br>
                                <?php echo htmlspecialchars($ord['_complete_address_'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p>
                                <strong>Ordered</strong><br><br>
                                <?php echo htmlspecialchars($ord['_ordered_'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p>
                                <strong>Delivery Date<br>(Weekly)</strong><br><br>
                                <?php echo htmlspecialchars($ord['_delivery_date_'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <p>
                                <strong>Payment Method</strong><br><br>
                                <?php echo htmlspecialchars($ord['_payment_method_'], ENT_QUOTES, 'UTF-8'); ?>
                            </p>
                            <?php if($ord['_status_']==='Ordered'): ?>
                                <button 
                                    type="button" class="perficereOrdinem" 
                                    data-id="<?php echo (int)$ord['_id_']; ?>" 
                                    title="Complete Order"
                                    style="<?php echo $currentTheme==='Silver Key'?'background-color: rgb(100,100,100);':''; ?>"
                                >
                                    PERFICERE ORDINEM
                                </button>
                            <?php elseif($ord['_status_']==='Cancelled'): ?>
                                <p>Cancelled</p>
                            <?php elseif($ord['_status_']==='Delivered'): ?>
                                <p>Completed</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; width: 100%;">No orders found.</p>
                <?php endif; ?>
            </div>
        </section>
        <footer style="<?php echo $currentTheme==='Silver Key'?'background-color: rgb(150,150,150);':''; ?>">
            <p>
                GLORIA PATRI, ET FILIO, ET SPIRITVI SANCTO,
                SICVT ERAT IN PRINCIPIO, ET NVNC, ET SEMPER,
                ET IN SAECVLA SAECVLORVM, AMEN.
            </p>
        </footer>
        <div id="perficereOrdinem">
            <form 
                method="post" action="../admin/customers.php?user_id=<?php echo $user_id; ?>"
                style="<?php echo $currentTheme==='Silver Key'?'background-color: rgb(150,150,150);':''; ?>"
            >
                <h1>PERFICERE ORDINEM</h1>
                <p>Confirm the delivery and payment of this order?</p>
                <input type="hidden" name="complete_order_id" id="completeOrder">
                <div class="confirmare">
                    <button 
                        type="submit" title="Confirm"
                        style="<?php echo $currentTheme==='Silver Key'?'background-color: rgb(100,100,100);':''; ?>"
                    >
                        CONFIRMARE
                    </button>
                    <button 
                        id="cancellare" type="button" title="Cancel"
                        style="<?php echo $currentTheme==='Silver Key'?'background-color: rgb(200,200,200);':''; ?>"
                    >
                        CANCELLARE
                    </button>
                </div>
            </form>
        </div>
        <div id="onvstvs">
            <div></div>
        </div>
        <script src="../scripts/complete-order.js"></script>
        <script src="../scripts/loading.js"></script>
        <script src="../scripts/ui.js"></script>
    </body>
</html>