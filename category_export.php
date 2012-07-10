<?php
/**
 * Magento Category Exporter 
 *
 * This web-service returns a JSON with all the categories defined in the application's
 * Admin, where children categories are nested in the respective parent category. 
 *
 * Tested with Magento versions: 1.6.2
 *
 * @author      André Tavares <@andreftavares>
 */

// Imports.
define('MAGENTO', realpath(dirname(__FILE__)));
require_once MAGENTO . '/app/Mage.php';
Mage::app();

function nodeToArray(Varien_Data_Tree_Node $node, $category)
{
    // Only basic category data
    $result = array();
    $result['category_id'] = $node->getId();
    $result['parent_id'] = $node->getParentId();
    $result['name'] = $node->getName();
    $result['is_active'] = $node->getIsActive();
    $result['position'] = $node->getPosition();
    $result['level'] = $node->getLevel();
    $result['children'] = array();

    // Parse children.
    foreach($category->getCollection()->addFieldToFilter('parent_id', $node->getId()) as $child) {
        $result['children'][] = nodeToArray($child->load(), $category);
    }

    // Return.
    return $result;
}

// Response containing the results.
$response = array();

// Fetch the categories.
$category = Mage::getModel('catalog/category');
$response[] = nodeToArray($category->load(1), $category);

// Set headers.
header('Content-type: application/json');

// Encode JSON response.
echo json_encode($response);
?>