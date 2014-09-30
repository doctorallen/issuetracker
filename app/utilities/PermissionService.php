<?php
use Illuminate\Support\ServiceProvider;

class PermissionService extends ServiceProvider {

    public function register()
    {
        $this->app->bind('permission', function()
        {
            return new PermissionChecker;
        });
    }

}
