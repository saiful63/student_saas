<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head,Link,router } from '@inertiajs/vue3';
import { can } from '@/lib/can';



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User',
        href: '/users',
    },
];

const props = defineProps({
    permissions:Array
});


function deletePermission(id){
    if(confirm('Are you sure to delete ?')){
        router.delete(`delete-permission/${id}`);
    }
}
</script>

<template>
    <Head title="Permission edit" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-3">
            <div class="overflow-x-auto">
                <Link  href="/create-permission-interface" class="bg-blue-500 text-white px-2 py-1 rounded">Create</Link>
                <table class="min-w-full border border-gray-300 text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b">ID</th>
                            <th class="px-4 py-2 border-b">Name</th>
                            <th class="px-4 py-2 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="permission in props.permissions" class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ permission.id }}</td>
                            <td class="px-4 py-2">{{ permission.name }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <Link :href="`/edit-permission/${permission.id}`" class="bg-blue-500 text-white px-2 py-1 rounded pointer">Edit
                                </Link>
                                <button @click="deletePermission(permission.id)" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
