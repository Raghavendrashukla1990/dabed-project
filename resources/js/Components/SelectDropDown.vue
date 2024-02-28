<script setup>
const props = defineProps({
	items : {
		type: Object,
		required : true,
	},
	modelValue : {
		type : [String,Number,Boolean],
		default : false
	},
	value : {
		type : [String,Number],
		required : false,
	}
});
</script>
<template>
	<select class="block border border-gray-300 p-2.5 rounded-lg text-sm w-full" @change="$emit('update:modelValue', $event.target.value)">
		<option value="" selected>Select</option>
	    <option v-for="(item, key ,index) in items" :key="index" :value="key" :selected="key == value">{{item}}</option>
	</select>
</template>