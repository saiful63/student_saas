<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head,Link,useForm,router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import axios from 'axios'
import {ref} from 'vue'


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'User Create',
        href: '/users',
    },
];

const props = defineProps({
    permissions:Array,
    institutions:Array
});
const form = useForm({
    name:"",
    email:"",
    password:"",
    selectedPermission:[],
    institution_id:""
});
const permissions = ref({});

function submit(){
    form.post('/save/create2/user')
}

const fetchPermissions = async () => {
    const res = await axios.post(route('get.company.wise.permission'), {
        params: {
            institution_id: form.institution_id
        }
    })

    permissions.value = res.data.permissions
    
}

</script>

<template>
    <Head title="User2" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-3">
            <div class="overflow-x-auto">
                <Link href="/users" class="bg-blue-500 text-white px-2 py-1 rounded">Back</Link>
                <form @submit.prevent="submit"class="space-y-6 mt-4 max-w-md mx-auto">
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
                    <div class="grid gap-2">
                        <label for="institution_id">Institution</label>
                        <select class="block w-full rounded-md border-gray-300 shadow-sm cursor-pointer p-2.5" id="institution_id" v-model="form.institution_id" @change="fetchPermissions">
                            <option value="" disabled>Please,select...</option>
                            <option v-for="institution in props.institutions" :key="institution.id" :value="institution.id" >
                                {{ institution.name }}
                            </option>
                        </select>
                    </div>

                    <button
                        type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition"
                    >
                        Submit
                    </button>

                    <div class="flex flex-col space-y-2">
                            <label v-for="permission in permissions" :key="permission">
                                <input type="checkbox" :value="permission" v-model="form.selectedPermission"  />
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
