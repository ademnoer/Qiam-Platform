<?php

class courses_handler {

    public $errors = array();
    public $messages = array();
    
    public $courses = array();
    public $course;
    
    public $materials = array();
    public $material = array();
    public $materials_types = array();
    
    private $db_connection = null;

    function __construct() {
        
    }

    private function databaseConnection() {
        if ($this->db_connection != null) {
            return true;
        } else {
            try {
                $this->db_connection = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            } catch (PDOException $e) {
                $this->errors[] = MESSAGE_DATABASE_ERROR . $e->getMessage();
            }
        }
        return false;
    }

    public function getMaterial($course_id, $material_order) {  //for one selected course
        if ($this->databaseConnection()) {
            $query_user = $this->db_connection->prepare('SELECT * FROM materials WHERE course_id = :course_id AND material_order = :material_order');
            $query_user->bindValue(':course_id', $course_id, PDO::PARAM_STR);
            $query_user->bindValue(':material_order', $material_order, PDO::PARAM_STR);
            $query_user->execute();
            $this->material = $query_user->fetchObject();
        } else {
            $this->material = NULL;
            $this->errors[] = "Error In getMaterial Function";
        }
    }
    
    public function getAllCourses() {
        if ($this->databaseConnection()) {
            $query_user = $this->db_connection->prepare('SELECT * FROM courses');
            $query_user->execute();
            $this->courses = $query_user->fetchAll();
        } else {
            $this->courses = NULL;
            $this->error[] = "Error In getCourse Function";
        }
    }

    public function getCourse($course_id) {
        if ($this->databaseConnection()) {
            $query_user = $this->db_connection->prepare('SELECT * FROM courses WHERE course_id = :course_id');
            $query_user->bindValue(':course_id', $course_id, PDO::PARAM_STR);
            $query_user->execute();
            $this->course = $query_user->fetchObject();
        } else {
            $this->course = NULL;
            $this->error[] = "Error In getCourse Function";
        }
    }

        public function getMaterialsTypes($course_id) { //for one selected course
        if ($this->databaseConnection()) {
            $query_user = $this->db_connection->prepare('SELECT material_type FROM materials WHERE course_id = :course_id');
            $query_user->bindValue(':course_id', $course_id, PDO::PARAM_STR);
            $query_user->execute();
            $this->materials_types = $query_user->fetchAll();
        } else {
            $this->materials_types = NULL;
            $this->errors[] = "Error In getMaterialsTypes Function";
        }
    }

}
