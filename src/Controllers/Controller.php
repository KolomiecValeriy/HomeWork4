<?php

namespace Controllers;

error_reporting(E_ALL);

class Controller
{
    private $connector;

    private $connectorWithoutDatabase;

    /**
     * Controller constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->connectorWithoutDatabase = new Connector($config, null);
        $this->connector = new Connector($config);
    }

    /**
     * Create structure of Database with tables.
     */
    public function createStructure()
    {
        $this->createDB($this->connectorWithoutDatabase->getConnection());
        $this->createUniversityTable($this->connector->getConnection());
        $this->createDepartmentsTable($this->connector->getConnection());
        $this->createStudentsTable($this->connector->getConnection());
        $this->createHomeWorksTable($this->connector->getConnection());

        header('Location: index.php');
    }

    /**
     * Generete some data and insert them in tables.
     */
    public function generateData()
    {
        $sql = "INSERT INTO university (name,city,site) 
				VALUES ('GeekHub', 'Cherkassy', 'www.site.com')";
        $query = $this->connector->getConnection()->prepare($sql);
        $query->execute();
        header('Location: index.php');
    }

    private function createDB($connector)
    {
        $sql = 'CREATE DATABASE study';
        $query = $connector->exec($sql);
    }

    private function createUniversityTable($connector)
    {
        $sql = 'CREATE TABLE university (
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
			name char(15),
			city char(15),
			site char(40)
			) charset=utf8';
        $query = $connector->exec($sql);
    }

    private function createDepartmentsTable($connector)
    {
        $sql = 'CREATE TABLE departments (
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
			name char(30),
			university_id int
			) charset=utf8';
        $query = $connector->exec($sql);
    }

    private function createStudentsTable($connector)
    {
        $sql = 'CREATE TABLE students (
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
			first_name char(30),
			last_name char(30),
			email char(30),
			phone char(15) DEFAULT NULL,
			department_id int
			) charset=utf8';
        $query = $connector->exec($sql);
    }

    private function createHomeWorksTable($connector)
    {
        $sql = 'CREATE TABLE home_works (
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
			name char(30),
			students_id int,
			subjects_id int,
			finished BOOL DEFAULT 0
			) charset=utf8';
        $query = $connector->exec($sql);
    }
}
