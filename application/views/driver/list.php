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

    .btn {
        width: fit-content;
    }

    .hg{
        width: fit-content;
    }
    </style>
</head>

<body>
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="margin-top: 39px; margin-left: 25px; margin-right: 25px;">
                            <div class="card-header">
                                <h4>Partner List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>FullName</th>
                                                <th>MobileNumber</th>
                                                <th>Device</th>
                                                <th>PartnerCode</th>
                                                <th>PartnerId</th>
                                                <th>Type</th>
                                                <th>DOB</th>
                                                <th>LicenceNo</th>
                                                <th>DrivingLicence</th>
                                                <th>Email</th>
                                                <th>KYC</th>
                                                <th>Documents Details</th>
                                                <th>Status</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                foreach ($driver as $document) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php if (!empty($document['Image'])): ?>
                                                    <img src="<?php echo $document['Image']; ?>" alt="Image" width="100"
                                                        height="100" style="border-radius: 50%;">
                                                    <?php else: ?>
                                                    -
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo $document['FullName'] ?? '-'; ?></td>

                                                <td><?php echo isset($document['MobileNo']) ? $document['MobileNo'] : '-'; ?>
                                                </td>

                                                <td><?php echo isset($document['Device']) ? $document['Device'] : '-'; ?>
                                                </td>
                                                <td><?php echo isset($document['PartnerCode']) ? $document['PartnerCode'] : '-'; ?>
                                                <td><?php echo isset($document['PartnerId']) ? $document['PartnerId'] : '-'; ?>
                                                </td>

                                                <td><?php echo isset($document['Type']) ? $document['Type'] : '-'; ?>
                                                </td>

                                                <td><?php echo isset($document['DOB']) ? $document['DOB'] : ''; ?></td>
                                                <td><?php echo isset($document['LicenceNo']) ? $document['LicenceNo'] : ''; ?>
                                                </td>
                                                <td><?php echo isset($document['DrivingLicence']) ? $document['DrivingLicence'] : '-'; ?>
                                                </td>
                                                <td><?php echo isset($document['Email']) ? $document['Email'] : '-'; ?>
                                                </td>

                                                <td>
                                                    <?php if (!empty($document['KYC'])): ?>
                                                    <a href="<?php echo base_url().'index.php/welcome/driver_kyc_details/'.$document['_id']?>"
                                                        title="Edit" style="color:#0d6efd;">
                                                        <button type="button" class="btn btn-primary">KYC
                                                            Details</button>
                                                    </a>
                                                    <?php else: ?>
                                                    <button type="button" class="btn btn-danger">KYC Details</button>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <?php if (!empty($document['DocumentDetails'])): ?>
                                                    <a href="<?php echo base_url().'index.php/welcome/driver_documents_details/'.$document['_id']?>"
                                                        title="Edit" style="color:#0d6efd;">
                                                        <button type="button" class="btn hg btn-primary">Document
                                                            Details</button>
                                                    </a>
                                                    <?php else: ?>
                                                    <button type="button" class="btn btn-danger">Document
                                                        Details</button>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $status = isset($document['Status']) ? $document['Status'] : '';
                                                    $documentId = isset($document['_id']) ? $document['_id'] : '';
                                                    if ($status == 0) {
                                                        echo '<button type="button" class="btn btn-danger status-button" data-status="1" data-document-id="' . $documentId . '" onclick="updateStatus(this)">Deactivate</button>';
                                                    } elseif ($status == 1) {
                                                        echo '<button type="button" class="btn btn-success status-button" data-status="0" data-document-id="' . $documentId . '" onclick="updateStatus(this)">Activate</button>';
                                                    } else {
                                                        echo '<button type="button" class="btn btn-secondary status-button" data-status="0" data-document-id="' . $documentId . '" onclick="updateStatus(this)">Unknown</button>';
                                                    }
                                                    ?>
                                                </td>

                                            </tr>
                                            <?php
                                                        $i++;
                                                    }
                                                
                                            ?>
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
    <script>
    // function product_status(value, id) {
    //     $.ajax({
    //         type: "POST",
    //         cache: false,
    //         url: "<?php //echo base_url(); ?>Category/status",
    //         data: {
    //             id: id,
    //             status: value
    //         },
    //         dataType: 'json',
    //         success: function(data) {
    //             location.reload();
    //         }
    //     });
    // }
    //

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    <script>
    function updateStatus(button) {
        var newStatus = button.getAttribute('data-status') === '0' ? '1' : '0'; // Toggle status
        var documentId = button.getAttribute('data-document-id');
        // console.log(documentId);
        // Update the button attributes and text based on the new status
        button.setAttribute('data-status', newStatus);
        if (newStatus === '0') {
            button.classList.remove('btn-danger');
            button.classList.add('btn-success');
            button.textContent = 'Activate';
        } else {
            button.classList.remove('btn-success');
            button.classList.add('btn-danger');
            button.textContent = 'Deactivate';
        }
        // Send an AJAX request to update the status in the backend
        $.ajax({
            url: "<?php echo base_url('index.php/Welcome/driver_status'); ?>", // Assuming the base_url() function is properly configured
            method: 'POST',
            data: {
                document_id: documentId,
                new_status: newStatus
            },
            success: function(response) {
                console.log('Status updated successfully');
            },
            error: function(xhr, status, error) {
                console.error('Error updating status:', error);
            }
        });
    }
    </script>
</body>

</html>