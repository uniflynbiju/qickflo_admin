<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use MongoDB\Client as MongoDBClient;

class Welcome_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getDriverKYCDetails($_id)
    {
        $mongoUri = "mongodb+srv://uniflyn:UniFlyn@quickflo.ju2k4hq.mongodb.net/?retryWrites=true&w=majority";
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->QUIKFLO;
            $collection = $database->Driver;

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if (isset($document['KYC'])) {
                return $document['KYC'];
            } else {
                return array();
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function getCompanyDetails($_id)
    {
        $mongoUri = "mongodb+srv://uniflyn:UniFlyn@quickflo.ju2k4hq.mongodb.net/?retryWrites=true&w=majority";
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->QUIKFLO;
            $collection = $database->Driver;

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if ($document && isset($document['DocumentDetails'])) {
                return $document['DocumentDetails'];
            } else {
                return array();
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    public function getRetailerKYCDetails($_id)
    {
        $mongoUri = "mongodb+srv://uniflyn:UniFlyn@quickflo.ju2k4hq.mongodb.net/?retryWrites=true&w=majority";
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->QUIKFLO;
            $collection = $database->Retailer;

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if (isset($document['KYC'])) {
                return $document['KYC'];
            } else {
                return array();
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }
    public function getRetailerstoreDetails($_id)
    {
        $mongoUri = "mongodb+srv://uniflyn:UniFlyn@quickflo.ju2k4hq.mongodb.net/?retryWrites=true&w=majority";
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->QUIKFLO;
            $collection = $database->Retailer;

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if ($document && isset($document['StoreDetails'])) {
                return $document['StoreDetails'];
            } else {
                return array();
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }


    public function getManufactureKYCDetails($_id)
    {
        $mongoUri = "mongodb+srv://uniflyn:UniFlyn@quickflo.ju2k4hq.mongodb.net/?retryWrites=true&w=majority";
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->QUIKFLO;
            $collection = $database->Manufacture;

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if (isset($document['KYC'])) {
                return $document['KYC'];
            } else {
                return array();
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }
    public function getManufacturecompanyDetails($_id)
    {
        $mongoUri = "mongodb+srv://uniflyn:UniFlyn@quickflo.ju2k4hq.mongodb.net/?retryWrites=true&w=majority";
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->QUIKFLO;
            $collection = $database->Manufacture;

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if ($document && isset($document['CompanyDetails'])) {
                return $document['CompanyDetails'];
            } else {
                return array();
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }



    public function getPatnerKYCDetails($_id)
    {
        $mongoUri = "mongodb+srv://uniflyn:UniFlyn@quickflo.ju2k4hq.mongodb.net/?retryWrites=true&w=majority";
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->QUIKFLO;
            $collection = $database->Partner;

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if (isset($document['KYC'])) {
                return $document['KYC'];
            } else {
                return array();
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }

    
    public function getpatnercompanyDetails($_id)
    {
        $mongoUri = "mongodb+srv://uniflyn:UniFlyn@quickflo.ju2k4hq.mongodb.net/?retryWrites=true&w=majority";
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->QUIKFLO;
            $collection = $database->Partner;

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if ($document && isset($document['CompanyDetails'])) {
                return $document['CompanyDetails'];
            } else {
                return array();
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return array();
        }
    }


    public function get_categories_id($_id) {
        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase('QUIKFLO'); // Select your database
            $collection = $database->selectCollection('Categories'); // Select your collection

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if ($document) {
                return $document;
            } else {
                return null;
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function get_sub_categories_id($_id) {
        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase('QUIKFLO'); // Select your database
            $collection = $database->selectCollection('SubCategories'); // Select your collection

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if ($document) {
                return $document;
            } else {
                return null;
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function get_product_categories_id($_id) {
        $mongoUri = $this->session->userdata('mongo_uri');
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase('QUIKFLO'); // Select your database
            $collection = $database->selectCollection('ProductCategories'); // Select your collection

            $filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
            $document = $collection->findOne($filter);

            if ($document) {
                return $document;
            } else {
                return null;
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function update_detail($collection_name, $data, $filter)
    {
        $mongoUri = "mongodb+srv://uniflyn:UniFlyn@quickflo.ju2k4hq.mongodb.net/?retryWrites=true&w=majority";
        try {
            $mongoClient = new MongoDB\Client($mongoUri);
            $database = $mongoClient->selectDatabase('QUIKFLO');
            $collection = $database->selectCollection($collection_name);
            
            $updateResult = $collection->updateOne(
                $filter, // Filter to find the document to update
                ['$set' => $data] // New data to set
            );
            
            if ($updateResult->getModifiedCount() > 0) {
                return true; // Document updated successfully
            } else {
                return false; // Document not found or no changes made
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo "Error: " . $e->getMessage();
            return false; // Error occurred while updating
        }
    }

    public function delete_detail($collection_name, $id)
    {
        $mongoUri = $this->session->userdata('mongo_uri');
    try {
        $mongoClient = new MongoDB\Client($mongoUri);
        $database = $mongoClient->selectDatabase('QUIKFLO');
        $collection = $database->selectCollection($collection_name);

        $filter = ['_id' => new MongoDB\BSON\ObjectId($id)];
        $deleteResult = $collection->deleteOne($filter);

        if ($deleteResult->getDeletedCount() > 0) {
            return true;
        } else {
            return false;
        }
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

    
}