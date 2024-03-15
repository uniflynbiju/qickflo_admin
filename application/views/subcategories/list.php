<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partner Page</title>
    <style>
    .action {
        /* display: flex;
        flex-direction: row;
        justify-content: space-around; */
        /* width: 200px; */
    }

    /* CSS */
    .button-31 {
        background-color: #696cff;
        border-radius: 4px;
        border-style: none;
        box-sizing: border-box;
        color: #fff;
        cursor: pointer;
        display: inline-block;
        font-family: "Farfetch Basis", "Helvetica Neue", Arial, sans-serif;
        font-size: 16px;
        font-weight: 700;
        line-height: 1.5;
        margin: 0;
        max-width: none;
        min-height: 44px;
        min-width: 10px;
        outline: none;
        overflow: hidden;
        padding: 9px 20px 8px;
        position: relative;
        text-align: center;
        text-transform: none;
        user-select: none;
        -webkit-user-select: none;
        touch-action: manipulation;
        width: fit-content;
    }

    .button-31:hover,
    .button-31:focus {
        opacity: .75;
    }
    .button-container{
        display:flex;
        justify-content: center;
    }
    .button-container a{
        margin-right:5px;
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
                                <h4>Sub Categories List</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <a href="<?php echo base_url() . 'index.php/welcome/sub_categories_add/' ?>"
                                        style="color:#0d6efd;">
                                        <button style="float: inline-end;" class=" button-31" role="button">ADD SUB
                                            CATEGORY</button>
                                    </a>

                                    <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Category Name</th>
                                                <th>Status</th>
                                                <!-- <th>Add Product</th> -->
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i = 1;
                                                foreach ($sub_categories as $sub_category) {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <?php if (!empty($sub_category['Image'])): ?>
                                                    <img src="<?php echo $sub_category['Image']; ?>" alt="Image"
                                                        width="100" height="100" style="border-radius: 50%;">
                                                    <?php else: ?>
                                                    -
                                                    <?php endif; ?>
                                                </td>
                                                <td>

                                                    <?php echo $sub_category['Name'] ?? '-'; ?>

                                                </td>

                                                <td>
                                                    <?php
                                                    // Check if $value['category_id'] is not empty
                                                    if (!empty($sub_category['CategoryId'])) {
                                                        $category_id = $sub_category['CategoryId'];

                                                        try {
                                                            // Connect to MongoDB
                                                            $mongoUri = $this->session->userdata('mongo_uri');
                                                            $mongoClient = new MongoDB\Client($mongoUri);
                                                            $database = $mongoClient->selectDatabase('QUIKFLO'); // Select your database
                                                            $collection = $database->selectCollection('Categories'); // Select your collection

                                                            // Find the category document based on the ID and project only the 'Name' field
                                                            $filter = ['_id' => new MongoDB\BSON\ObjectId($category_id)];
                                                            $options = ['projection' => ['Name' => 1]]; // Project only the 'Name' field
                                                            $document = $collection->findOne($filter, $options);

                                                            // If the document exists, echo its name
                                                            if ($document) {
                                                                echo $document['Name']; // Output the name of the category
                                                            } else {
                                                                echo '-'; // Category not found
                                                            }
                                                        } catch (MongoDB\Driver\Exception\Exception $e) {
                                                            echo "Error: " . $e->getMessage(); // Handle MongoDB exceptions
                                                        }
                                                    } else {
                                                        echo '-'; // Empty category ID
                                                    }
                                                    ?>
                                                </td>



                                                <td>
                                                    <?php
                                                    $status = isset($sub_category['Status']) ? $sub_category['Status'] : '-';
                                                    $documentId = isset($sub_category['_id']) ? $sub_category['_id'] : '-';
                                                    if ($status == 0) {
                                                        echo '<button type="button" class="btn btn-danger status-button" data-status="1" data-document-id="' . $documentId . '" onclick="updateStatus(this)">Deactivate</button>';
                                                    } elseif ($status == 1) {
                                                        echo '<button type="button" class="btn btn-success status-button" data-status="0" data-document-id="' . $documentId . '" onclick="updateStatus(this)">Activate</button>';
                                                    } else {
                                                        echo '<button type="button" class="btn btn-secondary status-button" data-status="0" data-document-id="' . $documentId . '" onclick="updateStatus(this)">Unknown</button>';
                                                    }
                                                    ?>
                                                </td>

                                                <!-- <td>
                                                    <div class="card-body">
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal" data-target="#exampleModal">ADD</button>
                                                    </div>
                                                </td> -->

                                                <td class="action">
                                                <div class="button-container">
                                                        <a href="<?php echo base_url() . 'index.php/welcome/sub_categories_edit/' . $sub_category['_id'] ?>"
                                                            title="Edit" style="color:#0d6efd;"><button type="button"
                                                                class="btn btn-primary">Edit</button></a>
                                                        <a onclick="return confirm('Are you sure you want to delete?');"
                                                            href="<?php echo base_url() . 'index.php/welcome/delete_sub_categories/' . $sub_category['_id'] ?>"
                                                            title="Delete" style="color:#0d6efd;"><button type="button"
                                                                class="btn btn-danger">Delete</button></a>
                                                    </div>

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


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">ADD PRODUCT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('admin/signup'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" placeholder="Name" id="name" name="name"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" placeholder="company name" id="company_name"
                                    name="companyname" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Logo</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="file" name="image" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>EMAIL</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" placeholder="email" id="email" name="email"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>PASSWORD</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control" placeholder="Password" id="password"
                                    name="password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            url: "<?php echo base_url('index.php/Welcome/sub_category_status'); ?>", // Assuming the base_url() function is properly configured
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