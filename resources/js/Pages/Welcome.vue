<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Home" />
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-slate-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-slate-600 hover:text-slate-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ms-4 font-semibold text-slate-600 hover:text-slate-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
            <h1 class="mt-2 text-2xl font-medium text-gray-900">
                Welcome to my Laravel-Vue.js application !
            </h1>

            <p class="mt-6 text-gray-500 leading-relaxed">
                Laravel Jetstream provides a beautiful, robust starting point for your next Laravel application. Laravel is
                designed
                to help you build your application using a development environment that is simple, powerful, and enjoyable.
                We believe
                you should love expressing your creativity through programming, so we have spent time carefully crafting the
                Laravel
                ecosystem to be a breath of fresh air. We hope you love it.
            </p>
        </div>
        </div>
    </div>
</template>

