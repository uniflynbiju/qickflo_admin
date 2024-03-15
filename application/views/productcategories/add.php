<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="col-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Sub Category</h4>
                    </div>
                    <form method="POST" action="<?php echo base_url('index.php/welcome/product_categories_insert'); ?>"
                        enctype="multipart/form-data">
                        <div class="card-body">

                            <!-- categories list -->

                            <div class="form-group">
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                    <option value="">Select a category</option>
                                    <?php foreach ($categories as $category) { ?>
                                    <option value="<?php echo htmlspecialchars($category['_id']); ?>">
                                        <?php echo isset($category['Name']) ? htmlspecialchars($category['Name']) : htmlspecialchars($category['name']); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>



                            <!-- sub categories list -->
                            <div class="form-group">
                                <label>Sub Category</label>
                                <select name="sub_category_id" class="form-control">
                                    <option value="">Select a sub category</option>
                                    <?php foreach ($sub_categories as $sub_category) { ?>
                                    <option value="<?php echo htmlspecialchars($sub_category['_id']); ?>">
                                        <?php echo isset($sub_category['Name']) ? htmlspecialchars($sub_category['Name']) : htmlspecialchars($sub_category['name']); ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control selectric" name="status" required>
                                    <option value="">Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <!-- <div class="form-group">
                                <label>Home Page</label>
                                <textarea name="homepage" class="form-control"></textarea>
                            </div> -->
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