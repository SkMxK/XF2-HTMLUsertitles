<?php

namespace SkMxK\HTMLTitles\XF\Admin\Controller;


class User extends XFCP_User {
    /**
     * Adds the custom_title_type field to the processing of a user edit.
     *
     * @param \XF\Entity\User $user
     * @return \XF\Mvc\FormAction
     * @throws \XF\Mvc\Reply\Exception
     */
    protected function userSaveProcess(\XF\Entity\User $user)
    {
        $form = parent::userSaveProcess($user);
        $input = $this->filter([
            'user' => [
                'custom_title_type' => 'str',
            ]
        ]);
        $form->basicEntitySave($user, $input['user']);
        return $form;
    }
}