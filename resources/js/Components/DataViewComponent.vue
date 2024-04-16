<template>
    <div style="" class="container">
        <table id="dataTable" class="display">
            <thead class="table">
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>points</th>
                    <th>link</th>
                    <td>posted at</td>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody class="table">
                <!-- Data rows will be populated here -->
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3';
import {  onMounted } from 'vue';

const { data } = defineProps(['data']);

let table;

onMounted(() => {
    table = $('#dataTable').DataTable({
        "paging": true,
        "pageLength": 10,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "data": data,
        "columns": [
            {"data":"id"},
            {"data":"title"},
            {"data":"points"},
            {"data":"link"},
            {"data":"posted_at"},
            {
                "data": null,
                "render": function (data, type, row) {
                    return '<button class="remove-button">Remove</button>';
                }
            }
        ]
    });

    // Event delegation for Remove button click
    $('#dataTable tbody').on('click', '.remove-button', function () {
        const rowData = table.row($(this).parents('tr')).data();
        handleRemoveButtonClick(rowData.id);
    });
});

// Function to handle button click for row removal
function handleRemoveButtonClick(id) {
    const rowIndex = table.rows().eq(0).filter(function (rowIdx) {
        return table.cell(rowIdx, 0).data() === id;
    });

    // Remove the row
    if (rowIndex.length > 0) {
        table.row(rowIndex).remove().draw(false);
        router.post('deleteRow', { id })
    }
}
</script>

<style scoped>
    .container {
        padding-top: 2rem;
    }

    .display {
        margin-top: 5rem;
        width: 90%;
        margin: 0 auto;
        border: 2px black solid;
    }
    .table {
        margin-top: 2rem;
        padding-top: 2rem;
    }
    
    
</style>