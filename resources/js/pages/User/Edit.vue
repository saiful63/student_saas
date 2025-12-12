<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head,Link,useForm } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User Edit',
        href: '/users',
    },
];

const props=defineProps({
    user:Object,
    permissions:Array
});
const form = useForm({
    name:props.user.name,
    email:props.user.email,
    password:"",

});
function update(){
    form.put(`/users/${props.user.id}`)
}

</script>

<template>
    <Head title="User" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-3">
            <div class="overflow-x-auto">
                <Link href="/users" class="bg-blue-500 text-white px-2 py-1 rounded">Back</Link>
                <form @submit.prevent="update"class="space-y-6 mt-4 max-w-md mx-auto">
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
                        <label for="email" class="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                            Email:
                        </label>
                        <input
                            id="email"
                            name="email"
                            v-model="form.email"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your email"
                        />
                        <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                    </div>

                    <div class="grid gap-2">
                        <label for="password" class="text-sm leading-none font-medium select-none peer-disabled:cursor-not-allowed peer-disabled:opacity-50">
                            Password:
                        </label>
                        <input
                            id="password"
                            name="password"
                            v-model="form.password"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 text-base shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter your password"
                        />
                        <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password }}.</p>
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
