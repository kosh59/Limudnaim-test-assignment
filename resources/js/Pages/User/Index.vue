<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    users: {
        type: Array,
        default: [],
    },
});

defineOptions()
// export default {
//     components: {
//         AuthenticatedLayout,
//         Head,
//     },
//     data() {
//         return {
//             users: [],
//         }
//     },
//     methods: {
//         update() {
//             //
//         }
//     },
// }
</script>

<template>
    <Head title="Users Index" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users Index</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Picture</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="users && users.length">
                                <tr v-for="user in users">
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>
                                        <img style="max-width: 200px;max-height: 200px;" v-if="user.image_path" :src="route('users.getUserImage', user.id)">
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <div>No users</div>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
