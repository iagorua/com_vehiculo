<?php

/**
 * @version		$Id: helloworld.php 46 2010-11-21 17:27:33Z chdemko $
 * @package		Joomla16.Tutorials
 * @subpackage	Components
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @author		Christophe Demko
 * @link		http://joomlacode.org/gf/project/helloworld_1_6/
 * @license		License GNU General Public License version 2 or later
 */

// No direct access to this file
defined('_JEXEC') or die;

// import the list field type
//~ jimport('joomla.form.helper');
//~ JFormHelper::loadFieldClass('list');

/**
 * Vehiculo Form Field class for the Vehiculo component
 */
class JFormFieldVirtuemartcruce extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'Virtuemartcruce';

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	
	protected function getInput()
	{
		$allowEdit		= ((string) $this->element['edit'] == 'true') ? true : false;
		$allowClear		= ((string) $this->element['clear'] != 'false') ? true : false;

		// Load language
		//~ JFactory::getLanguage()->load('com_proveedor', JPATH_ADMINISTRATOR);

		// Load the javascript
		JHtml::_('bootstrap.tooltip');

		
	}
	
	
	
	protected function getOptions() 
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select('id', 'recambio_id', 'version_vehiculo_id', 'virtuemart_product_id', 'fecha_actualizacion');
		$query->from('#__vehiculo_cruces_virtuemart');
		$db->setQuery((string)$query);
		$messages = $db->loadObjectList();
		$options = array();
		if ($messages)
		{
			foreach($messages as $message) 
			{
				$options[] = JHtml::_('select.option', $message->id, $message->virtuemart_product_id,$message->version_vehiculo_id,$message->recambio_id,$message->fecha_actualizacion);
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}
