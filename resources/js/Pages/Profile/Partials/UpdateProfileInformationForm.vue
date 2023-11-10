<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import PixabaySelectPreview from "@/Components/PixabaySelectPreview.vue";
import FileInput from "@/Components/FileInput.vue";
import { Link, useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
    status: String,
});

const user = usePage().props.auth.user;

const form = useForm({
    name: user.name,
    email: user.email,
    user_image: null,
    pixabay_url: null,
});
</script>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Profile Information</h2>
        </header>

        <form @submit.prevent="form.patch(route('profile.update'))" class="mt-6 space-y-6">
            <img style="max-width: 200px;max-height: 200px;" v-if="user.image_path" :src="route('users.getUserImage', user.id)"/>
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="user_image" value="Load profile image" />
                <FileInput
                    id="user_image"
                    type="file"
                    class="mt-1 block w-full"
                    v-model="form.user_image"
                />

                <InputError class="mt-2" :message="form.errors.user_image" />
            </div>

            <div>
                <InputLabel for="pixabay_url" value="You can choose profile image" />

                <PixabaySelectPreview
                    v-on:imageSelected="form.pixabay_url = $event.url"
                />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
