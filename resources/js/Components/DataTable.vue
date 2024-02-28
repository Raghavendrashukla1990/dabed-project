<script setup>
import { watch,ref } from "vue";
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import Search from '@/Components/Search.vue'
import Trash from '@/Components/Icons/svg/Trash.vue'
import Edit from '@/Components/Icons/svg/Edit.vue'
import { router } from '@inertiajs/vue3'
const props = defineProps({
    theaders:{
    	type:Object,
    	required:true,
    },
    items: {
        type: Object,
        required: true,
    },
    forEditPath:{
    	type: String,
        default: '',
    },
    forDeletePath:{
    	type: String,
        default: '',
    },
    forIndexPath:{
    	type:String,
    	default:'',
    },
});

const filter = {
	orderBy : '',
	order 	: '',
};

const filterData = (orderBy) => {
	if(filter.orderBy == ''){
		filter.orderBy = orderBy;
	}

	filter.order = filter.order == 'desc' || filter.order == '' ? 'asc' : 'desc';

	if(filter.orderBy != orderBy){
		filter.orderBy 	= orderBy;
		filter.order 	= 'asc'
	}

	router.get(route(props.forIndexPath), { orderBy: filter.orderBy,order:filter.order }, {preserveState: true});
}

const deleteMe = (id) => {
    if(confirm('are you sure')){
    	router.get(route(props.forDeletePath,id));
    }
}

</script>
<template>
	<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
		<div class="p-4" v-if="forIndexPath != '' ">
	        <Search :path="forIndexPath"/>
	    </div>
	    <table class="table-auto min-w-full divide-y divide-gray-200">
	        <thead class="bg-gray-50  text-gray-500 text-xs font-medium  uppercase tracking-wider">
	            <tr>
	                <th scope="col" class="px-6 py-3">
	                    S.No
	                </th>
	                <th v-for="(name,key,index) in theaders" :key="index" scope="col" class="px-6 py-3">
	                	<div class="flex items-center">
	                        {{ name }}
	                        <a href="#" @click="filterData(key)" v-if="forIndexPath != '' ">
	                        	<svg class="w-3 h-3 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
							    	<path d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z"/>
							  	</svg>
							</a>
						</div>
	                </th>
	                <th colspan="2" scope="col" class="px-6 py-3">
	                    Action
	                </th>
	            </tr>
	        </thead>
	        <tbody class="bg-white divide-y divide-gray-200 text-xs text-gray-500">
	            <tr v-if="props.items.data.length != 0" v-for="(item,index) in items.data" :key="item.id">
	                <td class="px-6 py-4 text-black-600 text-center">
	                    {{ items.from+index }}
	                </td>
	                <td v-for="(name,key,i) in theaders" :key="i" class="px-6 py-4 text-black-600">
	                    <span v-if="typeof item[key] === 'object' ">{{item[key]['name']}}</span>
	                    <span v-else>{{ item[key] }}</span>
	                </td>
	                <td>
	                	<div v-if="forEditPath != '' ">
	                		<Link :href="route(forEditPath,item.id)" class="text-indigo-600 hover:text-indigo-900">
								<span title="Edit" class="cursor-pointer text-black-600 hover:text-black-900">
									<span><Edit class="w-4 h-4" /></span>
							    </span>
							</Link>
	                	</div>
	                </td>
	                <td>
	                	<div v-if="forDeletePath != '' ">
	                		<span @click="deleteMe(item.id)" title="Delete" class="cursor-pointer text-red-600 hover:text-red-900">
								<span title="Delete" class="cursor-pointer text-red-600 hover:text-red-900">
									<span><Trash class="w-4 h-4" /></span>
							    </span>
							</span>	                	
						</div>
	                </td>
	            </tr>
	            <tr v-else>
	            	<td class="px-6 py-4 text-black-600 text-center" :colspan='`${Object.keys(props.theaders).length+2}`'>Data Not Found</td>
	            </tr>
	        </tbody>
	    </table>
	</div>
	<Pagination v-if="props.items.data.length != 0" :pageData="items" pageof="Customers"/>
</template>