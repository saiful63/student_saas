<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';
import { Head,Link,router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Roles',
        href: '/roles',
    },
];

defineProps({
    roles:Array
});

function roleDelete(id){
    if(confirm('Are you sure to delete ?')){
        router.delete(`roles/${id}`);
    }
}
</script>

<template>
    <Head title="Role" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-3">
            <div class="overflow-x-auto">
                <Link href="/roles/create" class="bg-blue-500 text-white px-2 py-1 rounded">Create</Link>
                <table class="min-w-full border border-gray-300 text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b">ID</th>
                            <th class="px-4 py-2 border-b">Role</th>
                            <th class="px-4 py-2 border-b">Permission</th>
                            <th class="px-4 py-2 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="role in roles" class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ role.id }}</td>
                            <td class="px-4 py-2">{{ role.name }}</td>
                            <td class="px-4 py-2">
                                <span v-for="permission in role.permissions" class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-black-400 inset-ring inset-ring-green-500/20">{{ permission.name }}</span>
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <Link :href="`users/${role.id}`"class="bg-gray-500 text-white px-2 py-1 rounded pointer">Show</Link>
                                <!-- <Link :href="`users/${role.id}/edit`"class="bg-blue-500 text-white px-2 py-1 rounded pointer">Edit</Link> -->

                                <Link :href="route('roles.edit', role.id)" class="bg-blue-500 text-white px-2 py-1 rounded pointer">Edit</Link>

                                <button @click="roleDelete(role.id)" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
