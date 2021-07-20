<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Team Members
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div>
                        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                            <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-if="flashErrors.message">
                                <div class="flex">
                                    <div>
                                        <p class="text-sm">{{ flashErrors.message }}</p>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <button @click="openModal()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded my-3">Create New Member</button>
                            </div>

                            <table class="table-auto min-w-full leading-normal">
                                <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Telephone</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Joined</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Current routes</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Comments</th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="item in teamMembersList.data" :key="item.id">
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ item.name }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ item.email }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ item.telephone }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ item.joined_date }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ item.current_route }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ item.comments }}</td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <button @click="edit(item)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 mr-1 rounded">Edit</button>
                                        <button @click="deleteRow(item)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">Delete</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                            <pagination class="mt-6" :links="teamMembersList.links"/>

                        </div>
                    </div>

                    <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                            <div class="fixed inset-0 transition-opacity">
                                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                            </div>

                            <!-- This element is to trick the browser into centering the modal contents. -->

                            <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                <form>
                                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                        <div class="">
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput1" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter name" v-model="form.name">
                                                <div v-if="pageErrors.full_name" class="text-red-500">{{ pageErrors.full_name[0] }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput3" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                                                <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput3" placeholder="Enter email" v-model="form.email">
                                                <div v-if="pageErrors.email" class="text-red-500">{{ pageErrors.email[0] }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput4" class="block text-gray-700 text-sm font-bold mb-2">Telephone number:</label>
                                                <input type="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput4" placeholder="Enter telephone number" v-model="form.telephone">
                                                <div v-if="pageErrors.telephone" class="text-red-500">{{ pageErrors.telephone[0] }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput2" class="block text-gray-700 text-sm font-bold mb-2">Joined date:</label>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput2" placeholder="Enter joined date" v-model="form.joined_date">
                                                <div v-if="pageErrors.joined_date" class="text-red-500">{{ pageErrors.joined_date[0] }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput5" class="block text-gray-700 text-sm font-bold mb-2">Current route:</label>
                                                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput5" placeholder="Enter current route" v-model="form.current_route">
                                                <div v-if="pageErrors.current_route" class="text-red-500">{{ pageErrors.current_route[0] }}</div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="exampleFormControlInput6" class="block text-gray-700 text-sm font-bold mb-2">Comments:</label>
                                                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput6" placeholder="Enter comments" v-model="form.comments"></textarea>
                                                <div v-if="pageErrors.comments" class="text-red-500">{{ pageErrors.comments[0] }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                          <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="!editMode" @click="save(form)">Save</button>
                                        </span>
                                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                          <button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="editMode" @click="update(form)">Update</button>
                                        </span>
                                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                          <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">Cancel</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Pagination from '@/Components/Pagination'

export default {
    props: {
        teamMembersList: Object,
        errors: Object,
        flash: Object,
    },
    components: {
        AppLayout,
        Pagination,
    },
    data() {
        return {
            editMode: false,
            isOpen: false,
            form: {
                name: null,
                email: null,
                telephone: null,
                joined_date: null,
                current_route: null,
                comments: null,
            },
            pageErrors: Object,
            flashErrors: Object,
        }
    },
    watch: {
        $page (newData,oldData) {
            this.updatePageErrors()
            this.updateFlashErrors()
        }
    },
    methods: {
        openModal: function () {
            this.isOpen = true;
        },
        closeModal: function () {
            this.isOpen = false;
            this.reset();
            this.editMode=false;
        },
        reset: function () {
            this.form = {
                name: null,
                email: null,
                telephone: null,
                joined_date: null,
                current_route: null,
                comments: null,
            }
        },
        save: function (data) {
            this.$inertia.post('/team-members', data, { preserveState:false })
            this.reset();
            this.closeModal();
            this.editMode = false;
        },
        edit: function (data) {
            this.form = Object.assign({}, data);
            this.editMode = true;
            this.openModal();
        },
        update: function (data) {
            data._method = 'PUT';
            this.$inertia.post('/team-members/' + data.id, data, { preserveState:false })
            console.log(this.errors)
            this.reset();
            this.closeModal();
        },
        deleteRow: function (data) {
            if (!confirm('Are you sure want to remove?')) return;
            data._method = 'DELETE';
            this.$inertia.post('/team-members/' + data.id, data, { preserveState:false })
            this.reset();
            this.closeModal();
        },
        updatePageErrors() {
            this.pageErrors = this.$page.props.errors
        },
        updateFlashErrors() {
            this.flashErrors = this.$page.props.flash
        },
    },
}
</script>
