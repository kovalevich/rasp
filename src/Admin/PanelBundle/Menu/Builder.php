<?php

namespace Admin\PanelBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'childrenAttributes'    => array(
                'class'             => 'main-menu',
            )
        ));

        $menu->addChild('Статистика', array('route' => 'admin_panel_homepage'))
            ->setAttribute('icon', 'fa fa-bar-chart');

        $menu->addChild('Карты', array('route' => 'admin_cards_index'))
            ->setAttribute('icon', 'fa fa-credit-card');

        $menu->addChild('Компании', array('route'=> 'admin_panel_belkarta'))
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'fa fa-child');

        $menu['Компании']->addChild('Компании', array('route' => 'admin_panel_belkarta_companies'))
            ->setAttribute('icon', 'fa fa-file-text-o');

        $menu['Компании']->addChild('Типы компаний', array('route' => 'admin_panel_belkarta_types'))
            ->setAttribute('icon', 'fa fa-folder');

        $menu->addChild('Блог', array('route'=> 'admin_panel_blog'))
            ->setAttribute('dropdown', true)
            ->setAttribute('icon', 'fa fa-bullhorn');

        $menu['Блог']->addChild('Публикации', array('route' => 'admin_panel_publications'))
            ->setAttribute('icon', 'fa fa-file-text-o');

        $menu['Блог']->addChild('Категории', array('route' => 'admin_panel_categories'))
            ->setAttribute('icon', 'fa fa-folder');

        $menu['Блог']->addChild('Темы', array('route' => 'admin_panel_themes'))
            ->setAttribute('icon', 'fa fa-font');

        $menu->addChild('Пользователи', array('route' => 'admin_users_index'))
            ->setAttribute('icon', 'fa fa-users');

        $menu->addChild('Настройки', array('route' => 'admin_panel_config'))
            ->setAttribute('icon', 'fa fa-cog');


        return $menu;
    }
}