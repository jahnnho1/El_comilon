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
use AppBundle\Model\Pedido;
use AppBundle\Model\Venta;
use AppBundle\Model\VentaPeer;
use AppBundle\Model\VentaQuery;

/**
 * @method VentaQuery orderByVenId($order = Criteria::ASC) Order by the ven_id column
 * @method VentaQuery orderByVenNumeroDocumento($order = Criteria::ASC) Order by the ven_numero_documento column
 * @method VentaQuery orderByVenTipoDocumento($order = Criteria::ASC) Order by the ven_tipo_documento column
 * @method VentaQuery orderByVenSubTotal($order = Criteria::ASC) Order by the ven_sub_total column
 * @method VentaQuery orderByVenIva($order = Criteria::ASC) Order by the ven_iva column
 * @method VentaQuery orderByVenPropina($order = Criteria::ASC) Order by the ven_propina column
 * @method VentaQuery orderByVenTotal($order = Criteria::ASC) Order by the ven_total column
 * @method VentaQuery orderByVenEstado($order = Criteria::ASC) Order by the ven_estado column
 * @method VentaQuery orderByVenEliminado($order = Criteria::ASC) Order by the ven_eliminado column
 * @method VentaQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method VentaQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method VentaQuery groupByVenId() Group by the ven_id column
 * @method VentaQuery groupByVenNumeroDocumento() Group by the ven_numero_documento column
 * @method VentaQuery groupByVenTipoDocumento() Group by the ven_tipo_documento column
 * @method VentaQuery groupByVenSubTotal() Group by the ven_sub_total column
 * @method VentaQuery groupByVenIva() Group by the ven_iva column
 * @method VentaQuery groupByVenPropina() Group by the ven_propina column
 * @method VentaQuery groupByVenTotal() Group by the ven_total column
 * @method VentaQuery groupByVenEstado() Group by the ven_estado column
 * @method VentaQuery groupByVenEliminado() Group by the ven_eliminado column
 * @method VentaQuery groupByCreatedAt() Group by the created_at column
 * @method VentaQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method VentaQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method VentaQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method VentaQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method VentaQuery leftJoinPedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pedido relation
 * @method VentaQuery rightJoinPedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pedido relation
 * @method VentaQuery innerJoinPedido($relationAlias = null) Adds a INNER JOIN clause to the query using the Pedido relation
 *
 * @method Venta findOne(PropelPDO $con = null) Return the first Venta matching the query
 * @method Venta findOneOrCreate(PropelPDO $con = null) Return the first Venta matching the query, or a new Venta object populated from the query conditions when no match is found
 *
 * @method Venta findOneByVenNumeroDocumento(string $ven_numero_documento) Return the first Venta filtered by the ven_numero_documento column
 * @method Venta findOneByVenTipoDocumento(string $ven_tipo_documento) Return the first Venta filtered by the ven_tipo_documento column
 * @method Venta findOneByVenSubTotal(string $ven_sub_total) Return the first Venta filtered by the ven_sub_total column
 * @method Venta findOneByVenIva(string $ven_iva) Return the first Venta filtered by the ven_iva column
 * @method Venta findOneByVenPropina(string $ven_propina) Return the first Venta filtered by the ven_propina column
 * @method Venta findOneByVenTotal(string $ven_total) Return the first Venta filtered by the ven_total column
 * @method Venta findOneByVenEstado(int $ven_estado) Return the first Venta filtered by the ven_estado column
 * @method Venta findOneByVenEliminado(boolean $ven_eliminado) Return the first Venta filtered by the ven_eliminado column
 * @method Venta findOneByCreatedAt(string $created_at) Return the first Venta filtered by the created_at column
 * @method Venta findOneByUpdatedAt(string $updated_at) Return the first Venta filtered by the updated_at column
 *
 * @method array findByVenId(int $ven_id) Return Venta objects filtered by the ven_id column
 * @method array findByVenNumeroDocumento(string $ven_numero_documento) Return Venta objects filtered by the ven_numero_documento column
 * @method array findByVenTipoDocumento(string $ven_tipo_documento) Return Venta objects filtered by the ven_tipo_documento column
 * @method array findByVenSubTotal(string $ven_sub_total) Return Venta objects filtered by the ven_sub_total column
 * @method array findByVenIva(string $ven_iva) Return Venta objects filtered by the ven_iva column
 * @method array findByVenPropina(string $ven_propina) Return Venta objects filtered by the ven_propina column
 * @method array findByVenTotal(string $ven_total) Return Venta objects filtered by the ven_total column
 * @method array findByVenEstado(int $ven_estado) Return Venta objects filtered by the ven_estado column
 * @method array findByVenEliminado(boolean $ven_eliminado) Return Venta objects filtered by the ven_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Venta objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Venta objects filtered by the updated_at column
 */
abstract class BaseVentaQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseVentaQuery object.
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
            $modelName = 'AppBundle\\Model\\Venta';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new VentaQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   VentaQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return VentaQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof VentaQuery) {
            return $criteria;
        }
        $query = new VentaQuery(null, null, $modelAlias);

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
     * @return   Venta|Venta[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = VentaPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(VentaPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Venta A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByVenId($key, $con = null)
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
     * @return                 Venta A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ven_id`, `ven_numero_documento`, `ven_tipo_documento`, `ven_sub_total`, `ven_iva`, `ven_propina`, `ven_total`, `ven_estado`, `ven_eliminado`, `created_at`, `updated_at` FROM `venta` WHERE `ven_id` = :p0';
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
            $obj = new Venta();
            $obj->hydrate($row);
            VentaPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Venta|Venta[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Venta[]|mixed the list of results, formatted by the current formatter
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
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(VentaPeer::VEN_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(VentaPeer::VEN_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ven_id column
     *
     * Example usage:
     * <code>
     * $query->filterByVenId(1234); // WHERE ven_id = 1234
     * $query->filterByVenId(array(12, 34)); // WHERE ven_id IN (12, 34)
     * $query->filterByVenId(array('min' => 12)); // WHERE ven_id >= 12
     * $query->filterByVenId(array('max' => 12)); // WHERE ven_id <= 12
     * </code>
     *
     * @param     mixed $venId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByVenId($venId = null, $comparison = null)
    {
        if (is_array($venId)) {
            $useMinMax = false;
            if (isset($venId['min'])) {
                $this->addUsingAlias(VentaPeer::VEN_ID, $venId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($venId['max'])) {
                $this->addUsingAlias(VentaPeer::VEN_ID, $venId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::VEN_ID, $venId, $comparison);
    }

    /**
     * Filter the query on the ven_numero_documento column
     *
     * Example usage:
     * <code>
     * $query->filterByVenNumeroDocumento('fooValue');   // WHERE ven_numero_documento = 'fooValue'
     * $query->filterByVenNumeroDocumento('%fooValue%'); // WHERE ven_numero_documento LIKE '%fooValue%'
     * </code>
     *
     * @param     string $venNumeroDocumento The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByVenNumeroDocumento($venNumeroDocumento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($venNumeroDocumento)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $venNumeroDocumento)) {
                $venNumeroDocumento = str_replace('*', '%', $venNumeroDocumento);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VentaPeer::VEN_NUMERO_DOCUMENTO, $venNumeroDocumento, $comparison);
    }

    /**
     * Filter the query on the ven_tipo_documento column
     *
     * Example usage:
     * <code>
     * $query->filterByVenTipoDocumento('fooValue');   // WHERE ven_tipo_documento = 'fooValue'
     * $query->filterByVenTipoDocumento('%fooValue%'); // WHERE ven_tipo_documento LIKE '%fooValue%'
     * </code>
     *
     * @param     string $venTipoDocumento The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByVenTipoDocumento($venTipoDocumento = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($venTipoDocumento)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $venTipoDocumento)) {
                $venTipoDocumento = str_replace('*', '%', $venTipoDocumento);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(VentaPeer::VEN_TIPO_DOCUMENTO, $venTipoDocumento, $comparison);
    }

    /**
     * Filter the query on the ven_sub_total column
     *
     * Example usage:
     * <code>
     * $query->filterByVenSubTotal(1234); // WHERE ven_sub_total = 1234
     * $query->filterByVenSubTotal(array(12, 34)); // WHERE ven_sub_total IN (12, 34)
     * $query->filterByVenSubTotal(array('min' => 12)); // WHERE ven_sub_total >= 12
     * $query->filterByVenSubTotal(array('max' => 12)); // WHERE ven_sub_total <= 12
     * </code>
     *
     * @param     mixed $venSubTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByVenSubTotal($venSubTotal = null, $comparison = null)
    {
        if (is_array($venSubTotal)) {
            $useMinMax = false;
            if (isset($venSubTotal['min'])) {
                $this->addUsingAlias(VentaPeer::VEN_SUB_TOTAL, $venSubTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($venSubTotal['max'])) {
                $this->addUsingAlias(VentaPeer::VEN_SUB_TOTAL, $venSubTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::VEN_SUB_TOTAL, $venSubTotal, $comparison);
    }

    /**
     * Filter the query on the ven_iva column
     *
     * Example usage:
     * <code>
     * $query->filterByVenIva(1234); // WHERE ven_iva = 1234
     * $query->filterByVenIva(array(12, 34)); // WHERE ven_iva IN (12, 34)
     * $query->filterByVenIva(array('min' => 12)); // WHERE ven_iva >= 12
     * $query->filterByVenIva(array('max' => 12)); // WHERE ven_iva <= 12
     * </code>
     *
     * @param     mixed $venIva The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByVenIva($venIva = null, $comparison = null)
    {
        if (is_array($venIva)) {
            $useMinMax = false;
            if (isset($venIva['min'])) {
                $this->addUsingAlias(VentaPeer::VEN_IVA, $venIva['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($venIva['max'])) {
                $this->addUsingAlias(VentaPeer::VEN_IVA, $venIva['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::VEN_IVA, $venIva, $comparison);
    }

    /**
     * Filter the query on the ven_propina column
     *
     * Example usage:
     * <code>
     * $query->filterByVenPropina(1234); // WHERE ven_propina = 1234
     * $query->filterByVenPropina(array(12, 34)); // WHERE ven_propina IN (12, 34)
     * $query->filterByVenPropina(array('min' => 12)); // WHERE ven_propina >= 12
     * $query->filterByVenPropina(array('max' => 12)); // WHERE ven_propina <= 12
     * </code>
     *
     * @param     mixed $venPropina The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByVenPropina($venPropina = null, $comparison = null)
    {
        if (is_array($venPropina)) {
            $useMinMax = false;
            if (isset($venPropina['min'])) {
                $this->addUsingAlias(VentaPeer::VEN_PROPINA, $venPropina['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($venPropina['max'])) {
                $this->addUsingAlias(VentaPeer::VEN_PROPINA, $venPropina['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::VEN_PROPINA, $venPropina, $comparison);
    }

    /**
     * Filter the query on the ven_total column
     *
     * Example usage:
     * <code>
     * $query->filterByVenTotal(1234); // WHERE ven_total = 1234
     * $query->filterByVenTotal(array(12, 34)); // WHERE ven_total IN (12, 34)
     * $query->filterByVenTotal(array('min' => 12)); // WHERE ven_total >= 12
     * $query->filterByVenTotal(array('max' => 12)); // WHERE ven_total <= 12
     * </code>
     *
     * @param     mixed $venTotal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByVenTotal($venTotal = null, $comparison = null)
    {
        if (is_array($venTotal)) {
            $useMinMax = false;
            if (isset($venTotal['min'])) {
                $this->addUsingAlias(VentaPeer::VEN_TOTAL, $venTotal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($venTotal['max'])) {
                $this->addUsingAlias(VentaPeer::VEN_TOTAL, $venTotal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::VEN_TOTAL, $venTotal, $comparison);
    }

    /**
     * Filter the query on the ven_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByVenEstado(1234); // WHERE ven_estado = 1234
     * $query->filterByVenEstado(array(12, 34)); // WHERE ven_estado IN (12, 34)
     * $query->filterByVenEstado(array('min' => 12)); // WHERE ven_estado >= 12
     * $query->filterByVenEstado(array('max' => 12)); // WHERE ven_estado <= 12
     * </code>
     *
     * @param     mixed $venEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByVenEstado($venEstado = null, $comparison = null)
    {
        if (is_array($venEstado)) {
            $useMinMax = false;
            if (isset($venEstado['min'])) {
                $this->addUsingAlias(VentaPeer::VEN_ESTADO, $venEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($venEstado['max'])) {
                $this->addUsingAlias(VentaPeer::VEN_ESTADO, $venEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::VEN_ESTADO, $venEstado, $comparison);
    }

    /**
     * Filter the query on the ven_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByVenEliminado(true); // WHERE ven_eliminado = true
     * $query->filterByVenEliminado('yes'); // WHERE ven_eliminado = true
     * </code>
     *
     * @param     boolean|string $venEliminado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByVenEliminado($venEliminado = null, $comparison = null)
    {
        if (is_string($venEliminado)) {
            $venEliminado = in_array(strtolower($venEliminado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(VentaPeer::VEN_ELIMINADO, $venEliminado, $comparison);
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
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(VentaPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(VentaPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return VentaQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(VentaPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(VentaPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(VentaPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Pedido object
     *
     * @param   Pedido|PropelObjectCollection $pedido  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 VentaQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPedido($pedido, $comparison = null)
    {
        if ($pedido instanceof Pedido) {
            return $this
                ->addUsingAlias(VentaPeer::VEN_ID, $pedido->getVenId(), $comparison);
        } elseif ($pedido instanceof PropelObjectCollection) {
            return $this
                ->usePedidoQuery()
                ->filterByPrimaryKeys($pedido->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByPedido() only accepts arguments of type Pedido or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Pedido relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function joinPedido($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Pedido');

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
            $this->addJoinObject($join, 'Pedido');
        }

        return $this;
    }

    /**
     * Use the Pedido relation Pedido object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\PedidoQuery A secondary query class using the current class as primary query
     */
    public function usePedidoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinPedido($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Pedido', '\AppBundle\Model\PedidoQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Venta $venta Object to remove from the list of results
     *
     * @return VentaQuery The current query, for fluid interface
     */
    public function prune($venta = null)
    {
        if ($venta) {
            $this->addUsingAlias(VentaPeer::VEN_ID, $venta->getVenId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(VentaPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(VentaPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(VentaPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(VentaPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(VentaPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     VentaQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(VentaPeer::CREATED_AT);
    }
}
