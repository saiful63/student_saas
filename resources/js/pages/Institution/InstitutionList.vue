<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import { Head,Link,useForm } from '@inertiajs/vue3';
    const breadcrumbs:BreadcrumbItem[]=[
        {
            title: 'Institution',
            href: '/users',
        },
    ]
    const props = defineProps({
        institutions:Object
    });
</script>
<template>
    <Head title="Institution List" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
            <table class="w-full text-sm text-left rtl:text-right text-body">
                <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                    <tr>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Sl
                        </th>
                        <th scope="col" class="px-6 py-3 font-medium">
                            Name
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(institution,index) in props.institutions" class="bg-neutral-primary border-b border-default">
                        <td class="px-6 py-4">
                            {{ index+1 }}
                        </td>
                        <td class="px-6 py-4">
                            {{ institution.name }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </AppLayout>
</template>



