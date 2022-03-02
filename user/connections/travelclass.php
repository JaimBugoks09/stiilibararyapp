<?php 

    Class lib{

        private $server = "mysql:host=localhost;dbname=lms";
        private $user = "root";
        private $pass = "admin123";
        private $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        private $con;

        public function openConnection()
        {

            try
            {
                
                $this->con = new PDO($this->server, $this->user, $this->pass, $this->option);
                return $this->con;

            }catch(PDOException $e)
            {
                echo "Connection Failed! ". $e->getMessage();
            }

        }

        public function closeConnection()
        {

            $this->con = null;

        }
        

    }

    $lib = new lib();

?>