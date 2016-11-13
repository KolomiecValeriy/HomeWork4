<?php

namespace Project;
use Faker;
use PDO;

class DataRepository
{
	private $connector;
	
	private $faker;
	
	public function __construct($connector)
	{
		$this->connector = $connector;
		$this->faker = Faker\Factory::create();
	}
	public function generateUniversity()
	{
		$sqlInsert = "INSERT INTO university (name,city,site) 
				VALUES (
				:name,
				:city,
				:site
				)";				
        $query = $this->connector->prepare($sqlInsert);
        $query->bindParam(':name', $this->faker->company);
        $query->bindParam(':city', $this->faker->city);
        $query->bindParam(':site', $this->faker->domainName);
        $query->execute();
	}
	
	public function generateDepartment()
	{
		$sqlFetchMin = "SELECT min(id) FROM university";
		$sqlFetchMax = "SELECT max(id) FROM university";
		$resMin = $this->connector->query($sqlFetchMin);
		$resMax = $this->connector->query($sqlFetchMax);
		$sqlInsert = "INSERT INTO department (name,university_id) 
				VALUES
				(
				:name,
				:university_id
				)";		
		
        $query = $this->connector->prepare($sqlInsert);
        $query->bindParam(':name', $this->faker->jobTitle);
        $query->bindParam(':university_id', $this->faker->numberBetween($resMin->fetch()[0], $resMax->fetch()[0]));
        $query->execute();
	}
	
	public function generateStudent()
	{
		// TODO
	}
	
	public function generateTeacher()
	{
		// TODO
	}
	
	public function generateSubject()
	{
		// TODO
	}
}
