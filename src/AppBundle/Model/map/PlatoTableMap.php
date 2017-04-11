<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'plato' table.
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
class PlatoTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.PlatoTableMap';

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
        $this->setName('plato');
        $this->setPhpName('Plato');
        $this->setClassname('AppBundle\\Model\\Plato');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('pla_id', 'PlaId', 'INTEGER', true, null, null);
        $this->addColumn('pla_nombre', 'PlaNombre', 'VARCHAR', false, 100, null);
        $this->addColumn('pla_descripcion', 'PlaDescripcion', 'CLOB', false, null, null);
        $this->addColumn('pla_precio', 'PlaPrecio', 'BIGINT', false, null, null);
        $this->addColumn('pla_stock', 'PlaStock', 'BIGINT', false, null, null);
        $this->addColumn('pla_estado', 'PlaEstado', 'SMALLINT', false, null, null);
        $this->addColumn('pla_eliminado', 'PlaEliminado', 'BOOLEAN', false, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('PlatoPedido', 'AppBundle\\Model\\PlatoPedido', RelationMap::ONE_TO_MANY, array('pla_id' => 'pla_id', ), null, null, 'PlatoPedidos');
        $this->addRelation('Recurso', 'AppBundle\\Model\\Recurso', RelationMap::ONE_TO_MANY, array('pla_id' => 'pla_id', ), null, null, 'Recursos');
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

} // PlatoTableMap
