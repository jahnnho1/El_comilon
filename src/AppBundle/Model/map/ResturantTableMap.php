<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'resturant' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.src.AppBundle.Model.map
 */
class ResturantTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.ResturantTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('resturant');
        $this->setPhpName('Resturant');
        $this->setClassname('AppBundle\\Model\\Resturant');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('res_id', 'ResId', 'INTEGER', true, null, null);
        $this->addColumn('res_nombre', 'ResNombre', 'VARCHAR', false, 50, null);
        $this->addColumn('res_descripcion', 'ResDescripcion', 'VARCHAR', false, 50, null);
        $this->addColumn('res_direccion', 'ResDireccion', 'VARCHAR', false, 100, null);
        $this->addColumn('res_email', 'ResEmail', 'VARCHAR', false, 50, null);
        $this->addColumn('res_telefono', 'ResTelefono', 'VARCHAR', false, 50, null);
        $this->addColumn('res_estado', 'ResEstado', 'SMALLINT', false, null, null);
        $this->addColumn('res_eliminado', 'ResEliminado', 'BOOLEAN', false, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Recurso', 'AppBundle\\Model\\Recurso', RelationMap::ONE_TO_MANY, array('res_id' => 'res_id', ), null, null, 'Recursos');
        $this->addRelation('Usuario', 'AppBundle\\Model\\Usuario', RelationMap::ONE_TO_MANY, array('res_id' => 'res_id', ), null, null, 'Usuarios');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
        );
    } // getBehaviors()

} // ResturantTableMap
