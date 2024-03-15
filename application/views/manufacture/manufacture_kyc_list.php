<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner Page</title>
    <style>
    .action {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
    .image-container img {
        max-height: 200px;
        /* Define the maximum height for the images */
    }
    </style>
</head>
<body>
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="margin-top: 39px;margin-left: 25px;margin-right: 25px;">
                            <div class="card-header">
                                <h4>Partner Page</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>KEY</th>
                                                <th>VALUE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($kyc_details as $key => $value): ?>
                                            <tr>
                                                <td><?php echo isset($key) ? $key : '-'; ?></td>
                                                <td>
                                                        <?php
                                                        if (!empty($value)) {
                                                            if ($key === 'AadhaarProfile') {
                                                                // If the key is 'AadhaarProfile'
                                                                echo '<div class="image-container"><img src="data:image/jpeg;base64,'.base64_encode(base64_decode($value)).'" alt="Aadhaar Profile Image"></div>';
                                                            } else if (filter_var($value, FILTER_VALIDATE_URL)) {
                                                                // If $value is a valid URL
                                                                echo '<div class="image-container"><img src="'.$value.'" alt="Image"></div>';
                                                            } else {
                                                                // If $value is not a valid URL
                                                                echo $value;
                                                            }
                                                        } else {
                                                            // If $value is empty
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>