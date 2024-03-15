<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <!-- Include any necessary CSS files -->
</head>

<body>
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Category</h4>
                        </div>
                        <form method="POST" action="<?php echo base_url('index.php/welcome/categories_update'); ?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <input type="hidden" name="edit_id" value="<?php echo $categories->_id; ?>">
                                <div class="image-container">
                                    <?php if (filter_var($categories->Image, FILTER_VALIDATE_URL)): ?>
                                    <img src="<?php echo $categories->Image; ?>" alt="Image" width="200px">
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label>Category Image</label>
                                        <input type="hidden" name="current_image_path"
                                        value="<?php echo htmlspecialchars($categories->Image, ENT_QUOTES); ?>" class="form-control" maxlength="1000">
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?php echo $categories->Name; ?>"
                                        class="form-control" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control selectric" name="status" required>
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div> -->
                                <div class="form-group">
                                    <label>Home Page</label>
                                    <textarea name="homepage" class="form-control"
                                        required><?php echo $categories->HomePage; ?></textarea>
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
    <!-- Include any necessary JavaScript files -->
</body>

</html>
