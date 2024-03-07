<script setup>
import {Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectDropDown from '@/Components/SelectDropDown.vue';

const props = defineProps({
    course: Object,
	course_test : Object,
});

const courseList = {};

props.course.forEach((data) => {
	courseList[data.id] = data.name
});

const form = useForm({
    course_id   : typeof props.course_test === 'undefined' ? ''  : props.course_test.course_id,
	test_name   : typeof props.course_test === 'undefined' ? ''  : props.course_test.test_name,
	total_marks : typeof props.course_test === 'undefined' ? '0' : props.course_test.total_marks,
});

const submit = () => {
	if(typeof props.course_test === 'undefined'){
	    form.post(route('course.test.store'), {
	  		onSuccess: () => form.reset(),
	    });
	} else {
		form.post(route('course.test.update',props.course_test.id), {
    		PrimaryButton:true
    	});
	}  
};
</script>

<template>
    <AppLayout title="Course Test">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('course.test.index')" class="text-gray-600 hover:text-gray-900">
                    Course / Test /
                </Link>
                {{ typeof props.course_test === 'undefined' ? 'Add' : 'Update' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<form @submit.prevent="submit" class="mx-6 py-10">
				        <div class="flex flex-wrap -mx-3 mb-6">
    						
							<div class="mb-4 px-3 w-full">
				            	<InputLabel for="course_id" value="Select Course" />
				                <SelectDropDown 
				                	:items="course" 
				                	:value="form.course_id"
				                	v-model="form.course_id"
				                	id="course_id"
				                />
				                <InputError class="mt-2" :message="form.errors.course_id" />
				            </div>

							<div class="mb-4 px-3 w-full">
				                <InputLabel for="test_name" value="Test Name" required/>
				                <TextInput
				                    id="test_name"
				                    v-model="form.test_name"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.test_name" />
				            </div>
							
							<div class="mb-4 px-3 w-full">
				                <InputLabel for="test_name" value="Test Name" required/>
				                <TextInput
				                    id="test_name"
				                    v-model="form.test_name"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.test_name" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="total_marks" value="Course Total Marks" required/>
				                <TextInput
				                    id="total_marks"
				                    v-model="form.total_marks"
				                    type="number"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.total_marks" />
				            </div>

				        </div>

            			<div class="flex items-center justify-end mt-4">
                			<PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    			{{ typeof props.course_test === 'undefined' ? 'Add' : 'Update' }}
                			</PrimaryButton>
            			</div>
        			</form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>