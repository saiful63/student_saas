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
        permissions:Object
    });
    const form = useForm({
        name:"",
        address:"",
        selectedPermissions:[]
    });

    function submit(){
        form.post('/create-institution')
    }
</script>
<template>
    <Head title="Institution" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <Link href="list-institution" class="border border-solid border-black block w-30 cursor-pointer">Institution List</Link>
        <form class="max-w-sm mx-auto" @submit.prevent="submit">
            <div class="mb-5">
                <label for="institution" class="block mb-2.5 text-xl font-medium text-heading">Institution</label>
                <input type="institution" id="institution" class="bg-neutral-secondary-medium border border-default-medium text-heading text-xl rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" v-model="form.name" placeholder="Enter institution" required />
            </div>
            <div class="mb-5">
                <label for="address" class="block mb-2.5 text-xl font-medium text-heading">Address</label>
                <input type="address" id="address" class="bg-neutral-secondary-medium border border-default-medium text-heading text-xl rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow-xs placeholder:text-body" v-model="form.address" placeholder="Enter address" required />
            </div>
            <button type="submit" class="text-black bg-brand box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">Submit</button>

            <div class="flex flex-col space-y-2">
                <label v-for="(name,id) in props.permissions" :key="id">
                    <input type="checkbox" :value="id" v-model="form.selectedPermissions"  />
                    <span>
                    {{ name }}
                    </span>
                </label>
            </div>
        </form>
    </AppLayout>

</template>