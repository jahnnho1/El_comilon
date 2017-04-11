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
use AppBundle\Model\TipoPedido;
use AppBundle\Model\TipoPedidoPeer;
use AppBundle\Model\TipoPedidoQuery;

/**
 * @method TipoPedidoQuery orderByTpeId($order = Criteria::ASC) Order by the tpe_id column
 * @method TipoPedidoQuery orderByTpeNombre($order = Criteria::ASC) Order by the tpe_nombre column
 * @method TipoPedidoQuery orderByTpeEstado($order = Criteria::ASC) Order by the tpe_estado column
 * @method TipoPedidoQuery orderByTpeEliminado($order = Criteria::ASC) Order by the tpe_eliminado column
 * @method TipoPedidoQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method TipoPedidoQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method TipoPedidoQuery groupByTpeId() Group by the tpe_id column
 * @method TipoPedidoQuery groupByTpeNombre() Group by the tpe_nombre column
 * @method TipoPedidoQuery groupByTpeEstado() Group by the tpe_estado column
 * @method TipoPedidoQuery groupByTpeEliminado() Group by the tpe_eliminado column
 * @method TipoPedidoQuery groupByCreatedAt() Group by the created_at column
 * @method TipoPedidoQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method TipoPedidoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TipoPedidoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TipoPedidoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TipoPedidoQuery leftJoinPedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pedido relation
 * @method TipoPedidoQuery rightJoinPedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pedido relation
 * @method TipoPedidoQuery innerJoinPedido($relationAlias = null) Adds a INNER JOIN clause to the query using the Pedido relation
 *
 * @method TipoPedido findOne(PropelPDO $con = null) Return the first TipoPedido matching the query
 * @method TipoPedido findOneOrCreate(PropelPDO $con = null) Return the first TipoPedido matching the query, or a new TipoPedido object populated from the query conditions when no match is found
 *
 * @method TipoPedido findOneByTpeNombre(string $tpe_nombre) Return the first TipoPedido filtered by the tpe_nombre column
 * @method TipoPedido findOneByTpeEstado(int $tpe_estado) Return the first TipoPedido filtered by the tpe_estado column
 * @method TipoPedido findOneByTpeEliminado(boolean $tpe_eliminado) Return the first TipoPedido filtered by the tpe_eliminado column
 * @method TipoPedido findOneByCreatedAt(string $created_at) Return the first TipoPedido filtered by the created_at column
 * @method TipoPedido findOneByUpdatedAt(string $updated_at) Return the first TipoPedido filtered by the updated_at column
 *
 * @method array findByTpeId(int $tpe_id) Return TipoPedido objects filtered by the tpe_id column
 * @method array findByTpeNombre(string $tpe_nombre) Return TipoPedido objects filtered by the tpe_nombre column
 * @method array findByTpeEstado(int $tpe_estado) Return TipoPedido objects filtered by the tpe_estado column
 * @method array findByTpeEliminado(boolean $tpe_eliminado) Return TipoPedido objects filtered by the tpe_eliminado column
 * @method array findByCreatedAt(string $created_at) Return TipoPedido objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return TipoPedido objects filtered by the updated_at column
 */
abstract class BaseTipoPedidoQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTipoPedidoQuery object.
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
            $modelName = 'AppBundle\\Model\\TipoPedido';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TipoPedidoQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TipoPedidoQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TipoPedidoQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TipoPedidoQuery) {
            return $criteria;
        }
        $query = new TipoPedidoQuery(null, null, $modelAlias);

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
     * @return   TipoPedido|TipoPedido[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TipoPedidoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TipoPedidoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 TipoPedido A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByTpeId($key, $con = null)
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
     * @return                 TipoPedido A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `tpe_id`, `tpe_nombre`, `tpe_estado`, `tpe_eliminado`, `created_at`, `updated_at` FROM `tipo_pedido` WHERE `tpe_id` = :p0';
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
            $obj = new TipoPedido();
            $obj->hydrate($row);
            TipoPedidoPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TipoPedido|TipoPedido[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TipoPedido[]|mixed the list of results, formatted by the current formatter
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
     * @return TipoPedidoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TipoPedidoPeer::TPE_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TipoPedidoQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TipoPedidoPeer::TPE_ID, $keys, Criteria::IN);
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
     * @param     mixed $tpeId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoPedidoQuery The current query, for fluid interface
     */
    public function filterByTpeId($tpeId = null, $comparison = null)
    {
        if (is_array($tpeId)) {
            $useMinMax = false;
            if (isset($tpeId['min'])) {
                $this->addUsingAlias(TipoPedidoPeer::TPE_ID, $tpeId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tpeId['max'])) {
                $this->addUsingAlias(TipoPedidoPeer::TPE_ID, $tpeId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoPedidoPeer::TPE_ID, $tpeId, $comparison);
    }

    /**
     * Filter the query on the tpe_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByTpeNombre('fooValue');   // WHERE tpe_nombre = 'fooValue'
     * $query->filterByTpeNombre('%fooValue%'); // WHERE tpe_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tpeNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoPedidoQuery The current query, for fluid interface
     */
    public function filterByTpeNombre($tpeNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tpeNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tpeNombre)) {
                $tpeNombre = str_replace('*', '%', $tpeNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TipoPedidoPeer::TPE_NOMBRE, $tpeNombre, $comparison);
    }

    /**
     * Filter the query on the tpe_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByTpeEstado(1234); // WHERE tpe_estado = 1234
     * $query->filterByTpeEstado(array(12, 34)); // WHERE tpe_estado IN (12, 34)
     * $query->filterByTpeEstado(array('min' => 12)); // WHERE tpe_estado >= 12
     * $query->filterByTpeEstado(array('max' => 12)); // WHERE tpe_estado <= 12
     * </code>
     *
     * @param     mixed $tpeEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoPedidoQuery The current query, for fluid interface
     */
    public function filterByTpeEstado($tpeEstado = null, $comparison = null)
    {
        if (is_array($tpeEstado)) {
            $useMinMax = false;
            if (isset($tpeEstado['min'])) {
                $this->addUsingAlias(TipoPedidoPeer::TPE_ESTADO, $tpeEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tpeEstado['max'])) {
                $this->addUsingAlias(TipoPedidoPeer::TPE_ESTADO, $tpeEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoPedidoPeer::TPE_ESTADO, $tpeEstado, $comparison);
    }

    /**
     * Filter the query on the tpe_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByTpeEliminado(true); // WHERE tpe_eliminado = true
     * $query->filterByTpeEliminado('yes'); // WHERE tpe_eliminado = true
     * </code>
     *
     * @param     boolean|string $tpeEliminado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoPedidoQuery The current query, for fluid interface
     */
    public function filterByTpeEliminado($tpeEliminado = null, $comparison = null)
    {
        if (is_string($tpeEliminado)) {
            $tpeEliminado = in_array(strtolower($tpeEliminado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TipoPedidoPeer::TPE_ELIMINADO, $tpeEliminado, $comparison);
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
     * @return TipoPedidoQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TipoPedidoPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TipoPedidoPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoPedidoPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return TipoPedidoQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TipoPedidoPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TipoPedidoPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoPedidoPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Pedido object
     *
     * @param   Pedido|PropelObjectCollection $pedido  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TipoPedidoQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPedido($pedido, $comparison = null)
    {
        if ($pedido instanceof Pedido) {
            return $this
                ->addUsingAlias(TipoPedidoPeer::TPE_ID, $pedido->getTpeId(), $comparison);
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
     * @return TipoPedidoQuery The current query, for fluid interface
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
     * @param   TipoPedido $tipoPedido Object to remove from the list of results
     *
     * @return TipoPedidoQuery The current query, for fluid interface
     */
    public function prune($tipoPedido = null)
    {
        if ($tipoPedido) {
            $this->addUsingAlias(TipoPedidoPeer::TPE_ID, $tipoPedido->getTpeId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     TipoPedidoQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TipoPedidoPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     TipoPedidoQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TipoPedidoPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     TipoPedidoQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TipoPedidoPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     TipoPedidoQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TipoPedidoPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     TipoPedidoQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TipoPedidoPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     TipoPedidoQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TipoPedidoPeer::CREATED_AT);
    }
}
