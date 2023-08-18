<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import Field from "@/Components/Field.vue";
import LoadingButton from "@/Components/LoadingButton.vue";
defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.transform((data) => ({
        ...data,
        remember: form.remember ? "on" : "",
    })).post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <Head title="Log in" />

    <!-- <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    v-model="form.password"
                    type="password"
                    class="mt-1 block w-full"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Forgot your password?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard> -->
    <section class="h-screen">
        <div class="h-full">
            <!-- Left column container with background-->
            <div
                class="g-6 flex h-full flex-wrap items-center justify-center lg:justify-between">
                <div
                    class="hidden lg:block shrink-1 mb-12 grow-0 basis-auto md:mb-0 md:w-9/12 md:shrink-0 lg:w-6/12 xl:w-6/12">
                    <img
                        src="http://www.localplaner.de/img/login-v2.72cd8a26.svg"
                        class="w-full"
                        alt="Sample image"
                    />
                </div>

                <!-- Right column container -->
                <div class="mb-12 md:mb-0 md:w-8/12 lg:w-5/12 xl:w-5/12">
                    <section class="bg-gray-50 dark:bg-gray-900">
                        <div
                            class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                            <a
                                href="#"
                                class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                                <!-- <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo"> -->
                                <AuthenticationCardLogo class="w-8 h-8 mr-2" />
                                Maquinarium
                            </a>
                            <div
                                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                    <h1
                                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                        Iniciar sesión en tu cuenta
                                    </h1>
                                    <form
                                        @submit.prevent="submit"
                                        class="space-y-4 md:space-y-6">
                                        <div>
                                            <Field
                                                label="Tu Correo"
                                                :error="form.errors.email">
                                                <Input
                                                    v-model="form.email"
                                                    type="email"
                                                    placeholder="name@company.com"
                                                />
                                            </Field>
                                        </div>
                                        <div>
                                            <Field
                                                label="Password"
                                                :error="form.errors.password">
                                                <Input
                                                    v-model="form.password"
                                                    type="password"
                                                    placeholder="••••••••"
                                                />
                                            </Field>
                                        </div>
                                        <div
                                            class="flex items-center justify-between">
                                            <div class="flex items-start">
                                                <div
                                                    class="flex items-center h-5">
                                                    <!-- <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800" required=""> -->
                                                    <Checkbox
                                                        v-model:checked="
                                                            form.remember
                                                        "
                                                        name="remember"
                                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                                    />
                                                </div>
                                                <div class="ml-3 text-sm">
                                                    <label
                                                        for="remember"
                                                        class="text-gray-500 dark:text-gray-300"
                                                        >Recuerdame</label>
                                                </div>
                                            </div>
                                            <Link
                                                v-if="canResetPassword"
                                                :href="
                                                    route('password.request')
                                                "
                                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">
                                                ¿Olvidaste tu contraseña?
                                            </Link>
                                        </div>
                                        <LoadingButton
                                            :loading="form.processing"
                                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Iniciar sesión
                                        </LoadingButton>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</template>
