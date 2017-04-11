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
use AppBundle\Model\Plato;
use AppBundle\Model\PlatoPedido;
use AppBundle\Model\PlatoPeer;
use AppBundle\Model\PlatoQuery;
use AppBundle\Model\Recurso;

/**
 * @method PlatoQuery orderByPlaId($order = Criteria::ASC) Order by the pla_id column
 * @method PlatoQuery orderByPlaNombre($order = Criteria::ASC) Order by the pla_nombre column
 * @method PlatoQuery orderByPlaDescripcion($order = Criteria::ASC) Order by the pla_descripcion column
 * @method PlatoQuery orderByPlaPrecio($order = Criteria::ASC) Order by the pla_precio column
 * @method PlatoQuery orderByPlaStock($order = Criteria::ASC) Order by the pla_stock column
 * @method PlatoQuery orderByPlaEstado($order = Criteria::ASC) Order by the pla_estado column
 * @method PlatoQuery orderByPlaEliminado($order = Criteria::ASC) Order by the pla_eliminado column
 * @method PlatoQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PlatoQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method PlatoQuery groupByPlaId() Group by the pla_id column
 * @method PlatoQuery groupByPlaNombre() Group by the pla_nombre column
 * @method PlatoQuery groupByPlaDescripcion() Group by the pla_descripcion column
 * @method PlatoQuery groupByPlaPrecio() Group by the pla_precio column
 * @method PlatoQuery groupByPlaStock() Group by the pla_stock column
 * @method PlatoQuery groupByPlaEstado() Group by the pla_estado column
 * @method PlatoQuery groupByPlaEliminado() Group by the pla_eliminado column
 * @method PlatoQuery groupByCreatedAt() Group by the created_at column
 * @method PlatoQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method PlatoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PlatoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PlatoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PlatoQuery leftJoinPlatoPedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlatoPedido relation
 * @method PlatoQuery rightJoinPlatoPedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlatoPedido relation
 * @method PlatoQuery innerJoinPlatoPedido($relationAlias = null) Adds a INNER JOIN clause to the query using the PlatoPedido relation
 *
 * @method PlatoQuery leftJoinRecurso($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recurso relation
 * @method PlatoQuery rightJoinRecurso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recurso relation
 * @method PlatoQuery innerJoinRecurso($relationAlias = null) Adds a INNER JOIN clause to the query using the Recurso relation
 *
 * @method Plato findOne(PropelPDO $con = null) Return the first Plato matching the query
 * @method Plato findOneOrCreate(PropelPDO $con = null) Return the first Plato matching the query, or a new Plato object populated from the query conditions when no match is found
 *
 * @method Plato findOneByPlaNombre(string $pla_nombre) Return the first Plato filtered by the pla_nombre column
 * @method Plato findOneByPlaDescripcion(string $pla_descripcion) Return the first Plato filtered by the pla_descripcion column
 * @method Plato findOneByPlaPrecio(string $pla_precio) Return the first Plato filtered by the pla_precio column
 * @method Plato findOneByPlaStock(string $pla_stock) Return the first Plato filtered by the pla_stock column
 * @method Plato findOneByPlaEstado(int $pla_estado) Return the first Plato filtered by the pla_estado column
 * @method Plato findOneByPlaEliminado(boolean $pla_eliminado) Return the first Plato filtered by the pla_eliminado column
 * @method Plato findOneByCreatedAt(string $created_at) Return the first Plato filtered by the created_at column
 * @method Plato findOneByUpdatedAt(string $updated_at) Return the first Plato filtered by the updated_at column
 *
 * @method array findByPlaId(int $pla_id) Return Plato objects filtered by the pla_id column
 * @method array findByPlaNombre(string $pla_nombre) Return Plato objects filtered by the pla_nombre column
 * @method array findByPlaDescripcion(string $pla_descripcion) Return Plato objects filtered by the pla_descripcion column
 * @method array findByPlaPrecio(string $pla_precio) Return Plato objects filtered by the pla_precio column
 * @method array findByPlaStock(string $pla_stock) Return Plato objects filtered by the pla_stock column
 * @method array findByPlaEstado(int $pla_estado) Return Plato objects filtered by the pla_estado column
 * @method array findByPlaEliminado(boolean $pla_eliminado) Return Plato objects filtered by the pla_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Plato objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Plato objects filtered by the updated_at column
 */
abstract class BasePlatoQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePlatoQuery object.
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
            $modelName = 'AppBundle\\Model\\Plato';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PlatoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PlatoQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PlatoQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PlatoQuery) {
            return $criteria;
        }
        $query = new PlatoQuery(null, null, $modelAlias);

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
     * @return   Plato|Plato[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PlatoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PlatoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Plato A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByPlaId($key, $con = null)
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
     * @return                 Plato A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `pla_id`, `pla_nombre`, `pla_descripcion`, `pla_precio`, `pla_stock`, `pla_estado`, `pla_eliminado`, `created_at`, `updated_at` FROM `plato` WHERE `pla_id` = :p0';
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
            $obj = new Plato();
            $obj->hydrate($row);
            PlatoPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Plato|Plato[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Plato[]|mixed the list of results, formatted by the current formatter
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
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PlatoPeer::PLA_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PlatoPeer::PLA_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pla_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaId(1234); // WHERE pla_id = 1234
     * $query->filterByPlaId(array(12, 34)); // WHERE pla_id IN (12, 34)
     * $query->filterByPlaId(array('min' => 12)); // WHERE pla_id >= 12
     * $query->filterByPlaId(array('max' => 12)); // WHERE pla_id <= 12
     * </code>
     *
     * @param     mixed $plaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByPlaId($plaId = null, $comparison = null)
    {
        if (is_array($plaId)) {
            $useMinMax = false;
            if (isset($plaId['min'])) {
                $this->addUsingAlias(PlatoPeer::PLA_ID, $plaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($plaId['max'])) {
                $this->addUsingAlias(PlatoPeer::PLA_ID, $plaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlatoPeer::PLA_ID, $plaId, $comparison);
    }

    /**
     * Filter the query on the pla_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaNombre('fooValue');   // WHERE pla_nombre = 'fooValue'
     * $query->filterByPlaNombre('%fooValue%'); // WHERE pla_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $plaNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByPlaNombre($plaNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($plaNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $plaNombre)) {
                $plaNombre = str_replace('*', '%', $plaNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlatoPeer::PLA_NOMBRE, $plaNombre, $comparison);
    }

    /**
     * Filter the query on the pla_descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaDescripcion('fooValue');   // WHERE pla_descripcion = 'fooValue'
     * $query->filterByPlaDescripcion('%fooValue%'); // WHERE pla_descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $plaDescripcion The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByPlaDescripcion($plaDescripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($plaDescripcion)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $plaDescripcion)) {
                $plaDescripcion = str_replace('*', '%', $plaDescripcion);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(PlatoPeer::PLA_DESCRIPCION, $plaDescripcion, $comparison);
    }

    /**
     * Filter the query on the pla_precio column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaPrecio(1234); // WHERE pla_precio = 1234
     * $query->filterByPlaPrecio(array(12, 34)); // WHERE pla_precio IN (12, 34)
     * $query->filterByPlaPrecio(array('min' => 12)); // WHERE pla_precio >= 12
     * $query->filterByPlaPrecio(array('max' => 12)); // WHERE pla_precio <= 12
     * </code>
     *
     * @param     mixed $plaPrecio The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByPlaPrecio($plaPrecio = null, $comparison = null)
    {
        if (is_array($plaPrecio)) {
            $useMinMax = false;
            if (isset($plaPrecio['min'])) {
                $this->addUsingAlias(PlatoPeer::PLA_PRECIO, $plaPrecio['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($plaPrecio['max'])) {
                $this->addUsingAlias(PlatoPeer::PLA_PRECIO, $plaPrecio['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlatoPeer::PLA_PRECIO, $plaPrecio, $comparison);
    }

    /**
     * Filter the query on the pla_stock column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaStock(1234); // WHERE pla_stock = 1234
     * $query->filterByPlaStock(array(12, 34)); // WHERE pla_stock IN (12, 34)
     * $query->filterByPlaStock(array('min' => 12)); // WHERE pla_stock >= 12
     * $query->filterByPlaStock(array('max' => 12)); // WHERE pla_stock <= 12
     * </code>
     *
     * @param     mixed $plaStock The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByPlaStock($plaStock = null, $comparison = null)
    {
        if (is_array($plaStock)) {
            $useMinMax = false;
            if (isset($plaStock['min'])) {
                $this->addUsingAlias(PlatoPeer::PLA_STOCK, $plaStock['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($plaStock['max'])) {
                $this->addUsingAlias(PlatoPeer::PLA_STOCK, $plaStock['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlatoPeer::PLA_STOCK, $plaStock, $comparison);
    }

    /**
     * Filter the query on the pla_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaEstado(1234); // WHERE pla_estado = 1234
     * $query->filterByPlaEstado(array(12, 34)); // WHERE pla_estado IN (12, 34)
     * $query->filterByPlaEstado(array('min' => 12)); // WHERE pla_estado >= 12
     * $query->filterByPlaEstado(array('max' => 12)); // WHERE pla_estado <= 12
     * </code>
     *
     * @param     mixed $plaEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByPlaEstado($plaEstado = null, $comparison = null)
    {
        if (is_array($plaEstado)) {
            $useMinMax = false;
            if (isset($plaEstado['min'])) {
                $this->addUsingAlias(PlatoPeer::PLA_ESTADO, $plaEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($plaEstado['max'])) {
                $this->addUsingAlias(PlatoPeer::PLA_ESTADO, $plaEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlatoPeer::PLA_ESTADO, $plaEstado, $comparison);
    }

    /**
     * Filter the query on the pla_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByPlaEliminado(true); // WHERE pla_eliminado = true
     * $query->filterByPlaEliminado('yes'); // WHERE pla_eliminado = true
     * </code>
     *
     * @param     boolean|string $plaEliminado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByPlaEliminado($plaEliminado = null, $comparison = null)
    {
        if (is_string($plaEliminado)) {
            $plaEliminado = in_array(strtolower($plaEliminado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PlatoPeer::PLA_ELIMINADO, $plaEliminado, $comparison);
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
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PlatoPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PlatoPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlatoPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return PlatoQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PlatoPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PlatoPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PlatoPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related PlatoPedido object
     *
     * @param   PlatoPedido|PropelObjectCollection $platoPedido  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PlatoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPlatoPedido($platoPedido, $comparison = null)
    {
        if ($platoPedido instanceof PlatoPedido) {
            return $this
                ->addUsingAlias(PlatoPeer::PLA_ID, $platoPedido->getPlaId(), $comparison);
        } elseif ($platoPedido instanceof PropelObjectCollection) {
            return $this
                ->usePlatoPedidoQuery()
                ->filterByPrimaryKeys($platoPedido->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPlatoPedido() only accepts arguments of type PlatoPedido or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the PlatoPedido relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PlatoQuery The current query, for fluid interface
     */
    public function joinPlatoPedido($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('PlatoPedido');

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
            $this->addJoinObject($join, 'PlatoPedido');
        }

        return $this;
    }

    /**
     * Use the PlatoPedido relation PlatoPedido object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\PlatoPedidoQuery A secondary query class using the current class as primary query
     */
    public function usePlatoPedidoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinPlatoPedido($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'PlatoPedido', '\AppBundle\Model\PlatoPedidoQuery');
    }

    /**
     * Filter the query by a related Recurso object
     *
     * @param   Recurso|PropelObjectCollection $recurso  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PlatoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRecurso($recurso, $comparison = null)
    {
        if ($recurso instanceof Recurso) {
            return $this
                ->addUsingAlias(PlatoPeer::PLA_ID, $recurso->getPlaId(), $comparison);
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
     * @return PlatoQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Plato $plato Object to remove from the list of results
     *
     * @return PlatoQuery The current query, for fluid interface
     */
    public function prune($plato = null)
    {
        if ($plato) {
            $this->addUsingAlias(PlatoPeer::PLA_ID, $plato->getPlaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     PlatoQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PlatoPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     PlatoQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PlatoPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     PlatoQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PlatoPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PlatoQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PlatoPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     PlatoQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PlatoPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     PlatoQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PlatoPeer::CREATED_AT);
    }
}
