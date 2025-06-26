<?php
require_once __DIR__ . "/../../vendor/autoload.php";

require_once(__DIR__ . '/../../bootstrap.php');
require_once(__DIR__ . '/../entity/EClient.php');
require_once(__DIR__ . '/../entity/EEmployee.php');
require_once(__DIR__ . '/../entity/EInstructor.php');


class FEntityManager{
    private static $instance;
    private static $entityManager;


    private function __construct() {
        self::$entityManager = getEntityManager();
    }

    public static function getInstance(){
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getEntityManager(){
        return self::$entityManager;
    }

     /**
     * retrive one obj
     */
    public static function retriveObj($class, $id): ?object {
        try{
            $obj = self::$entityManager->find($class, $id);
            return $obj;
        }catch(Exception $e){
            echo "ERROR: ". $e->getMessage();
            return null;
        }
    }

    /**
     * save one object in the db (persistance of Entity)
     * @return boolean
     */
    public static function saveObject(object $obj)
    {
        try{
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->persist($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }catch(Exception $e){
            self::$entityManager->getConnection();
            echo "ERROR: " . $e->getMessage() . "\n";
            return false;
        }
    }

    /**
     * delete an object from the db
     * @return boolean
     */
    public static function deleteObj($obj){
        try{
            self::$entityManager->getConnection()->beginTransaction();
            self::$entityManager->remove($obj);
            self::$entityManager->flush();
            self::$entityManager->getConnection()->commit();
            return true;
        }catch(Exception $e){
            self::$entityManager->getConnection();
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * return an array of all elemnts of a table
     * @return array
     */
    public static function selectAll($table){
        try{
            $dql = "SELECT e FROM " . $table . " e";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            return $result;
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return [];
        }
    }

    /**
     * return an object finding it not on the a but on an attribute
     */
    public static function retriveObjFromField($class, $field, $value){
        try{
            $obj = self::$entityManager->getRepository($class)->findOneBy([$field => $value]);
            return $obj;
        }catch(Exception $e){
            echo "ERROR: ". $e->getMessage();
            return null;
        }
    }



    /**
     * Checks if at least one entity exists where the given field matches the specified value.
     *
     * @return bool True if at least one matching entity exists, false otherwise
     */
    public function verifyAttributeExists(string $entityClass, string $field, mixed $value): bool
    {
        $qb = self::$entityManager->createQueryBuilder();

        $qb->select('1')
           ->from($entityClass, 'e')
           ->where("e.$field = :value")
           ->setParameter('value', $value)
           ->setMaxResults(1); // We only need to check existence, no need to fetch all

        $result = $qb->getQuery()->getOneOrNullResult();

        return $result !== null;
    }

        /**
         * return a list of objects
         * @return array
         */
    public static function objectList($table, $field, $id)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $result = $query->getResult();
            return $result;
            }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return [];
            }
        
    }

    /**
     * return a list of object that are not banned (for ex. posts and comments not banned)
     * @return array
     */
    public static function objectListNotRemoved($table, $field, $id)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " = :creatorId AND e.removed = 0";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('creatorId', $id);
            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return array();
            }
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return array();
        }
    }

    /**
     * return all the object of a specifyc table where the field value is null(ex. all the report)
     * @return array
     */
    public static function objectListUsingNull($table, $field): ?array{
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." .$field. " IS NULL";
            $query = self::$entityManager->createQuery($dql);
            $result = $query->getResult();
            if(count($result) > 0){
                return $result;
            }else{
                return array();
            }
        }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
        }
    }

    /**
     * return an object finding it not on the id but specifying 2 attributes
     */
    public static function getObjOnTwoAttributes($table, $field1, $id1, $field2, $id2)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field1 . " = :id1 AND e." . $field2 . " = :id2";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('id1', $id1);
            $query->setParameter('id2', $id2);
            $result = $query->getOneOrNullResult();
            return $result;

        }catch(Exception $e){
            self::$entityManager->getConnection();
            echo "ERROR: " . $e->getMessage();
            return false;
        }
    }

    /**
     * return a list of all the object that have the $str in the specified attribute
     */
    public static function getSearchedItem($table, $field, $str)
    {
        try{
            $dql = "SELECT e FROM " . $table . " e WHERE e." . $field . " LIKE :searchedStr";
            $query = self::$entityManager->createQuery($dql)->setParameter('searchedStr', '%' . $str . '%');
            $result = $query->getResult();
            if(count($result) > 0)
            {
                return $result;
            }else{
                return array();
            }
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return null;
        }
    }

    /**
     * return the number of objects in a list finding they on a specific attribute
     */
    public static function countObjectListAttribute($table, $field, $id)
    {
        try{
            $dql = "SELECT COUNT(e) FROM " . $table . " e WHERE  e." .$field . " = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $id);

            $result = $query->getSingleScalarResult();
            return $result;
        }catch(Exception $e){
            echo "ERROR " . $e->getMessage();
            return [];
        }
    }

    /**
     * verify if exist an object
     */
    public static function verifyAttributes($fieldId, $table, $field, $id){
        try{
            $dql = "SELECT u.id".$fieldId. " FROM " . $table . " u WHERE u." . $field . " = :attribute";
            $query = self::$entityManager->createQuery($dql);
            $query->setParameter('attribute', $id);

            $result = $query->getResult();
            if(count($result) > 0){
                return true;
            }else{
                return false;
            }
        }catch(Exception $e){
                echo "ERROR " . $e->getMessage();
                return null;
            }
    }
    /**
     * Retrieves an object from the database based on multiple fields.
     * @param string $class The class name of the entity to retrieve.
     * @param array $fields An associative array where keys are field names and values are the corresponding values to match.
     * @return object|null The first matching object, or null if no match is found or an error occurs.
     * @throws Exception If an error occurs during the retrieval process.   
    */
    public static function retriveObjFromFields($class, array $fields): ?object {
        try {
            $criteria = [];
            foreach ($fields as $field => $value) {
                $criteria[$field] = $value;
            }
            $obj = self::$entityManager->getRepository($class)->findOneBy($criteria);
            return $obj;
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Retrieves a list of objects from the database based on multiple fields.
     * @param string $class The class name of the entity to retrieve.
     * @param array $fields An associative array where keys are field names and values are the corresponding values to match.
     * @return array|null An array of matching objects, or null if no match is found or an error occurs.
     */
    public static function retriveObjListFromFields($class, array $fields): ?array {
        try {
            $criteria = [];
            foreach ($fields as $field => $value) {
                $criteria[$field] = $value;
            }
            $obj = self::$entityManager->getRepository($class)->findBy($criteria);
            return $obj;
        } catch (Exception $e) {
            echo "ERROR: " . $e->getMessage();
            return null;
        }
    }
}