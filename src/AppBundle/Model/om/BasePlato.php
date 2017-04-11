<?php

namespace AppBundle\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use AppBundle\Model\Plato;
use AppBundle\Model\PlatoPedido;
use AppBundle\Model\PlatoPedidoQuery;
use AppBundle\Model\PlatoPeer;
use AppBundle\Model\PlatoQuery;
use AppBundle\Model\Recurso;
use AppBundle\Model\RecursoQuery;

abstract class BasePlato extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\PlatoPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        PlatoPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the pla_id field.
     * @var        int
     */
    protected $pla_id;

    /**
     * The value for the pla_nombre field.
     * @var        string
     */
    protected $pla_nombre;

    /**
     * The value for the pla_descripcion field.
     * @var        string
     */
    protected $pla_descripcion;

    /**
     * The value for the pla_precio field.
     * @var        string
     */
    protected $pla_precio;

    /**
     * The value for the pla_stock field.
     * @var        string
     */
    protected $pla_stock;

    /**
     * The value for the pla_estado field.
     * @var        int
     */
    protected $pla_estado;

    /**
     * The value for the pla_eliminado field.
     * @var        boolean
     */
    protected $pla_eliminado;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        PropelObjectCollection|PlatoPedido[] Collection to store aggregation of PlatoPedido objects.
     */
    protected $collPlatoPedidos;
    protected $collPlatoPedidosPartial;

    /**
     * @var        PropelObjectCollection|Recurso[] Collection to store aggregation of Recurso objects.
     */
    protected $collRecursos;
    protected $collRecursosPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $platoPedidosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $recursosScheduledForDeletion = null;

    /**
     * Get the [pla_id] column value.
     *
     * @return int
     */
    public function getPlaId()
    {

        return $this->pla_id;
    }

    /**
     * Get the [pla_nombre] column value.
     *
     * @return string
     */
    public function getPlaNombre()
    {

        return $this->pla_nombre;
    }

    /**
     * Get the [pla_descripcion] column value.
     *
     * @return string
     */
    public function getPlaDescripcion()
    {

        return $this->pla_descripcion;
    }

    /**
     * Get the [pla_precio] column value.
     *
     * @return string
     */
    public function getPlaPrecio()
    {

        return $this->pla_precio;
    }

    /**
     * Get the [pla_stock] column value.
     *
     * @return string
     */
    public function getPlaStock()
    {

        return $this->pla_stock;
    }

    /**
     * Get the [pla_estado] column value.
     *
     * @return int
     */
    public function getPlaEstado()
    {

        return $this->pla_estado;
    }

    /**
     * Get the [pla_eliminado] column value.
     *
     * @return boolean
     */
    public function getPlaEliminado()
    {

        return $this->pla_eliminado;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = null)
    {
        if ($this->created_at === null) {
            return null;
        }

        if ($this->created_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->created_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = null)
    {
        if ($this->updated_at === null) {
            return null;
        }

        if ($this->updated_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->updated_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Set the value of [pla_id] column.
     *
     * @param  int $v new value
     * @return Plato The current object (for fluent API support)
     */
    public function setPlaId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->pla_id !== $v) {
            $this->pla_id = $v;
            $this->modifiedColumns[] = PlatoPeer::PLA_ID;
        }


        return $this;
    } // setPlaId()

    /**
     * Set the value of [pla_nombre] column.
     *
     * @param  string $v new value
     * @return Plato The current object (for fluent API support)
     */
    public function setPlaNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pla_nombre !== $v) {
            $this->pla_nombre = $v;
            $this->modifiedColumns[] = PlatoPeer::PLA_NOMBRE;
        }


        return $this;
    } // setPlaNombre()

    /**
     * Set the value of [pla_descripcion] column.
     *
     * @param  string $v new value
     * @return Plato The current object (for fluent API support)
     */
    public function setPlaDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pla_descripcion !== $v) {
            $this->pla_descripcion = $v;
            $this->modifiedColumns[] = PlatoPeer::PLA_DESCRIPCION;
        }


        return $this;
    } // setPlaDescripcion()

    /**
     * Set the value of [pla_precio] column.
     *
     * @param  string $v new value
     * @return Plato The current object (for fluent API support)
     */
    public function setPlaPrecio($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->pla_precio !== $v) {
            $this->pla_precio = $v;
            $this->modifiedColumns[] = PlatoPeer::PLA_PRECIO;
        }


        return $this;
    } // setPlaPrecio()

    /**
     * Set the value of [pla_stock] column.
     *
     * @param  string $v new value
     * @return Plato The current object (for fluent API support)
     */
    public function setPlaStock($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->pla_stock !== $v) {
            $this->pla_stock = $v;
            $this->modifiedColumns[] = PlatoPeer::PLA_STOCK;
        }


        return $this;
    } // setPlaStock()

    /**
     * Set the value of [pla_estado] column.
     *
     * @param  int $v new value
     * @return Plato The current object (for fluent API support)
     */
    public function setPlaEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->pla_estado !== $v) {
            $this->pla_estado = $v;
            $this->modifiedColumns[] = PlatoPeer::PLA_ESTADO;
        }


        return $this;
    } // setPlaEstado()

    /**
     * Sets the value of the [pla_eliminado] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Plato The current object (for fluent API support)
     */
    public function setPlaEliminado($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->pla_eliminado !== $v) {
            $this->pla_eliminado = $v;
            $this->modifiedColumns[] = PlatoPeer::PLA_ELIMINADO;
        }


        return $this;
    } // setPlaEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Plato The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = PlatoPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Plato The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = PlatoPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->pla_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->pla_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->pla_descripcion = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->pla_precio = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->pla_stock = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->pla_estado = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->pla_eliminado = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
            $this->created_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->updated_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 9; // 9 = PlatoPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Plato object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(PlatoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = PlatoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collPlatoPedidos = null;

            $this->collRecursos = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(PlatoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = PlatoQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(PlatoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(PlatoPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(PlatoPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(PlatoPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                PlatoPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->platoPedidosScheduledForDeletion !== null) {
                if (!$this->platoPedidosScheduledForDeletion->isEmpty()) {
                    PlatoPedidoQuery::create()
                        ->filterByPrimaryKeys($this->platoPedidosScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->platoPedidosScheduledForDeletion = null;
                }
            }

            if ($this->collPlatoPedidos !== null) {
                foreach ($this->collPlatoPedidos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->recursosScheduledForDeletion !== null) {
                if (!$this->recursosScheduledForDeletion->isEmpty()) {
                    foreach ($this->recursosScheduledForDeletion as $recurso) {
                        // need to save related object because we set the relation to null
                        $recurso->save($con);
                    }
                    $this->recursosScheduledForDeletion = null;
                }
            }

            if ($this->collRecursos !== null) {
                foreach ($this->collRecursos as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = PlatoPeer::PLA_ID;
        if (null !== $this->pla_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . PlatoPeer::PLA_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(PlatoPeer::PLA_ID)) {
            $modifiedColumns[':p' . $index++]  = '`pla_id`';
        }
        if ($this->isColumnModified(PlatoPeer::PLA_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = '`pla_nombre`';
        }
        if ($this->isColumnModified(PlatoPeer::PLA_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = '`pla_descripcion`';
        }
        if ($this->isColumnModified(PlatoPeer::PLA_PRECIO)) {
            $modifiedColumns[':p' . $index++]  = '`pla_precio`';
        }
        if ($this->isColumnModified(PlatoPeer::PLA_STOCK)) {
            $modifiedColumns[':p' . $index++]  = '`pla_stock`';
        }
        if ($this->isColumnModified(PlatoPeer::PLA_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`pla_estado`';
        }
        if ($this->isColumnModified(PlatoPeer::PLA_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`pla_eliminado`';
        }
        if ($this->isColumnModified(PlatoPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(PlatoPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `plato` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`pla_id`':
                        $stmt->bindValue($identifier, $this->pla_id, PDO::PARAM_INT);
                        break;
                    case '`pla_nombre`':
                        $stmt->bindValue($identifier, $this->pla_nombre, PDO::PARAM_STR);
                        break;
                    case '`pla_descripcion`':
                        $stmt->bindValue($identifier, $this->pla_descripcion, PDO::PARAM_STR);
                        break;
                    case '`pla_precio`':
                        $stmt->bindValue($identifier, $this->pla_precio, PDO::PARAM_STR);
                        break;
                    case '`pla_stock`':
                        $stmt->bindValue($identifier, $this->pla_stock, PDO::PARAM_STR);
                        break;
                    case '`pla_estado`':
                        $stmt->bindValue($identifier, $this->pla_estado, PDO::PARAM_INT);
                        break;
                    case '`pla_eliminado`':
                        $stmt->bindValue($identifier, (int) $this->pla_eliminado, PDO::PARAM_INT);
                        break;
                    case '`created_at`':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case '`updated_at`':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setPlaId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            if (($retval = PlatoPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPlatoPedidos !== null) {
                    foreach ($this->collPlatoPedidos as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRecursos !== null) {
                    foreach ($this->collRecursos as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = PlatoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getPlaId();
                break;
            case 1:
                return $this->getPlaNombre();
                break;
            case 2:
                return $this->getPlaDescripcion();
                break;
            case 3:
                return $this->getPlaPrecio();
                break;
            case 4:
                return $this->getPlaStock();
                break;
            case 5:
                return $this->getPlaEstado();
                break;
            case 6:
                return $this->getPlaEliminado();
                break;
            case 7:
                return $this->getCreatedAt();
                break;
            case 8:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['Plato'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Plato'][$this->getPrimaryKey()] = true;
        $keys = PlatoPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPlaId(),
            $keys[1] => $this->getPlaNombre(),
            $keys[2] => $this->getPlaDescripcion(),
            $keys[3] => $this->getPlaPrecio(),
            $keys[4] => $this->getPlaStock(),
            $keys[5] => $this->getPlaEstado(),
            $keys[6] => $this->getPlaEliminado(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collPlatoPedidos) {
                $result['PlatoPedidos'] = $this->collPlatoPedidos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRecursos) {
                $result['Recursos'] = $this->collRecursos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = PlatoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPlaId($value);
                break;
            case 1:
                $this->setPlaNombre($value);
                break;
            case 2:
                $this->setPlaDescripcion($value);
                break;
            case 3:
                $this->setPlaPrecio($value);
                break;
            case 4:
                $this->setPlaStock($value);
                break;
            case 5:
                $this->setPlaEstado($value);
                break;
            case 6:
                $this->setPlaEliminado($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = PlatoPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setPlaId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setPlaNombre($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPlaDescripcion($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setPlaPrecio($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setPlaStock($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setPlaEstado($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setPlaEliminado($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(PlatoPeer::DATABASE_NAME);

        if ($this->isColumnModified(PlatoPeer::PLA_ID)) $criteria->add(PlatoPeer::PLA_ID, $this->pla_id);
        if ($this->isColumnModified(PlatoPeer::PLA_NOMBRE)) $criteria->add(PlatoPeer::PLA_NOMBRE, $this->pla_nombre);
        if ($this->isColumnModified(PlatoPeer::PLA_DESCRIPCION)) $criteria->add(PlatoPeer::PLA_DESCRIPCION, $this->pla_descripcion);
        if ($this->isColumnModified(PlatoPeer::PLA_PRECIO)) $criteria->add(PlatoPeer::PLA_PRECIO, $this->pla_precio);
        if ($this->isColumnModified(PlatoPeer::PLA_STOCK)) $criteria->add(PlatoPeer::PLA_STOCK, $this->pla_stock);
        if ($this->isColumnModified(PlatoPeer::PLA_ESTADO)) $criteria->add(PlatoPeer::PLA_ESTADO, $this->pla_estado);
        if ($this->isColumnModified(PlatoPeer::PLA_ELIMINADO)) $criteria->add(PlatoPeer::PLA_ELIMINADO, $this->pla_eliminado);
        if ($this->isColumnModified(PlatoPeer::CREATED_AT)) $criteria->add(PlatoPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(PlatoPeer::UPDATED_AT)) $criteria->add(PlatoPeer::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(PlatoPeer::DATABASE_NAME);
        $criteria->add(PlatoPeer::PLA_ID, $this->pla_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getPlaId();
    }

    /**
     * Generic method to set the primary key (pla_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPlaId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getPlaId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Plato (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPlaNombre($this->getPlaNombre());
        $copyObj->setPlaDescripcion($this->getPlaDescripcion());
        $copyObj->setPlaPrecio($this->getPlaPrecio());
        $copyObj->setPlaStock($this->getPlaStock());
        $copyObj->setPlaEstado($this->getPlaEstado());
        $copyObj->setPlaEliminado($this->getPlaEliminado());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPlatoPedidos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPlatoPedido($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRecursos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRecurso($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPlaId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return Plato Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return PlatoPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new PlatoPeer();
        }

        return self::$peer;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('PlatoPedido' == $relationName) {
            $this->initPlatoPedidos();
        }
        if ('Recurso' == $relationName) {
            $this->initRecursos();
        }
    }

    /**
     * Clears out the collPlatoPedidos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Plato The current object (for fluent API support)
     * @see        addPlatoPedidos()
     */
    public function clearPlatoPedidos()
    {
        $this->collPlatoPedidos = null; // important to set this to null since that means it is uninitialized
        $this->collPlatoPedidosPartial = null;

        return $this;
    }

    /**
     * reset is the collPlatoPedidos collection loaded partially
     *
     * @return void
     */
    public function resetPartialPlatoPedidos($v = true)
    {
        $this->collPlatoPedidosPartial = $v;
    }

    /**
     * Initializes the collPlatoPedidos collection.
     *
     * By default this just sets the collPlatoPedidos collection to an empty array (like clearcollPlatoPedidos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPlatoPedidos($overrideExisting = true)
    {
        if (null !== $this->collPlatoPedidos && !$overrideExisting) {
            return;
        }
        $this->collPlatoPedidos = new PropelObjectCollection();
        $this->collPlatoPedidos->setModel('PlatoPedido');
    }

    /**
     * Gets an array of PlatoPedido objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Plato is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|PlatoPedido[] List of PlatoPedido objects
     * @throws PropelException
     */
    public function getPlatoPedidos($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPlatoPedidosPartial && !$this->isNew();
        if (null === $this->collPlatoPedidos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPlatoPedidos) {
                // return empty collection
                $this->initPlatoPedidos();
            } else {
                $collPlatoPedidos = PlatoPedidoQuery::create(null, $criteria)
                    ->filterByPlato($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPlatoPedidosPartial && count($collPlatoPedidos)) {
                      $this->initPlatoPedidos(false);

                      foreach ($collPlatoPedidos as $obj) {
                        if (false == $this->collPlatoPedidos->contains($obj)) {
                          $this->collPlatoPedidos->append($obj);
                        }
                      }

                      $this->collPlatoPedidosPartial = true;
                    }

                    $collPlatoPedidos->getInternalIterator()->rewind();

                    return $collPlatoPedidos;
                }

                if ($partial && $this->collPlatoPedidos) {
                    foreach ($this->collPlatoPedidos as $obj) {
                        if ($obj->isNew()) {
                            $collPlatoPedidos[] = $obj;
                        }
                    }
                }

                $this->collPlatoPedidos = $collPlatoPedidos;
                $this->collPlatoPedidosPartial = false;
            }
        }

        return $this->collPlatoPedidos;
    }

    /**
     * Sets a collection of PlatoPedido objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $platoPedidos A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Plato The current object (for fluent API support)
     */
    public function setPlatoPedidos(PropelCollection $platoPedidos, PropelPDO $con = null)
    {
        $platoPedidosToDelete = $this->getPlatoPedidos(new Criteria(), $con)->diff($platoPedidos);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->platoPedidosScheduledForDeletion = clone $platoPedidosToDelete;

        foreach ($platoPedidosToDelete as $platoPedidoRemoved) {
            $platoPedidoRemoved->setPlato(null);
        }

        $this->collPlatoPedidos = null;
        foreach ($platoPedidos as $platoPedido) {
            $this->addPlatoPedido($platoPedido);
        }

        $this->collPlatoPedidos = $platoPedidos;
        $this->collPlatoPedidosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related PlatoPedido objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related PlatoPedido objects.
     * @throws PropelException
     */
    public function countPlatoPedidos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPlatoPedidosPartial && !$this->isNew();
        if (null === $this->collPlatoPedidos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPlatoPedidos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPlatoPedidos());
            }
            $query = PlatoPedidoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPlato($this)
                ->count($con);
        }

        return count($this->collPlatoPedidos);
    }

    /**
     * Method called to associate a PlatoPedido object to this object
     * through the PlatoPedido foreign key attribute.
     *
     * @param    PlatoPedido $l PlatoPedido
     * @return Plato The current object (for fluent API support)
     */
    public function addPlatoPedido(PlatoPedido $l)
    {
        if ($this->collPlatoPedidos === null) {
            $this->initPlatoPedidos();
            $this->collPlatoPedidosPartial = true;
        }

        if (!in_array($l, $this->collPlatoPedidos->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPlatoPedido($l);

            if ($this->platoPedidosScheduledForDeletion and $this->platoPedidosScheduledForDeletion->contains($l)) {
                $this->platoPedidosScheduledForDeletion->remove($this->platoPedidosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	PlatoPedido $platoPedido The platoPedido object to add.
     */
    protected function doAddPlatoPedido($platoPedido)
    {
        $this->collPlatoPedidos[]= $platoPedido;
        $platoPedido->setPlato($this);
    }

    /**
     * @param	PlatoPedido $platoPedido The platoPedido object to remove.
     * @return Plato The current object (for fluent API support)
     */
    public function removePlatoPedido($platoPedido)
    {
        if ($this->getPlatoPedidos()->contains($platoPedido)) {
            $this->collPlatoPedidos->remove($this->collPlatoPedidos->search($platoPedido));
            if (null === $this->platoPedidosScheduledForDeletion) {
                $this->platoPedidosScheduledForDeletion = clone $this->collPlatoPedidos;
                $this->platoPedidosScheduledForDeletion->clear();
            }
            $this->platoPedidosScheduledForDeletion[]= clone $platoPedido;
            $platoPedido->setPlato(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Plato is new, it will return
     * an empty collection; or if this Plato has previously
     * been saved, it will retrieve related PlatoPedidos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Plato.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|PlatoPedido[] List of PlatoPedido objects
     */
    public function getPlatoPedidosJoinPedido($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PlatoPedidoQuery::create(null, $criteria);
        $query->joinWith('Pedido', $join_behavior);

        return $this->getPlatoPedidos($query, $con);
    }

    /**
     * Clears out the collRecursos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Plato The current object (for fluent API support)
     * @see        addRecursos()
     */
    public function clearRecursos()
    {
        $this->collRecursos = null; // important to set this to null since that means it is uninitialized
        $this->collRecursosPartial = null;

        return $this;
    }

    /**
     * reset is the collRecursos collection loaded partially
     *
     * @return void
     */
    public function resetPartialRecursos($v = true)
    {
        $this->collRecursosPartial = $v;
    }

    /**
     * Initializes the collRecursos collection.
     *
     * By default this just sets the collRecursos collection to an empty array (like clearcollRecursos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRecursos($overrideExisting = true)
    {
        if (null !== $this->collRecursos && !$overrideExisting) {
            return;
        }
        $this->collRecursos = new PropelObjectCollection();
        $this->collRecursos->setModel('Recurso');
    }

    /**
     * Gets an array of Recurso objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Plato is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Recurso[] List of Recurso objects
     * @throws PropelException
     */
    public function getRecursos($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRecursosPartial && !$this->isNew();
        if (null === $this->collRecursos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRecursos) {
                // return empty collection
                $this->initRecursos();
            } else {
                $collRecursos = RecursoQuery::create(null, $criteria)
                    ->filterByPlato($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRecursosPartial && count($collRecursos)) {
                      $this->initRecursos(false);

                      foreach ($collRecursos as $obj) {
                        if (false == $this->collRecursos->contains($obj)) {
                          $this->collRecursos->append($obj);
                        }
                      }

                      $this->collRecursosPartial = true;
                    }

                    $collRecursos->getInternalIterator()->rewind();

                    return $collRecursos;
                }

                if ($partial && $this->collRecursos) {
                    foreach ($this->collRecursos as $obj) {
                        if ($obj->isNew()) {
                            $collRecursos[] = $obj;
                        }
                    }
                }

                $this->collRecursos = $collRecursos;
                $this->collRecursosPartial = false;
            }
        }

        return $this->collRecursos;
    }

    /**
     * Sets a collection of Recurso objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $recursos A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Plato The current object (for fluent API support)
     */
    public function setRecursos(PropelCollection $recursos, PropelPDO $con = null)
    {
        $recursosToDelete = $this->getRecursos(new Criteria(), $con)->diff($recursos);


        $this->recursosScheduledForDeletion = $recursosToDelete;

        foreach ($recursosToDelete as $recursoRemoved) {
            $recursoRemoved->setPlato(null);
        }

        $this->collRecursos = null;
        foreach ($recursos as $recurso) {
            $this->addRecurso($recurso);
        }

        $this->collRecursos = $recursos;
        $this->collRecursosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Recurso objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Recurso objects.
     * @throws PropelException
     */
    public function countRecursos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRecursosPartial && !$this->isNew();
        if (null === $this->collRecursos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRecursos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getRecursos());
            }
            $query = RecursoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByPlato($this)
                ->count($con);
        }

        return count($this->collRecursos);
    }

    /**
     * Method called to associate a Recurso object to this object
     * through the Recurso foreign key attribute.
     *
     * @param    Recurso $l Recurso
     * @return Plato The current object (for fluent API support)
     */
    public function addRecurso(Recurso $l)
    {
        if ($this->collRecursos === null) {
            $this->initRecursos();
            $this->collRecursosPartial = true;
        }

        if (!in_array($l, $this->collRecursos->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRecurso($l);

            if ($this->recursosScheduledForDeletion and $this->recursosScheduledForDeletion->contains($l)) {
                $this->recursosScheduledForDeletion->remove($this->recursosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Recurso $recurso The recurso object to add.
     */
    protected function doAddRecurso($recurso)
    {
        $this->collRecursos[]= $recurso;
        $recurso->setPlato($this);
    }

    /**
     * @param	Recurso $recurso The recurso object to remove.
     * @return Plato The current object (for fluent API support)
     */
    public function removeRecurso($recurso)
    {
        if ($this->getRecursos()->contains($recurso)) {
            $this->collRecursos->remove($this->collRecursos->search($recurso));
            if (null === $this->recursosScheduledForDeletion) {
                $this->recursosScheduledForDeletion = clone $this->collRecursos;
                $this->recursosScheduledForDeletion->clear();
            }
            $this->recursosScheduledForDeletion[]= $recurso;
            $recurso->setPlato(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Plato is new, it will return
     * an empty collection; or if this Plato has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Plato.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recurso[] List of Recurso objects
     */
    public function getRecursosJoinResturant($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RecursoQuery::create(null, $criteria);
        $query->joinWith('Resturant', $join_behavior);

        return $this->getRecursos($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Plato is new, it will return
     * an empty collection; or if this Plato has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Plato.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recurso[] List of Recurso objects
     */
    public function getRecursosJoinUsuario($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RecursoQuery::create(null, $criteria);
        $query->joinWith('Usuario', $join_behavior);

        return $this->getRecursos($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->pla_id = null;
        $this->pla_nombre = null;
        $this->pla_descripcion = null;
        $this->pla_precio = null;
        $this->pla_stock = null;
        $this->pla_estado = null;
        $this->pla_eliminado = null;
        $this->created_at = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collPlatoPedidos) {
                foreach ($this->collPlatoPedidos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRecursos) {
                foreach ($this->collRecursos as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collPlatoPedidos instanceof PropelCollection) {
            $this->collPlatoPedidos->clearIterator();
        }
        $this->collPlatoPedidos = null;
        if ($this->collRecursos instanceof PropelCollection) {
            $this->collRecursos->clearIterator();
        }
        $this->collRecursos = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(PlatoPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     Plato The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = PlatoPeer::UPDATED_AT;

        return $this;
    }

}
