#!/bin/bash

awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/base-resource.stub > stubs/base-resource.stub

cp vendor/laravel/nova/src/Console/stubs/resource.stub stubs/resource.stub
cp vendor/laravel/nova/src/Console/stubs/lens.stub stubs/lens.stub
cp vendor/laravel/nova/src/Console/stubs/partition.stub stubs/partition.stub
cp vendor/laravel/nova/src/Console/stubs/progress.stub stubs/progress.stub
cp vendor/laravel/nova/src/Console/stubs/table.stub stubs/table.stub
cp vendor/laravel/nova/src/Console/stubs/trend.stub stubs/trend.stub
cp vendor/laravel/nova/src/Console/stubs/value.stub stubs/value.stub

cp vendor/laravel/nova/src/Console/stubs/action.stub stubs/action.stub
cp vendor/laravel/nova/src/Console/stubs/action.queued.stub stubs/action.queued.stub
cp vendor/laravel/nova/src/Console/stubs/destructive-action.stub stubs/destructive-action.stub
cp vendor/laravel/nova/src/Console/stubs/destructive-action.queued.stub stubs/destructive-action.queued.stub

cp vendor/laravel/nova/src/Console/stubs/filter.stub stubs/filter.stub
cp vendor/laravel/nova/src/Console/stubs/boolean-filter.stub stubs/boolean-filter.stub
cp vendor/laravel/nova/src/Console/stubs/date-filter.stub stubs/date-filter.stub

cp vendor/laravel/nova/src/Console/stubs/dashboard.stub stubs/dashboard.stub
awk '{sub(/namespace App\\Nova\\Dashboards/,"namespace {{ namespace }}")}1' vendor/laravel/nova/src/Console/stubs/main-dashboard.stub > stubs/main-dashboard.stub
