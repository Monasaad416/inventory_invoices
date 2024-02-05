<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
  {
        $permissions = [
            'لوحة التحكم',

            'قائمة المهام',
            'إضافة مهمة',
            'تعديل مهمة',
            'حذف مهمة',
            'تفاصيل المهمة',

            'تعديل الإعدادات',

            'قائمة المنتجات',
            'إضافة منتج',
            'تعديل منتج',
            'حذف منتج',
            'تفاصيل المنتج',

            'قائمة الوحدات',
            'إضافة وحدة',
            'تعديل وحدة',
            'حذف وحدة',
            'تفاصيل الوحدة',

            'قائمة المستخدمين',
            'إضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',
            'تفاصيل المستخدم',

           'قائمة الفواتير',
            'إضافة فاتورة',
            'تعديل فاتورة',
            'حذف فاتورة',
            'ترحيل فاتورة',
            'تفاصيل الفاتورة',


         ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
