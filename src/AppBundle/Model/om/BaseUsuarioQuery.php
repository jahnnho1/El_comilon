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
use AppBundle\Model\Recurso;
use AppBundle\Model\Resturant;
use AppBundle\Model\TipoUsuario;
use AppBundle\Model\Usuario;
use AppBundle\Model\UsuarioPeer;
use AppBundle\Model\UsuarioQuery;

/**
 * @method UsuarioQuery orderByUsuId($order = Criteria::ASC) Order by the usu_id column
 * @method UsuarioQuery orderByResId($order = Criteria::ASC) Order by the res_id column
 * @method UsuarioQuery orderByUsuNombre($order = Criteria::ASC) Order by the usu_nombre column
 * @method UsuarioQuery orderByUsuApellido($order = Criteria::ASC) Order by the usu_apellido column
 * @method UsuarioQuery orderByUsuClave($order = Criteria::ASC) Order by the usu_clave column
 * @method UsuarioQuery orderByUsuTelefono($order = Criteria::ASC) Order by the usu_telefono column
 * @method UsuarioQuery orderByUsuEmail($order = Criteria::ASC) Order by the usu_email column
 * @method UsuarioQuery orderByUsuEstado($order = Criteria::ASC) Order by the usu_estado column
 * @method UsuarioQuery orderByUsuEliminado($order = Criteria::ASC) Order by the usu_eliminado column
 * @method UsuarioQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method UsuarioQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method UsuarioQuery groupByUsuId() Group by the usu_id column
 * @method UsuarioQuery groupByResId() Group by the res_id column
 * @method UsuarioQuery groupByUsuNombre() Group by the usu_nombre column
 * @method UsuarioQuery groupByUsuApellido() Group by the usu_apellido column
 * @method UsuarioQuery groupByUsuClave() Group by the usu_clave column
 * @method UsuarioQuery groupByUsuTelefono() Group by the usu_telefono column
 * @method UsuarioQuery groupByUsuEmail() Group by the usu_email column
 * @method UsuarioQuery groupByUsuEstado() Group by the usu_estado column
 * @method UsuarioQuery groupByUsuEliminado() Group by the usu_eliminado column
 * @method UsuarioQuery groupByCreatedAt() Group by the created_at column
 * @method UsuarioQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method UsuarioQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UsuarioQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UsuarioQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UsuarioQuery leftJoinResturant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Resturant relation
 * @method UsuarioQuery rightJoinResturant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Resturant relation
 * @method UsuarioQuery innerJoinResturant($relationAlias = null) Adds a INNER JOIN clause to the query using the Resturant relation
 *
 * @method UsuarioQuery leftJoinPedido($relationAlias = null) Adds a LEFT JOIN clause to the query using the Pedido relation
 * @method UsuarioQuery rightJoinPedido($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Pedido relation
 * @method UsuarioQuery innerJoinPedido($relationAlias = null) Adds a INNER JOIN clause to the query using the Pedido relation
 *
 * @method UsuarioQuery leftJoinRecurso($relationAlias = null) Adds a LEFT JOIN clause to the query using the Recurso relation
 * @method UsuarioQuery rightJoinRecurso($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Recurso relation
 * @method UsuarioQuery innerJoinRecurso($relationAlias = null) Adds a INNER JOIN clause to the query using the Recurso relation
 *
 * @method UsuarioQuery leftJoinTipoUsuario($relationAlias = null) Adds a LEFT JOIN clause to the query using the TipoUsuario relation
 * @method UsuarioQuery rightJoinTipoUsuario($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TipoUsuario relation
 * @method UsuarioQuery innerJoinTipoUsuario($relationAlias = null) Adds a INNER JOIN clause to the query using the TipoUsuario relation
 *
 * @method Usuario findOne(PropelPDO $con = null) Return the first Usuario matching the query
 * @method Usuario findOneOrCreate(PropelPDO $con = null) Return the first Usuario matching the query, or a new Usuario object populated from the query conditions when no match is found
 *
 * @method Usuario findOneByResId(int $res_id) Return the first Usuario filtered by the res_id column
 * @method Usuario findOneByUsuNombre(string $usu_nombre) Return the first Usuario filtered by the usu_nombre column
 * @method Usuario findOneByUsuApellido(string $usu_apellido) Return the first Usuario filtered by the usu_apellido column
 * @method Usuario findOneByUsuClave(string $usu_clave) Return the first Usuario filtered by the usu_clave column
 * @method Usuario findOneByUsuTelefono(string $usu_telefono) Return the first Usuario filtered by the usu_telefono column
 * @method Usuario findOneByUsuEmail(string $usu_email) Return the first Usuario filtered by the usu_email column
 * @method Usuario findOneByUsuEstado(int $usu_estado) Return the first Usuario filtered by the usu_estado column
 * @method Usuario findOneByUsuEliminado(boolean $usu_eliminado) Return the first Usuario filtered by the usu_eliminado column
 * @method Usuario findOneByCreatedAt(string $created_at) Return the first Usuario filtered by the created_at column
 * @method Usuario findOneByUpdatedAt(string $updated_at) Return the first Usuario filtered by the updated_at column
 *
 * @method array findByUsuId(int $usu_id) Return Usuario objects filtered by the usu_id column
 * @method array findByResId(int $res_id) Return Usuario objects filtered by the res_id column
 * @method array findByUsuNombre(string $usu_nombre) Return Usuario objects filtered by the usu_nombre column
 * @method array findByUsuApellido(string $usu_apellido) Return Usuario objects filtered by the usu_apellido column
 * @method array findByUsuClave(string $usu_clave) Return Usuario objects filtered by the usu_clave column
 * @method array findByUsuTelefono(string $usu_telefono) Return Usuario objects filtered by the usu_telefono column
 * @method array findByUsuEmail(string $usu_email) Return Usuario objects filtered by the usu_email column
 * @method array findByUsuEstado(int $usu_estado) Return Usuario objects filtered by the usu_estado column
 * @method array findByUsuEliminado(boolean $usu_eliminado) Return Usuario objects filtered by the usu_eliminado column
 * @method array findByCreatedAt(string $created_at) Return Usuario objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Usuario objects filtered by the updated_at column
 */
abstract class BaseUsuarioQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUsuarioQuery object.
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
            $modelName = 'AppBundle\\Model\\Usuario';
        }
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UsuarioQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UsuarioQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UsuarioQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UsuarioQuery) {
            return $criteria;
        }
        $query = new UsuarioQuery(null, null, $modelAlias);

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
     * @return   Usuario|Usuario[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UsuarioPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Usuario A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneByUsuId($key, $con = null)
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
     * @return                 Usuario A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `usu_id`, `res_id`, `usu_nombre`, `usu_apellido`, `usu_clave`, `usu_telefono`, `usu_email`, `usu_estado`, `usu_eliminado`, `created_at`, `updated_at` FROM `usuario` WHERE `usu_id` = :p0';
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
            $obj = new Usuario();
            $obj->hydrate($row);
            UsuarioPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Usuario|Usuario[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Usuario[]|mixed the list of results, formatted by the current formatter
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
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UsuarioPeer::USU_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UsuarioPeer::USU_ID, $keys, Criteria::IN);
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
     * @param     mixed $usuId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuId($usuId = null, $comparison = null)
    {
        if (is_array($usuId)) {
            $useMinMax = false;
            if (isset($usuId['min'])) {
                $this->addUsingAlias(UsuarioPeer::USU_ID, $usuId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuId['max'])) {
                $this->addUsingAlias(UsuarioPeer::USU_ID, $usuId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::USU_ID, $usuId, $comparison);
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
     * @see       filterByResturant()
     *
     * @param     mixed $resId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByResId($resId = null, $comparison = null)
    {
        if (is_array($resId)) {
            $useMinMax = false;
            if (isset($resId['min'])) {
                $this->addUsingAlias(UsuarioPeer::RES_ID, $resId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($resId['max'])) {
                $this->addUsingAlias(UsuarioPeer::RES_ID, $resId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::RES_ID, $resId, $comparison);
    }

    /**
     * Filter the query on the usu_nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuNombre('fooValue');   // WHERE usu_nombre = 'fooValue'
     * $query->filterByUsuNombre('%fooValue%'); // WHERE usu_nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuNombre The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuNombre($usuNombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuNombre)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuNombre)) {
                $usuNombre = str_replace('*', '%', $usuNombre);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::USU_NOMBRE, $usuNombre, $comparison);
    }

    /**
     * Filter the query on the usu_apellido column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuApellido('fooValue');   // WHERE usu_apellido = 'fooValue'
     * $query->filterByUsuApellido('%fooValue%'); // WHERE usu_apellido LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuApellido The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuApellido($usuApellido = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuApellido)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuApellido)) {
                $usuApellido = str_replace('*', '%', $usuApellido);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::USU_APELLIDO, $usuApellido, $comparison);
    }

    /**
     * Filter the query on the usu_clave column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuClave('fooValue');   // WHERE usu_clave = 'fooValue'
     * $query->filterByUsuClave('%fooValue%'); // WHERE usu_clave LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuClave The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuClave($usuClave = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuClave)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuClave)) {
                $usuClave = str_replace('*', '%', $usuClave);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::USU_CLAVE, $usuClave, $comparison);
    }

    /**
     * Filter the query on the usu_telefono column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuTelefono('fooValue');   // WHERE usu_telefono = 'fooValue'
     * $query->filterByUsuTelefono('%fooValue%'); // WHERE usu_telefono LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuTelefono The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuTelefono($usuTelefono = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuTelefono)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuTelefono)) {
                $usuTelefono = str_replace('*', '%', $usuTelefono);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::USU_TELEFONO, $usuTelefono, $comparison);
    }

    /**
     * Filter the query on the usu_email column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuEmail('fooValue');   // WHERE usu_email = 'fooValue'
     * $query->filterByUsuEmail('%fooValue%'); // WHERE usu_email LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usuEmail The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuEmail($usuEmail = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usuEmail)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usuEmail)) {
                $usuEmail = str_replace('*', '%', $usuEmail);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::USU_EMAIL, $usuEmail, $comparison);
    }

    /**
     * Filter the query on the usu_estado column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuEstado(1234); // WHERE usu_estado = 1234
     * $query->filterByUsuEstado(array(12, 34)); // WHERE usu_estado IN (12, 34)
     * $query->filterByUsuEstado(array('min' => 12)); // WHERE usu_estado >= 12
     * $query->filterByUsuEstado(array('max' => 12)); // WHERE usu_estado <= 12
     * </code>
     *
     * @param     mixed $usuEstado The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuEstado($usuEstado = null, $comparison = null)
    {
        if (is_array($usuEstado)) {
            $useMinMax = false;
            if (isset($usuEstado['min'])) {
                $this->addUsingAlias(UsuarioPeer::USU_ESTADO, $usuEstado['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usuEstado['max'])) {
                $this->addUsingAlias(UsuarioPeer::USU_ESTADO, $usuEstado['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::USU_ESTADO, $usuEstado, $comparison);
    }

    /**
     * Filter the query on the usu_eliminado column
     *
     * Example usage:
     * <code>
     * $query->filterByUsuEliminado(true); // WHERE usu_eliminado = true
     * $query->filterByUsuEliminado('yes'); // WHERE usu_eliminado = true
     * </code>
     *
     * @param     boolean|string $usuEliminado The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUsuEliminado($usuEliminado = null, $comparison = null)
    {
        if (is_string($usuEliminado)) {
            $usuEliminado = in_array(strtolower($usuEliminado), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UsuarioPeer::USU_ELIMINADO, $usuEliminado, $comparison);
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
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UsuarioPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UsuarioPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UsuarioPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UsuarioPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UsuarioPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Resturant object
     *
     * @param   Resturant|PropelObjectCollection $resturant The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByResturant($resturant, $comparison = null)
    {
        if ($resturant instanceof Resturant) {
            return $this
                ->addUsingAlias(UsuarioPeer::RES_ID, $resturant->getResId(), $comparison);
        } elseif ($resturant instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UsuarioPeer::RES_ID, $resturant->toKeyValue('PrimaryKey', 'ResId'), $comparison);
        } else {
            throw new PropelException('filterByResturant() only accepts arguments of type Resturant or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Resturant relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function joinResturant($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Resturant');

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
            $this->addJoinObject($join, 'Resturant');
        }

        return $this;
    }

    /**
     * Use the Resturant relation Resturant object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\ResturantQuery A secondary query class using the current class as primary query
     */
    public function useResturantQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinResturant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Resturant', '\AppBundle\Model\ResturantQuery');
    }

    /**
     * Filter the query by a related Pedido object
     *
     * @param   Pedido|PropelObjectCollection $pedido  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByPedido($pedido, $comparison = null)
    {
        if ($pedido instanceof Pedido) {
            return $this
                ->addUsingAlias(UsuarioPeer::USU_ID, $pedido->getUsuId(), $comparison);
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
     * @return UsuarioQuery The current query, for fluid interface
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
     * Filter the query by a related Recurso object
     *
     * @param   Recurso|PropelObjectCollection $recurso  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRecurso($recurso, $comparison = null)
    {
        if ($recurso instanceof Recurso) {
            return $this
                ->addUsingAlias(UsuarioPeer::USU_ID, $recurso->getUsuId(), $comparison);
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
     * @return UsuarioQuery The current query, for fluid interface
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
     * Filter the query by a related TipoUsuario object
     *
     * @param   TipoUsuario|PropelObjectCollection $tipoUsuario  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UsuarioQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTipoUsuario($tipoUsuario, $comparison = null)
    {
        if ($tipoUsuario instanceof TipoUsuario) {
            return $this
                ->addUsingAlias(UsuarioPeer::USU_ID, $tipoUsuario->getUsuId(), $comparison);
        } elseif ($tipoUsuario instanceof PropelObjectCollection) {
            return $this
                ->useTipoUsuarioQuery()
                ->filterByPrimaryKeys($tipoUsuario->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTipoUsuario() only accepts arguments of type TipoUsuario or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TipoUsuario relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function joinTipoUsuario($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TipoUsuario');

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
            $this->addJoinObject($join, 'TipoUsuario');
        }

        return $this;
    }

    /**
     * Use the TipoUsuario relation TipoUsuario object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \AppBundle\Model\TipoUsuarioQuery A secondary query class using the current class as primary query
     */
    public function useTipoUsuarioQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTipoUsuario($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TipoUsuario', '\AppBundle\Model\TipoUsuarioQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Usuario $usuario Object to remove from the list of results
     *
     * @return UsuarioQuery The current query, for fluid interface
     */
    public function prune($usuario = null)
    {
        if ($usuario) {
            $this->addUsingAlias(UsuarioPeer::USU_ID, $usuario->getUsuId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuarioPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuarioPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuarioPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UsuarioPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UsuarioPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     UsuarioQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UsuarioPeer::CREATED_AT);
    }
}
