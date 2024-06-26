<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lever MC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/style.css" />
    <link rel="stylesheet" href="styles/store.css">
    <link rel="icon" type="image/png" sizes="16x16" href="img/logo/logo.png">
</head>

<body>
    <div class="d-flex p-3 bg-light-subtle">
        <div class="container user-select-none">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="m-0"><a href="index.html"
                        class="text-decoration-none text-white fw-bolder main-title">LEVERMC</a>
                </h1>
                <a href="store.html" class="text-decoration-none text-white ms-2 btn btn-md btn-secondary">
                    <h5 class="m-0 fw-bolder">Back</h5>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="alert alert-success mt-3 text-center">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $webhook_url = 'https://discord.com/api/webhooks/1237420088227794954/CaafCY2i9ukNJD_jexPyqHnI-f_EYnewKHyqk2BbYIMa9nT_4ndz5PvL6IPJsZIZw-Jn';
                $username = htmlspecialchars($_POST['username']);
                $rank = '-';
                $coins = '-';
                if (isset($_POST['rank-select']) && !empty($_POST['rank-select'])) {
                    $rank = $_POST['rank-select'];
                    $rank_txt = htmlspecialchars($rank);
                }
                if (isset($_POST['coins-select']) && !empty($_POST['coins-select'])) {
                    $coins = $_POST['coins-select'];
                    $coins_txt = htmlspecialchars($coins);
                }
                $rank_price = 0;
                $coins_price = 0;
                switch ($rank_txt) {
                    case 'Hero':
                        $rank_price = 5;
                        break;
                    case 'Legend':
                        $rank_price = 10;
                        break;
                    case 'Infinity':
                        $rank_price = 15;
                        break;
                }
                switch ($coins_txt) {
                    case '64':
                        $coins_price = 1;
                        break;
                    case '350':
                        $coins_price = 5;
                        break;
                    case '700':
                        $coins_price = 10;
                        break;
                    case '1400':
                        $coins_price = 20;
                        break;
                }
                $total_amt = $rank_price + $coins_price;
                function formatCurrency($number)
                {
                    return '$' . number_format($number, 2, '.', ',');
                }
                $total_amt_format = formatCurrency($total_amt);
                $format_message = "<@&1050615337839767672> ```Username: {$username}\nRank: {$rank_txt}\nCoins: {$coins_txt}\n\nTotal: {$total_amt_format}```";
                if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
                    $file_tmp_path = $_FILES['image']['tmp_name'];
                    $file_name = $_FILES['image']['name'];
                    $file_size = $_FILES['image']['size'];
                    $file_type = $_FILES['image']['type'];
                    $allowed_mime_types = ['image/jpeg', 'image/jpg', 'image/png'];
                    if (in_array($file_type, $allowed_mime_types)) {
                        $file_contents = file_get_contents($file_tmp_path);
                        $payload = [
                            'content' => $format_message,
                            'file' => new CURLFile($file_tmp_path, $file_type, $file_name)
                        ];
                        $ch = curl_init($webhook_url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']);
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
                        $response = curl_exec($ch);
                        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        curl_close($ch);
                        if ($response === false) {
                            echo "Error sending webhook: " . curl_error($ch) . " (HTTP Code:" . $http_code . ")";
                        } else {
                            echo "<strong>Success!</strong> transaction completed! Our staff will review your transaction and deliver to you shortly.";
                        }
                    } else {
                        echo "Invalid image type. Only JPG, PNG, and GIF are allowed.";
                    }
                } else {
                    echo "Error uploading image.";
                }
            } else {
                echo "Invalid request method.";
            }
            ?>
        </div>
    </div>
    <!-- <div class="position-relative bottom-0 store-footer-bg user-select-none">
        <p class="p-3 m-0 text-center text-xl-start text-sm-center">&copy; Copyright LEVERMC 2024. All rights reserved.</p>
    </div> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>