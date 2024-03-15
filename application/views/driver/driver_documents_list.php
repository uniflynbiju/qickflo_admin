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
            max-height: 200px; /* Define the maximum height for the images */
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
                                <h4>Driver Company Details</h4>
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
                                          
                                            <?php if (!empty($documents_details) && (is_array($documents_details) || is_object($documents_details))): ?>
                                                <?php foreach ($documents_details as $key => $value): ?>
                                                    <tr>
                                                        <td><?php echo $key; ?></td>
                                                        <td>
                                                            <?php if (filter_var($value, FILTER_VALIDATE_URL)): ?>
                                                                <div class="image-container">
                                                                    <img src="<?php echo $value; ?>" alt="Image">
                                                                </div>
                                                            <?php else: ?>
                                                                <?php echo !empty($value) ? $value : '-'; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="2">No data available</td>
                                                </tr>
                                            <?php endif; ?>
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
