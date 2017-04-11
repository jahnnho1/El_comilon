<?php

namespace AppBundle\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use AppBundle\Model\Recurso;
use AppBundle\Model\Resturant;
use AppBundle\Model\ResturantPeer;
use AppBundle\Model\ResturantQuery;
use AppBundle\Model\Usuario;

/**
 * @method ResturantQuery orderByResId($order = Criteria::ASC) Order by the res_id column
 * @method ResturantQuery orderByResNombre($order = Criteria::ASC) Order by the res_nombre column
 * @method ResturantQuery orderByResDescripcion($order = Criteria::ASC) Order by the res_descripcion column
 * @method ResturantQuery orderByResDireccion($order = Criteria::ASC) Order by the res_direccion column
 * @method ResturantQuery orderByResEmail($order = Criteria::ASC) Order by the res_email column
 * @method ResturantQuery orderByResTelefono($order = Criteria::ASC) Order by the res_telefono column
 * @method ResturantQuery orderByResEstado($order = Criteria::ASC) Order by the res_estado column
 * @method ResturantQuery orderByResEliminado($order = Criteria::ASC) Order by the res_eliminado column
 * @method ResturantQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method ResturantQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method ResturantQuery groupByResId() Group by the res_id column
 * @method ResturantQuery groupByResNombre() Group by the res_nombre column
 * @method ResturantQuery groupByResDescripcion() Group by the res_descripcion column
 * @method ResturantQuery groupByResDireccion() Group by the res_direccion column
 * @method ResturantQuery groupByResEmail() Group by the res_email column
 * @method ResturantQuery groupByResTelefono() Group by the res_telefono column
 * @method ResturantQuery groupByResEstado() Group by the res_estado column
 * @method ResturantQuery groupByResEliminado() Group by the res_eliminado column
 * @method ResturantQuery groupByCreatedAt() Group by the created_at column
 * @method ResturantQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method ResturantQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method ResturantQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method ResturantQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method ResturantQuery leftJoinRecurso($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recurso relation
 * @method ResturantQuery rightJoinRecurso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recurso relation
 * @method ResturantQuery innerJoinRecurso($relationAlias = null) Adds a INNER JOIN clause to the query using the Recurso relation
 *
 * @method ResturantQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method ResturantQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method ResturantQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method Resturant findOne(PropelPDO $con = null) Return the first Resturant matching the query
 * @method Resturant findOneOrCreate(PropelPDO $con = null) Return the first Resturant matching the query, or a new Resturant object populated from the query conditions when no match is found
 *
 * @method Resturant findOneByResNombre(string $res_nombre) Return the first Resturant filtered by the res_nombre column
 * @method Resturant findOneByResDescripcion(string $res_descripcion) Return the first Resturant filtered by the res_descripcion column
 * @method Resturant findOneByResDireccion(string $res_direccion) Return the first Resturant filtered by the res_direccion column
 * @method Resturant findOneByResEmail(string $res_email) Return the first Resturant filtered by the res_email column
 * @method Resturant findOneByResTelefono(string $res_telefono) Return the first Resturant filtered by the res_telefono column
 * @method Resturant findOneByResEstado(int $res_estado) Return the first Resturant filtered by the res_estado column
 * @method Resturant findOneByResEliminado(boolean $res_eliminado) Return the first Resturant filtered by the res_eliminado column
 * @method Resturant findOneByCreatedAt(string $created_at) Return the first Resturant filtered by the created_at column
 * @method Resturant findOneByUpdatedAt(string $updated_at) Return the first Resturant filtered by the updated_at column
 *
 * @method array findByResId(int $res_id) Return Resturant objects filtered by the res_id column
 * @method array findByResNombre(string $res_nombre) Return Resturant objects filtered by the res_nombre column
 * @method array findByResDescripcion(string $res_descripcion) Return Resturant objects filtered by the res_descripcion column
 * @method array findByResDireccion(string $res_direccion) Return Resturant objects filtered by the res_direccion column
 * @method array findByResEmail(string $res_email) Return Resturant objects filtered by the res_email column
 * @method array findByResTelefono(string $res_telefono) Return Resturant objects filtered by the res_telefono column
 * @method array findByResEstado(int $res_estado) Return Resturant objects filtered by the res_estado column
 * @method array findByResEliminado(boolean $res_eliminado) Return Resturant objects filtered by the res_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Resturant objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Resturant objects filtered by the updated_at column
 */
abstract class BaseResturantQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseResturantQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = null, $modelName = null, $modelAlias = null)
    {
        if (null === $dbName) {
            $dbName = 'default';
        }
        if (null === $modelName) {
            $modelName = 'AppBundle\\Model\\Resturant';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ResturantQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   ResturantQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return ResturantQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof ResturantQuery) {
            return $criteria;
        }
        $query = new ResturantQuery(null, null, $modelAlias);

        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Resturant|Resturant[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ResturantPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(ResturantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Resturant A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByResId($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Resturant A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `res_id`, `res_nombre`, `res_descripcion`, `res_direccion`, `res_email`, `res_telefono`, `res_estado`, `res_eliminado`, `created_at`, `updated_at` FROM `resturant` WHERE `res_id` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Resturant();
            $obj->hydrate($row);
            ResturantPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Resturant|Resturant[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Resturant[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ResturantPeer::RES_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ResturantPeer::RES_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the res_id column
     *
     * Example usage:
     * <code>
     * $query->filterByResId(1234); // WHERE res_id = 1234
     * $query->filterByResId(array(12, 34)); // WHERE res_id IN (12, 34)
     * $query->filterByResId(array('min' => 12)); // WHERE res_id >= 12
     * $query->filterByResId(array('max' => 12)); // WHERE res_id <= 12
     * </code>
     *
     * @param     mixed $resId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByResId($resId = null, $comparison = null)
    {
        if (is_array($resId)) {
            $useMinMax = false;
            if (isset($resId['min'])) {
                $this->addUsingAlias(ResturantPeer::RES_ID, $resId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resId['max'])) {
                $this->addUsingAlias(ResturantPeer::RES_ID, $resId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResturantPeer::RES_ID, $resId, $comparison);
    }

    /**
     * Filter the query on the res_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByResNombre('fooValue');   // WHERE res_nombre = 'fooValue'
     * $query->filterByResNombre('%fooValue%'); // WHERE res_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $resNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByResNombre($resNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $resNombre)) {
                $resNombre = str_replace('*', '%', $resNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResturantPeer::RES_NOMBRE, $resNombre, $comparison);
    }

    /**
     * Filter the query on the res_descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByResDescripcion('fooValue');   // WHERE res_descripcion = 'fooValue'
     * $query->filterByResDescripcion('%fooValue%'); // WHERE res_descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $resDescripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByResDescripcion($resDescripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resDescripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $resDescripcion)) {
                $resDescripcion = str_replace('*', '%', $resDescripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResturantPeer::RES_DESCRIPCION, $resDescripcion, $comparison);
    }

    /**
     * Filter the query on the res_direccion column
     *
     * Example usage:
     * <code>
     * $query->filterByResDireccion('fooValue');   // WHERE res_direccion = 'fooValue'
     * $query->filterByResDireccion('%fooValue%'); // WHERE res_direccion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $resDireccion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByResDireccion($resDireccion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resDireccion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $resDireccion)) {
                $resDireccion = str_replace('*', '%', $resDireccion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResturantPeer::RES_DIRECCION, $resDireccion, $comparison);
    }

    /**
     * Filter the query on the res_email column
     *
     * Example usage:
     * <code>
     * $query->filterByResEmail('fooValue');   // WHERE res_email = 'fooValue'
     * $query->filterByResEmail('%fooValue%'); // WHERE res_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $resEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByResEmail($resEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $resEmail)) {
                $resEmail = str_replace('*', '%', $resEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResturantPeer::RES_EMAIL, $resEmail, $comparison);
    }

    /**
     * Filter the query on the res_telefono column
     *
     * Example usage:
     * <code>
     * $query->filterByResTelefono('fooValue');   // WHERE res_telefono = 'fooValue'
     * $query->filterByResTelefono('%fooValue%'); // WHERE res_telefono LIKE '%fooValue%'
     * </code>
     *
     * @param     string $resTelefono The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByResTelefono($resTelefono = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($resTelefono)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $resTelefono)) {
                $resTelefono = str_replace('*', '%', $resTelefono);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ResturantPeer::RES_TELEFONO, $resTelefono, $comparison);
    }

    /**
     * Filter the query on the res_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByResEstado(1234); // WHERE res_estado = 1234
     * $query->filterByResEstado(array(12, 34)); // WHERE res_estado IN (12, 34)
     * $query->filterByResEstado(array('min' => 12)); // WHERE res_estado >= 12
     * $query->filterByResEstado(array('max' => 12)); // WHERE res_estado <= 12
     * </code>
     *
     * @param     mixed $resEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByResEstado($resEstado = null, $comparison = null)
    {
        if (is_array($resEstado)) {
            $useMinMax = false;
            if (isset($resEstado['min'])) {
                $this->addUsingAlias(ResturantPeer::RES_ESTADO, $resEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resEstado['max'])) {
                $this->addUsingAlias(ResturantPeer::RES_ESTADO, $resEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResturantPeer::RES_ESTADO, $resEstado, $comparison);
    }

    /**
     * Filter the query on the res_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByResEliminado(true); // WHERE res_eliminado = true
     * $query->filterByResEliminado('yes'); // WHERE res_eliminado = true
     * </code>
     *
     * @param     boolean|string $resEliminado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByResEliminado($resEliminado = null, $comparison = null)
    {
        if (is_string($resEliminado)) {
            $resEliminado = in_array(strtolower($resEliminado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(ResturantPeer::RES_ELIMINADO, $resEliminado, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at < '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(ResturantPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(ResturantPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResturantPeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at < '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(ResturantPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(ResturantPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ResturantPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Recurso object
     *
     * @param   Recurso|PropelObjectCollection $recurso  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ResturantQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRecurso($recurso, $comparison = null)
    {
        if ($recurso instanceof Recurso) {
            return $this
                ->addUsingAlias(ResturantPeer::RES_ID, $recurso->getResId(), $comparison);
        } elseif ($recurso instanceof PropelObjectCollection) {
            return $this
                ->useRecursoQuery()
                ->filterByPrimaryKeys($recurso->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRecurso() only accepts arguments of type Recurso or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Recurso relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function joinRecurso($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Recurso');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Recurso');
        }

        return $this;
    }

    /**
     * Use the Recurso relation Recurso object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\RecursoQuery A secondary query class using the current class as primary query
     */
    public function useRecursoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRecurso($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Recurso', '\AppBundle\Model\RecursoQuery');
    }

    /**
     * Filter the query by a related Usuario object
     *
     * @param   Usuario|PropelObjectCollection $usuario  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 ResturantQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof Usuario) {
            return $this
                ->addUsingAlias(ResturantPeer::RES_ID, $usuario->getResId(), $comparison);
        } elseif ($usuario instanceof PropelObjectCollection) {
            return $this
                ->useUsuarioQuery()
                ->filterByPrimaryKeys($usuario->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsuario() only accepts arguments of type Usuario or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Usuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function joinUsuario($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Usuario');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Usuario');
        }

        return $this;
    }

    /**
     * Use the Usuario relation Usuario object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\UsuarioQuery A secondary query class using the current class as primary query
     */
    public function useUsuarioQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Usuario', '\AppBundle\Model\UsuarioQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Resturant $resturant Object to remove from the list of results
     *
     * @return ResturantQuery The current query, for fluid interface
     */
    public function prune($resturant = null)
    {
        if ($resturant) {
            $this->addUsingAlias(ResturantPeer::RES_ID, $resturant->getResId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     ResturantQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(ResturantPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     ResturantQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(ResturantPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     ResturantQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(ResturantPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     ResturantQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(ResturantPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     ResturantQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(ResturantPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     ResturantQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(ResturantPeer::CREATED_AT);
    }
}
