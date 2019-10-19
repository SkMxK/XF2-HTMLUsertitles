<?php

namespace SkMxK\HTMLTitles\XF\Entity;

use XF\Mvc\Entity\Structure;

/**
 * Class User
 * @package SkMxK\HTMLTitles\XF\Entity
 *
 * @property string custom_title_type
 */
class User extends XFCP_User
{
    /**
     * Reset custom_title_type if the edit isn't from Admin CP
     */
    protected function _preSave()
    {
        parent::_preSave();

        if($this->isChanged('custom_title')) {
            if (!$this->getOption('admin_edit')) {
                $this->custom_title_type = 'user_set';
            }
        }
    }

    /**
     * Add the custom_title_type field to the structure
     *
     * @param Structure $structure
     * @return Structure
     */
    public static function getStructure(Structure $structure)
    {
        $structure = parent::getStructure($structure);
        $structure->columns['custom_title_type'] = ['type' => self::STR, 'default' => 'user_set', 'allowedValues' => [
            'user_set', 'admin_set'
            ]
        ];
        return $structure;
    }
}