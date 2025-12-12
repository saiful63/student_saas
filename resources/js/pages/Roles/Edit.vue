<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head,Link,useForm } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Roles Create',
        href: '/roles',
    },
];
const props = defineProps({
    role:Object,
    permissions:Array,
    rolePermissions:Array
});
const form = useForm({
    name:props.role.name,
    perms:props.rolePermissions
});

</script>

<template>
    <Head title="Edit Role" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-3">
            <div class="overflow-x-auto">
                <Link href="/roles" class="bg-blue-500 text-white px-2 py-1 rounded">Back</Link>
                <form @submit.prevent="form.put(route('roles.update'))" class="space-y-6 mt-4 max-w-md mx-auto">
                    <div class="grid gap-2">
                        <label for="name" class="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                            Name:
                        </label>
                        <input
                            id="name"
                            name="name"
                            v-model="form.name"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your name"
                        />
                        <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                    </div>
                    <div class="grid gap-2">
                        <label for="permission" class="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                            permission:
                        </label>

                        <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                    </div>
                    <button
                        type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition"
                    >
                        Submit
                    </button>
                        <div class="flex flex-col space-y-2">
                            <label v-for="permission in props.permissions" :key="permission">
                                <input type="checkbox" :value="permission" v-model="form.perms"  />
                                <span>

                                {{ permission }}
                                </span>
                            </label>
                        </div>
                </form>
            </div>

        </div>
    </AppLayout>
</template>
