<?php

namespace App\Http\Composers;

use App\Models\BackendMenu;
use Illuminate\View\View;
use Request;

class BackendMenuComposer
{
    public $blockNodes = [];

    public function compose(View $view)
    {
        $view->with('backendMenus', $this->backendMenu());
    }

    private function backendMenu()
    {
        $backendMenus = BackendMenu::where(['status' => 1])->get()->toArray();

        $myMenu = '';
        $nodes  = $this->menuTree($backendMenus, $this->blockNodes);

        $this->frontendMenu($nodes, $myMenu);

        return $myMenu;
    }

    private function menuTree(array $nodes, array $blockNodes = null)
    {
        $tree = [];
        foreach ($nodes as $node) {
            if (isset($node['link']) && !isset($blockNodes[$node['link']])) {

                if (in_array($node['link'], $blockNodes)) {
                    continue;
                }

                if (($node['link'] != '#') && !blank(auth()->user()) && !auth()->user()->can($node['link'])) {
                    continue;
                }

                if ($node['parent_id'] == 0) {
                    $tree[$node['id']] = $node;
                } else {
                    if (!isset($tree[$node['parent_id']]['child'])) {
                        $tree[$node['parent_id']]['child'] = [];
                    }
                    $tree[$node['parent_id']]['child'][$node['id']] = $node;
                }
            }
        }

        return $tree;
    }

    private function frontendMenu(array $nodes, string &$menu)
    {
        foreach ($nodes as $node) {

            if ($node['link'] == '#' && !isset($node['child'])) {
                continue;
            }

            $f           = 0;
            $active      = '';
            $dropdown    = '';

            if (Request::segment(2) == $node['link']) {
                $active = 'active';
            }

            if (isset($node['child'])) {
                $f        = 1;
                $dropdown = 'data-toggle="collapse" data-target="#collapse' . $node['id'] . '" aria-expanded="true" aria-controls="collapse' . $node['id'] . '"';

                $childArray  = collect($node['child'])->pluck('link')->toArray();
                $segmentLink = Request::segment(1);
                if (in_array($segmentLink, $childArray)) {
                    $active = 'active';
                }
            }

            $menu .= '<li class="nav-item ' . $active . '">';
            $menu .= '<a class="nav-link" href="' . url('admin/'.$node['link']) . '" ' . $dropdown . '>';
            $menu .= '<i class="' . ($node['icon'] ? $node['icon'] : 'fa fa-home') . '"></i>';
            $menu .= '<span>' . $node['name'] . '</span>';
            $menu .= "</a>";
            if ($f) {
                $menu .= '<div id="collapse' . $node['id'] . '" class="collapse" data-parent="#accordionSidebar">';
                $menu .= '<div class="bg-white py-2 collapse-inner rounded">';
                $menu .= '<h6 class="collapse-header">' . $node['name'] . '</h6>';
                foreach ($node['child'] as $childnode) {
                    $childactive = '';
                    if (Request::segment(1) == $childnode['link']) {
                        $childactive = 'active';
                    }
                    $menu .= '<a class="collapse-item ' . $childactive . '" href="' . url('admin/'.$childnode['link']) . '">' . $childnode['name'] . '</a>';
                }
                $menu .= '</div>';
                $menu .= '</div>';
            }
            $menu .= "</li>";
        }
    }
}
