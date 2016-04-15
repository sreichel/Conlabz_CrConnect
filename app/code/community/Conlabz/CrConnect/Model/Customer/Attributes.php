<?php

class Conlabz_CrConnect_Model_Customer_Attributes
{
	public function toOptionArray()
	{
		$attributes = Mage::getModel('customer/entity_attribute_collection');

		$options = array();
		foreach ($attributes as $attribute)
		{
			if (($label = $attribute->getFrontendLabel()))
			{
				$options[] = array(
					'label' => $label,
					'value' => $attribute->getName(),
				);
			}
		}
		return $options;
	}
}