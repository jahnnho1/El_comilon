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
use AppBundle\Model\Recurso;
use AppBundle\Model\RecursoQuery;
use AppBundle\Model\Resturant;
use AppBundle\Model\ResturantPeer;
use AppBundle\Model\ResturantQuery;
use AppBundle\Model\Usuario;
use AppBundle\Model\UsuarioQuery;

abstract class BaseResturant extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\ResturantPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ResturantPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the res_id field.
     * @var        int
     */
    protected $res_id;

    /**
     * The value for the res_nombre field.
     * @var        string
     */
    protected $res_nombre;

    /**
     * The value for the res_descripcion field.
     * @var        string
     */
    protected $res_descripcion;

    /**
     * The value for the res_direccion field.
     * @var        string
     */
    protected $res_direccion;

    /**
     * The value for the res_email field.
     * @var        string
     */
    protected $res_email;

    /**
     * The value for the res_telefono field.
     * @var        string
     */
    protected $res_telefono;

    /**
     * The value for the res_estado field.
     * @var        int
     */
    protected $res_estado;

    /**
     * The value for the res_eliminado field.
     * @var        boolean
     */
    protected $res_eliminado;

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
     * @var        PropelObjectCollection|Recurso[] Collection to store aggregation of Recurso objects.
     */
    protected $collRecursos;
    protected $collRecursosPartial;

    /**
     * @var        PropelObjectCollection|Usuario[] Collection to store aggregation of Usuario objects.
     */
    protected $collUsuarios;
    protected $collUsuariosPartial;

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
    protected $recursosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usuariosScheduledForDeletion = null;

    /**
     * Get the [res_id] column value.
     *
     * @return int
     */
    public function getResId()
    {

        return $this->res_id;
    }

    /**
     * Get the [res_nombre] column value.
     *
     * @return string
     */
    public function getResNombre()
    {

        return $this->res_nombre;
    }

    /**
     * Get the [res_descripcion] column value.
     *
     * @return string
     */
    public function getResDescripcion()
    {

        return $this->res_descripcion;
    }

    /**
     * Get the [res_direccion] column value.
     *
     * @return string
     */
    public function getResDireccion()
    {

        return $this->res_direccion;
    }

    /**
     * Get the [res_email] column value.
     *
     * @return string
     */
    public function getResEmail()
    {

        return $this->res_email;
    }

    /**
     * Get the [res_telefono] column value.
     *
     * @return string
     */
    public function getResTelefono()
    {

        return $this->res_telefono;
    }

    /**
     * Get the [res_estado] column value.
     *
     * @return int
     */
    public function getResEstado()
    {

        return $this->res_estado;
    }

    /**
     * Get the [res_eliminado] column value.
     *
     * @return boolean
     */
    public function getResEliminado()
    {

        return $this->res_eliminado;
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
     * Set the value of [res_id] column.
     *
     * @param  int $v new value
     * @return Resturant The current object (for fluent API support)
     */
    public function setResId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->res_id !== $v) {
            $this->res_id = $v;
            $this->modifiedColumns[] = ResturantPeer::RES_ID;
        }


        return $this;
    } // setResId()

    /**
     * Set the value of [res_nombre] column.
     *
     * @param  string $v new value
     * @return Resturant The current object (for fluent API support)
     */
    public function setResNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->res_nombre !== $v) {
            $this->res_nombre = $v;
            $this->modifiedColumns[] = ResturantPeer::RES_NOMBRE;
        }


        return $this;
    } // setResNombre()

    /**
     * Set the value of [res_descripcion] column.
     *
     * @param  string $v new value
     * @return Resturant The current object (for fluent API support)
     */
    public function setResDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->res_descripcion !== $v) {
            $this->res_descripcion = $v;
            $this->modifiedColumns[] = ResturantPeer::RES_DESCRIPCION;
        }


        return $this;
    } // setResDescripcion()

    /**
     * Set the value of [res_direccion] column.
     *
     * @param  string $v new value
     * @return Resturant The current object (for fluent API support)
     */
    public function setResDireccion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->res_direccion !== $v) {
            $this->res_direccion = $v;
            $this->modifiedColumns[] = ResturantPeer::RES_DIRECCION;
        }


        return $this;
    } // setResDireccion()

    /**
     * Set the value of [res_email] column.
     *
     * @param  string $v new value
     * @return Resturant The current object (for fluent API support)
     */
    public function setResEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->res_email !== $v) {
            $this->res_email = $v;
            $this->modifiedColumns[] = ResturantPeer::RES_EMAIL;
        }


        return $this;
    } // setResEmail()

    /**
     * Set the value of [res_telefono] column.
     *
     * @param  string $v new value
     * @return Resturant The current object (for fluent API support)
     */
    public function setResTelefono($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->res_telefono !== $v) {
            $this->res_telefono = $v;
            $this->modifiedColumns[] = ResturantPeer::RES_TELEFONO;
        }


        return $this;
    } // setResTelefono()

    /**
     * Set the value of [res_estado] column.
     *
     * @param  int $v new value
     * @return Resturant The current object (for fluent API support)
     */
    public function setResEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->res_estado !== $v) {
            $this->res_estado = $v;
            $this->modifiedColumns[] = ResturantPeer::RES_ESTADO;
        }


        return $this;
    } // setResEstado()

    /**
     * Sets the value of the [res_eliminado] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Resturant The current object (for fluent API support)
     */
    public function setResEliminado($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->res_eliminado !== $v) {
            $this->res_eliminado = $v;
            $this->modifiedColumns[] = ResturantPeer::RES_ELIMINADO;
        }


        return $this;
    } // setResEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Resturant The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = ResturantPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Resturant The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = ResturantPeer::UPDATED_AT;
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

            $this->res_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->res_nombre = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->res_descripcion = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->res_direccion = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->res_email = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->res_telefono = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->res_estado = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->res_eliminado = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
            $this->created_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->updated_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 10; // 10 = ResturantPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Resturant object", $e);
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
            $con = Propel::getConnection(ResturantPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ResturantPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collRecursos = null;

            $this->collUsuarios = null;

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
            $con = Propel::getConnection(ResturantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ResturantQuery::create()
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
            $con = Propel::getConnection(ResturantPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(ResturantPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(ResturantPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(ResturantPeer::UPDATED_AT)) {
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
                ResturantPeer::addInstanceToPool($this);
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

            if ($this->usuariosScheduledForDeletion !== null) {
                if (!$this->usuariosScheduledForDeletion->isEmpty()) {
                    foreach ($this->usuariosScheduledForDeletion as $usuario) {
                        // need to save related object because we set the relation to null
                        $usuario->save($con);
                    }
                    $this->usuariosScheduledForDeletion = null;
                }
            }

            if ($this->collUsuarios !== null) {
                foreach ($this->collUsuarios as $referrerFK) {
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

        $this->modifiedColumns[] = ResturantPeer::RES_ID;
        if (null !== $this->res_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ResturantPeer::RES_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ResturantPeer::RES_ID)) {
            $modifiedColumns[':p' . $index++]  = '`res_id`';
        }
        if ($this->isColumnModified(ResturantPeer::RES_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = '`res_nombre`';
        }
        if ($this->isColumnModified(ResturantPeer::RES_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = '`res_descripcion`';
        }
        if ($this->isColumnModified(ResturantPeer::RES_DIRECCION)) {
            $modifiedColumns[':p' . $index++]  = '`res_direccion`';
        }
        if ($this->isColumnModified(ResturantPeer::RES_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`res_email`';
        }
        if ($this->isColumnModified(ResturantPeer::RES_TELEFONO)) {
            $modifiedColumns[':p' . $index++]  = '`res_telefono`';
        }
        if ($this->isColumnModified(ResturantPeer::RES_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`res_estado`';
        }
        if ($this->isColumnModified(ResturantPeer::RES_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`res_eliminado`';
        }
        if ($this->isColumnModified(ResturantPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(ResturantPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `resturant` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`res_id`':
                        $stmt->bindValue($identifier, $this->res_id, PDO::PARAM_INT);
                        break;
                    case '`res_nombre`':
                        $stmt->bindValue($identifier, $this->res_nombre, PDO::PARAM_STR);
                        break;
                    case '`res_descripcion`':
                        $stmt->bindValue($identifier, $this->res_descripcion, PDO::PARAM_STR);
                        break;
                    case '`res_direccion`':
                        $stmt->bindValue($identifier, $this->res_direccion, PDO::PARAM_STR);
                        break;
                    case '`res_email`':
                        $stmt->bindValue($identifier, $this->res_email, PDO::PARAM_STR);
                        break;
                    case '`res_telefono`':
                        $stmt->bindValue($identifier, $this->res_telefono, PDO::PARAM_STR);
                        break;
                    case '`res_estado`':
                        $stmt->bindValue($identifier, $this->res_estado, PDO::PARAM_INT);
                        break;
                    case '`res_eliminado`':
                        $stmt->bindValue($identifier, (int) $this->res_eliminado, PDO::PARAM_INT);
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
        $this->setResId($pk);

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


            if (($retval = ResturantPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collRecursos !== null) {
                    foreach ($this->collRecursos as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collUsuarios !== null) {
                    foreach ($this->collUsuarios as $referrerFK) {
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
        $pos = ResturantPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getResId();
                break;
            case 1:
                return $this->getResNombre();
                break;
            case 2:
                return $this->getResDescripcion();
                break;
            case 3:
                return $this->getResDireccion();
                break;
            case 4:
                return $this->getResEmail();
                break;
            case 5:
                return $this->getResTelefono();
                break;
            case 6:
                return $this->getResEstado();
                break;
            case 7:
                return $this->getResEliminado();
                break;
            case 8:
                return $this->getCreatedAt();
                break;
            case 9:
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
        if (isset($alreadyDumpedObjects['Resturant'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Resturant'][$this->getPrimaryKey()] = true;
        $keys = ResturantPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getResId(),
            $keys[1] => $this->getResNombre(),
            $keys[2] => $this->getResDescripcion(),
            $keys[3] => $this->getResDireccion(),
            $keys[4] => $this->getResEmail(),
            $keys[5] => $this->getResTelefono(),
            $keys[6] => $this->getResEstado(),
            $keys[7] => $this->getResEliminado(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collRecursos) {
                $result['Recursos'] = $this->collRecursos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsuarios) {
                $result['Usuarios'] = $this->collUsuarios->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ResturantPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setResId($value);
                break;
            case 1:
                $this->setResNombre($value);
                break;
            case 2:
                $this->setResDescripcion($value);
                break;
            case 3:
                $this->setResDireccion($value);
                break;
            case 4:
                $this->setResEmail($value);
                break;
            case 5:
                $this->setResTelefono($value);
                break;
            case 6:
                $this->setResEstado($value);
                break;
            case 7:
                $this->setResEliminado($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
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
        $keys = ResturantPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setResId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setResNombre($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setResDescripcion($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setResDireccion($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setResEmail($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setResTelefono($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setResEstado($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setResEliminado($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ResturantPeer::DATABASE_NAME);

        if ($this->isColumnModified(ResturantPeer::RES_ID)) $criteria->add(ResturantPeer::RES_ID, $this->res_id);
        if ($this->isColumnModified(ResturantPeer::RES_NOMBRE)) $criteria->add(ResturantPeer::RES_NOMBRE, $this->res_nombre);
        if ($this->isColumnModified(ResturantPeer::RES_DESCRIPCION)) $criteria->add(ResturantPeer::RES_DESCRIPCION, $this->res_descripcion);
        if ($this->isColumnModified(ResturantPeer::RES_DIRECCION)) $criteria->add(ResturantPeer::RES_DIRECCION, $this->res_direccion);
        if ($this->isColumnModified(ResturantPeer::RES_EMAIL)) $criteria->add(ResturantPeer::RES_EMAIL, $this->res_email);
        if ($this->isColumnModified(ResturantPeer::RES_TELEFONO)) $criteria->add(ResturantPeer::RES_TELEFONO, $this->res_telefono);
        if ($this->isColumnModified(ResturantPeer::RES_ESTADO)) $criteria->add(ResturantPeer::RES_ESTADO, $this->res_estado);
        if ($this->isColumnModified(ResturantPeer::RES_ELIMINADO)) $criteria->add(ResturantPeer::RES_ELIMINADO, $this->res_eliminado);
        if ($this->isColumnModified(ResturantPeer::CREATED_AT)) $criteria->add(ResturantPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(ResturantPeer::UPDATED_AT)) $criteria->add(ResturantPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(ResturantPeer::DATABASE_NAME);
        $criteria->add(ResturantPeer::RES_ID, $this->res_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getResId();
    }

    /**
     * Generic method to set the primary key (res_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setResId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getResId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Resturant (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setResNombre($this->getResNombre());
        $copyObj->setResDescripcion($this->getResDescripcion());
        $copyObj->setResDireccion($this->getResDireccion());
        $copyObj->setResEmail($this->getResEmail());
        $copyObj->setResTelefono($this->getResTelefono());
        $copyObj->setResEstado($this->getResEstado());
        $copyObj->setResEliminado($this->getResEliminado());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getRecursos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRecurso($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsuarios() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsuario($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setResId(NULL); // this is a auto-increment column, so set to default value
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
     * @return Resturant Clone of current object.
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
     * @return ResturantPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ResturantPeer();
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
        if ('Recurso' == $relationName) {
            $this->initRecursos();
        }
        if ('Usuario' == $relationName) {
            $this->initUsuarios();
        }
    }

    /**
     * Clears out the collRecursos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Resturant The current object (for fluent API support)
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
     * If this Resturant is new, it will return
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
                    ->filterByResturant($this)
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
     * @return Resturant The current object (for fluent API support)
     */
    public function setRecursos(PropelCollection $recursos, PropelPDO $con = null)
    {
        $recursosToDelete = $this->getRecursos(new Criteria(), $con)->diff($recursos);


        $this->recursosScheduledForDeletion = $recursosToDelete;

        foreach ($recursosToDelete as $recursoRemoved) {
            $recursoRemoved->setResturant(null);
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
                ->filterByResturant($this)
                ->count($con);
        }

        return count($this->collRecursos);
    }

    /**
     * Method called to associate a Recurso object to this object
     * through the Recurso foreign key attribute.
     *
     * @param    Recurso $l Recurso
     * @return Resturant The current object (for fluent API support)
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
        $recurso->setResturant($this);
    }

    /**
     * @param	Recurso $recurso The recurso object to remove.
     * @return Resturant The current object (for fluent API support)
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
            $recurso->setResturant(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resturant is new, it will return
     * an empty collection; or if this Resturant has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resturant.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Recurso[] List of Recurso objects
     */
    public function getRecursosJoinPlato($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RecursoQuery::create(null, $criteria);
        $query->joinWith('Plato', $join_behavior);

        return $this->getRecursos($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Resturant is new, it will return
     * an empty collection; or if this Resturant has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Resturant.
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
     * Clears out the collUsuarios collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Resturant The current object (for fluent API support)
     * @see        addUsuarios()
     */
    public function clearUsuarios()
    {
        $this->collUsuarios = null; // important to set this to null since that means it is uninitialized
        $this->collUsuariosPartial = null;

        return $this;
    }

    /**
     * reset is the collUsuarios collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsuarios($v = true)
    {
        $this->collUsuariosPartial = $v;
    }

    /**
     * Initializes the collUsuarios collection.
     *
     * By default this just sets the collUsuarios collection to an empty array (like clearcollUsuarios());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsuarios($overrideExisting = true)
    {
        if (null !== $this->collUsuarios && !$overrideExisting) {
            return;
        }
        $this->collUsuarios = new PropelObjectCollection();
        $this->collUsuarios->setModel('Usuario');
    }

    /**
     * Gets an array of Usuario objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Resturant is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Usuario[] List of Usuario objects
     * @throws PropelException
     */
    public function getUsuarios($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsuariosPartial && !$this->isNew();
        if (null === $this->collUsuarios || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsuarios) {
                // return empty collection
                $this->initUsuarios();
            } else {
                $collUsuarios = UsuarioQuery::create(null, $criteria)
                    ->filterByResturant($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsuariosPartial && count($collUsuarios)) {
                      $this->initUsuarios(false);

                      foreach ($collUsuarios as $obj) {
                        if (false == $this->collUsuarios->contains($obj)) {
                          $this->collUsuarios->append($obj);
                        }
                      }

                      $this->collUsuariosPartial = true;
                    }

                    $collUsuarios->getInternalIterator()->rewind();

                    return $collUsuarios;
                }

                if ($partial && $this->collUsuarios) {
                    foreach ($this->collUsuarios as $obj) {
                        if ($obj->isNew()) {
                            $collUsuarios[] = $obj;
                        }
                    }
                }

                $this->collUsuarios = $collUsuarios;
                $this->collUsuariosPartial = false;
            }
        }

        return $this->collUsuarios;
    }

    /**
     * Sets a collection of Usuario objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usuarios A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Resturant The current object (for fluent API support)
     */
    public function setUsuarios(PropelCollection $usuarios, PropelPDO $con = null)
    {
        $usuariosToDelete = $this->getUsuarios(new Criteria(), $con)->diff($usuarios);


        $this->usuariosScheduledForDeletion = $usuariosToDelete;

        foreach ($usuariosToDelete as $usuarioRemoved) {
            $usuarioRemoved->setResturant(null);
        }

        $this->collUsuarios = null;
        foreach ($usuarios as $usuario) {
            $this->addUsuario($usuario);
        }

        $this->collUsuarios = $usuarios;
        $this->collUsuariosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Usuario objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Usuario objects.
     * @throws PropelException
     */
    public function countUsuarios(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsuariosPartial && !$this->isNew();
        if (null === $this->collUsuarios || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsuarios) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getUsuarios());
            }
            $query = UsuarioQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByResturant($this)
                ->count($con);
        }

        return count($this->collUsuarios);
    }

    /**
     * Method called to associate a Usuario object to this object
     * through the Usuario foreign key attribute.
     *
     * @param    Usuario $l Usuario
     * @return Resturant The current object (for fluent API support)
     */
    public function addUsuario(Usuario $l)
    {
        if ($this->collUsuarios === null) {
            $this->initUsuarios();
            $this->collUsuariosPartial = true;
        }

        if (!in_array($l, $this->collUsuarios->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUsuario($l);

            if ($this->usuariosScheduledForDeletion and $this->usuariosScheduledForDeletion->contains($l)) {
                $this->usuariosScheduledForDeletion->remove($this->usuariosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Usuario $usuario The usuario object to add.
     */
    protected function doAddUsuario($usuario)
    {
        $this->collUsuarios[]= $usuario;
        $usuario->setResturant($this);
    }

    /**
     * @param	Usuario $usuario The usuario object to remove.
     * @return Resturant The current object (for fluent API support)
     */
    public function removeUsuario($usuario)
    {
        if ($this->getUsuarios()->contains($usuario)) {
            $this->collUsuarios->remove($this->collUsuarios->search($usuario));
            if (null === $this->usuariosScheduledForDeletion) {
                $this->usuariosScheduledForDeletion = clone $this->collUsuarios;
                $this->usuariosScheduledForDeletion->clear();
            }
            $this->usuariosScheduledForDeletion[]= $usuario;
            $usuario->setResturant(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->res_id = null;
        $this->res_nombre = null;
        $this->res_descripcion = null;
        $this->res_direccion = null;
        $this->res_email = null;
        $this->res_telefono = null;
        $this->res_estado = null;
        $this->res_eliminado = null;
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
            if ($this->collRecursos) {
                foreach ($this->collRecursos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsuarios) {
                foreach ($this->collUsuarios as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collRecursos instanceof PropelCollection) {
            $this->collRecursos->clearIterator();
        }
        $this->collRecursos = null;
        if ($this->collUsuarios instanceof PropelCollection) {
            $this->collUsuarios->clearIterator();
        }
        $this->collUsuarios = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ResturantPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Resturant The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = ResturantPeer::UPDATED_AT;

        return $this;
    }

}
