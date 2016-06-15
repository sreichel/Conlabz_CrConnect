<?php
class Conlabz_Crconnect_Adminhtml_CrconfigController extends Mage_Adminhtml_Controller_Action
{
    const EMPTY_CODE = "empty";

    public function confirmKeyAction()
    {
        $apiKey = $this->getRequest()->getParam("crconnectkey");
        $api = Mage::getModel("crconnect/api");
        if ($api->isConnected()) {
            $groups = $api->getGroupsForKey($apiKey);
            if ($groups) {
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($groups));
            } else {
                $this->getResponse()->setBody(self::EMPTY_CODE);
            }
        }
    }

    public function changeGroupAction()
    {
        $groupId = $this->getRequest()->getParam("group");
        $apiKey = $this->getRequest()->getParam("crconnectkey");

        $api = Mage::getModel("crconnect/api");
        if ($api->isConnected()) {
            $forms = $api->getFormsForGroup($apiKey, $groupId);
            if ($forms) {
                $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($forms));
            } else {
                $this->getResponse()->setBody(self::EMPTY_CODE);
            }
        }
    }

    public function getGroupsBlockAction()
    {
        $this->getResponse()->setBody(
            $this->getLayout()
                ->createBlock('crconnect/config_groupsApis')
                ->toHtml()
        );
    }

    protected function _isAllowed()
    {
        return true;
    }
}
