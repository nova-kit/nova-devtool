#!/bin/bash

awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/base-resource.stub > stubs/base-resource.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/resource.stub > stubs/resource.stub
awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/action.stub > stubs/action.stub
