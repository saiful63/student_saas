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

defineProps({
    users:Array
});

function userDelete(id){
    if(confirm('Are you sure to delete ?')){
        router.delete(`users/${id}`);
    }
}
</script>

<template>
    <Head title="User" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-3">
            <div class="overflow-x-auto">
                <Link v-if="can('users.create')" href="/users/create" class="bg-blue-500 text-white px-2 py-1 rounded">Create</Link>
                <Link  href="/index/create2/user" class="bg-blue-500 text-white px-2 py-1 rounded">Create2</Link>
                <table class="min-w-full border border-gray-300 text-sm text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 border-b">ID</th>
                            <th class="px-4 py-2 border-b">Name</th>
                            <th class="px-4 py-2 border-b">Email</th>
                            <th class="px-4 py-2 border-b">roles</th>
                            <th class="px-4 py-2 border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ user.id }}</td>
                            <td class="px-4 py-2">{{ user.name }}</td>
                            <td class="px-4 py-2">{{ user.email }}</td>
                            <td class="px-4 py-2">
                                <span v-for="role in user.roles" class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-black-400 inset-ring inset-ring-green-500/20">{{ role.name }}</span>
                            </td>
                            <td class="px-4 py-2 space-x-2">
                                <Link v-if="can('users.view')" :href="`users/${user.id}`"class="bg-gray-500 text-white px-2 py-1 rounded pointer">Show</Link>
                                <Link v-if="can('users.edit')" :href="`users/${user.id}/edit`"class="bg-blue-500 text-white px-2 py-1 rounded pointer">Edit</Link>
                                <button v-if="can('users.delete')" @click="userDelete(user.id)" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AppLayout>
</template>
