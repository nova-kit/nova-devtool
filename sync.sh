#!/bin/bash

awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/base-resource.stub > stubs/BaseResource.stub

awk '{sub(/{{ namespace }}/,"Workbench\\App\\Nova")}1' vendor/laravel/nova/src/Console/stubs/resource.stub > stubs/Resource.stub
