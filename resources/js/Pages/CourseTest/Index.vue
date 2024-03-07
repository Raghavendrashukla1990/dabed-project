<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    course_test: Object,
});

const tableHeader = {
    'course'        : 'Course Name',
    'test_name'     : "Test Name",
    'total_marks'   : "Total Marks",   
};
</script>
<template>
    <AppLayout title="Course Test">
        <template #header>
            <div class="flow-root">
                <div class="float-left">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <Link :href="route('course.test.index')" class="text-gray-600 hover:text-gray-900">
                            Course / Test /
                        </Link>
                        List
                    </h2>
                </div>
                <div class="float-right">
                    <SecondaryButton>
                        <Link :href="route('course.test.create')" class="text-gray-600 hover:text-gray-900">
                            Add New Test
                        </Link>
                    </SecondaryButton>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                	<DataTable 
                        :items="course_test" 
                        :theaders="tableHeader" 
                        forEditPath="course.test.edit" 
                        forDeletePath="course.test.delete"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>