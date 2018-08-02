OMDB (The Open Movie Database) library for codeigniter
=========================================

##### The OMDb API is a RESTful web service to obtain movie information, all content and images on the site are contributed and maintained by our users. 
Please check [OMDB documentation](http://www.omdbapi.com/) for create api key.

Requirements
------------

* CodeIgniter 3.0+
* PHP 5.6+
* cURL
* OMDB API-key


Installation
------------

Download and unpack the contents of the application/libraries and application/config folder to your CodeIgniter project.


Config file
------------------

####Move omdb.php to application/config folder

    <?php
    
    $config['omdbapi'] = 'YOUR API'; // Enter your api key.

    
 Controller example
------------------
####Initialize the class
    <?php
    	class Omdb_test extends CI_Controller {
    
    		public function __construct() {
    			parent::__construct();
    			$this->load->library('omdb');
    		}
    
    		public function index() {
    			$params = array(
                			's' => 'Batman'
                			);
            		return $this->omdb->getMovie($params);
    		}
    	}
