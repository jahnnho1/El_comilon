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
use AppBundle\Model\PedidoPeer;
use AppBundle\Model\PedidoQuery;
use AppBundle\Model\PlatoPedido;
use AppBundle\Model\TipoPedido;
use AppBundle\Model\Usuario;
use AppBundle\Model\Venta;

/**
 * @method PedidoQuery orderByPedId($order = Criteria::ASC) Order by the ped_id column
 * @method PedidoQuery orderByVenId($order = Criteria::ASC) Order by the ven_id column
 * @method PedidoQuery orderByTpeId($order = Criteria::ASC) Order by the tpe_id column
 * @method PedidoQuery orderByUsuId($order = Criteria::ASC) Order by the usu_id column
 * @method PedidoQuery orderByPedEstado($order = Criteria::ASC) Order by the ped_estado column
 * @method PedidoQuery orderByPedEliminado($order = Criteria::ASC) Order by the ped_eliminado column
 * @method PedidoQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method PedidoQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method PedidoQuery groupByPedId() Group by the ped_id column
 * @method PedidoQuery groupByVenId() Group by the ven_id column
 * @method PedidoQuery groupByTpeId() Group by the tpe_id column
 * @method PedidoQuery groupByUsuId() Group by the usu_id column
 * @method PedidoQuery groupByPedEstado() Group by the ped_estado column
 * @method PedidoQuery groupByPedEliminado() Group by the ped_eliminado column
 * @method PedidoQuery groupByCreatedAt() Group by the created_at column
 * @method PedidoQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method PedidoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method PedidoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method PedidoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method PedidoQuery leftJoinTipoPedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the TipoPedido relation
 * @method PedidoQuery rightJoinTipoPedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TipoPedido relation
 * @method PedidoQuery innerJoinTipoPedido($relationAlias = null) Adds a INNER JOIN clause to the query using the TipoPedido relation
 *
 * @method PedidoQuery leftJoinVenta($relationAlias = null) Adds a LEFT JOIN clause to the query using the Venta relation
 * @method PedidoQuery rightJoinVenta($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Venta relation
 * @method PedidoQuery innerJoinVenta($relationAlias = null) Adds a INNER JOIN clause to the query using the Venta relation
 *
 * @method PedidoQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method PedidoQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method PedidoQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method PedidoQuery leftJoinPlatoPedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the PlatoPedido relation
 * @method PedidoQuery rightJoinPlatoPedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the PlatoPedido relation
 * @method PedidoQuery innerJoinPlatoPedido($relationAlias = null) Adds a INNER JOIN clause to the query using the PlatoPedido relation
 *
 * @method Pedido findOne(PropelPDO $con = null) Return the first Pedido matching the query
 * @method Pedido findOneOrCreate(PropelPDO $con = null) Return the first Pedido matching the query, or a new Pedido object populated from the query conditions when no match is found
 *
 * @method Pedido findOneByVenId(int $ven_id) Return the first Pedido filtered by the ven_id column
 * @method Pedido findOneByTpeId(int $tpe_id) Return the first Pedido filtered by the tpe_id column
 * @method Pedido findOneByUsuId(int $usu_id) Return the first Pedido filtered by the usu_id column
 * @method Pedido findOneByPedEstado(int $ped_estado) Return the first Pedido filtered by the ped_estado column
 * @method Pedido findOneByPedEliminado(boolean $ped_eliminado) Return the first Pedido filtered by the ped_eliminado column
 * @method Pedido findOneByCreatedAt(string $created_at) Return the first Pedido filtered by the created_at column
 * @method Pedido findOneByUpdatedAt(string $updated_at) Return the first Pedido filtered by the updated_at column
 *
 * @method array findByPedId(int $ped_id) Return Pedido objects filtered by the ped_id column
 * @method array findByVenId(int $ven_id) Return Pedido objects filtered by the ven_id column
 * @method array findByTpeId(int $tpe_id) Return Pedido objects filtered by the tpe_id column
 * @method array findByUsuId(int $usu_id) Return Pedido objects filtered by the usu_id column
 * @method array findByPedEstado(int $ped_estado) Return Pedido objects filtered by the ped_estado column
 * @method array findByPedEliminado(boolean $ped_eliminado) Return Pedido objects filtered by the ped_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Pedido objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Pedido objects filtered by the updated_at column
 */
abstract class BasePedidoQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BasePedidoQuery object.
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
            $modelName = 'AppBundle\\Model\\Pedido';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new PedidoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   PedidoQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return PedidoQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof PedidoQuery) {
            return $criteria;
        }
        $query = new PedidoQuery(null, null, $modelAlias);

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
     * @return   Pedido|Pedido[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = PedidoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(PedidoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Pedido A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByPedId($key, $con = null)
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
     * @return                 Pedido A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ped_id`, `ven_id`, `tpe_id`, `usu_id`, `ped_estado`, `ped_eliminado`, `created_at`, `updated_at` FROM `pedido` WHERE `ped_id` = :p0';
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
            $obj = new Pedido();
            $obj->hydrate($row);
            PedidoPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Pedido|Pedido[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Pedido[]|mixed the list of results, formatted by the current formatter
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
     * @return PedidoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(PedidoPeer::PED_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return PedidoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(PedidoPeer::PED_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ped_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPedId(1234); // WHERE ped_id = 1234
     * $query->filterByPedId(array(12, 34)); // WHERE ped_id IN (12, 34)
     * $query->filterByPedId(array('min' => 12)); // WHERE ped_id >= 12
     * $query->filterByPedId(array('max' => 12)); // WHERE ped_id <= 12
     * </code>
     *
     * @param     mixed $pedId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PedidoQuery The current query, for fluid interface
     */
    public function filterByPedId($pedId = null, $comparison = null)
    {
        if (is_array($pedId)) {
            $useMinMax = false;
            if (isset($pedId['min'])) {
                $this->addUsingAlias(PedidoPeer::PED_ID, $pedId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pedId['max'])) {
                $this->addUsingAlias(PedidoPeer::PED_ID, $pedId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoPeer::PED_ID, $pedId, $comparison);
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
     * @see       filterByVenta()
     *
     * @param     mixed $venId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PedidoQuery The current query, for fluid interface
     */
    public function filterByVenId($venId = null, $comparison = null)
    {
        if (is_array($venId)) {
            $useMinMax = false;
            if (isset($venId['min'])) {
                $this->addUsingAlias(PedidoPeer::VEN_ID, $venId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($venId['max'])) {
                $this->addUsingAlias(PedidoPeer::VEN_ID, $venId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoPeer::VEN_ID, $venId, $comparison);
    }

    /**
     * Filter the query on the tpe_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTpeId(1234); // WHERE tpe_id = 1234
     * $query->filterByTpeId(array(12, 34)); // WHERE tpe_id IN (12, 34)
     * $query->filterByTpeId(array('min' => 12)); // WHERE tpe_id >= 12
     * $query->filterByTpeId(array('max' => 12)); // WHERE tpe_id <= 12
     * </code>
     *
     * @see       filterByTipoPedido()
     *
     * @param     mixed $tpeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PedidoQuery The current query, for fluid interface
     */
    public function filterByTpeId($tpeId = null, $comparison = null)
    {
        if (is_array($tpeId)) {
            $useMinMax = false;
            if (isset($tpeId['min'])) {
                $this->addUsingAlias(PedidoPeer::TPE_ID, $tpeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tpeId['max'])) {
                $this->addUsingAlias(PedidoPeer::TPE_ID, $tpeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoPeer::TPE_ID, $tpeId, $comparison);
    }

    /**
     * Filter the query on the usu_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuId(1234); // WHERE usu_id = 1234
     * $query->filterByUsuId(array(12, 34)); // WHERE usu_id IN (12, 34)
     * $query->filterByUsuId(array('min' => 12)); // WHERE usu_id >= 12
     * $query->filterByUsuId(array('max' => 12)); // WHERE usu_id <= 12
     * </code>
     *
     * @see       filterByUsuario()
     *
     * @param     mixed $usuId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PedidoQuery The current query, for fluid interface
     */
    public function filterByUsuId($usuId = null, $comparison = null)
    {
        if (is_array($usuId)) {
            $useMinMax = false;
            if (isset($usuId['min'])) {
                $this->addUsingAlias(PedidoPeer::USU_ID, $usuId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuId['max'])) {
                $this->addUsingAlias(PedidoPeer::USU_ID, $usuId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoPeer::USU_ID, $usuId, $comparison);
    }

    /**
     * Filter the query on the ped_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByPedEstado(1234); // WHERE ped_estado = 1234
     * $query->filterByPedEstado(array(12, 34)); // WHERE ped_estado IN (12, 34)
     * $query->filterByPedEstado(array('min' => 12)); // WHERE ped_estado >= 12
     * $query->filterByPedEstado(array('max' => 12)); // WHERE ped_estado <= 12
     * </code>
     *
     * @param     mixed $pedEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PedidoQuery The current query, for fluid interface
     */
    public function filterByPedEstado($pedEstado = null, $comparison = null)
    {
        if (is_array($pedEstado)) {
            $useMinMax = false;
            if (isset($pedEstado['min'])) {
                $this->addUsingAlias(PedidoPeer::PED_ESTADO, $pedEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pedEstado['max'])) {
                $this->addUsingAlias(PedidoPeer::PED_ESTADO, $pedEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoPeer::PED_ESTADO, $pedEstado, $comparison);
    }

    /**
     * Filter the query on the ped_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByPedEliminado(true); // WHERE ped_eliminado = true
     * $query->filterByPedEliminado('yes'); // WHERE ped_eliminado = true
     * </code>
     *
     * @param     boolean|string $pedEliminado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return PedidoQuery The current query, for fluid interface
     */
    public function filterByPedEliminado($pedEliminado = null, $comparison = null)
    {
        if (is_string($pedEliminado)) {
            $pedEliminado = in_array(strtolower($pedEliminado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(PedidoPeer::PED_ELIMINADO, $pedEliminado, $comparison);
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
     * @return PedidoQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(PedidoPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(PedidoPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return PedidoQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(PedidoPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(PedidoPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(PedidoPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related TipoPedido object
     *
     * @param   TipoPedido|PropelObjectCollection $tipoPedido The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PedidoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTipoPedido($tipoPedido, $comparison = null)
    {
        if ($tipoPedido instanceof TipoPedido) {
            return $this
                ->addUsingAlias(PedidoPeer::TPE_ID, $tipoPedido->getTpeId(), $comparison);
        } elseif ($tipoPedido instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PedidoPeer::TPE_ID, $tipoPedido->toKeyValue('PrimaryKey', 'TpeId'), $comparison);
        } else {
            throw new PropelException('filterByTipoPedido() only accepts arguments of type TipoPedido or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TipoPedido relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PedidoQuery The current query, for fluid interface
     */
    public function joinTipoPedido($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TipoPedido');

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
            $this->addJoinObject($join, 'TipoPedido');
        }

        return $this;
    }

    /**
     * Use the TipoPedido relation TipoPedido object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\TipoPedidoQuery A secondary query class using the current class as primary query
     */
    public function useTipoPedidoQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTipoPedido($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TipoPedido', '\AppBundle\Model\TipoPedidoQuery');
    }

    /**
     * Filter the query by a related Venta object
     *
     * @param   Venta|PropelObjectCollection $venta The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PedidoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByVenta($venta, $comparison = null)
    {
        if ($venta instanceof Venta) {
            return $this
                ->addUsingAlias(PedidoPeer::VEN_ID, $venta->getVenId(), $comparison);
        } elseif ($venta instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PedidoPeer::VEN_ID, $venta->toKeyValue('PrimaryKey', 'VenId'), $comparison);
        } else {
            throw new PropelException('filterByVenta() only accepts arguments of type Venta or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Venta relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return PedidoQuery The current query, for fluid interface
     */
    public function joinVenta($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Venta');

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
            $this->addJoinObject($join, 'Venta');
        }

        return $this;
    }

    /**
     * Use the Venta relation Venta object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\VentaQuery A secondary query class using the current class as primary query
     */
    public function useVentaQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinVenta($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Venta', '\AppBundle\Model\VentaQuery');
    }

    /**
     * Filter the query by a related Usuario object
     *
     * @param   Usuario|PropelObjectCollection $usuario The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PedidoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof Usuario) {
            return $this
                ->addUsingAlias(PedidoPeer::USU_ID, $usuario->getUsuId(), $comparison);
        } elseif ($usuario instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(PedidoPeer::USU_ID, $usuario->toKeyValue('PrimaryKey', 'UsuId'), $comparison);
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
     * @return PedidoQuery The current query, for fluid interface
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
     * Filter the query by a related PlatoPedido object
     *
     * @param   PlatoPedido|PropelObjectCollection $platoPedido  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 PedidoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPlatoPedido($platoPedido, $comparison = null)
    {
        if ($platoPedido instanceof PlatoPedido) {
            return $this
                ->addUsingAlias(PedidoPeer::PED_ID, $platoPedido->getPedId(), $comparison);
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
     * @return PedidoQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Pedido $pedido Object to remove from the list of results
     *
     * @return PedidoQuery The current query, for fluid interface
     */
    public function prune($pedido = null)
    {
        if ($pedido) {
            $this->addUsingAlias(PedidoPeer::PED_ID, $pedido->getPedId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     PedidoQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(PedidoPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     PedidoQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(PedidoPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     PedidoQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(PedidoPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     PedidoQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(PedidoPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     PedidoQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(PedidoPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     PedidoQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(PedidoPeer::CREATED_AT);
    }
}
