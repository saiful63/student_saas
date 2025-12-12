<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head,Link,useForm } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User Show',
        href: '/users',
    },
];

const props=defineProps({
    user:Object
});

</script>

<template>
    <Head title="User" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-3">
            <div class="overflow-x-auto">
                <Link href="/users" class="bg-blue-500 text-white px-2 py-1 rounded">Back</Link>
                <div>
                    <p><strong>Name</strong>{{ props.user.name }}</p>
                    <p><strong>Name</strong>{{ props.user.email }}</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
