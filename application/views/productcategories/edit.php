<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Sub Category</h4>
                    </div>
                    <form method="POST" action="<?php echo base_url('index.php/welcome/product_categories_update'); ?>"
                        enctype="multipart/form-data">
                        <div class="card-body">

                            <input type="hidden" name="edit_id" value="<?php echo $product_categories->_id; ?>">

                            <div class="image-container">
                                <?php if (filter_var($product_categories->Image, FILTER_VALIDATE_URL)): ?>
                                <img src="<?php echo $product_categories->Image; ?>" alt="Image" width="200px">
                                <?php endif; ?>
                                <div class="form-group">
                                    <label>Category Image</label>
                                    <input type="hidden" name="current_image_path"
                                        value="<?php echo $product_categories->Image; ?>" class="form-control">
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="<?php echo $product_categories->Name; ?>"
                                    class="form-control" required>
                            </div>


                            <div class="form-group">
                                <label>Select Category</label>

                                <?php
                                if (!empty($product_categories->CategoryId)) {
                                    $category_id = $product_categories->CategoryId;

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
                                        // print_r($document);die;

                                        // If the document exists, echo its name
                                        if ($document) {
                                            echo '<select name="category_id" class="form-control">';
                                            echo '<option value="' . $category_id . '">' . $document['Name'] . '</option>';
                                            echo '</select>';
                                        } else {
                                            echo '<select name="category_id" class="form-control">';
                                            echo '<option value="">Category not found</option>';
                                            echo '</select>';
                                        }
                                    } catch (MongoDB\Driver\Exception\Exception $e) {
                                        echo '<select name="category_id" class="form-control">';
                                        echo '<option value="">Error: ' . $e->getMessage() . '</option>';
                                        echo '</select>';
                                    }
                                } else {
                                    echo '<select name="category_id" class="form-control">';
                                    echo '<option value="">-</option>';
                                    echo '</select>';
                                }
                                ?>

                            </div>

                            <div class="form-group">
                                <label>Select Sub Category</label>

                                <?php
                                if (!empty($product_categories->SubCategoryId)) {
                                    $product_category_id = $product_categories->SubCategoryId;
                                    // print_r($product_category_id);die;

                                    try {
                                        // Connect to MongoDB
                                        $mongoUri = $this->session->userdata('mongo_uri');
                                        $mongoClient = new MongoDB\Client($mongoUri);
                                        $database = $mongoClient->selectDatabase('QUIKFLO'); // Select your database
                                        $collection = $database->selectCollection('SubCategories'); // Select your collection
                                        

                                        // Find the category document based on the ID and project only the 'Name' field
                                        $filter = ['_id' => new MongoDB\BSON\ObjectId($product_category_id)];
                                        $options = ['projection' => ['Name' => 1]]; // Project only the 'Name' field
                                        $document = $collection->findOne($filter, $options);
                                        // print_r($document);die;

                                        // If the document exists, echo its name
                                        if ($document) {
                                            echo '<select name="sub_category_id" class="form-control">';
                                            echo '<option value="' . $product_category_id . '">' . $document['Name'] . '</option>';
                                            echo '</select>';
                                        } else {
                                            echo '<select name="category_id" class="form-control">';
                                            echo '<option value="">Category not found</option>';
                                            echo '</select>';
                                        }
                                    } catch (MongoDB\Driver\Exception\Exception $e) {
                                        echo '<select name="category_id" class="form-control">';
                                        echo '<option value="">Error: ' . $e->getMessage() . '</option>';
                                        echo '</select>';
                                    }
                                } else {
                                    echo '<select name="category_id" class="form-control">';
                                    echo '<option value="">-</option>';
                                    echo '</select>';
                                }
                                ?>

                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control selectric" name="status" required>
                                    <option label="select">select</option>
                                    <option value="1" <?php if ($product_categories['Status'] == 1) {echo "selected";}?>>
                                        Active</option>
                                    <option value="0" <?php if ($product_categories['Status'] == 0) {echo "selected";}?>>
                                        Not Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-primary mr-1" type="submit" name="save">Submit</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>