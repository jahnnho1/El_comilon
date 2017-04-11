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
use AppBundle\Model\Pedido;
use AppBundle\Model\PedidoQuery;
use AppBundle\Model\Recurso;
use AppBundle\Model\RecursoQuery;
use AppBundle\Model\Resturant;
use AppBundle\Model\ResturantQuery;
use AppBundle\Model\TipoUsuario;
use AppBundle\Model\TipoUsuarioQuery;
use AppBundle\Model\Usuario;
use AppBundle\Model\UsuarioPeer;
use AppBundle\Model\UsuarioQuery;

abstract class BaseUsuario extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'AppBundle\\Model\\UsuarioPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UsuarioPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the usu_id field.
     * @var        int
     */
    protected $usu_id;

    /**
     * The value for the res_id field.
     * @var        int
     */
    protected $res_id;

    /**
     * The value for the usu_nombre field.
     * @var        string
     */
    protected $usu_nombre;

    /**
     * The value for the usu_apellido field.
     * @var        string
     */
    protected $usu_apellido;

    /**
     * The value for the usu_clave field.
     * @var        string
     */
    protected $usu_clave;

    /**
     * The value for the usu_telefono field.
     * @var        string
     */
    protected $usu_telefono;

    /**
     * The value for the usu_email field.
     * @var        string
     */
    protected $usu_email;

    /**
     * The value for the usu_estado field.
     * @var        int
     */
    protected $usu_estado;

    /**
     * The value for the usu_eliminado field.
     * @var        boolean
     */
    protected $usu_eliminado;

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
     * @var        Resturant
     */
    protected $aResturant;

    /**
     * @var        PropelObjectCollection|Pedido[] Collection to store aggregation of Pedido objects.
     */
    protected $collPedidos;
    protected $collPedidosPartial;

    /**
     * @var        PropelObjectCollection|Recurso[] Collection to store aggregation of Recurso objects.
     */
    protected $collRecursos;
    protected $collRecursosPartial;

    /**
     * @var        PropelObjectCollection|TipoUsuario[] Collection to store aggregation of TipoUsuario objects.
     */
    protected $collTipoUsuarios;
    protected $collTipoUsuariosPartial;

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
    protected $pedidosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $recursosScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $tipoUsuariosScheduledForDeletion = null;

    /**
     * Get the [usu_id] column value.
     *
     * @return int
     */
    public function getUsuId()
    {

        return $this->usu_id;
    }

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
     * Get the [usu_nombre] column value.
     *
     * @return string
     */
    public function getUsuNombre()
    {

        return $this->usu_nombre;
    }

    /**
     * Get the [usu_apellido] column value.
     *
     * @return string
     */
    public function getUsuApellido()
    {

        return $this->usu_apellido;
    }

    /**
     * Get the [usu_clave] column value.
     *
     * @return string
     */
    public function getUsuClave()
    {

        return $this->usu_clave;
    }

    /**
     * Get the [usu_telefono] column value.
     *
     * @return string
     */
    public function getUsuTelefono()
    {

        return $this->usu_telefono;
    }

    /**
     * Get the [usu_email] column value.
     *
     * @return string
     */
    public function getUsuEmail()
    {

        return $this->usu_email;
    }

    /**
     * Get the [usu_estado] column value.
     *
     * @return int
     */
    public function getUsuEstado()
    {

        return $this->usu_estado;
    }

    /**
     * Get the [usu_eliminado] column value.
     *
     * @return boolean
     */
    public function getUsuEliminado()
    {

        return $this->usu_eliminado;
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
     * Set the value of [usu_id] column.
     *
     * @param  int $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setUsuId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->usu_id !== $v) {
            $this->usu_id = $v;
            $this->modifiedColumns[] = UsuarioPeer::USU_ID;
        }


        return $this;
    } // setUsuId()

    /**
     * Set the value of [res_id] column.
     *
     * @param  int $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setResId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->res_id !== $v) {
            $this->res_id = $v;
            $this->modifiedColumns[] = UsuarioPeer::RES_ID;
        }

        if ($this->aResturant !== null && $this->aResturant->getResId() !== $v) {
            $this->aResturant = null;
        }


        return $this;
    } // setResId()

    /**
     * Set the value of [usu_nombre] column.
     *
     * @param  string $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setUsuNombre($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usu_nombre !== $v) {
            $this->usu_nombre = $v;
            $this->modifiedColumns[] = UsuarioPeer::USU_NOMBRE;
        }


        return $this;
    } // setUsuNombre()

    /**
     * Set the value of [usu_apellido] column.
     *
     * @param  string $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setUsuApellido($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usu_apellido !== $v) {
            $this->usu_apellido = $v;
            $this->modifiedColumns[] = UsuarioPeer::USU_APELLIDO;
        }


        return $this;
    } // setUsuApellido()

    /**
     * Set the value of [usu_clave] column.
     *
     * @param  string $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setUsuClave($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usu_clave !== $v) {
            $this->usu_clave = $v;
            $this->modifiedColumns[] = UsuarioPeer::USU_CLAVE;
        }


        return $this;
    } // setUsuClave()

    /**
     * Set the value of [usu_telefono] column.
     *
     * @param  string $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setUsuTelefono($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usu_telefono !== $v) {
            $this->usu_telefono = $v;
            $this->modifiedColumns[] = UsuarioPeer::USU_TELEFONO;
        }


        return $this;
    } // setUsuTelefono()

    /**
     * Set the value of [usu_email] column.
     *
     * @param  string $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setUsuEmail($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->usu_email !== $v) {
            $this->usu_email = $v;
            $this->modifiedColumns[] = UsuarioPeer::USU_EMAIL;
        }


        return $this;
    } // setUsuEmail()

    /**
     * Set the value of [usu_estado] column.
     *
     * @param  int $v new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setUsuEstado($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->usu_estado !== $v) {
            $this->usu_estado = $v;
            $this->modifiedColumns[] = UsuarioPeer::USU_ESTADO;
        }


        return $this;
    } // setUsuEstado()

    /**
     * Sets the value of the [usu_eliminado] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Usuario The current object (for fluent API support)
     */
    public function setUsuEliminado($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->usu_eliminado !== $v) {
            $this->usu_eliminado = $v;
            $this->modifiedColumns[] = UsuarioPeer::USU_ELIMINADO;
        }


        return $this;
    } // setUsuEliminado()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Usuario The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = UsuarioPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Usuario The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = UsuarioPeer::UPDATED_AT;
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

            $this->usu_id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->res_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->usu_nombre = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->usu_apellido = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->usu_clave = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->usu_telefono = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->usu_email = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->usu_estado = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->usu_eliminado = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
            $this->created_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->updated_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);

            return $startcol + 11; // 11 = UsuarioPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Usuario object", $e);
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

        if ($this->aResturant !== null && $this->res_id !== $this->aResturant->getResId()) {
            $this->aResturant = null;
        }
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
            $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UsuarioPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aResturant = null;
            $this->collPedidos = null;

            $this->collRecursos = null;

            $this->collTipoUsuarios = null;

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
            $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UsuarioQuery::create()
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
            $con = Propel::getConnection(UsuarioPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(UsuarioPeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(UsuarioPeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(UsuarioPeer::UPDATED_AT)) {
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
                UsuarioPeer::addInstanceToPool($this);
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

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aResturant !== null) {
                if ($this->aResturant->isModified() || $this->aResturant->isNew()) {
                    $affectedRows += $this->aResturant->save($con);
                }
                $this->setResturant($this->aResturant);
            }

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

            if ($this->pedidosScheduledForDeletion !== null) {
                if (!$this->pedidosScheduledForDeletion->isEmpty()) {
                    foreach ($this->pedidosScheduledForDeletion as $pedido) {
                        // need to save related object because we set the relation to null
                        $pedido->save($con);
                    }
                    $this->pedidosScheduledForDeletion = null;
                }
            }

            if ($this->collPedidos !== null) {
                foreach ($this->collPedidos as $referrerFK) {
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

            if ($this->tipoUsuariosScheduledForDeletion !== null) {
                if (!$this->tipoUsuariosScheduledForDeletion->isEmpty()) {
                    foreach ($this->tipoUsuariosScheduledForDeletion as $tipoUsuario) {
                        // need to save related object because we set the relation to null
                        $tipoUsuario->save($con);
                    }
                    $this->tipoUsuariosScheduledForDeletion = null;
                }
            }

            if ($this->collTipoUsuarios !== null) {
                foreach ($this->collTipoUsuarios as $referrerFK) {
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

        $this->modifiedColumns[] = UsuarioPeer::USU_ID;
        if (null !== $this->usu_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UsuarioPeer::USU_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UsuarioPeer::USU_ID)) {
            $modifiedColumns[':p' . $index++]  = '`usu_id`';
        }
        if ($this->isColumnModified(UsuarioPeer::RES_ID)) {
            $modifiedColumns[':p' . $index++]  = '`res_id`';
        }
        if ($this->isColumnModified(UsuarioPeer::USU_NOMBRE)) {
            $modifiedColumns[':p' . $index++]  = '`usu_nombre`';
        }
        if ($this->isColumnModified(UsuarioPeer::USU_APELLIDO)) {
            $modifiedColumns[':p' . $index++]  = '`usu_apellido`';
        }
        if ($this->isColumnModified(UsuarioPeer::USU_CLAVE)) {
            $modifiedColumns[':p' . $index++]  = '`usu_clave`';
        }
        if ($this->isColumnModified(UsuarioPeer::USU_TELEFONO)) {
            $modifiedColumns[':p' . $index++]  = '`usu_telefono`';
        }
        if ($this->isColumnModified(UsuarioPeer::USU_EMAIL)) {
            $modifiedColumns[':p' . $index++]  = '`usu_email`';
        }
        if ($this->isColumnModified(UsuarioPeer::USU_ESTADO)) {
            $modifiedColumns[':p' . $index++]  = '`usu_estado`';
        }
        if ($this->isColumnModified(UsuarioPeer::USU_ELIMINADO)) {
            $modifiedColumns[':p' . $index++]  = '`usu_eliminado`';
        }
        if ($this->isColumnModified(UsuarioPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`created_at`';
        }
        if ($this->isColumnModified(UsuarioPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`updated_at`';
        }

        $sql = sprintf(
            'INSERT INTO `usuario` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`usu_id`':
                        $stmt->bindValue($identifier, $this->usu_id, PDO::PARAM_INT);
                        break;
                    case '`res_id`':
                        $stmt->bindValue($identifier, $this->res_id, PDO::PARAM_INT);
                        break;
                    case '`usu_nombre`':
                        $stmt->bindValue($identifier, $this->usu_nombre, PDO::PARAM_STR);
                        break;
                    case '`usu_apellido`':
                        $stmt->bindValue($identifier, $this->usu_apellido, PDO::PARAM_STR);
                        break;
                    case '`usu_clave`':
                        $stmt->bindValue($identifier, $this->usu_clave, PDO::PARAM_STR);
                        break;
                    case '`usu_telefono`':
                        $stmt->bindValue($identifier, $this->usu_telefono, PDO::PARAM_STR);
                        break;
                    case '`usu_email`':
                        $stmt->bindValue($identifier, $this->usu_email, PDO::PARAM_STR);
                        break;
                    case '`usu_estado`':
                        $stmt->bindValue($identifier, $this->usu_estado, PDO::PARAM_INT);
                        break;
                    case '`usu_eliminado`':
                        $stmt->bindValue($identifier, (int) $this->usu_eliminado, PDO::PARAM_INT);
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
        $this->setUsuId($pk);

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


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aResturant !== null) {
                if (!$this->aResturant->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aResturant->getValidationFailures());
                }
            }


            if (($retval = UsuarioPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collPedidos !== null) {
                    foreach ($this->collPedidos as $referrerFK) {
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

                if ($this->collTipoUsuarios !== null) {
                    foreach ($this->collTipoUsuarios as $referrerFK) {
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
        $pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getUsuId();
                break;
            case 1:
                return $this->getResId();
                break;
            case 2:
                return $this->getUsuNombre();
                break;
            case 3:
                return $this->getUsuApellido();
                break;
            case 4:
                return $this->getUsuClave();
                break;
            case 5:
                return $this->getUsuTelefono();
                break;
            case 6:
                return $this->getUsuEmail();
                break;
            case 7:
                return $this->getUsuEstado();
                break;
            case 8:
                return $this->getUsuEliminado();
                break;
            case 9:
                return $this->getCreatedAt();
                break;
            case 10:
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
        if (isset($alreadyDumpedObjects['Usuario'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Usuario'][$this->getPrimaryKey()] = true;
        $keys = UsuarioPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getUsuId(),
            $keys[1] => $this->getResId(),
            $keys[2] => $this->getUsuNombre(),
            $keys[3] => $this->getUsuApellido(),
            $keys[4] => $this->getUsuClave(),
            $keys[5] => $this->getUsuTelefono(),
            $keys[6] => $this->getUsuEmail(),
            $keys[7] => $this->getUsuEstado(),
            $keys[8] => $this->getUsuEliminado(),
            $keys[9] => $this->getCreatedAt(),
            $keys[10] => $this->getUpdatedAt(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aResturant) {
                $result['Resturant'] = $this->aResturant->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collPedidos) {
                $result['Pedidos'] = $this->collPedidos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRecursos) {
                $result['Recursos'] = $this->collRecursos->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTipoUsuarios) {
                $result['TipoUsuarios'] = $this->collTipoUsuarios->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setUsuId($value);
                break;
            case 1:
                $this->setResId($value);
                break;
            case 2:
                $this->setUsuNombre($value);
                break;
            case 3:
                $this->setUsuApellido($value);
                break;
            case 4:
                $this->setUsuClave($value);
                break;
            case 5:
                $this->setUsuTelefono($value);
                break;
            case 6:
                $this->setUsuEmail($value);
                break;
            case 7:
                $this->setUsuEstado($value);
                break;
            case 8:
                $this->setUsuEliminado($value);
                break;
            case 9:
                $this->setCreatedAt($value);
                break;
            case 10:
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
        $keys = UsuarioPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setUsuId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setResId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUsuNombre($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUsuApellido($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setUsuClave($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setUsuTelefono($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUsuEmail($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setUsuEstado($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setUsuEliminado($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

        if ($this->isColumnModified(UsuarioPeer::USU_ID)) $criteria->add(UsuarioPeer::USU_ID, $this->usu_id);
        if ($this->isColumnModified(UsuarioPeer::RES_ID)) $criteria->add(UsuarioPeer::RES_ID, $this->res_id);
        if ($this->isColumnModified(UsuarioPeer::USU_NOMBRE)) $criteria->add(UsuarioPeer::USU_NOMBRE, $this->usu_nombre);
        if ($this->isColumnModified(UsuarioPeer::USU_APELLIDO)) $criteria->add(UsuarioPeer::USU_APELLIDO, $this->usu_apellido);
        if ($this->isColumnModified(UsuarioPeer::USU_CLAVE)) $criteria->add(UsuarioPeer::USU_CLAVE, $this->usu_clave);
        if ($this->isColumnModified(UsuarioPeer::USU_TELEFONO)) $criteria->add(UsuarioPeer::USU_TELEFONO, $this->usu_telefono);
        if ($this->isColumnModified(UsuarioPeer::USU_EMAIL)) $criteria->add(UsuarioPeer::USU_EMAIL, $this->usu_email);
        if ($this->isColumnModified(UsuarioPeer::USU_ESTADO)) $criteria->add(UsuarioPeer::USU_ESTADO, $this->usu_estado);
        if ($this->isColumnModified(UsuarioPeer::USU_ELIMINADO)) $criteria->add(UsuarioPeer::USU_ELIMINADO, $this->usu_eliminado);
        if ($this->isColumnModified(UsuarioPeer::CREATED_AT)) $criteria->add(UsuarioPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(UsuarioPeer::UPDATED_AT)) $criteria->add(UsuarioPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(UsuarioPeer::DATABASE_NAME);
        $criteria->add(UsuarioPeer::USU_ID, $this->usu_id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getUsuId();
    }

    /**
     * Generic method to set the primary key (usu_id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setUsuId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getUsuId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of Usuario (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setResId($this->getResId());
        $copyObj->setUsuNombre($this->getUsuNombre());
        $copyObj->setUsuApellido($this->getUsuApellido());
        $copyObj->setUsuClave($this->getUsuClave());
        $copyObj->setUsuTelefono($this->getUsuTelefono());
        $copyObj->setUsuEmail($this->getUsuEmail());
        $copyObj->setUsuEstado($this->getUsuEstado());
        $copyObj->setUsuEliminado($this->getUsuEliminado());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getPedidos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addPedido($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRecursos() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRecurso($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTipoUsuarios() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTipoUsuario($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setUsuId(NULL); // this is a auto-increment column, so set to default value
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
     * @return Usuario Clone of current object.
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
     * @return UsuarioPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UsuarioPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Resturant object.
     *
     * @param                  Resturant $v
     * @return Usuario The current object (for fluent API support)
     * @throws PropelException
     */
    public function setResturant(Resturant $v = null)
    {
        if ($v === null) {
            $this->setResId(NULL);
        } else {
            $this->setResId($v->getResId());
        }

        $this->aResturant = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Resturant object, it will not be re-added.
        if ($v !== null) {
            $v->addUsuario($this);
        }


        return $this;
    }


    /**
     * Get the associated Resturant object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Resturant The associated Resturant object.
     * @throws PropelException
     */
    public function getResturant(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aResturant === null && ($this->res_id !== null) && $doQuery) {
            $this->aResturant = ResturantQuery::create()->findPk($this->res_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aResturant->addUsuarios($this);
             */
        }

        return $this->aResturant;
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
        if ('Pedido' == $relationName) {
            $this->initPedidos();
        }
        if ('Recurso' == $relationName) {
            $this->initRecursos();
        }
        if ('TipoUsuario' == $relationName) {
            $this->initTipoUsuarios();
        }
    }

    /**
     * Clears out the collPedidos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Usuario The current object (for fluent API support)
     * @see        addPedidos()
     */
    public function clearPedidos()
    {
        $this->collPedidos = null; // important to set this to null since that means it is uninitialized
        $this->collPedidosPartial = null;

        return $this;
    }

    /**
     * reset is the collPedidos collection loaded partially
     *
     * @return void
     */
    public function resetPartialPedidos($v = true)
    {
        $this->collPedidosPartial = $v;
    }

    /**
     * Initializes the collPedidos collection.
     *
     * By default this just sets the collPedidos collection to an empty array (like clearcollPedidos());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initPedidos($overrideExisting = true)
    {
        if (null !== $this->collPedidos && !$overrideExisting) {
            return;
        }
        $this->collPedidos = new PropelObjectCollection();
        $this->collPedidos->setModel('Pedido');
    }

    /**
     * Gets an array of Pedido objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Usuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Pedido[] List of Pedido objects
     * @throws PropelException
     */
    public function getPedidos($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collPedidosPartial && !$this->isNew();
        if (null === $this->collPedidos || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collPedidos) {
                // return empty collection
                $this->initPedidos();
            } else {
                $collPedidos = PedidoQuery::create(null, $criteria)
                    ->filterByUsuario($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collPedidosPartial && count($collPedidos)) {
                      $this->initPedidos(false);

                      foreach ($collPedidos as $obj) {
                        if (false == $this->collPedidos->contains($obj)) {
                          $this->collPedidos->append($obj);
                        }
                      }

                      $this->collPedidosPartial = true;
                    }

                    $collPedidos->getInternalIterator()->rewind();

                    return $collPedidos;
                }

                if ($partial && $this->collPedidos) {
                    foreach ($this->collPedidos as $obj) {
                        if ($obj->isNew()) {
                            $collPedidos[] = $obj;
                        }
                    }
                }

                $this->collPedidos = $collPedidos;
                $this->collPedidosPartial = false;
            }
        }

        return $this->collPedidos;
    }

    /**
     * Sets a collection of Pedido objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $pedidos A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Usuario The current object (for fluent API support)
     */
    public function setPedidos(PropelCollection $pedidos, PropelPDO $con = null)
    {
        $pedidosToDelete = $this->getPedidos(new Criteria(), $con)->diff($pedidos);


        $this->pedidosScheduledForDeletion = $pedidosToDelete;

        foreach ($pedidosToDelete as $pedidoRemoved) {
            $pedidoRemoved->setUsuario(null);
        }

        $this->collPedidos = null;
        foreach ($pedidos as $pedido) {
            $this->addPedido($pedido);
        }

        $this->collPedidos = $pedidos;
        $this->collPedidosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Pedido objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Pedido objects.
     * @throws PropelException
     */
    public function countPedidos(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collPedidosPartial && !$this->isNew();
        if (null === $this->collPedidos || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collPedidos) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getPedidos());
            }
            $query = PedidoQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collPedidos);
    }

    /**
     * Method called to associate a Pedido object to this object
     * through the Pedido foreign key attribute.
     *
     * @param    Pedido $l Pedido
     * @return Usuario The current object (for fluent API support)
     */
    public function addPedido(Pedido $l)
    {
        if ($this->collPedidos === null) {
            $this->initPedidos();
            $this->collPedidosPartial = true;
        }

        if (!in_array($l, $this->collPedidos->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddPedido($l);

            if ($this->pedidosScheduledForDeletion and $this->pedidosScheduledForDeletion->contains($l)) {
                $this->pedidosScheduledForDeletion->remove($this->pedidosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	Pedido $pedido The pedido object to add.
     */
    protected function doAddPedido($pedido)
    {
        $this->collPedidos[]= $pedido;
        $pedido->setUsuario($this);
    }

    /**
     * @param	Pedido $pedido The pedido object to remove.
     * @return Usuario The current object (for fluent API support)
     */
    public function removePedido($pedido)
    {
        if ($this->getPedidos()->contains($pedido)) {
            $this->collPedidos->remove($this->collPedidos->search($pedido));
            if (null === $this->pedidosScheduledForDeletion) {
                $this->pedidosScheduledForDeletion = clone $this->collPedidos;
                $this->pedidosScheduledForDeletion->clear();
            }
            $this->pedidosScheduledForDeletion[]= $pedido;
            $pedido->setUsuario(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Pedidos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Pedido[] List of Pedido objects
     */
    public function getPedidosJoinTipoPedido($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PedidoQuery::create(null, $criteria);
        $query->joinWith('TipoPedido', $join_behavior);

        return $this->getPedidos($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Pedidos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Pedido[] List of Pedido objects
     */
    public function getPedidosJoinVenta($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = PedidoQuery::create(null, $criteria);
        $query->joinWith('Venta', $join_behavior);

        return $this->getPedidos($query, $con);
    }

    /**
     * Clears out the collRecursos collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Usuario The current object (for fluent API support)
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
     * If this Usuario is new, it will return
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
                    ->filterByUsuario($this)
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
     * @return Usuario The current object (for fluent API support)
     */
    public function setRecursos(PropelCollection $recursos, PropelPDO $con = null)
    {
        $recursosToDelete = $this->getRecursos(new Criteria(), $con)->diff($recursos);


        $this->recursosScheduledForDeletion = $recursosToDelete;

        foreach ($recursosToDelete as $recursoRemoved) {
            $recursoRemoved->setUsuario(null);
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
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collRecursos);
    }

    /**
     * Method called to associate a Recurso object to this object
     * through the Recurso foreign key attribute.
     *
     * @param    Recurso $l Recurso
     * @return Usuario The current object (for fluent API support)
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
        $recurso->setUsuario($this);
    }

    /**
     * @param	Recurso $recurso The recurso object to remove.
     * @return Usuario The current object (for fluent API support)
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
            $recurso->setUsuario(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
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
     * Otherwise if this Usuario is new, it will return
     * an empty collection; or if this Usuario has previously
     * been saved, it will retrieve related Recursos from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Usuario.
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
     * Clears out the collTipoUsuarios collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Usuario The current object (for fluent API support)
     * @see        addTipoUsuarios()
     */
    public function clearTipoUsuarios()
    {
        $this->collTipoUsuarios = null; // important to set this to null since that means it is uninitialized
        $this->collTipoUsuariosPartial = null;

        return $this;
    }

    /**
     * reset is the collTipoUsuarios collection loaded partially
     *
     * @return void
     */
    public function resetPartialTipoUsuarios($v = true)
    {
        $this->collTipoUsuariosPartial = $v;
    }

    /**
     * Initializes the collTipoUsuarios collection.
     *
     * By default this just sets the collTipoUsuarios collection to an empty array (like clearcollTipoUsuarios());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTipoUsuarios($overrideExisting = true)
    {
        if (null !== $this->collTipoUsuarios && !$overrideExisting) {
            return;
        }
        $this->collTipoUsuarios = new PropelObjectCollection();
        $this->collTipoUsuarios->setModel('TipoUsuario');
    }

    /**
     * Gets an array of TipoUsuario objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Usuario is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TipoUsuario[] List of TipoUsuario objects
     * @throws PropelException
     */
    public function getTipoUsuarios($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTipoUsuariosPartial && !$this->isNew();
        if (null === $this->collTipoUsuarios || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTipoUsuarios) {
                // return empty collection
                $this->initTipoUsuarios();
            } else {
                $collTipoUsuarios = TipoUsuarioQuery::create(null, $criteria)
                    ->filterByUsuario($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTipoUsuariosPartial && count($collTipoUsuarios)) {
                      $this->initTipoUsuarios(false);

                      foreach ($collTipoUsuarios as $obj) {
                        if (false == $this->collTipoUsuarios->contains($obj)) {
                          $this->collTipoUsuarios->append($obj);
                        }
                      }

                      $this->collTipoUsuariosPartial = true;
                    }

                    $collTipoUsuarios->getInternalIterator()->rewind();

                    return $collTipoUsuarios;
                }

                if ($partial && $this->collTipoUsuarios) {
                    foreach ($this->collTipoUsuarios as $obj) {
                        if ($obj->isNew()) {
                            $collTipoUsuarios[] = $obj;
                        }
                    }
                }

                $this->collTipoUsuarios = $collTipoUsuarios;
                $this->collTipoUsuariosPartial = false;
            }
        }

        return $this->collTipoUsuarios;
    }

    /**
     * Sets a collection of TipoUsuario objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $tipoUsuarios A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Usuario The current object (for fluent API support)
     */
    public function setTipoUsuarios(PropelCollection $tipoUsuarios, PropelPDO $con = null)
    {
        $tipoUsuariosToDelete = $this->getTipoUsuarios(new Criteria(), $con)->diff($tipoUsuarios);


        $this->tipoUsuariosScheduledForDeletion = $tipoUsuariosToDelete;

        foreach ($tipoUsuariosToDelete as $tipoUsuarioRemoved) {
            $tipoUsuarioRemoved->setUsuario(null);
        }

        $this->collTipoUsuarios = null;
        foreach ($tipoUsuarios as $tipoUsuario) {
            $this->addTipoUsuario($tipoUsuario);
        }

        $this->collTipoUsuarios = $tipoUsuarios;
        $this->collTipoUsuariosPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TipoUsuario objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TipoUsuario objects.
     * @throws PropelException
     */
    public function countTipoUsuarios(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTipoUsuariosPartial && !$this->isNew();
        if (null === $this->collTipoUsuarios || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTipoUsuarios) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getTipoUsuarios());
            }
            $query = TipoUsuarioQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUsuario($this)
                ->count($con);
        }

        return count($this->collTipoUsuarios);
    }

    /**
     * Method called to associate a TipoUsuario object to this object
     * through the TipoUsuario foreign key attribute.
     *
     * @param    TipoUsuario $l TipoUsuario
     * @return Usuario The current object (for fluent API support)
     */
    public function addTipoUsuario(TipoUsuario $l)
    {
        if ($this->collTipoUsuarios === null) {
            $this->initTipoUsuarios();
            $this->collTipoUsuariosPartial = true;
        }

        if (!in_array($l, $this->collTipoUsuarios->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTipoUsuario($l);

            if ($this->tipoUsuariosScheduledForDeletion and $this->tipoUsuariosScheduledForDeletion->contains($l)) {
                $this->tipoUsuariosScheduledForDeletion->remove($this->tipoUsuariosScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param	TipoUsuario $tipoUsuario The tipoUsuario object to add.
     */
    protected function doAddTipoUsuario($tipoUsuario)
    {
        $this->collTipoUsuarios[]= $tipoUsuario;
        $tipoUsuario->setUsuario($this);
    }

    /**
     * @param	TipoUsuario $tipoUsuario The tipoUsuario object to remove.
     * @return Usuario The current object (for fluent API support)
     */
    public function removeTipoUsuario($tipoUsuario)
    {
        if ($this->getTipoUsuarios()->contains($tipoUsuario)) {
            $this->collTipoUsuarios->remove($this->collTipoUsuarios->search($tipoUsuario));
            if (null === $this->tipoUsuariosScheduledForDeletion) {
                $this->tipoUsuariosScheduledForDeletion = clone $this->collTipoUsuarios;
                $this->tipoUsuariosScheduledForDeletion->clear();
            }
            $this->tipoUsuariosScheduledForDeletion[]= $tipoUsuario;
            $tipoUsuario->setUsuario(null);
        }

        return $this;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->usu_id = null;
        $this->res_id = null;
        $this->usu_nombre = null;
        $this->usu_apellido = null;
        $this->usu_clave = null;
        $this->usu_telefono = null;
        $this->usu_email = null;
        $this->usu_estado = null;
        $this->usu_eliminado = null;
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
            if ($this->collPedidos) {
                foreach ($this->collPedidos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRecursos) {
                foreach ($this->collRecursos as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTipoUsuarios) {
                foreach ($this->collTipoUsuarios as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aResturant instanceof Persistent) {
              $this->aResturant->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collPedidos instanceof PropelCollection) {
            $this->collPedidos->clearIterator();
        }
        $this->collPedidos = null;
        if ($this->collRecursos instanceof PropelCollection) {
            $this->collRecursos->clearIterator();
        }
        $this->collRecursos = null;
        if ($this->collTipoUsuarios instanceof PropelCollection) {
            $this->collTipoUsuarios->clearIterator();
        }
        $this->collTipoUsuarios = null;
        $this->aResturant = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UsuarioPeer::DEFAULT_STRING_FORMAT);
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
     * @return     Usuario The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = UsuarioPeer::UPDATED_AT;

        return $this;
    }

}
