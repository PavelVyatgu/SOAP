<?php


class client
{
    private SoapClient $instance;

    public function __construct()
    {
        $params = [
            'location' => 'http://soap.loc/server.php',
            'uri' => 'http://soap.loc/server.php',
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE
        ];
        try {
            $this->instance = new SoapClient(null, $params);
        } catch (SoapFault $e) {
        }
    }

    public function getStudents()
    {
        return $this->instance->__soapCall('getStudents', []);
    }

    public function getStudent(int $id)
    {
        return $this->instance->__soapCall('getStudent', [$id]);
    }

    public function addStudent(array $studentData)
    {
        return $this->instance->__soapCall('addStudent', [$studentData]);
    }

    public function deleteStudent(int $id)
    {
        return $this->instance->__soapCall('deleteStudent', [$id]);
    }
}

$client = new client();
