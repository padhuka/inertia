<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Table from "@/Components/Table.vue";
import TableRow from "@/Components/TableRow.vue";
import TableHeaderCell from "@/Components/TableHeaderCell.vue";
import TableDataCell from "@/Components/TableDataCell.vue";
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps(["roles"]);
const form = useForm({});

const showConfirmDeleteRoleModal = ref(false);
const confirmDeleteRole = () => {
    showConfirmDeleteRoleModal.value = true;
};

const closeModal = () => {
    showConfirmDeleteRoleModal.value = false;
};
const deleteRole = (id) => {
    form.delete(route("roles.destroy", id), {
        onSuccess: () => closeModal(),
    });
};
</script>

<template>
    <Head title="Dashboard" />

    <AdminLayout>
        <div class="max-w-7xl mx-auto py-4">
            <div class="flex justify-between">
                <h1>Role Index Page!</h1>
                <Link
                    :href="route('roles.create')"
                    class="px-3 py-2 text-white font-semibold bg-indigo-500 hover:bg-indigo-700 rounded"
                >
                    New Role
                </Link>
            </div>
            <div class="mt-6">
                <Table>
                    <template #header>
                        <TableRow>
                            <TableHeaderCell>ID</TableHeaderCell>
                            <TableHeaderCell>Name</TableHeaderCell>
                            <TableHeaderCell>Action</TableHeaderCell>
                        </TableRow>
                    </template>
                    <template #default>
                        <TableRow
                            v-for="role in roles"
                            :key="role.id"
                            class="border-b"
                        >
                            <TableDataCell>{{ role.id }}</TableDataCell>
                            <TableDataCell>{{ role.name }}</TableDataCell>
                            <TableDataCell class="space-x-4">
                                <Link
                                    :href="route('roles.edit', role.id)"
                                    class="text-green-400 hover:text-green-700"
                                >
                                    Edit
                                </Link>
                                <button
                                    @click="confirmDeleteRole"
                                    class="text-red-400 hover:text-red-700"
                                >
                                    Delete
                                </button>
                                <Modal
                                    :show="showConfirmDeleteRoleModal"
                                    @close="closeModal"
                                >
                                    <div class="p-6">
                                        <h2
                                            class="text-lg fonto-semibold text-slate-800"
                                        >
                                            Are you sure to delete this role ?
                                        </h2>
                                        <div class="mt-6 flex space-x-4">
                                            <DangerButton
                                                @click="deleteRole(role.id)"
                                                >Delete</DangerButton
                                            >
                                            <SecondaryButton @click="closeModal"
                                                >Cancel</SecondaryButton
                                            >
                                        </div>
                                    </div>
                                </Modal>
                            </TableDataCell>
                        </TableRow>
                    </template>
                </Table>
            </div>
        </div>
    </AdminLayout>
</template>
