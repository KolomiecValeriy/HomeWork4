<?php

namespace Controllers;
use Project\SchemaRepository;
use Project\DataRepository;

error_reporting(E_ALL);

class Controller
{
    private $connector;

    private $connectorWithoutDatabase;
    
    private $schemaRepository;
    
    private $dataRepository;

    /**
     * Controller constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->connectorWithoutDatabase = new Connector($config, null);
        $this->connectorWithoutDatabase = $this->connectorWithoutDatabase->getConnection();
        $this->connector = new Connector($config);
        $this->schemaRepository = new SchemaRepository($this->connectorWithoutDatabase);
        $this->schemaRepository->createDB();
        $this->connector = $this->connector->getConnection();
    }

    /**
     * Create structure of Database with tables.
     */
    public function createStructure()
    {
        
        $this->schemaRepository = new SchemaRepository($this->connector);
        
        $this->schemaRepository->createUniversityTable();
        $this->schemaRepository->createDepartmentTable();
        $this->schemaRepository->createStudentTable();
        $this->schemaRepository->createTecherTable();
        $this->schemaRepository->createSubjectTable();
		$this->schemaRepository->createHomeWorkTable();
		
        header('Location: index.php');
    }
    
	/**
     * Generete some data and insert them in tables.
     */
    public function generateData()
    {
        $this->dataRepository = new DataRepository($this->connector);
        $this->dataRepository->generateUniversity();
        $this->dataRepository->generateDepartment();
        header('Location: index.php');
    }
    
}
