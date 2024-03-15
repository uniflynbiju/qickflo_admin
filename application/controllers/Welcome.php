<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';

// use MongoDB\Client as MongoDBClient;
use Kreait\Firebase\Factory;

use Kreait\Firebase\ServiceAccount;


class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'html'));
        $this->load->model('Welcome_model');
        $this->load->library('session');
        $mongoUri = "mongodb+srv://uniflyn:UniFlyn@quickflo.ju2k4hq.mongodb.net/?retryWrites=true&w=majority";
        $this->session->set_userdata('mongo_uri', $mongoUri);
        

    }
	private function load_view($view_name, $data = array())
    {
        $this->load->view('include/header');
        $this->load->view('include/sidebar');
        $this->load->view($view_name, $data);
        $this->load->view('include/footer');
    }

    public function index()
    { 
        $this->load_view('dashboard');
    }

    public function add()
    {
        $this->load_view('add');
    }
   
    public function driver_list()
    {

        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase("QUIKFLO");
            $collection = $database->selectCollection("Driver");
            $data['driver'] = $collection->find([]);
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return; // Exiting the function if an error occurs
        }
        $this->load_view('driver/list',$data);
    }
    
    public function driver_kyc_details($_id)
    {
        $data['kyc_details'] = $this->Welcome_model->getDriverKYCDetails($_id);
        $this->load_view('driver/driver_kyc_list', $data);
    }

    public function driver_documents_details($_id)
    {
        $data['documents_details'] = $this->Welcome_model->getCompanyDetails($_id);
        $this->load_view('driver/driver_documents_list', $data);
    }


    public function manufacture_list()
    {
        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase("QUIKFLO");
            $collection = $database->selectCollection("Manufacture");
            $data['manufacture'] = $collection->find([]);
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return; // Exiting the function if an error occurs
        }
        $this->load_view('manufacture/list',$data);
    }


    public function manufacture_status()
{
    // Retrieve data from the AJAX request
    $documentId = $this->input->post('document_id');
    // Connect to MongoDB
    $mongoUri = $this->session->userdata('mongo_uri');
    $mongoClient = new MongoDB\Client($mongoUri);
    $database = $mongoClient->selectDatabase("QUIKFLO");
    $collection = $database->selectCollection("Manufacture");
    try {
        // Find the document by its ID
        $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($documentId)]);
        // Toggle the status based on the current status
        $newStatus = ($document['Status'] == 1) ? 0 : 1;
        // Update the status in the database
        $result = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($documentId)],
            ['$set' => ['Status' => (string)$newStatus]]
        );
        // Check if the update operation was successful
        if ($result->getModifiedCount() == 1) {
            // Send a success response to the client
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['success' => true, 'new_status' => $newStatus]));
        } else {
            // Send an error response if the document was not found or status not updated
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['error' => 'Document not found or status not updated']));
        }
    } catch (Exception $e) {
        // Log the error
        log_message('error', 'Retailer status update error: ' . $e->getMessage());
        // Send an error response
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['error' => 'An error occurred. Please try again later.']));
    }
}
    public function driver_status()
{
    // Retrieve data from the AJAX request
    $documentId = $this->input->post('document_id');
    // Connect to MongoDB
    $mongoUri = $this->session->userdata('mongo_uri');
    $mongoClient = new MongoDB\Client($mongoUri);
    $database = $mongoClient->selectDatabase("QUIKFLO");
    $collection = $database->selectCollection("Driver");
    try {
        // Find the document by its ID
        $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($documentId)]);
        // Toggle the status based on the current status
        $newStatus = ($document['Status'] == 1) ? 0 : 1;
        // Update the status in the database
        $result = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($documentId)],
            ['$set' => ['Status' => (string)$newStatus]]
        );
        // Check if the update operation was successful
        if ($result->getModifiedCount() == 1) {
            // Send a success response to the client
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['success' => true, 'new_status' => $newStatus]));
        } else {
            // Send an error response if the document was not found or status not updated
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['error' => 'Document not found or status not updated']));
        }
    } catch (Exception $e) {
        // Log the error
        log_message('error', 'Retailer status update error: ' . $e->getMessage());
        // Send an error response
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['error' => 'An error occurred. Please try again later.']));
    }
}
    public function partner_status()
{
    // Retrieve data from the AJAX request
    $documentId = $this->input->post('document_id');
    // Connect to MongoDB
    $mongoUri = $this->session->userdata('mongo_uri');
    $mongoClient = new MongoDB\Client($mongoUri);
    $database = $mongoClient->selectDatabase("QUIKFLO");
    $collection = $database->selectCollection("Partner");
    try {
        // Find the document by its ID
        $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($documentId)]);
        // Toggle the status based on the current status
        $newStatus = ($document['Status'] == 1) ? 0 : 1;
        // Update the status in the database
        $result = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($documentId)],
            ['$set' => ['Status' => (string)$newStatus]]
        );
        // Check if the update operation was successful
        if ($result->getModifiedCount() == 1) {
            // Send a success response to the client
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['success' => true, 'new_status' => $newStatus]));
        } else {
            // Send an error response if the document was not found or status not updated
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['error' => 'Document not found or status not updated']));
        }
    } catch (Exception $e) {
        // Log the error
        log_message('error', 'Retailer status update error: ' . $e->getMessage());
        // Send an error response
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['error' => 'An error occurred. Please try again later.']));
    }
}

    public function retailer_status()
{
    // Retrieve data from the AJAX request
    $documentId = $this->input->post('document_id');
    // Connect to MongoDB
    $mongoUri = $this->session->userdata('mongo_uri');
    $mongoClient = new MongoDB\Client($mongoUri);
    $database = $mongoClient->selectDatabase("QUIKFLO");
    $collection = $database->selectCollection("Retailer");
    try {
        // Find the document by its ID
        $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($documentId)]);
        // Toggle the status based on the current status
        $newStatus = ($document['Status'] == 1) ? 0 : 1;
        // Update the status in the database
        $result = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($documentId)],
            ['$set' => ['Status' => (string)$newStatus]]
        );
        // Check if the update operation was successful
        if ($result->getModifiedCount() == 1) {
            // Send a success response to the client
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['success' => true, 'new_status' => $newStatus]));
        } else {
            // Send an error response if the document was not found or status not updated
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['error' => 'Document not found or status not updated']));
        }
    } catch (Exception $e) {
        // Log the error
        log_message('error', 'Retailer status update error: ' . $e->getMessage());
        // Send an error response
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['error' => 'An error occurred. Please try again later.']));
    }
}
    public function category_status()
{
    // Retrieve data from the AJAX request
    $documentId = $this->input->post('document_id');
    // Connect to MongoDB
    $mongoUri = $this->session->userdata('mongo_uri');
    $mongoClient = new MongoDB\Client($mongoUri);
    $database = $mongoClient->selectDatabase("QUIKFLO");
    $collection = $database->selectCollection("Categories");
    try {
        // Find the document by its ID
        $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($documentId)]);
        // Toggle the status based on the current status
        $newStatus = ($document['Status'] == 1) ? 0 : 1;
        // Update the status in the database
        $result = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($documentId)],
            ['$set' => ['Status' => (string)$newStatus]]
        );
        // Check if the update operation was successful
        if ($result->getModifiedCount() == 1) {
            // Send a success response to the client
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['success' => true, 'new_status' => $newStatus]));
        } else {
            // Send an error response if the document was not found or status not updated
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['error' => 'Document not found or status not updated']));
        }
    } catch (Exception $e) {
        // Log the error
        log_message('error', 'Retailer status update error: ' . $e->getMessage());
        // Send an error response
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['error' => 'An error occurred. Please try again later.']));
    }
}
    public function sub_category_status()
{
    // Retrieve data from the AJAX request
    $documentId = $this->input->post('document_id');
    // Connect to MongoDB
    $mongoUri = $this->session->userdata('mongo_uri');
    $mongoClient = new MongoDB\Client($mongoUri);
    $database = $mongoClient->selectDatabase("QUIKFLO");
    $collection = $database->selectCollection("SubCategories");
    try {
        // Find the document by its ID
        $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($documentId)]);
        // Toggle the status based on the current status
        $newStatus = ($document['Status'] == 1) ? 0 : 1;
        // Update the status in the database
        $result = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($documentId)],
            ['$set' => ['Status' => (string)$newStatus]]
        );
        // Check if the update operation was successful
        if ($result->getModifiedCount() == 1) {
            // Send a success response to the client
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['success' => true, 'new_status' => $newStatus]));
        } else {
            // Send an error response if the document was not found or status not updated
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['error' => 'Document not found or status not updated']));
        }
    } catch (Exception $e) {
        // Log the error
        log_message('error', 'Retailer status update error: ' . $e->getMessage());
        // Send an error response
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['error' => 'An error occurred. Please try again later.']));
    }
}
    public function product_status()
{
    // Retrieve data from the AJAX request
    $documentId = $this->input->post('document_id');
    // Connect to MongoDB
    $mongoUri = $this->session->userdata('mongo_uri');
    $mongoClient = new MongoDB\Client($mongoUri);
    $database = $mongoClient->selectDatabase("QUIKFLO");
    $collection = $database->selectCollection("ProductCategories");
    try {
        // Find the document by its ID
        $document = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($documentId)]);
        // Toggle the status based on the current status
        $newStatus = ($document['Status'] == 1) ? 0 : 1;
        // Update the status in the database
        $result = $collection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($documentId)],
            ['$set' => ['Status' => (string)$newStatus]]
        );
        // Check if the update operation was successful
        if ($result->getModifiedCount() == 1) {
            // Send a success response to the client
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['success' => true, 'new_status' => $newStatus]));
        } else {
            // Send an error response if the document was not found or status not updated
            $this->output
                 ->set_content_type('application/json')
                 ->set_output(json_encode(['error' => 'Document not found or status not updated']));
        }
    } catch (Exception $e) {
        // Log the error
        log_message('error', 'Retailer status update error: ' . $e->getMessage());
        // Send an error response
        $this->output
             ->set_content_type('application/json')
             ->set_output(json_encode(['error' => 'An error occurred. Please try again later.']));
    }
}


	public function manufacture_kyc_details($_id)
    {
        $data['kyc_details'] = $this->Welcome_model->getManufactureKYCDetails($_id);
        $this->load_view('manufacture/manufacture_kyc_list', $data);
    }

	public function manufacture_company_details($_id)
    {
        $data['company_details'] = $this->Welcome_model->getManufacturecompanyDetails($_id);
        $this->load_view('manufacture/manufacture_company_list', $data);
    }
	

	public function partner_list()
    {
        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase("QUIKFLO");
            $collection = $database->selectCollection("Partner");
            $data['partner'] = $collection->find([]);
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return; // Exiting the function if an error occurs
        }
        $this->load_view('partner/list',$data);
    }

	public function patner_kyc_details($_id)
    {
        $data['kyc_details'] = $this->Welcome_model->getPatnerKYCDetails($_id);
        $this->load_view('partner/partner_kyc_list', $data);
    }

	public function patner_company_details($_id)
    {

        $data['company_details'] = $this->Welcome_model->getpatnercompanyDetails($_id);
        // print_r($data['company_details']);die;
        $this->load_view('partner/partner_company_list', $data);

    }

    public function retailer_list()
    {
        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase("QUIKFLO");
            $collection = $database->selectCollection("Retailer");
            $data['retailer'] = $collection->find([]);
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return; // Exiting the function if an error occurs
        }
        $this->load_view('retailer/list',$data);
    }


    public function retailer_kyc_details($_id)
    {
        $data['kyc_details'] = $this->Welcome_model->getRetailerKYCDetails($_id);
        // print_r($data['kyc_details']);die;
        $this->load_view('retailer/retailer_kyc_list', $data);
    }

	public function retailer_store_details($_id)
    {
        $data['store_details'] = $this->Welcome_model->getRetailerstoreDetails($_id);
        $this->load_view('retailer/retailer_store_list', $data);
    }


    public function categories_add()
    {
        $this->load_view('categories/add');
    }
    
    public function categories_insert() {
    
        if (!empty($this->input->post())) {

            $mongoUri = $this->session->userdata('mongo_uri');
    
            try {
                
                $mongoClient = new MongoDB\Client($mongoUri);
                $database = $mongoClient->selectDatabase("QUIKFLO");
                $collection = $database->selectCollection("Categories");
    
                $name = $this->input->post('name');
                $status = $this->input->post('status');
                $homepage = $this->input->post('homepage');

                $imageURL = $this->uploadImage($_FILES['image']);

                $document = array(
                    'Name' => $name,
                    'Status' => $status,
                    'HomePage' => $homepage,
                    'deleted' => 0,
                    'Image' => $imageURL
                );

                $insertResult = $collection->insertOne($document);

                if ($insertResult->getInsertedCount() > 0) {

                    redirect('welcome/categories_list');
                } else {

                    echo "Failed to insert document into MongoDB.";
                }
            } catch (MongoDB\Driver\Exception\Exception $e) {

                echo "Error: " . $e->getMessage();
            }
        } else {

            redirect('welcome');
        }
    }
    private function uploadImage($imageFile) {
        // Firebase configuration
        $firebaseConfig = [
            'apiKey' => 'AIzaSyB3KiTZGa5Qpq54gZYHyPVNID_G0y6M0Yk',
            'authDomain' => 'quikflo-64d8b.firebaseapp.com',
            'projectId' => 'quikflo-64d8b',
            'storageBucket' => 'quikflo-64d8b.appspot.com',
            'messagingSenderId' => '172899289931',
            'appId' => '1:172899289931:web:10223847c82ba5b5edb6ce',
            'measurementId' => 'G-KY2KTP6V9W',
        ];
        
    
       
    // Service account credentials
    $serviceAccount = [
        "type" => "service_account",
        "project_id" => "quikflo-64d8b",
        "private_key_id" => "706a961f2d3b1423185efe9b5cf7b7150eaf956c",
        "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDRsPWyaPupTBMb\n4rokLANv11X1rKsMBB1NjxL68Tk7rMuGcweHRVTALGcjYISRhnMsam5k0JUOfO04\nNtEY3qk4grbUn4/w0wEmdUs33vZIW36NC9SakBz5Wk5o8NUuwnKSSFZKzb5IwBwK\nSLAaeMrzw9OgWNs2gRooxDIwLAUrZEamgWZjnV8hMlxIclKLtcPwSVimg1UHeAMO\nTHRFgiB7/eAvuXK/mhlfM8WvbJegOFZPeuAObI4768oYnJGWL7ahugFpNP5lHpiV\nQvKvWwtFl2cwFhmHMjIFT1onHZ3UdTO1GjG/4dJdt2MKAf0iphjxa3cB3ZXFVpW2\nt55TINR9AgMBAAECggEAHfvvIigTZlm3uMrSoaX+htFUnBjo64KyGvtMtD/mlnMm\nti7AIpZmIEWpKNyeED4YvX7pkrZlvgjcled2vlbmfStpz90SJNZTSYfHrfFOp7mX\njr0klUZqsjg40pYvcayB3AuGdVNWtInt6IWM0vg3UySLIBhcnj5XOoGViKBey92c\nL+8ObPD1Im6wW1KXBkTskoVQcUeq4cL46l1fWgE0uLWjg0KISZuRR/k9iLDHZHx2\nMfIcJit0WrNd/4vgF8wuSduAaRz0P61cVXvWTJFL90ii6YKfTUCqRL9YMqTHQydR\nWpUt7UnN5ih09XKKnYYO4O8MUd/EIJ6OJaCogNxGAQKBgQD5k0M/G2qyLeBQvfmM\nUur5+ccZE+mK6CdCBRawwgxwowjE0US8d1K/mtSy1jP8Pdm0PmV845MuAG/x+4HP\nnn8+QzdDz0Xmo66gMTLHg6Zj+h8yOKSCOBw/2fCHgbsGWAjN8TR2f2j0X6WzhpC3\nRvEzTNKWN3N2THOdGGMonru6fQKBgQDXFtsQDih4a/d1eK0CfQFtrcPffn3y0FZi\nKprP+wN6wg/ye+/rgAD0zNUZXZt3kgr3zjckesHQVusRtVeTlZkY/t7nInNTz0xO\njggvJeXn/MyGLYLY5SKl6Gzw0ZJtazYOSIl8i5GXXuS1+Eeh4DIVJELZGlft69WE\nTU+utYqiAQKBgQDYK4qalafD72KU7QfCWGu423VtLkciDtU6JOgzb9CQm1ZUC6LK\nz1u4JGbJBCoA+J2htk33b7KirLRJ13vnljRGfLfYnya/j9UIYbTHBSvQ+uucd11e\ngTVOxPnGlUKmSwhNQPgdD1ycFmCS8CJW7TasJYVdoWf79lpJnr78hwi5jQKBgHNd\nJ+wJm/1S82xHaIxQHgcEz209PDKTOfH3Jgfte2VJVyJZBUsL4fdrMdUkFvHgHA/j\nxEHFsdSb+gMKf8mB0JbOhSH1oWPPaP8tQQiAzDpMpipFmMvawmW4L05PKbmUam7o\nyw1JErLcy9EqNMmHJXWfeFdXwNe0yVXn3Zg4eP4BAoGBAOZuCUJTUVlvLGy2yAE0\nEQacvXuaXLSmNdT5SHBTKWTl6i2ZVMlFWhLLY5kFA0BzRWYf8IrXMJIrzyWRpr5K\ndaMLp2klU0Cj9qod+ok1ZjG2Cu/eCDB6mMBMLvfdGrG8zkETOyTe+0oTbESoAmzn\nrZq3YXWUlayoF1Udgw9Jmzun\n-----END PRIVATE KEY-----\n",
        "client_email" => "firebase-adminsdk-a0tzc@quikflo-64d8b.iam.gserviceaccount.com",
        "client_id" => "100330148552026883627",
        "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
        "token_uri" => "https://oauth2.googleapis.com/token",
        "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
        "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/firebase-adminsdk-a0tzc%40quikflo-64d8b.iam.gserviceaccount.com",
        "universe_domain" => "googleapis.com",
    ];
    

    // Initialize Firebase with service account array
    $firebase = (new Kreait\Firebase\Factory)
        ->withServiceAccount($serviceAccount);

    // Get storage instance
    $storage = $firebase->createStorage();

    // Upload file to Firebase Storage
    $imageData = file_get_contents($imageFile['tmp_name']);
    $imageName = $imageFile['name'];

    $firebaseStoragePath = 'categories/' . $imageName; // Adjust the path as per your requirement

    // Upload the file
    $storage->getBucket()->upload($imageData, [
        'name' => $firebaseStoragePath
    ]);

    // Get the URL of the uploaded image
    $imageURL = $storage->getBucket()->object($firebaseStoragePath)->signedUrl(new DateTime('+1 week'));

    return $imageURL;
    }
    
    public function categories_list()
    {

        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase("QUIKFLO");
            $collection = $database->selectCollection("Categories");
            $data['categories'] = $collection->find([]);
            // print_r($data['categories']);die;
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return; // Exiting the function if an error occurs
        }
        $this->load_view('categories/list',$data);
    }


    public function categories_edit($_id) {

        $data['categories'] = $this->Welcome_model->get_categories_id($_id);
        // print_r($data['categories']);die;
        $this->load_view('categories/edit', $data);
    }

    public function categories_update() {

            if (isset($_POST['save'])) {

                $edit_id = $this->input->post('edit_id', true);
        
                $home_page = $this->input->post('homepage', true);
                // print_r($home_page);die;
                $name = $this->input->post('name', true);
                 // Get the current image path
                 $imageURL  = $this->input->get('current_image_path', true);
                //  print_r($imageURL);die;



        // Check if a new image is uploaded
        if(isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $imageURL = $this->uploadImage($_FILES['image']);
        }
        // print_r($imageURL);die;

                $update_data = array(
                    'Name' => $name,
                    'HomePage' => $home_page,
                    'deleted'=> 0,
                    'Image' => $imageURL,
                );
        
                $filter = ['_id' => new MongoDB\BSON\ObjectId($edit_id)];
                $isUpdated = $this->Welcome_model->update_detail('Categories', $update_data, $filter);
        
                if ($isUpdated) {
                    $this->session->set_flashdata('success', 'Updated Successfully');
                    redirect('welcome/categories_list');
                } else {
                    $this->session->set_flashdata('unsuccess', 'Error');
                    redirect('Admin');
                }
            } else {
                $this->session->set_flashdata('unsuccess', 'Error');
                redirect('Admin');
            }
        }
        

        public function delete_categories($id)
        {
            $isDeleted = $this->Welcome_model->delete_detail('Categories', $id);
        
            if ($isDeleted) {
                $this->session->set_flashdata('success', 'Deleted Successfully');
                redirect('welcome/categories_list');
            } else {
                $this->session->set_flashdata('unsuccess', 'Error');
            }
        
            redirect('Admin/subcategory');
        }

        
    public function sub_categories_add()
    {

        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase("QUIKFLO");
            $collection = $database->selectCollection("Categories");
            $data['categories'] = $collection->find([], ['projection' => ['_id' => 1, 'Name' => 1]]);
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return; // Exiting the function if an error occurs
        }
        $this->load_view('subcategories/add', $data);
    }

    public function sub_categories_insert() {
      
        if (!empty($this->input->post())) {

            $mongoUri = $this->session->userdata('mongo_uri');
    
            try {
                
                $mongoClient = new MongoDB\Client($mongoUri);
                $database = $mongoClient->selectDatabase("QUIKFLO");
                $collection = $database->selectCollection("SubCategories");
    
                // Get form data
                $name = $this->input->post('name');
                $status = $this->input->post('status');
                $category_id = $this->input->post('category_id');

                $imageURL = $this->uploadImage($_FILES['image']);
    

                $document = array(
                    'CategoryId' => $category_id,
                    'Name' => $name,
                    'Status' => $status,
                    'deleted' => 0,
                    'Image' => $imageURL
                );

                $insertResult = $collection->insertOne($document);

                if ($insertResult->getInsertedCount() > 0) {

                    redirect('welcome/sub_categories_list');
                } else {

                    echo "Failed to insert document into MongoDB.";
                }
            } catch (MongoDB\Driver\Exception\Exception $e) {

                echo "Error: " . $e->getMessage();
            }
        } else {

            redirect('welcome');
        }
    }


    public function sub_categories_list()
    {

        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase("QUIKFLO");
            $collection = $database->selectCollection("SubCategories");
            $data['sub_categories'] = $collection->find([]);
            // print_r($data['sub_categories']);die;
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return; // Exiting the function if an error occurs
        }
        $this->load_view('subcategories/list',$data);
    }


    public function sub_categories_edit($_id) {

        $data['sub_categories'] = $this->Welcome_model->get_sub_categories_id($_id);
        // print_r($data['sub_categories']);die;
        $this->load_view('subcategories/edit', $data);
    }

    public function sub_categories_update() {

            if (isset($_POST['save'])) {

                $edit_id = $this->input->post('edit_id', true);
        
                $category_id = $this->input->post('category_id', true);
                $status = $this->input->post('status', true);
                // print_r($category_id);die;
                $name = $this->input->post('name', true);
                $imageURL = $this->uploadImage($_FILES['image']);

                $update_data = array(
                    'CategoryId' => $category_id,
                    'Name' => $name,
                    'Status' => $status,
                    'deleted' => 0,
                    'Image' => $imageURL,
                );
        
                $filter = ['_id' => new MongoDB\BSON\ObjectId($edit_id)];
                // print_r();die;
                $isUpdated = $this->Welcome_model->update_detail('SubCategories', $update_data, $filter);
        
                if ($isUpdated) {
                    $this->session->set_flashdata('success', 'Updated Successfully');
                    redirect('welcome/sub_categories_list');
                } else {
                    $this->session->set_flashdata('unsuccess', 'Error');
                    redirect('Admin');
                }
            } else {
                $this->session->set_flashdata('unsuccess', 'Error');
                redirect('welcome');
            }
        }

        public function delete_sub_categories($id)
        {
            $isDeleted = $this->Welcome_model->delete_detail('SubCategories', $id);
        
            if ($isDeleted) {
                $this->session->set_flashdata('success', 'Deleted Successfully');
                redirect('welcome/sub_categories_list');
            } else {
                $this->session->set_flashdata('unsuccess', 'Error');
            }
        
            redirect('Admin/sub_category');
        }


    public function product_categories_add()
    {
        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase("QUIKFLO");
            $collection = $database->selectCollection("Categories");
            $collection2 = $database->selectCollection("SubCategories");
            
            
            // Fetching categories
            $categoriesCursor = $collection->find([], ['projection' => ['_id' => 1, 'Name' => 1]]);
            $data['categories'] = [];
            foreach ($categoriesCursor as $category) {
                $data['categories'][] = $category;
            }

            // Fetching sub-categories
            $subCategoriesCursor = $collection2->find([], ['projection' => ['_id' => 1, 'Name' => 1]]);
            $data['sub_categories'] = [];
            foreach ($subCategoriesCursor as $subCategory) {
                $data['sub_categories'][] = $subCategory;
            }
            
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return; // Exiting the function if an error occurs
        }
        $this->load_view('productcategories/add', $data);
    }
    

    public function product_categories_insert() {
      
        if (!empty($this->input->post())) {

            $mongoUri = $this->session->userdata('mongo_uri');
    
            try {
                
                $mongoClient = new MongoDB\Client($mongoUri);
                $database = $mongoClient->selectDatabase("QUIKFLO");
                $collection = $database->selectCollection("ProductCategories");
    
                // Get form data
                $name = $this->input->post('name');
                $status = $this->input->post('status');
                $category_id = $this->input->post('category_id');
                $sub_category_id = $this->input->post('sub_category_id');
    

                $imageURL = $this->uploadImage($_FILES['image']);

                $document = array(
                    'CategoryId' => $category_id,
                    'SubCategoryId' => $sub_category_id,
                    'Name' => $name,
                    'Status' => $status,
                    'deleted' => 0,
                    'Image' => $imageURL
                );

                $insertResult = $collection->insertOne($document);

                if ($insertResult->getInsertedCount() > 0) {

                    redirect('welcome/product_categories_list');
                } else {

                    echo "Failed to insert document into MongoDB.";
                }
            } catch (MongoDB\Driver\Exception\Exception $e) {

                echo "Error: " . $e->getMessage();
            }
        } else {

            redirect('welcome');
        }
    }


    public function product_categories_list()
    {

        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase("QUIKFLO");
            $collection = $database->selectCollection("ProductCategories");
            $data['product_categories'] = $collection->find([]);
            // print_r($data['sub_categories']);die;
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return; // Exiting the function if an error occurs
        }
        $this->load_view('productcategories/list',$data);
    }


    public function product_categories_edit($_id) {

        $data['product_categories'] = $this->Welcome_model->get_product_categories_id($_id);
        // print_r($data['product_categories']);die;
        $this->load_view('productcategories/edit', $data);
    }

    public function product_categories_update() {

            if (isset($_POST['save'])) {

                $edit_id = $this->input->post('edit_id', true);
        
                // $home_page = $this->input->post('homepage', true);
                $category_id = $this->input->post('category_id', true);
                $sub_category_id = $this->input->post('sub_category_id', true);
                $status = $this->input->post('status', true);
                // print_r($home_page);die;
                $name = $this->input->post('name', true);
                $imageURL = $this->uploadImage($_FILES['image']);

                $update_data = array(
                    'CategoryId' => $category_id,
                    'SubCategoryId' => $sub_category_id,
                    'Name' => $name,
                    'Status'=> $status,
                    'deleted'=> 0,
                    'Image' => $imageURL,
                );
        
                $filter = ['_id' => new MongoDB\BSON\ObjectId($edit_id)];
                $isUpdated = $this->Welcome_model->update_detail('ProductCategories', $update_data, $filter);
        
                if ($isUpdated) {
                    $this->session->set_flashdata('success', 'Updated Successfully');
                    redirect('welcome/product_categories_list');
                } else {
                    $this->session->set_flashdata('unsuccess', 'Error');
                    redirect('Admin');
                }
            } else {
                $this->session->set_flashdata('unsuccess', 'Error');
                redirect('Admin');
            }
        }

        public function delete_product_categories($id)
        {
            $isDeleted = $this->Welcome_model->delete_detail('ProductCategories', $id);
        
            if ($isDeleted) {
                $this->session->set_flashdata('success', 'Deleted Successfully');
                redirect('welcome/product_categories_list');
            } else {
                $this->session->set_flashdata('unsuccess', 'Error');
            }
        
            redirect('Admin/subcategory');
        }



    // public function upload_img()
    // {
    //     $image_path = "./uploads/categories/";
    //     $file_name = $_FILES["image"]['name'];
    //     $config = array(
    //         'upload_path'   => $image_path,
    //         'allowed_types' => '*',
    //         'file_name'     => $file_name
    //     );
    //     $this->load->library('upload', $config);
    //     $this->upload->initialize($config);
    //     $result = array();
    
    //     if (!$this->upload->do_upload('image')) {
    //         $result['error'] = $this->upload->display_errors();
    //         $result['file_url'] = ''; // Set file_url to an empty string in case of an error
    //     } else {
    //         $data = $this->upload->data();
    //         $result['file_name'] = $data['file_name'];
    //         $result['file_url'] = 'uploads/categories/' . $data['file_name'];
    //     }
    
    //     return $result;
    // }


    public function verticle_add()
    {
        $this->load_view('verticle/add');
    }
    
    public function verticle_insert() {
    
        if (!empty($this->input->post())) {

            $mongoUri = $this->session->userdata('mongo_uri');
    
            try {
                
                $mongoClient = new MongoDB\Client($mongoUri);
                $database = $mongoClient->selectDatabase("QUIKFLO");
                $collection = $database->selectCollection("Categories");
    
                $name = $this->input->post('name');
                $status = $this->input->post('status');
                $homepage = $this->input->post('homepage');

                $imageURL = $this->uploadImage($_FILES['image']);

                $document = array(
                    'Name' => $name,
                    'Status' => $status,
                    'HomePage' => $homepage,
                    'deleted' => 0,
                    'Image' => $imageURL
                );

                $insertResult = $collection->insertOne($document);

                if ($insertResult->getInsertedCount() > 0) {

                    redirect('welcome/categories_list');
                } else {

                    echo "Failed to insert document into MongoDB.";
                }
            } catch (MongoDB\Driver\Exception\Exception $e) {

                echo "Error: " . $e->getMessage();
            }
        } else {

            redirect('welcome');
        }
    }
    
}