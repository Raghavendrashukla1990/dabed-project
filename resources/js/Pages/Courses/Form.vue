<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Dropdown from '@/Components/Dropdown.vue';

const props = defineProps({
    course: Object,
});

const form = useForm({
	name: typeof props.course === 'undefined' ? '' : props.course.name ,
	price: typeof props.course === 'undefined' ? '0' : props.course.price ,
	status: typeof props.course === 'undefined' ? '1' : props.course.status,
});

const submit = () => {
	if(typeof props.course === 'undefined'){
	    form.post(route('courses.store'), {
	  		onSuccess: () => form.reset(),
	    });
	} else {
		form.post(route('courses.update',props.course.id), {
    		PrimaryButton:true
    	});
	}  
};
</script>

<template>
    <AppLayout title="Course Create">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <Link :href="route('courses.index')" class="text-gray-600 hover:text-gray-900">
                    Course
                </Link>
                {{ typeof props.course === 'undefined' ? '/ Create' : '/ Edit' }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
					<form @submit.prevent="submit" class="mx-6 py-10">
				        <div class="flex flex-wrap -mx-3 mb-6">
    						<div class="mb-4 px-3 w-full">
				                <InputLabel for="name" value="Course Name" required/>
				                <TextInput
				                    id="name"
				                    v-model="form.name"
				                    type="text"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.name" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				                <InputLabel for="price" value="Course Price" required/>
				                <TextInput
				                    id="price"
				                    v-model="form.price"
				                    type="number"
				                    class="mt-1 block w-full"
				                />
				                <InputError class="mt-2" :message="form.errors.price" />
				            </div>

				            <div class="mb-4 px-3 w-full">
				            	<InputLabel for="status" value="Course Status" />
				                <select id="status" v-model="form.status" class="block border border-gray-300 p-2.5 rounded-lg text-sm w-full">
								    <option value="1">Active</option>
								    <option value="0">Inactive</option>
								</select>
				                <InputError class="mt-2" :message="form.errors.status" />
				            </div>
				        </div>

            			<div class="flex items-center justify-end mt-4">
                			<PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    			{{ typeof props.course === 'undefined' ? 'Submit' : 'Update' }}
                			</PrimaryButton>
            			</div>
        			</form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>