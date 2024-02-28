<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    course: Object,
});

const tableHeader = {
    'name'   : 'Course Name',
    'price'  : 'Course Price',   
};
</script>

<template>
    <AppLayout title="Course">
        <template #header>
            <div class="flow-root">
                <div class="float-left">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <Link :href="route('courses.index')" class="text-gray-600 hover:text-gray-900">
                            Course /
                        </Link>
                        List
                    </h2>
                </div>
                <div class="float-right">
                    <SecondaryButton>
                        <Link :href="route('courses.create')" class="text-gray-600 hover:text-gray-900">
                            Add New Course
                        </Link>
                    </SecondaryButton>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                	<DataTable 
                        :items="course" 
                        :theaders="tableHeader" 
                        forEditPath="courses.edit" 
                        forDeletePath="courses.delete"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>