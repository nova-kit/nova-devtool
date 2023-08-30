#!/bin/bash

awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/base-resource.stub > stubs/base-resource.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/resource.stub > stubs/resource.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/lens.stub > stubs/lens.stub

awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/action.stub > stubs/action.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/action.queued.stub > stubs/action.queued.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/destructive-action.stub > stubs/destructive-action.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/destructive-action.queued.stub > stubs/destructive-action.queued.stub

awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/filter.stub > stubs/filter.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/boolean-filter.stub > stubs/boolean-filter.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/date-filter.stub > stubs/date-filter.stub

awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/dashboard.stub > stubs/dashboard.stub
awk '{sub(/namespace App/,"namespace Workbench\\App")}1' vendor/laravel/nova/src/Console/stubs/main-dashboard.stub > stubs/main-dashboard.stub

awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/partition.stub > stubs/partition.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/progress.stub > stubs/progress.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/table.stub > stubs/table.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/trend.stub > stubs/trend.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/value.stub > stubs/value.stub
