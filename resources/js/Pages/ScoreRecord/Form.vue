<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';
import Select from '@/Components/SelectDropDown.vue';

const props = defineProps({
    score_record: Object,
    students : Object,
});

const form = useForm({
	student_id 		: typeof props.score_record === 'undefined' ? '' : props.score_record.student_id,
	test_name 		: typeof props.score_record === 'undefined' ? '' : props.score_record.test_name,
	scored_marks 	: typeof props.score_record === 'undefined' ? '' : props.score_record.scored_marks,
	total_marks 	: typeof props.score_record === 'undefined' ? '' : props.score_record.total_marks,
	rank 			: typeof props.score_record === 'undefined' ? '' : props.score_record.rank,
});

const studentList = {};

props.students.forEach((data) => {
	studentList[data.id] = data.name
});

const submit = () => {
	if(typeof props.score_record === 'undefined'){
	    form.post(route('scored.record.store'), {
	  		onSuccess: () => form.reset(),
	    });
	} else {
		form.post(route('scored.record.update',props.score_record.id), {
    		PrimaryButton:true
    	});
	}  
};
</script>

<template>
    <AppLayout title="Student Scored Marks">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('scored.record.index')" class="text-gray-600 hover:text-gray-900">
                    Student Scored Marks
                </Link>
                {{ typeof props.score_record === 'undefined' ? '/ Add' : '/ Update' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<form @submit.prevent="submit" class="mx-6 py-10">
				        <div class="flex flex-wrap -mx-3 mb-6">

				        	<div class="mb-4 px-3 w-full">
				            	<InputLabel for="student_id" value="Select Student" />
				                <Select 
				                	:items="studentList" 
				                	:value="form.student_id"
				                	v-model="form.student_id"
				                	id="student_id"
				                />
				                <InputError class="mt-2" :message="form.errors.student_id" />
				            </div>

    						<div class="mb-4 px-3 w-full">
				                <InputLabel for="test_name" value="Test Name"/>
				                <TextInput
				                    id="test_name"
				                    v-model="form.test_name"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.test_name" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="scored_marks" value="Scored Number Of Marks"/>
				                <TextInput
				                    id="scored_marks"
				                    v-model="form.scored_marks"
				                    type="number"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.scored_marks" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="total_marks" value="Total Number Of Marks"/>
				                <TextInput
				                    id="total_marks"
				                    v-model="form.total_marks"
				                    type="number"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.total_marks" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="rank" value="Rank"/>
				                <TextInput
				                    id="rank"
				                    v-model="form.rank"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.rank" />
				            </div>

				        </div>

            			<div class="flex items-center justify-end mt-4">
                			<PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    			{{ typeof props.score_record === 'undefined' ? 'Add' : 'Update' }}
                			</PrimaryButton>
            			</div>
        			</form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>