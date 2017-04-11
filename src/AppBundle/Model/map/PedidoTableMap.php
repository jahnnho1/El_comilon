<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'pedido' table.
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
class PedidoTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.PedidoTableMap';

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
        $this->setName('pedido');
        $this->setPhpName('Pedido');
        $this->setClassname('AppBundle\\Model\\Pedido');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ped_id', 'PedId', 'INTEGER', true, null, null);
        $this->addForeignKey('ven_id', 'VenId', 'INTEGER', 'venta', 'ven_id', false, null, null);
        $this->addForeignKey('tpe_id', 'TpeId', 'INTEGER', 'tipo_pedido', 'tpe_id', false, null, null);
        $this->addForeignKey('usu_id', 'UsuId', 'INTEGER', 'usuario', 'usu_id', false, null, null);
        $this->addColumn('ped_estado', 'PedEstado', 'SMALLINT', false, null, null);
        $this->addColumn('ped_eliminado', 'PedEliminado', 'BOOLEAN', false, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TipoPedido', 'AppBundle\\Model\\TipoPedido', RelationMap::MANY_TO_ONE, array('tpe_id' => 'tpe_id', ), null, null);
        $this->addRelation('Venta', 'AppBundle\\Model\\Venta', RelationMap::MANY_TO_ONE, array('ven_id' => 'ven_id', ), null, null);
        $this->addRelation('Usuario', 'AppBundle\\Model\\Usuario', RelationMap::MANY_TO_ONE, array('usu_id' => 'usu_id', ), null, null);
        $this->addRelation('PlatoPedido', 'AppBundle\\Model\\PlatoPedido', RelationMap::ONE_TO_MANY, array('ped_id' => 'ped_id', ), null, null, 'PlatoPedidos');
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

} // PedidoTableMap
