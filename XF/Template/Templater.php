<?php

namespace SkMxK\HTMLTitles\XF\Template;

class Templater extends XFCP_Templater {
    /**
     * Allow HTML in usertitles if their custom_title_type Value is 'admin_set'
     *
     * @param $templater
     * @param $escape
     * @param $user
     * @param bool $withBanner
     * @param array $attributes
     * @return string
     */
    public function fnUserTitle($templater, &$escape, $user, $withBanner = false, $attributes = []) {
        /** @var \SkMxK\HTMLTitles\XF\Entity\User $user */

        $escape = false;
        $userIsValid = ($user instanceof \XF\Entity\User);

        $userTitle = null;

        if($userIsValid && $user->custom_title_type === 'admin_set') {
            $userTitle = $user->custom_title;

            if($userTitle) {
                $class = $this->processAttributeToRaw($attributes, 'class', ' %s', true);

                if (!empty($attributes['tag'])) {
                    $tag = htmlspecialchars($attributes['tag']);
                } else {
                    $tag = 'span';
                }

                unset($attributes['tag']);

                $unhandledAttrs = $this->processUnhandledAttributes($attributes);

                return "<{$tag} class=\"userTitle{$class}\" dir=\"auto\"{$unhandledAttrs}>{$userTitle}</{$tag}>";
            }
        }

        return parent::fnUserTitle($templater, $escape, $user, $withBanner, $attributes);
    }
}