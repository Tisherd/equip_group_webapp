<?php

namespace App\Services;

use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;

class GroupHierarchy
{
    protected Collection $groups;
    protected array $groupsById = [];
    protected array $hierarchy = [];

    public function __construct()
    {
        $this->groups = Group::withCount('products')->get();
        $this->buildHierarchy();
    }

    protected function buildHierarchy()
    {
        // Индексируем группы по id
        foreach ($this->groups as $group) {
            $this->groupsById[$group->id] = [
                'id' => $group->id,
                'name' => $group->name,
                'products_quantity' => $group->products_count ?? 0,
                'active' => false,
                'id_parent' => $group->id_parent,
                'full_group_ids' => [$group->id],
                'children' => [],
            ];
        }

        // Строим дерево
        foreach ($this->groupsById as &$group) {
            if ($group['id_parent'] && isset($this->groupsById[$group['id_parent']])) {
                $this->groupsById[$group['id_parent']]['children'][] = &$group;
            } else {
                $this->hierarchy[] = &$group;
            }
        }

        // Добавляем full_group_ids
        foreach ($this->hierarchy as &$rootGroup) {
            $this->populateFullGroupIds($rootGroup);
        }
    }

    protected function populateFullGroupIds(&$group)
    {
        foreach ($group['children'] as &$child) {
            $this->populateFullGroupIds($child);
            $group['full_group_ids'] = array_merge($group['full_group_ids'], $child['full_group_ids']);
            $group['products_quantity'] += $child['products_quantity']; // Суммируем товары из подгрупп
        }
    }

    public function getHierarchy(): array
    {
        return $this->hierarchy;
    }

    public function setActiveGroup(int $activeGroupId)
    {
        foreach ($this->groupsById as &$group) {
            if (in_array($activeGroupId, $group['full_group_ids'])) {
                $group['active'] = true;
            } else {
                $group['active'] = false;
            }
        }
    }

    public function getFullGroupIds($groupId): array
    {
        return $this->groupsById[$groupId]['full_group_ids'] ?? [];
    }
}
