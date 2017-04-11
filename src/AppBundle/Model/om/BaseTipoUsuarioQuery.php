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
use AppBundle\Model\TipoUsuario;
use AppBundle\Model\TipoUsuarioPeer;
use AppBundle\Model\TipoUsuarioQuery;
use AppBundle\Model\Usuario;

/**
 * @method TipoUsuarioQuery orderByTsuId($order = Criteria::ASC) Order by the tsu_id column
 * @method TipoUsuarioQuery orderByUsuId($order = Criteria::ASC) Order by the usu_id column
 * @method TipoUsuarioQuery orderByTsuNombre($order = Criteria::ASC) Order by the tsu_nombre column
 * @method TipoUsuarioQuery orderByTsuEstado($order = Criteria::ASC) Order by the tsu_estado column
 * @method TipoUsuarioQuery orderByTsuEliminado($order = Criteria::ASC) Order by the tsu_eliminado column
 * @method TipoUsuarioQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method TipoUsuarioQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method TipoUsuarioQuery groupByTsuId() Group by the tsu_id column
 * @method TipoUsuarioQuery groupByUsuId() Group by the usu_id column
 * @method TipoUsuarioQuery groupByTsuNombre() Group by the tsu_nombre column
 * @method TipoUsuarioQuery groupByTsuEstado() Group by the tsu_estado column
 * @method TipoUsuarioQuery groupByTsuEliminado() Group by the tsu_eliminado column
 * @method TipoUsuarioQuery groupByCreatedAt() Group by the created_at column
 * @method TipoUsuarioQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method TipoUsuarioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TipoUsuarioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TipoUsuarioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TipoUsuarioQuery leftJoinUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the Usuario relation
 * @method TipoUsuarioQuery rightJoinUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Usuario relation
 * @method TipoUsuarioQuery innerJoinUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the Usuario relation
 *
 * @method TipoUsuario findOne(PropelPDO $con = null) Return the first TipoUsuario matching the query
 * @method TipoUsuario findOneOrCreate(PropelPDO $con = null) Return the first TipoUsuario matching the query, or a new TipoUsuario object populated from the query conditions when no match is found
 *
 * @method TipoUsuario findOneByUsuId(int $usu_id) Return the first TipoUsuario filtered by the usu_id column
 * @method TipoUsuario findOneByTsuNombre(string $tsu_nombre) Return the first TipoUsuario filtered by the tsu_nombre column
 * @method TipoUsuario findOneByTsuEstado(int $tsu_estado) Return the first TipoUsuario filtered by the tsu_estado column
 * @method TipoUsuario findOneByTsuEliminado(boolean $tsu_eliminado) Return the first TipoUsuario filtered by the tsu_eliminado column
 * @method TipoUsuario findOneByCreatedAt(string $created_at) Return the first TipoUsuario filtered by the created_at column
 * @method TipoUsuario findOneByUpdatedAt(string $updated_at) Return the first TipoUsuario filtered by the updated_at column
 *
 * @method array findByTsuId(int $tsu_id) Return TipoUsuario objects filtered by the tsu_id column
 * @method array findByUsuId(int $usu_id) Return TipoUsuario objects filtered by the usu_id column
 * @method array findByTsuNombre(string $tsu_nombre) Return TipoUsuario objects filtered by the tsu_nombre column
 * @method array findByTsuEstado(int $tsu_estado) Return TipoUsuario objects filtered by the tsu_estado column
 * @method array findByTsuEliminado(boolean $tsu_eliminado) Return TipoUsuario objects filtered by the tsu_eliminado column
 * @method array findByCreatedAt(string $created_at) Return TipoUsuario objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return TipoUsuario objects filtered by the updated_at column
 */
abstract class BaseTipoUsuarioQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTipoUsuarioQuery object.
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
            $modelName = 'AppBundle\\Model\\TipoUsuario';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TipoUsuarioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TipoUsuarioQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TipoUsuarioQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TipoUsuarioQuery) {
            return $criteria;
        }
        $query = new TipoUsuarioQuery(null, null, $modelAlias);

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
     * @return   TipoUsuario|TipoUsuario[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TipoUsuarioPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TipoUsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 TipoUsuario A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByTsuId($key, $con = null)
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
     * @return                 TipoUsuario A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `tsu_id`, `usu_id`, `tsu_nombre`, `tsu_estado`, `tsu_eliminado`, `created_at`, `updated_at` FROM `tipo_usuario` WHERE `tsu_id` = :p0';
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
            $obj = new TipoUsuario();
            $obj->hydrate($row);
            TipoUsuarioPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TipoUsuario|TipoUsuario[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TipoUsuario[]|mixed the list of results, formatted by the current formatter
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
     * @return TipoUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TipoUsuarioPeer::TSU_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TipoUsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TipoUsuarioPeer::TSU_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the tsu_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTsuId(1234); // WHERE tsu_id = 1234
     * $query->filterByTsuId(array(12, 34)); // WHERE tsu_id IN (12, 34)
     * $query->filterByTsuId(array('min' => 12)); // WHERE tsu_id >= 12
     * $query->filterByTsuId(array('max' => 12)); // WHERE tsu_id <= 12
     * </code>
     *
     * @param     mixed $tsuId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoUsuarioQuery The current query, for fluid interface
     */
    public function filterByTsuId($tsuId = null, $comparison = null)
    {
        if (is_array($tsuId)) {
            $useMinMax = false;
            if (isset($tsuId['min'])) {
                $this->addUsingAlias(TipoUsuarioPeer::TSU_ID, $tsuId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tsuId['max'])) {
                $this->addUsingAlias(TipoUsuarioPeer::TSU_ID, $tsuId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoUsuarioPeer::TSU_ID, $tsuId, $comparison);
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
     * @return TipoUsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuId($usuId = null, $comparison = null)
    {
        if (is_array($usuId)) {
            $useMinMax = false;
            if (isset($usuId['min'])) {
                $this->addUsingAlias(TipoUsuarioPeer::USU_ID, $usuId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuId['max'])) {
                $this->addUsingAlias(TipoUsuarioPeer::USU_ID, $usuId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoUsuarioPeer::USU_ID, $usuId, $comparison);
    }

    /**
     * Filter the query on the tsu_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByTsuNombre('fooValue');   // WHERE tsu_nombre = 'fooValue'
     * $query->filterByTsuNombre('%fooValue%'); // WHERE tsu_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tsuNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoUsuarioQuery The current query, for fluid interface
     */
    public function filterByTsuNombre($tsuNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tsuNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $tsuNombre)) {
                $tsuNombre = str_replace('*', '%', $tsuNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TipoUsuarioPeer::TSU_NOMBRE, $tsuNombre, $comparison);
    }

    /**
     * Filter the query on the tsu_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByTsuEstado(1234); // WHERE tsu_estado = 1234
     * $query->filterByTsuEstado(array(12, 34)); // WHERE tsu_estado IN (12, 34)
     * $query->filterByTsuEstado(array('min' => 12)); // WHERE tsu_estado >= 12
     * $query->filterByTsuEstado(array('max' => 12)); // WHERE tsu_estado <= 12
     * </code>
     *
     * @param     mixed $tsuEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoUsuarioQuery The current query, for fluid interface
     */
    public function filterByTsuEstado($tsuEstado = null, $comparison = null)
    {
        if (is_array($tsuEstado)) {
            $useMinMax = false;
            if (isset($tsuEstado['min'])) {
                $this->addUsingAlias(TipoUsuarioPeer::TSU_ESTADO, $tsuEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tsuEstado['max'])) {
                $this->addUsingAlias(TipoUsuarioPeer::TSU_ESTADO, $tsuEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoUsuarioPeer::TSU_ESTADO, $tsuEstado, $comparison);
    }

    /**
     * Filter the query on the tsu_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByTsuEliminado(true); // WHERE tsu_eliminado = true
     * $query->filterByTsuEliminado('yes'); // WHERE tsu_eliminado = true
     * </code>
     *
     * @param     boolean|string $tsuEliminado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TipoUsuarioQuery The current query, for fluid interface
     */
    public function filterByTsuEliminado($tsuEliminado = null, $comparison = null)
    {
        if (is_string($tsuEliminado)) {
            $tsuEliminado = in_array(strtolower($tsuEliminado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(TipoUsuarioPeer::TSU_ELIMINADO, $tsuEliminado, $comparison);
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
     * @return TipoUsuarioQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(TipoUsuarioPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(TipoUsuarioPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoUsuarioPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return TipoUsuarioQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(TipoUsuarioPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(TipoUsuarioPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TipoUsuarioPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Usuario object
     *
     * @param   Usuario|PropelObjectCollection $usuario The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TipoUsuarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsuario($usuario, $comparison = null)
    {
        if ($usuario instanceof Usuario) {
            return $this
                ->addUsingAlias(TipoUsuarioPeer::USU_ID, $usuario->getUsuId(), $comparison);
        } elseif ($usuario instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TipoUsuarioPeer::USU_ID, $usuario->toKeyValue('PrimaryKey', 'UsuId'), $comparison);
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
     * @return TipoUsuarioQuery The current query, for fluid interface
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
     * @param   TipoUsuario $tipoUsuario Object to remove from the list of results
     *
     * @return TipoUsuarioQuery The current query, for fluid interface
     */
    public function prune($tipoUsuario = null)
    {
        if ($tipoUsuario) {
            $this->addUsingAlias(TipoUsuarioPeer::TSU_ID, $tipoUsuario->getTsuId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     TipoUsuarioQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(TipoUsuarioPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     TipoUsuarioQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(TipoUsuarioPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     TipoUsuarioQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(TipoUsuarioPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     TipoUsuarioQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(TipoUsuarioPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     TipoUsuarioQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(TipoUsuarioPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     TipoUsuarioQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(TipoUsuarioPeer::CREATED_AT);
    }
}
