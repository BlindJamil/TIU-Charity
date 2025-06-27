<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait AdminAuditLog
{
    protected static function bootAdminAuditLog()
    {
        static::created(function ($model) {
            static::logAction($model, 'created');
        });

        static::updated(function ($model) {
            static::logAction($model, 'updated');
        });

        static::deleted(function ($model) {
            static::logAction($model, 'deleted');
        });
    }

    protected static function logAction($model, $action)
    {
        if (!Auth::guard('admin')->check()) {
            return;
        }

        DB::table('admin_audit_logs')->insert([
            'admin_user_id' => Auth::guard('admin')->id(),
            'action' => $action,
            'entity_type' => get_class($model),
            'entity_id' => $model->id,
            'old_values' => $action === 'updated' ? json_encode($model->getOriginal()) : null,
            'new_values' => json_encode($model->getAttributes()),
            'ip_address' => request()->ip(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 