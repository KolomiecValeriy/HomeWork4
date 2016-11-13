<?php

namespace Project;

class SchemaRepository
{
	private $connectorWithoutDatabase;
	
	private $connector;
	
	/**
	 * SchemaRepository constructor
	 * @param Connector $connector
	 */
	
	public function __construct($connector)
	{
		$this->connector = $connector;
	}
	
    public function createDB()
    {
        $sql = 'CREATE DATABASE study';
        $query = $this->connector->exec($sql);
    }

    public function createUniversityTable()
    {
        $sql = 'CREATE TABLE university (
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
			name char(15),
			city char(15),
			site char(40)
			) charset=utf8';
        $query = $this->connector->exec($sql);
    }

    public function createDepartmentTable()
    {
        $sql = 'CREATE TABLE department (
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
			name char(30),
			university_id int,
			FOREIGN KEY (university_id) REFERENCES university(id)
			) charset=utf8';
        $query = $this->connector->exec($sql);
    }

    public function createStudentTable()
    {
        $sql = 'CREATE TABLE student (
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
			first_name char(30),
			last_name char(30),
			email char(30),
			phone char(15) DEFAULT NULL,
			department_id int,
			FOREIGN KEY (department_id) REFERENCES department(id)
			) charset=utf8';
        $query = $this->connector->exec($sql);
    }

    public function createTecherTable()
    {
        $sql = 'CREATE TABLE teacher (
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
			first_name char(30),
			last_name char(30),
			department_id int,
			FOREIGN KEY (department_id) REFERENCES department(id)
			) charset=utf8';
        $query = $this->connector->exec($sql);
    }

    public function createSubjectTable()
    {
        $sql = 'CREATE TABLE subject (
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
			name char(30),
			department char(30),
			teacher_id int,
			FOREIGN KEY (teacher_id) REFERENCES teacher(id)
			) charset=utf8';
        $query = $this->connector->exec($sql);
    }

    public function createHomeWorkTable()
    {
        $sql = 'CREATE TABLE home_work (
			id int NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE,
			name char(30),
			student_id int,
			subject_id int,
			finished BOOL DEFAULT 0,
			FOREIGN KEY (student_id) REFERENCES student(id),
			FOREIGN KEY (subject_id) REFERENCES subject(id)
			) charset=utf8';
        $query = $this->connector->exec($sql);
    }
}
