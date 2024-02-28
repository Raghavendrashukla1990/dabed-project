<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import DataTable from '@/Components/DataTable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
    score_record: Object,
});

const tableHeader = {
    'student'       : 'Student Name',
    'test_name'     : 'test Name',   
    'scored_marks'  : 'Scored Marks',
    'total_marks'   : 'Total Marks',
    'rank'          : 'Rank',
};
</script>

<template>
    <AppLayout title="Student Scored Marks Details">
        <template #header>
            <div class="flow-root">
                <div class="float-left">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        <Link :href="route('scored.record.index')" class="text-gray-600 hover:text-gray-900">
                            Student Scored Marks
                        </Link>
                        / Index
                    </h2>
                </div>
                <div class="float-right">
                    <SecondaryButton>
                        <Link :href="route('scored.record.create')" class="text-gray-600 hover:text-gray-900">
                            Add New Student Scored Marks
                        </Link>
                    </SecondaryButton>
                </div>
            </div>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                	<DataTable 
                        :items="score_record" 
                        :theaders="tableHeader" 
                        forEditPath="scored.record.edit" 
                        forDeletePath="scored.record.delete"
                        forIndexPath="scored.record.index"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>