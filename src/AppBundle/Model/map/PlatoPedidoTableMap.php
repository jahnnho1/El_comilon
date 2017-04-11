<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'plato_pedido' table.
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
class PlatoPedidoTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.PlatoPedidoTableMap';

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
        $this->setName('plato_pedido');
        $this->setPhpName('PlatoPedido');
        $this->setClassname('AppBundle\\Model\\PlatoPedido');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('ped_id', 'PedId', 'INTEGER' , 'pedido', 'ped_id', true, null, null);
        $this->addForeignPrimaryKey('pla_id', 'PlaId', 'INTEGER' , 'plato', 'pla_id', true, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Pedido', 'AppBundle\\Model\\Pedido', RelationMap::MANY_TO_ONE, array('ped_id' => 'ped_id', ), null, null);
        $this->addRelation('Plato', 'AppBundle\\Model\\Plato', RelationMap::MANY_TO_ONE, array('pla_id' => 'pla_id', ), null, null);
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

} // PlatoPedidoTableMap
