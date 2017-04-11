<?php

namespace AppBundle\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'recurso' table.
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
class RecursoTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'src.AppBundle.Model.map.RecursoTableMap';

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
        $this->setName('recurso');
        $this->setPhpName('Recurso');
        $this->setClassname('AppBundle\\Model\\Recurso');
        $this->setPackage('src.AppBundle.Model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('rec_id', 'RecId', 'INTEGER', true, null, null);
        $this->addForeignKey('res_id', 'ResId', 'INTEGER', 'resturant', 'res_id', false, null, null);
        $this->addForeignKey('usu_id', 'UsuId', 'INTEGER', 'usuario', 'usu_id', false, null, null);
        $this->addForeignKey('pla_id', 'PlaId', 'INTEGER', 'plato', 'pla_id', false, null, null);
        $this->addColumn('rec_src', 'RecSrc', 'VARCHAR', false, 50, null);
        $this->addColumn('rec_estado', 'RecEstado', 'SMALLINT', false, null, null);
        $this->addColumn('rec_eliminado', 'RecEliminado', 'BOOLEAN', false, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Plato', 'AppBundle\\Model\\Plato', RelationMap::MANY_TO_ONE, array('pla_id' => 'pla_id', ), null, null);
        $this->addRelation('Resturant', 'AppBundle\\Model\\Resturant', RelationMap::MANY_TO_ONE, array('res_id' => 'res_id', ), null, null);
        $this->addRelation('Usuario', 'AppBundle\\Model\\Usuario', RelationMap::MANY_TO_ONE, array('usu_id' => 'usu_id', ), null, null);
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

} // RecursoTableMap
