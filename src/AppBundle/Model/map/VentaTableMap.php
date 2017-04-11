<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'venta' table.
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
class VentaTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.VentaTableMap';

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
        $this->setName('venta');
        $this->setPhpName('Venta');
        $this->setClassname('AppBundle\\Model\\Venta');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('ven_id', 'VenId', 'INTEGER', true, null, null);
        $this->addColumn('ven_numero_documento', 'VenNumeroDocumento', 'VARCHAR', false, 50, null);
        $this->addColumn('ven_tipo_documento', 'VenTipoDocumento', 'VARCHAR', false, 50, null);
        $this->addColumn('ven_sub_total', 'VenSubTotal', 'BIGINT', false, null, null);
        $this->addColumn('ven_iva', 'VenIva', 'BIGINT', false, null, null);
        $this->addColumn('ven_propina', 'VenPropina', 'BIGINT', false, null, null);
        $this->addColumn('ven_total', 'VenTotal', 'BIGINT', false, null, null);
        $this->addColumn('ven_estado', 'VenEstado', 'SMALLINT', false, null, null);
        $this->addColumn('ven_eliminado', 'VenEliminado', 'BOOLEAN', false, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Pedido', 'AppBundle\\Model\\Pedido', RelationMap::ONE_TO_MANY, array('ven_id' => 'ven_id', ), null, null, 'Pedidos');
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

} // VentaTableMap
